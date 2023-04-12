<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index', [
            'title' => 'List Kategori',
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.form-kategori', ['title' => 'Tambah Kategori', 'url_form' => route('kategori.store'),]);
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
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        try {
            Kategori::create($request->except('_token'));
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kategori gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('kategori.form-kategori', [
            'kategori' => Kategori::find($id),
            'title' => 'Edit Kategori',
            'url_form' => route('kategori.update', $id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        try {
            Kategori::find($id)->update($request->except(['_token', '_method']));
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kategori gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Kategori::find($id)->delete();
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kategori gagal dihapus!');
        }
    }
}
