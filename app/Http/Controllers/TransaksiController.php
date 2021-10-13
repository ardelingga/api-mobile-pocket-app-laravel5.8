<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $kategori = DB::table('tbl_transaksi')
                // ->join('tbl_menu_users', 'tbl_submenu_users.menu_id', '=', 'tbl_menu_users.id')
                ->select('*')
                ->get();

        $metacode = [
            "code" => 200,
            "message" => "Berhasil get list data transaksi!",
        ];

        $response = [
            "meta" => $metacode,
            "data" => $kategori,
        ];

        return response()->json($response, 200);
    }
    
    public function add(Request $request)
    {
        $kode = $request->get('kode');
        $deskripsi = $request->get('deskripsi');
        $tanggal = $request->get('tanggal');
        $nilai = $request->get('nilai');
        $dompet_id = $request->get('dompet_id');
        $kategori_id = $request->get('kategori_id');
        $status_id = $request->get('status_id');
        

        DB::table('tbl_transaksi')->insert([
            'kode' => $kode,
            'deskripsi' => $deskripsi,
            'tanggal' => $tanggal,
            'nilai' => $nilai,
            'dompet_id' => $dompet_id,
            'kategori_id' => $kategori_id,
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
        $kode = $request->get('kode');
        $deskripsi = $request->get('deskripsi');
        $tanggal = $request->get('tanggal');
        $nilai = $request->get('nilai');
        $dompet_id = $request->get('dompet_id');
        $kategori_id = $request->get('kategori_id');
        $status_id = $request->get('status_id');
        

        DB::table('tbl_transaksi')->where('id', '=', $id)->update([
            'kode' => $kode,
            'deskripsi' => $deskripsi,
            'tanggal' => $tanggal,
            'nilai' => $nilai,
            'dompet_id' => $dompet_id,
            'kategori_id' => $kategori_id,
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
        

        DB::table('tbl_transaksi')->where('id', '=', $id)->delete();

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
