<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori')->orderBy('id', 'desc')->get();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'foto' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('produk_foto', 'public');
                $validated['foto'] = $fotoPath;
            }

            $validated['slug'] = Str::slug($validated['nama']);

            Produk::create($validated);

            DB::commit();
            return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'system_error' => 'Terjadi kesalahan sistem! ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {

        return view('admin.produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $kategori = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:produk,slug,' . $produk->id,
            'foto' => 'sometimes|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'harga' => 'sometimes|numeric|min:0',
            'deskripsi' => 'sometimes|string',
            'kategori_id' => 'sometimes|exists:kategori,id',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('produk_foto', 'public');
                $validated['foto'] = $fotoPath;
            }

            if (isset($validated['nama'])) {
                $validated['slug'] = Str::slug($validated['nama']);
            }

            $produk->update($validated);

            DB::commit();
            return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'system_error' => 'Terjadi kesalahan sistem! ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        DB::beginTransaction();

        try {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $produk->delete();
            DB::commit();
            return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'system_error' => 'Terjadi kesalahan sistem! ' . $e->getMessage(),
            ]);
        }
    }
}
