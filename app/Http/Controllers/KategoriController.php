<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Input::get('status');

        $kategori = null;
        if($status == 0){
            $kategori = DB::table('tbl_kategori')
                ->join('tbl_kategori_status', 'tbl_kategori.status_id', '=', 'tbl_kategori_status.id')
                ->select('tbl_kategori.*', 'tbl_kategori_status.nama AS status_name')
                ->get();
        }else if($status == 1 || $status == 2){
            $kategori = DB::table('tbl_kategori')
                ->join('tbl_kategori_status', 'tbl_kategori.status_id', '=', 'tbl_kategori_status.id')
                ->where('tbl_kategori.status_id', '=', $status)
                ->select('tbl_kategori.*', 'tbl_kategori_status.nama AS status_name')
                ->get();
        }

        $metacode = [
            "code" => 200,
            "message" => "Berhasil get list data kategori!",
        ];

        $response = [
            "meta" => $metacode,
            "data" => $kategori,
        ];

        return response()->json($response, 200);
    }
    
    public function add(Request $request)
    {
        $nama = $request->get('nama');
        $deskripsi = $request->get('deskripsi');
        $status_id = $request->get('status_id');
        

        DB::table('tbl_kategori')->insert([
            'nama' => $nama,
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
        $deskripsi = $request->get('deskripsi');
        $status_id = $request->get('status_id');
        

        DB::table('tbl_kategori')->where('id', '=', $id)->update([
            'nama' => $nama,
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
        

        DB::table('tbl_kategori')->where('id', '=', $id)->delete();

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
