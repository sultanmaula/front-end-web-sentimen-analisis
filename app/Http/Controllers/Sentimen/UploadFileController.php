<?php

namespace App\Http\Controllers\Sentimen;

use App\Http\Controllers\Controller;
use App\Models\RawData;
use Illuminate\Http\Request;
use App\Imports\DataImport;
use Alert;
use Maatwebsite\Excel\Facades\Excel;

class UploadFileController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = RawData::all();

        return view('sentimen.upload_file', compact('datas'));
    }

    public function import(Request $request)
    {
        if ($request->hasFile('excel')) {
            $excel = $request->file('excel');
            $name = time().'_'.$excel->getClientOriginalName();
            $destinationPath = storage_path('app/public/uploads/excel');
            if(file_exists($destinationPath.$name)) {
                unlink($destinationPath);
            }
            RawData::query()->truncate();
            $new_file = $excel->move($destinationPath, $name);
            Excel::import(new DataImport, $new_file);

            toast('Successfully upload file excel!', 'success');
            return redirect()->back();
        }
        return 'No File';
    }

    public function reset_raw_data()
    {
        $raw = RawData::count();

        if ($raw) {
            RawData::query()->truncate();
    
            toast('Successfully deleted data!', 'error')->autoClose(5000);
        } else {
            toast('Data is empty!', 'warning')->autoClose(5000);
        }

        return redirect()->back();
    }
}
