@extends('layouts.template')

@section('content')
<div class="card col-md-6">
  <div class="card-body">
    <form action="{{$url_form}}" method="post">
      @csrf
      {!! isset($anggota)?method_field('PUT'):''!!}

      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
          value="{{(isset($anggota))?$anggota->nama:old('nama') }}" placeholder="Masukkan Nama" id="nama">
        @error('nama')
        <span class="error invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
          value="{{(isset($anggota))?$anggota->alamat:old('alamat') }}" placeholder="Masukkan Alamat" id="alamat">
        @error('alamat')
        <span class="error invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="no_telp">No Telp</label>
        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
          value="{{(isset($anggota))?$anggota->no_telp:old('no_telp') }}" placeholder="Masukkan No Telp" id="no_telp">
        @error('no_telp')
        <span class="error invalid-feedback">{{$message}}</span>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

@endsection