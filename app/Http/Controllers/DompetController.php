<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DompetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Input::get('status');

        
        $dompet = null;
        if($status == 0){
            $dompet = DB::table('tbl_dompet')
                ->join('tbl_dompet_status', 'tbl_dompet.status_id', '=', 'tbl_dompet_status.id')
                ->select('tbl_dompet.*', 'tbl_dompet_status.nama AS status_name')
                ->get();
        }else if($status == 1 || $status == 2){
            $dompet = DB::table('tbl_dompet')
                ->join('tbl_dompet_status', 'tbl_dompet.status_id', '=', 'tbl_dompet_status.id')
                ->where('tbl_dompet.status_id', '=', $status)
                ->select('tbl_dompet.*', 'tbl_dompet_status.nama AS status_name')
                ->get();
        }

        $metacode = [
            "code" => 200,
            "message" => "Berhasil get list data dompet!",
        ];

        $response = [
            "meta" => $metacode,
            "data" => $dompet,
        ];

        return response()->json($response, 200);
    }
    
    public function add(Request $request)
    {
        $nama = $request->get('nama');
        $referensi = $request->get('referensi');
        $deskripsi = $request->get('deskripsi');
        $status_id = $request->get('status_id');
        

        DB::table('tbl_dompet')->insert([
            'nama' => $nama,
            'referensi' => $referensi,
            'deskripsi' => $deskripsi,
            'status_id' => $status_id,
        ]);

        $metacode = [
            "code" => 200,
            "message" => "Berhasil tambah data!",
        ];

        $response = [
            "meta" => $metacode,
        ];

        return response()->json($response, 200);
        // return json_encode($data);
    }
    
    public function edit(Request $request)
    {
        $id = $request->get('id');
        $nama = $request->get('nama');
        $referensi = $request->get('referensi');
        $deskripsi = $request->get('deskripsi');
        $status_id = $request->get('status_id');
        

        DB::table('tbl_dompet')->where('id', '=', $id)->update([
            'nama' => $nama,
            'referensi' => $referensi,
            'deskripsi' => $deskripsi,
            'status_id' => $status_id,
        ]);

        $metacode = [
            "code" => 200,
            "message" => "Berhasil ubah data!",
        ];

        $response = [
            "meta" => $metacode,
        ];

        return response()->json($response, 200);
    }
    
    public function delete(Request $request)
    {
        $id = $request->get('id');
        

        DB::table('tbl_dompet')->where('id', '=', $id)->delete();

        $metacode = [
            "code" => 200,
            "message" => "Berhasil delete data!",
        ];

        $response = [
            "meta" => $metacode,
        ];

        return response()->json($response, 200);
    }

}
