<?php

namespace App\Http\Controllers\Sentimen;

use App\Http\Controllers\Controller;
use App\Models\Clustering;
use App\Models\KNN;
use Illuminate\Http\Request;

class KNNController extends Controller
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
        $datas = KNN::all();
        
        return view('sentimen.knn', compact('datas'));
    }

    public function start_knn()
    {
        $datas = Clustering::all()->toArray();

        foreach ($datas as $data) {
            $content['username'] = $data['username'];
            $content['content'] = $data['content'];
            $content['cluster'] = $data['cluster'];

            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/knn/post/');
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
    
        curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/knn/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close ($ch);

        $response = json_decode($response);
        $classification_report = json_decode($response->data->classification_report);
        $f1score = 'f1-score';

        KNN::query()->truncate();
        KNN::create([
            'precision' => json_encode($classification_report->precision),
            'recall' => json_encode($classification_report->recall),
            'f1-score' => json_encode($classification_report->$f1score),
            'support' => json_encode($classification_report->support),
            'accuracy' => $response->data->accuracy,
        ]);

        return true;
    }

    public function reset_knn()
    {
        $raw = KNN::count();

        if ($raw) {
            KNN::query()->truncate();

            // Reset db in django python via API's
            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/knn/reset/');
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
