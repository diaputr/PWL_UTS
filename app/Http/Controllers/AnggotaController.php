<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('anggota.index', [
            'title' => 'List Data Anggota',
            'anggotas' => Anggota::all()->sortBy('id', descending: true),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggota.form-anggota', ["title" => "Tambah Anggota", "url_form" => url('/anggota'),]);
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
            'nama' => 'required|max:100',
            'alamat' => 'required|max:150',
            'no_telp' => 'required|max:20',
        ]);

        try {
            Anggota::create($request->except('_token'));

            return redirect()->route('anggota.index')
                ->with('success', 'Data Anggota Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('anggota.index')
                ->with('error', 'Data Anggota Gagal Ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        return view('anggota.form-anggota', [
            "title" => "Edit Anggota",
            "url_form" => url('/anggota/' . $id),
            "anggota" => Anggota::find($id),
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
            'nama' => 'required|max:100',
            'alamat' => 'required|max:150',
            'no_telp' => 'required|max:20',
        ]);

        try {
            Anggota::find($id)->update($request->except('_token'));

            return redirect()->route('anggota.index')
                ->with('success', 'Data Anggota Berhasil Diubah!');
        } catch (\Exception $e) {
            return redirect()->route('anggota.index')
                ->with('error', 'Data Anggota Gagal Diubah!');
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
            Anggota::find($id)->delete();

            return redirect()->route('anggota.index')
                ->with('success', 'Data Anggota Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('anggota.index')
                ->with('error', 'Data Anggota Gagal Dihapus!');
        }
    }
}
