<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk_transaksi;
use Illuminate\Support\Facades\Auth;


class ProdukTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Pembeli')) {
            $produk_transaksi = $user->produk_transaksi()->orderBy('id', 'DESC')->get();
        } else {
            $produk_transaksi = Produk_transaksi::orderBy('id', 'DESC')->get();
        }
        return view('admin.produk_transaksi.index', compact('produk_transaksi'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('admin.produk_transaksi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(produk_transaksi $produk_transaksi)
    {
        $produk_transaksi = Produk_transaksi::with('Detail_transaksi.Produk')->find($produk_transaksi->id);
        return view('admin.produk_transaksi.detail_transaksi', compact('produk_transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk_transaksi $produk_transaksi)
    {
        return view('admin.produk_transaksi.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, produk_transaksi $produk_transaksi)
    {
        return view('admin.produk_transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk_transaksi $produk_transaksi)
    {
        //
    }
}
