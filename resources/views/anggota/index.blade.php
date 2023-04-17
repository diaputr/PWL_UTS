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
        <div class="row d-flex justify-between"
            style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
            <form action="{{ route('anggota.index')}}" class="col-md-4" style="padding: 0">
                @csrf
                <div class="input-group input-group-sm ">
                    <input type="text" name="search" class="form-control input-sm " placeholder="Cari Anggota">
                    <button class="input-group-text input-sm" id="basic-addon2" type="submit">
                        <i class="fa fa-search" style="font-size:16px"></i>
                    </button>
                </div>
            </form>
        </div>
        <br>
        <table class="table table-bordered">
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
                @if ($anggotas->count() > 0)
                @php $no = $anggotas->firstItem(); @endphp
                @foreach ($anggotas as $item)
                <tr>
                    <input type="hidden" class="delete_id" value="{{ $item->id }}">
                    <td>{{ $no++ }}</td>
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
        <div class="mt-4" style="display: flex; justify-content: center; flex-direction: column-reverse">
            {{ $anggotas->links() }}
        </div>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Page specific script -->
<script>
    $(document).ready(function(){
            $('#tabelku').DataTable({
                processing: true,
                serverSide: true,
                // responsive: true
                ajax: "{{ route('anggota.index') }}",
            }).buttons().container().appendTo('#tabelku_wrapper .col-md-6:eq(0)');
        });
</script>

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
                                url: 'anggota/' + deleteid,
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