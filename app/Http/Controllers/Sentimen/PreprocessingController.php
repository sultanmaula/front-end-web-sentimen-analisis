<?php

namespace App\Http\Controllers\Sentimen;

use App\Http\Controllers\Controller;
use App\Models\Preprocessing;
use App\Models\RawData;

class PreprocessingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $datas = Preprocessing::all();

        return view('sentimen.preprocessing', compact('datas'));
    }

    public function start_preprocessing()
    {
        $datas = RawData::all()->toArray();

        foreach ($datas as $data) {
            $content['username'] = $data['username'];
            $content['content'] = $data['content'];

            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/preprocessing/post/');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type:application/json'
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            curl_exec($ch);
            curl_close ($ch);
        }

        $this->save_to_db();

        return redirect()->back();
    }

    static function save_to_db()
    {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/preprocessing/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close ($ch);

        $response = json_decode($response);

        /* 1 = id, 2 = username, 3 = content, 4 = review_tokens, 5 = review_tokens_fdist, 
        6 = review_tokens_WSW, 7 = review_normalized, 8 = review_tokens_stemmed */

        Preprocessing::query()->truncate();
        foreach ($response->id as $key => $value) {
            Preprocessing::create([
                'username' => $response->username->$key,
                'content' => $response->content->$key,
                'review_tokens' => json_encode($response->review_tokens->$key),
                'review_tokens_fdist' => json_encode($response->review_tokens_fdist->$key),
                'review_tokens_WSW' => json_encode($response->review_tokens_WSW->$key),
                'review_normalized' => json_encode($response->review_normalized->$key),
                'review_tokens_stemmed' => json_encode($response->review_tokens_stemmed->$key),
            ]);
        }

        return true;
    }
    
    public function reset_preprocessing()
    {
        $raw = Preprocessing::count();

        if ($raw) {
            Preprocessing::query()->truncate();

            // Reset db in django python via API's
            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/preprocessing/reset/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_exec($ch);
            curl_close ($ch);
    
            toast('Successfully deleted data!', 'error')->autoClose(5000);
        } else {
            toast('Data is empty!', 'warning')->autoClose(5000);
        }

        return redirect()->back();
    }
}
