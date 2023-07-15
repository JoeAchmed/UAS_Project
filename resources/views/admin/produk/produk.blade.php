@extends('admin.layout.appadmin', ['title' => 'Produk'])
@section('content')

@section('title')
<span class="text-muted fw-bold"><a href="{{ route('admin.produk.list') }}">Produk</a>
    /</span> List Produk
@endsection

<!-- Hoverable Table rows -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header">Data Produk</h5>
        <button type="button" class="btn btn-primary mx-4" style="max-height: 42px" id="btnAdd">
            <i class="menu-icon tf-icons bx bx-plus"></i>
            Tambah
        </button>
    </div>
    <div class="container mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="tableData">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->
@endsection

@section('js')
@include('admin.components.alerts')
<script>
    var tableData;

    $(function($) {
        tableData = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.produk.list') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $("#btnAdd").on("click", function() {
            window.location.href = "{{ route('admin.produk.add') }}";
        });

        $(document).on('click', '#btnDelete', function() {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#F46A6A',
                confirmButtonColor: '#34C38F',
                confirmButtonText: 'Ya',
                showLoaderOnConfirm: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses Data',
                        text: 'Tunggu sebentar...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    });

                    var token = $('#deleteForm input[name="_token"]').val();
                    var id = $(this).attr('data-id');

                    $.ajax({
                        url: "{{ route('admin.produk.kategori.delete') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function(res) {
                            if (res.success) {
                                window.location.href = "{{ route('admin.produk.kategori.list') }}";
                            } else {
                                Swal.close();
                                errorMsg(res.msg);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.close();
                            errorMsg(jqXHR.status + " - " + errorThrown);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection