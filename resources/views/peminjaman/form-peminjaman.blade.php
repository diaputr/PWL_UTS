@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ $url_form }}" method="post">
                @csrf
                {!! isset($peminjaman) ? method_field('PUT') : '' !!}

                {{-- <div class="form-group">
                    <label for="id">ID peminjaman</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                        value="{{ isset($peminjaman) ? $peminjaman->id : 'BK' . rand(1, 9999) }}" id="id" readonly>
                    @error('id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label for="kode_buku">Kode Buku</label>
                    <input type="text" class="form-control @error('kode_buku') is-invalid @enderror" name="kode_buku"
                        value="{{ isset($peminjaman) ? $peminjaman->kode_buku : old('kode_buku') }}"
                        placeholder="Masukkan Kode Buku" id="kode_buku">
                    @error('kode_buku')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_anggota">ID Anggota</label>
                    <input type="text" class="form-control @error('id_anggota') is-invalid @enderror" name="id_anggota"
                        value="{{ isset($peminjaman) ? $peminjaman->id_anggota : old('id_anggota') }}"
                        placeholder="Masukkan ID Anggota" id="id_anggota">
                    @error('id_anggota')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                    <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror" name="tgl_pinjam"
                        value="{{ isset($peminjaman) ? $peminjaman->tgl_pinjam : old('tgl_pinjam') }}"
                        placeholder="Masukkan Tanggal Pinjam" id="tgl_pinjam">
                    @error('tgl_pinjam')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tgl_kembali">Tanggal Kembali</label>
                    <input type="date" class="form-control @error('tgl_kembali') is-invalid @enderror" name="tgl_kembali"
                        value="{{ isset($peminjaman) ? $peminjaman->tgl_kembali : old('tgl_kembali') }}"
                        placeholder="Masukkan Tanggal Kembali" id="tgl_kembali">
                    @error('tgl_kembali')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
