@extends('layouts.template')

@push('custom_css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

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
                <label for="kode_buku">Pilih Buku</label>
                <select name="kode_buku" id="kode_buku"
                    class="form-control select2bs4 @error('kode_buku') is-invalid @enderror">
                    <option value="">-- Pilih Buku --</option>
                    @foreach ($buku as $item)
                    <option value="{{ $item->kode }}" {{ isset($peminjaman) && $peminjaman->kode_buku ==
                        $item->kode
                        ?
                        'selected' : ''
                        }}>
                        {{ $item->judul }}</option>
                    @endforeach
                </select>
                @error('kode_buku')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="id_anggota">Anggota</label>
                <select name="id_anggota" id="id_anggota"
                    class="form-control select2bs4 @error('id_anggota') is-invalid @enderror">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach ($anggota as $item)
                    <option value="{{ $item->id }}" {{ isset($peminjaman) && $peminjaman->id_anggota ==
                        $item->id
                        ?
                        'selected' : ''
                        }}>
                        {{ $item->nama }}</option>
                    @endforeach
                </select>
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
            @if (isset($peminjaman))
            <div class="form-group form-check">
                <input type="checkbox" name="status" class="form-check-input @error('status') is-invalid @enderror"
                    id="status">
                <label class="form-check-label" for="status">Dikembalikan</label>
                @error('status')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@push('custom_js')
<!-- Select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });
</script>
@endpush