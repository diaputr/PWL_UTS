<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buku.index', [
            'title' => 'List Buku',
            'buku' => Buku::all()->sortBy('kode', descending: true),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.form-buku', [
            "title" => "Tambah Buku", "url_form" => url('/buku'),
            'kategori' => Kategori::all()->sortBy('nama', descending: true),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|max:6',
            'kategori_id' => 'required',
            'judul' => 'required|max:50',
            'penulis' => 'required|max:30',
            'penerbit' => 'required|max:30',
            'th_terbit' => 'required|max:4',
        ]);

        try {
            $kategori = Kategori::find($request->kategori_id);
            Buku::create($request->except('_token'))->each(function ($buku) use ($kategori) {
                $buku->kategori()->associate($kategori);
                $buku->save();
            });

            return redirect()->route('buku.index')
                ->with('success', 'Data Buku Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')
                ->with('error', 'Data Buku Gagal Ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('buku.form-buku',  ["title" => "Edit Buku", "url_form" => route('buku.update', [$id]), "buku" => $buku, 'kategori' => Kategori::all()->sortBy('nama', descending: true),]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|max:6',
            'kategori_id' => 'required',
            'judul' => 'required|max:50',
            'penulis' => 'required|max:30',
            'penerbit' => 'required|max:30',
            'th_terbit' => 'required|max:4',
        ]);

        try {
            $kategori = Kategori::find($request->kategori_id);
            Buku::find($id)->update($request->except('_token'));

            return redirect()->route('buku.index')
                ->with('success', 'Data Buku Berhasil Diubah!');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')
                ->with('error', 'Data Buku Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Buku::find($id)->delete();

            return redirect()->route('buku.index')
                ->with('success', 'Data Buku Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')
                ->with('error', 'Data Buku Gagal Dihapus!');
        }
    }
}
