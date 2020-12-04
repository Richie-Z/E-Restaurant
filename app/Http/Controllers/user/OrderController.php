<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Detailorder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
	public function index(){
		$user_id = \Auth::user()->id;

		$order = DB::table('order')
					->join('status_order','status_order.id','=','order.status_order_id')
					->select('order.*','status_order.name')
					->where('order.status_order_id',1)
					->where('order.user_id',$user_id)->get();
		$dicek = DB::table('order')
					->join('status_order','status_order.id','=','order.status_order_id')
					->select('order.*','status_order.name')
					->where('order.status_order_id','!=',1)
					->where('order.status_order_id','!=',3)
					->where('order.status_order_id','!=',4)
					->where('order.status_order_id','!=',5)
					->where('order.user_id',$user_id)->get();
		$dibayar = DB::table('order')
					->join('status_order','status_order.id','=','order.status_order_id')
					->select('order.*','status_order.name')
					->where('order.status_order_id',3)
					->where('order.user_id',$user_id)->get();
		$histori = DB::table('order')
					->join('status_order','status_order.id','=','order.status_order_id')
					->select('order.*','status_order.name')
					->where('order.status_order_id','!=',1)
					->where('order.status_order_id','!=',2)
					->where('order.status_order_id','!=',3)
					->where('order.user_id',$user_id)->get();
		$data = array(
			'order' => $order,
			'dicek' => $dicek,
			'dibayar'=> $dibayar,
			'histori'=>$histori,
		);
		return view('user.order.order',$data);
	}
	public function detail($id){
		$detail_order = DB::table('detail_order')
		->join('menu','menu.id','=','detail_order.menu_id')
		->join('order','order.id','=','detail_order.order_id')
		->select('menu.namaMenu as nama_menu','detail_order.*','menu.harga','order.*')
		->where('detail_order.order_id',$id)
		->get();
		$order = DB::table('order')
		->join('users','users.id','=','order.user_id')
		->join('status_order','status_order.id','=','order.status_order_id')
		->select('order.*','users.name as nama_pelanggan','status_order.name as status')
		->where('order.id',$id)
		->first();
		$data = array(
			'detail' => $detail_order,
			'order'  => $order
		);
		return view('user.order.detail',$data);
	}

	public function sukses(){
		return view('user.terimakasih');
	}
	public function pesanan(Request $request){
        //untuk menyimpan pesanan ke table order
		$cek_invoice = DB::table('order')->where('invoice',$request->invoice)->count();
		if($cek_invoice < 1){
			$userid = \Auth::user()->id;
			Order::create([
				'invoice' => $request->invoice,
				'user_id' => $userid,
				'subtotal'=> $request->subtotal,
				'status_order_id' => 1
			]);

			$order = DB::table('order')->where('invoice',$request->invoice)->first();

			$barang = DB::table('keranjang')->where('user_id',$userid)->get();
        //lalu masukan barang2 yang dibeli ke table detail order
			foreach($barang as $brg){
				Detailorder::create([
					'order_id' => $order->id,
					'menu_id' => $brg->menu_id,
					'qty' => $brg->qty,
				]);
			}
        //lalu hapus data produk pada keranjang pembeli
			DB::table('keranjang')->where('user_id',$userid)->delete();
			return redirect()->route('user.order.sukses');
		}else{
			return redirect()->route('user.keranjang');
		}
	}
	public function pesanandibatalkan($id)
	{
        //function untuk membatalkan pesanan
		$order = Order::findOrFail($id);
		$order->status_order_id = 4;
		$order->save();

		return redirect()->route('user.order');

	}
	public function pembayaran($id){
		$order = Order::findOrFail($id);
        return view('user.order.pembayaran',['order'=>$order]);
	}
	public function sudah($id){
		$order = Order::findOrFail($id);
        $order->status_order_id = 5;
        $order->save();

        return redirect()->route('user.order');
	}
}
