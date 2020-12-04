<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::paginate(10);
        return view('user.menu', ['menu' => $menu]);
    }
    public function cari(Request $req)
    {
        $menu = Menu::where('namaMenu', $req->cari)->paginate(10);
        $total = Menu::where('namaMenu', $req->cari)->count();
        $data  = array(
            'menu' => $menu,
            'cari' => $req->cari,
            'total' => $total
        );
        return view('user.carimenu', $data);
    }
    public function detail($id)
    {
        $data = array('menu' => Menu::findorFail($id));
        return view('user.menudetail', $data);
    }
}
