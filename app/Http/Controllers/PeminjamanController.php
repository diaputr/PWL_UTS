<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peminjaman.index', [
            'title' => 'List Peminjaman',
            'peminjaman' => Peminjaman::all()->sortBy('id', descending: true),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peminjaman.form-peminjaman', [
            "title" => "Tambah Peminjaman", "url_form" => url('/peminjaman'),
            'buku' => Buku::all(),
            'anggota' => Anggota::all(),
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
            'kode_buku' => 'required|max:6',
            'id_anggota' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
        ]);

        try {
            Peminjaman::create($request->except('_token'));

            return redirect()->route('peminjaman.index')
                ->with('success', 'Data Peminjaman Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Data Peminjaman Gagal Ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('peminjaman.form-peminjaman', [
            "title" => "Edit Peminjaman",
            "url_form" => url('/peminjaman/' . $id),
            "peminjaman" => Peminjaman::find($id),
            'buku' => Buku::all(),
            'anggota' => Anggota::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_buku' => 'required|max:6',
            'id_anggota' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
        ]);

        $buku = $request->except('_token');
        $buku['status'] = $request['status'] == 'on';

        try {
            Peminjaman::find($id)->update($buku);

            return redirect()->route('peminjaman.index')
                ->with('success', 'Data Peminjaman Berhasil Diubah!');
        } catch (\Exception $e) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Data Peminjaman Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Peminjaman::find($id)->delete();

            return redirect()->route('peminjaman.index')
                ->with('success', 'Data Peminjaman Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Data Peminjaman Gagal Dihapus!');
        }
    }
}
