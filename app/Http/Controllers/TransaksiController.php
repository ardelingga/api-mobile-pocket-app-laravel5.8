<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status_transaksi = Input::get('status_transaksi');
        $status = Input::get('status');
        
        
        $transaksi = null;

        if($status_transaksi == 0){
            if($status == 0){
                $transaksi = DB::table('tbl_transaksi')
                    ->join('tbl_transaksi_status', 'tbl_transaksi.transaksi_status_id', '=', 'tbl_transaksi_status.id')
                    ->join('tbl_dompet', 'tbl_transaksi.dompet_id', '=', 'tbl_dompet.id')
                    ->join('tbl_kategori', 'tbl_transaksi.kategori_id', '=', 'tbl_kategori.id')
                    ->join('tbl_dompet_status', 'tbl_transaksi.status_id', '=', 'tbl_dompet_status.id')
                    ->select('tbl_transaksi.*', 'tbl_transaksi_status.nama AS transaksi_status_name', 'tbl_dompet.nama AS dompet_name', 'tbl_kategori.nama AS kategori_name', 'tbl_dompet_status.nama AS status_name')
                    ->get();
            }else if($status == 1 || $status == 2){
                $transaksi = DB::table('tbl_transaksi')
                    ->join('tbl_transaksi_status', 'tbl_transaksi.transaksi_status_id', '=', 'tbl_transaksi_status.id')
                    ->join('tbl_dompet', 'tbl_transaksi.dompet_id', '=', 'tbl_dompet.id')
                    ->join('tbl_kategori', 'tbl_transaksi.kategori_id', '=', 'tbl_kategori.id')
                    ->join('tbl_dompet_status', 'tbl_transaksi.status_id', '=', 'tbl_dompet_status.id')
                    ->where('tbl_transaksi.status_id', '=', $status)
                    ->select('tbl_transaksi.*', 'tbl_transaksi_status.nama AS transaksi_status_name', 'tbl_dompet.nama AS dompet_name', 'tbl_kategori.nama AS kategori_name', 'tbl_dompet_status.nama AS status_name')
                    ->get();
            }
        }else if($status_transaksi == 1 || $status_transaksi == 2){
            if($status == 0){
                $transaksi = DB::table('tbl_transaksi')
                    ->join('tbl_transaksi_status', 'tbl_transaksi.transaksi_status_id', '=', 'tbl_transaksi_status.id')
                    ->join('tbl_dompet', 'tbl_transaksi.dompet_id', '=', 'tbl_dompet.id')
                    ->join('tbl_kategori', 'tbl_transaksi.kategori_id', '=', 'tbl_kategori.id')
                    ->join('tbl_dompet_status', 'tbl_transaksi.status_id', '=', 'tbl_dompet_status.id')
                    ->select('tbl_transaksi.*', 'tbl_transaksi_status.nama AS transaksi_status_name', 'tbl_dompet.nama AS dompet_name', 'tbl_kategori.nama AS kategori_name', 'tbl_dompet_status.nama AS status_name')
                    ->where('tbl_transaksi.transaksi_status_id', '=', $status_transaksi)
                    ->get();
            }else if($status == 1 || $status == 2){
                $transaksi = DB::table('tbl_transaksi')
                    ->join('tbl_transaksi_status', 'tbl_transaksi.transaksi_status_id', '=', 'tbl_transaksi_status.id')
                    ->join('tbl_dompet', 'tbl_transaksi.dompet_id', '=', 'tbl_dompet.id')
                    ->join('tbl_kategori', 'tbl_transaksi.kategori_id', '=', 'tbl_kategori.id')
                    ->join('tbl_dompet_status', 'tbl_transaksi.status_id', '=', 'tbl_dompet_status.id')
                    ->where('tbl_transaksi.transaksi_status_id', '=', $status_transaksi)
                    ->where('tbl_transaksi.status_id', '=', $status)
                    ->select('tbl_transaksi.*', 'tbl_transaksi_status.nama AS transaksi_status_name', 'tbl_dompet.nama AS dompet_name', 'tbl_kategori.nama AS kategori_name', 'tbl_dompet_status.nama AS status_name')
                    ->get();
            }
        }
        $metacode = [
            "code" => 200,
            "message" => $status,
            // "message" => "Berhasil get list data transaksi!",
        ];

        $response = [
            "meta" => $metacode,
            "data" => $transaksi,
        ];

        return response()->json($response, 200);
    }
    
    public function add(Request $request)
    {
        $id_generator = $request->get('id_generator');
        $kode = $request->get('kode');
        $deskripsi = $request->get('deskripsi');
        $tanggal = $request->get('tanggal');
        $nilai = $request->get('nilai');
        $transaksi_status_id = $request->get('transaksi_status_id');
        $dompet_id = $request->get('dompet_id');
        $kategori_id = $request->get('kategori_id');
        $status_id = $request->get('status_id');
        

        DB::table('tbl_transaksi')->insert([
            'id' => $id_generator,
            'kode' => $kode,
            'deskripsi' => $deskripsi,
            'tanggal' => $tanggal,
            'nilai' => (int)$nilai,
            'transaksi_status_id' => (int)$transaksi_status_id,
            'dompet_id' => (int)$dompet_id,
            'kategori_id' => (int)$kategori_id,
            'status_id' => (int)$status_id,
        ]);  
        
        
        $metacode = [
            "code" => 200,
            "message" => "Berhasil tambah data!",
            // 'kode' => $kode,
            // 'deskripsi' => $deskripsi,
            // 'tanggal' => $tanggal,
            // 'nilai' => $nilai,
            // 'transaksi_status_id' => $transaksi_status_id,
            // 'dompet_id' => $dompet_id,
            // 'kategori_id' => $kategori_id,
            // 'status_id' => $status_id,
        ];

        $response = [
            "meta" => $metacode,
        ];

        return response()->json($response, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }
    
    public function idGenerator(Request $request){
        $prefix = $request->get('prefix');
        $idGenerator = IdGenerator::generate(['table' => 'tbl_transaksi', 'length' => 10, 'prefix' => date('y')]);

        $kode = $prefix . substr($idGenerator, 4, strlen($idGenerator));

        $metacode = [
            "code" => 200,
            "message" => "Generate ID Success!",
        ];

        $data = [
            "id_generator" => $idGenerator,
            "kode" => $kode
        ];

        $response = [
            "meta" => $metacode,
            "data" => $data,
        ];

        return response()->json($response, 200);
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $id_generator = $request->get('id_generator');
        $kode = $request->get('kode');
        $deskripsi = $request->get('deskripsi');
        $tanggal = $request->get('tanggal');
        $nilai = $request->get('nilai');
        $transaksi_status_id = $request->get('transaksi_status_id');
        $dompet_id = $request->get('dompet_id');
        $kategori_id = $request->get('kategori_id');
        $status_id = $request->get('status_id');
        

        DB::table('tbl_transaksi')->where('id_transaksi', '=', $id)->update([
            'id' => $id_generator,
            'kode' => $kode,
            'deskripsi' => $deskripsi,
            'tanggal' => $tanggal,
            'nilai' => (int)$nilai,
            'transaksi_status_id' => (int)$transaksi_status_id,
            'dompet_id' => (int)$dompet_id,
            'kategori_id' => (int)$kategori_id,
            'status_id' => (int)$status_id,
        ]);

        $metacode = [
            "code" => 200,
            "message" => "Berhasil ubah data!",
            // 'id_transaksi' => $id,
            // 'id' => $id_generator,
            // 'kode' => $kode,
            // 'deskripsi' => $deskripsi,
            // 'tanggal' => $tanggal,
            // 'nilai' => $nilai,
            // 'transaksi_status_id' => $transaksi_status_id,
            // 'dompet_id' => $dompet_id,
            // 'kategori_id' => $kategori_id,
            // 'status_id' => $status_id,
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

    public function store(Request $request){

        $id = IdGenerator::generate(['table' => 'todos', 'length' => 6, 'prefix' => date('y')]);
    
    
    
    }

}
