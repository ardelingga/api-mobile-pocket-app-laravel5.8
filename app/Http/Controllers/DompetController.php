<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DompetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "id" => 1,
            "nama" => "Ardelingga",
        ];
        
        $dompet = DB::table('tbl_dompet')
                // ->join('tbl_menu_users', 'tbl_submenu_users.menu_id', '=', 'tbl_menu_users.id')
                ->select('*')
                ->get();

        return response()->json($dompet, 200);
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
