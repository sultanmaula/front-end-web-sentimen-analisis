<?php

namespace App\Http\Controllers\Sentimen;

use App\Http\Controllers\Controller;
use App\Models\Clustering;
use App\Models\Preprocessing;
use Illuminate\Support\Facades\DB;

class ClusteringController extends Controller
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
        $datas = Clustering::all();

        $charts = DB::table('clustering')->select('cluster', DB::raw('COUNT(cluster) as count'))
                                         ->groupBy('cluster')
                                         ->orderBy('count', 'DESC')
                                         ->get()
                                         ->toArray();

        return view('sentimen.clustering', compact('datas', 'charts'));
    }

    public function cluster()
    {
        $datas = Preprocessing::all()->toArray();

        foreach ($datas as $data) {
            $content['username'] = $data['username'];
            $content['content'] = $data['content'];
            $content['review_tokens_stemmed'] = $data['review_tokens_stemmed'];

            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/clustering/post/');
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
    
        curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/clustering/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close ($ch);

        $response = json_decode($response);

        Clustering::query()->truncate();
        foreach ($response->id as $key => $value) {
            Clustering::create([
                'username' => $response->username->$key,
                'content' => $response->content->$key,
                'cluster' => $response->Cluster->$key,
            ]);
        }

        return true;
    }

    public function reset_clustering()
    {
        $raw = Clustering::count();

        if ($raw) {
            Clustering::query()->truncate();

            // Reset db in django python via API's
            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, 'http://0.0.0.0:354/clustering/reset/');
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
