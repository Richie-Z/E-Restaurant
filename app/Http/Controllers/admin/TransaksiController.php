<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Order;

class TransaksiController extends Controller
{
    public function index()
    {
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 1)
            ->get();
        $data = array(
            'orderbaru' => $order
        );
        return view('admin.transaksi.index', $data);
    }
    public function detail($id, Request $request)
    {
        $detail_order = DB::table('detail_order')
            ->join('menu', 'menu.id', '=', 'detail_order.menu_id')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->select('menu.namaMenu as nama_menu', 'detail_order.*', 'menu.harga', 'order.*')
            ->where('detail_order.order_id', $id)
            ->get();
        $order = DB::table('order')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->select('order.*', 'users.name as nama_pelanggan', 'status_order.name as status')
            ->where('order.id', $id)
            ->first();
        $data = array(
            'detail' => $detail_order,
            'order'  => $order
        );
        return view('admin.transaksi.detail', $data);
    }
    public function perludibayar()
    {
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 2)
            ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.perludibayar', $data);
    }
    public function perludikirim()
    {
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 3)
            ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.perludikirim', $data);
    }
    public function selesai()
    {
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 5)
            ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.selesai', $data);
    }
    public function dibatalkan()
    {
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 4)
            ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.dibatalkan', $data);
    }
    public function ceked($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $order->status_order_id  = 2;
        $order->save();
        return redirect()->route('admin.transaksi.index')->with('status', 'Berhasil Mengonfirmasi Pembayaran Pesanan');
    }
    public function konfirmasi($id)
    {
        $order = Order::findOrFail($id);
        $order->status_order_id = 3;
        $order->save();
        return redirect()->route('admin.transaksi.perludikirim')->with('status', 'Berhasil Mengonfirmasi Pembayaran Pesanan');
    }

    public function inputpesanan($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $order->no_pesanan = $request->no_pesanan;
        $order->save();
        return redirect()->route('admin.transaksi.perludikirim')->with('status', 'Berhasil Menginput No Resi');
    }
}
