<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DompetStatusController extends Controller
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
        
        $dompet_status = DB::table('tbl_dompet_status')
                // ->join('tbl_menu_users', 'tbl_submenu_users.menu_id', '=', 'tbl_menu_users.id')
                ->select('*')
                ->get();

        $metacode = [
            "code" => 200,
            "message" => "Berhasil get list dompet status!",
        ];

        $response = [
            "meta" => $metacode,
            "data" => $dompet_status,
        ];

        return response()->json($response, 200);
    }

}
