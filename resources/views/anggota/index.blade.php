@extends('layouts.template')

@push('custom_css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('anggota.create') }}" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Tambah</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabelku" class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($anggotas as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->no_telp }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <form method="POST" action="{{ route('anggota.destroy', $item->id) }}">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <!-- Bikin tombol edit dan delete -->
                                        <a href="{{ route('anggota.edit', $item->id) }}" class="btn btn-sm btn-warning"><i
                                                class="fas fa-pen"></i>
                                            edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                            hapus</button>
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
        $(function() {
            $('#tabelku').DataTable({
                "responsive": true
            }).buttons().container().appendTo('#tabelku_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
