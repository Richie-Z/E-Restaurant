<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
	public function index(){
		$data = array(
			'menu' => DB::table('menu')->limit(10)->get(),
		);
		return view('user.welcome',$data);
	}
	public function kontak(){
		return view ('user.kontak');
	}
}
