<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class DataUploadController extends Controller
{
    public function companyInfo(Request $request)
    {
        $request->validate([
            'excelfile'=>'required',
        ]);

        if(request()->has('excelfile')){
            // $data = array_map('str_getcsv', file(request()->excelfile));
            $data = file(request()->excelfile);
            

            //Chumk
            $chunks = array_chunk($data, 2500);
            $path = public_path('uploads/csvimport/');

            foreach($chunks as $key => $chunk){
                $name = 'temp'.$key.'.csv';
                file_put_contents($path.$name, $chunk);

            }



            $files = glob("$path/*.csv");
            $header = [];

            foreach($files as $key => $file){
                $data = array_map('str_getcsv', file($file));
                if($key === 0){
                    $header = $data[0];
                    unset($data[0]);
                }
                dispatch(function () use ($data, $header) {
                    foreach($data as $info){
                        $allinfo = array_combine($header, $info);
    
                        CompanyInfo::create($allinfo);
                    }
                });
                
                unlink($file);
            }

            session()->flash('success', 'Data added to queue! All data will be uploaded');
            return redirect()->back();

        }
    }

    public function storeInfo()
    {
        $path = public_path('uploads/csvimport/');
        return 'Stored';
    }
}
