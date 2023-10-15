<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use App\Produk;
use App\Status;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['status','kategori'])->where('status_id',1)->get();
        return view('produk.index', ['produk' => $produk]);
    }

    public function create()
    {
        $Status = Status::all();
        $Kategori = Kategori::all();
        return view('produk.create',compact('Status','Kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori_id' => 'required',
            'status_id' => 'required',
        ]);

        Produk::create($request->all());

        return redirect('/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $Status = Status::all();
        $Kategori = Kategori::all();
        $produk = Produk::find($id);
        return view('produk.edit', compact('Status', 'Kategori','produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori_id' => 'required',
            'status_id' => 'required',
        ]);

        Produk::where('id_produk', $id)->update($request->except('_token', '_method'));

        return redirect('/produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Produk::where('id_produk', $id)->delete();
        return redirect('/produk')->with('success', 'Produk berhasil dihapus!');
    }
}
