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
        $id = $request->get('id');
        $nama = $request->get('nama');
        $username = $request->get('username');
        
        $data = [
            "id" => $id,
            "nama" => $nama,
            "username" => $username,
        ];

        $metacode = [
            "code" => 200,
            "message" => "Berhasil request API!",
        ];

        $response = [
            "meta" => $metacode,
            "data" => $data,
        ];


        
        $dompet = DB::table('tbl_dompet')
                // ->join('tbl_menu_users', 'tbl_submenu_users.menu_id', '=', 'tbl_menu_users.id')
                ->select('*')
                ->get();

        return response()->json($response, 200);
        // return json_encode($data);
    }
    
    public function edit()
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
    
    public function delete()
    {
        $data = [
            "id" => 1,
            "nama" => "Ardelingga",
        ];
        
        $dompet = DB::table('tbl_dompet')
                // ->join('tbl_menu_users', 'tbl_submenu_users.menu_id', '=', 'tbl_menu_users.id')
                ->select('*')
                ->get();

        return json_encode($dompet);
    }

}
