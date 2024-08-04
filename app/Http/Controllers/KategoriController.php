<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('nama', 'desc')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'ikon' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('ikon')) {
                $iconPath = $request->file('ikon')->store('kategori_ikon', 'public');
                $validated['ikon'] = $iconPath;
            }

            $validated['slug'] = Str::slug($validated['nama']);

            Kategori::create($validated);

            DB::commit();
            return redirect()->route('admin.kategori.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori $kategori)
    { {
            $validated = $request->validate([
                'nama' => 'sometimes|string|max:255',
                'ikon' => 'sometimes|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            DB::beginTransaction();

            try {
                if ($request->hasFile('ikon')) {
                    $iconPath = $request->file('ikon')->store('kategori_ikon', 'public');
                    $validated['ikon'] = $iconPath;
                }

                $validated['slug'] = Str::slug($validated['nama']);

                $kategori->update($validated);

                DB::commit();
                return redirect()->route('admin.kategori.index')->with('success', 'Category created successfully!');
            } catch (\Exception $e) {
                DB::rollBack();
                throw ValidationException::withMessages([
                    'system_error' => ['System error! ' . $e->getMessage()],
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori $kategori)
    {
        DB::beginTransaction();

        try {
            if ($kategori->foto) {
                Storage::disk('public')->delete($kategori->foto);
            }
            $kategori->delete();
            DB::commit();
            return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'system_error' => 'Terjadi kesalahan sistem! ' . $e->getMessage(),
            ]);
        }
    }
}
