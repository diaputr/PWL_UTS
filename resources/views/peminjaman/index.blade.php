@extends('layouts.template')

@push('custom_css')
<!-- DataTables -->
{{--
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ url('peminjaman/create') }}" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Tambah</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('peminjaman.index')}}" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Cari Peminjaman" name="search"
                aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama Buku</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($peminjaman->count() > 0)
                @php $no = $peminjaman->firstItem(); @endphp
                @foreach ($peminjaman as $item)
                <tr>
                    <input type="hidden" class="delete_id" value="{{ $item->id }}">
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->buku->judul }}</td>
                    <td>{{ $item->anggota->nama }}</td>
                    <td>{{ $item->tgl_pinjam }}</td>
                    <td>{{ $item->tgl_kembali }}</td>
                    <td>
                        {{ $item->status == 1 ? 'Dikembalikan' : 'Belum Dikembalikan' }}
                    </td>
                    <td>
                        <!-- Bikin tombol edit dan delete -->
                        <form method="POST" action="{{ url('/peminjaman/' . $item->id) }}">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url('/peminjaman/' . $item->id . '/edit') }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen"></i> edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btndelete show_confirm"
                                    data-toggle="tooltip" title='Delete'> <i class="fas fa-trash"></i>
                                    hapus</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7" class="text-center">Data tidak ada</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- /.card -->
@endsection

@push('custom_js')
<!-- DataTables  & Plugins -->
{{-- <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Page specific script -->
{{-- <script>
    $(function() {
            $('#tabelku').DataTable({
                "responsive": true
            }).buttons().container().appendTo('#tabelku_wrapper .col-md-6:eq(0)');
        });
</script> --}}

<script>
    $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btndelete').click(function(e) {
                e.preventDefault();

                var deleteid = $(this).closest("tr").find('.delete_id').val();

                swal({
                        title: `Apakah yakin?`,
                        text: "Setelah dihapus, data tidak dapat kembali.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            var data = {
                                "_token": $('input[name=_token]').val(),
                                'id': deleteid,
                            };
                            $.ajax({
                                type: "DELETE",
                                url: 'peminjaman/' + deleteid,
                                data: data,
                                success: function(response) {
                                    swal(response.status, {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });
        });
</script>
@endpush