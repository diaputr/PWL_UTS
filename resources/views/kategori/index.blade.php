@extends('layouts.template')

@push('custom_css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="card">
  <!-- /.card-header -->
  <div class="card-header">
    <a href="{{ route('kategori.create') }}" class="btn btn-outline-success">Tambah</a>
  </div>
  <div class="card-body">
    <table id="tabelku" class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">No</th>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php
        $i = 1;
        @endphp
        @foreach ($kategoris as $item)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $item->nama}}</td>
          <td>{{ $item->deskripsi}}</td>
          <td>
            <form method="POST" action="{{ route('kategori.destroy', $item->id) }}">
              <div class="btn-group">
                <!-- Bikin tombol edit dan delete -->
                <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-sm btn-warning">edit</a>

                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">hapus</button>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!-- /.card -->
@endsection

@push('custom_js')
@push('custom_js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
        $('#tabelku').DataTable();
      });
</script>
@endpush
@endpush