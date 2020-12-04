<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return view('admin.menu.index', ['menu' => $menu]);
    }
    public function tambah()
    {
        return view('admin.menu.tambah');
    }
    public function store(Request $request)
    {
        Menu::create([
            'namaMenu' => $request->nama,
            'harga' => $request->harga,
            'description' => $request->description
        ]);

        return redirect()->route('admin.menu.index')->with('status', 'Berhasil Menambah Produk Baru');
    }
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', ['menu' => $menu]);
    }
    public function update($id, Request $request)
    {
        $menu = Menu::findOrFail($id);

        $menu->namaMenu = $request->nama;
        $menu->harga = $request->harga;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->route('admin.menu.index')->with('status', 'Berhasil Mengubah Kategori');
    }
    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        Menu::destroy($id);
        return redirect()->route('admin.menu.index')->with('status', 'Berhasil Mengahapus Produk');
    }
}
