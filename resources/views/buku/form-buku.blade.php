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
            {!! isset($buku) ? method_field('PUT') : '' !!}

            <div class="form-group">
                <label for="kode">Kode Buku</label>
                <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode"
                    value="{{ isset($buku) ? $buku->kode : 'BK' . rand(1, 9999) }}" id="kode" readonly>
                @error('kode')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                    value="{{ isset($buku) ? $buku->judul : old('judul') }}" placeholder="Masukkan Judul" id="judul">
                @error('judul')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori_id" id="kategori_id"
                    class="form-control select2bs4 @error('kategori_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $item)
                    <option value="{{ $item->id }}" {{ isset($buku) && $buku->kategori_id == $item->id ? 'selected' : ''
                        }}>
                        {{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis"
                    value="{{ isset($buku) ? $buku->penulis : old('penulis') }}" placeholder="Masukkan Penulis"
                    id="penulis">
                @error('penulis')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit"
                    value="{{ isset($buku) ? $buku->penerbit : old('penerbit') }}" placeholder="Masukkan Penerbit"
                    id="penerbit">
                @error('penerbit')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="th_terbit">Tahun Terbit</label>
                <input type="number" class="form-control @error('th_terbit') is-invalid @enderror" name="th_terbit"
                    value="{{ isset($buku) ? $buku->th_terbit : old('th_terbit') }}" placeholder="Masukkan Tahun Terbit"
                    id="th_terbit">
                @error('th_terbit')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
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