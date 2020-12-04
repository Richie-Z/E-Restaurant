<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $id_user = \Auth::user()->id;
        $keranjangs = DB::table('keranjang')
            ->join('users', 'users.id', '=', 'keranjang.user_id')
            ->join('menu', 'menu.id', '=', 'keranjang.menu_id')
            ->select('menu.namaMenu as nama_menu', 'users.name', 'keranjang.*', 'menu.harga')
            ->where('keranjang.user_id', '=', $id_user)
            ->get();
        $data = [
            'invoice' => 'RICHIE' . Date('Ymdhi'),
            'keranjangs' => $keranjangs
        ];
        return view('user.checkout', $data);
    }
}
