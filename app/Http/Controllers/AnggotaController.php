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
        if (request('search')) {
            $anggotas = Anggota::where('nama', 'like', '%' . request('search') . '%')
                ->orWhere('alamat', 'like', '%' . request('search') . '%')
                ->orWhere('no_telp', 'like', '%' . request('search') . '%')
                ->paginate(10);
        } else {
            $anggotas = Anggota::paginate(10);
        }
        return view('anggota.index', [
            'title' => 'List Data Anggota',
            'anggotas' => $anggotas,
        ]);
    }

    public function getAnggota(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $totalRecords = Anggota::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Anggota::select('count(*) as allcount')
            ->where('nama', 'like', '%' . $searchValue . '%')
            ->orWhere('alamat', 'like', '%' . $searchValue . '%')
            ->orWhere('no_telp', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records
        $records = Anggota::orderBy($columnName, $columnSortOrder)
            ->where('anggotas.nama', 'like', '%' . $searchValue . '%')
            ->orWhere('anggotas.alamat', 'like', '%' . $searchValue . '%')
            ->orWhere('anggotas.no_telp', 'like', '%' . $searchValue . '%')
            ->select('anggotas.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $r) {

            $data_arr[] = array(
                "no" => $sno++,
                "id" => $r->id,
                "nama" => $r->nama,
                "alamat" => $r->alamat,
                "no_telp" => $r->no_telp,
                "action" => '<form method="POST" action="' . route('anggota.destroy', $r->id) . '">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <!-- Bikin tombol edit dan delete -->
                                        <a href="' . route('anggota.edit', $r->id) . '" class="btn btn-sm btn-warning"><i
                                                class="fas fa-pen"></i>
                                            edit</a>

                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger btndelete show_confirm"
                                            data-toggle="tooltip" title="Delete"> <i class="fas fa-trash"></i>
                                            hapus</button>
                                    </div>
                                </form>',
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
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
            Anggota::findOrFail($id)->delete();

            return response()
                ->json(['status' => 'Data Anggota Berhasil Dihapus!']);
        } catch (\Exception $e) {
            return redirect()->route('anggota.index')
                ->with('error', 'Data Anggota Gagal Dihapus!');
        }
    }
}
