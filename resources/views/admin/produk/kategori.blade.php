@extends('admin.layout.appadmin', ['title' => "Kategori Produk"])
@section('content')

@section('title')
<span class="text-muted fw-bold"><a href="{{ route('admin.produk.list') }}">Produk</a>
        /</span> List Kategori Produk
@endsection

<!-- Hoverable Table rows -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header">Data Kategori Produk</h5>
        <button type="button" class="btn btn-primary mx-4" style="max-height: 42px" id="btnAdd">
            <i class="menu-icon tf-icons bx bx-plus"></i>
            Tambah
        </button>
    </div>
    <div class="container mb-3">
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
<!--/ Hoverable Table rows -->

{{-- Modal --}}
<div class="modal fade" id="modalForm" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" id="form">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Masukan Nama Kategori" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSubmit">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('admin.components.alerts')
<script>
    var tableData;

    var method;
    var btnCounter = 0;
    var btnStts = true;

    $(function($) {
        $("input").on('keypress', function() {
            $(this).removeClass('is-invalid');
        });

        tableData = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.produk.kategori.list') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $("#btnAdd").on("click", function() {
            method = "add";
            $("#form")[0].reset();
            $("#modalForm").modal('show');
            $("#modalFormTitle").text("Tambah Kategori Produk");

            $("input").removeClass('is-invalid');
        });

        $("#btnSubmit").on("click", function() {
            // Condition Action URL Form
            var url;
            (method == "add" ? url = "{{ route('admin.produk.kategori.add') }}" : url = "{{ route('admin.produk.kategori.update') }}");

            btnCounter++;
            ((btnCounter > 1) ? btnStts = false : btnStts);

            if (btnStts == true) {
                Swal.fire({
                    title: 'Memproses Data',
                    text: 'Tunggu Sebentar...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                });

                let token = $("input[name='_token']").val();
                let id = $("input[name='id']").val();
                let name = $("input[name='name']").val();

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        _token: token,
                        id: id,
                        name: name
                    },
                    success: function(res) {
                        if ($.isEmptyObject(res.err)) {
                            if (res.success) {
                                window.location.href = "{{ route('admin.produk.kategori.list') }}";
                            } else {
                                Swal.close();
                                btnCounter = 0;
                                errorMsg(res.msg);
                            }
                        } else {
                            Swal.close();
                            btnCounter = 0;

                            let response = res.err;
                            for (let error in response) {
                                let errors = response[error];
                                $("input[name='" + error + "']").addClass('is-invalid');

                                warningMsg(errors);
                                return;
                            }

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.close();
                        btnCounter = 0;

                        $("#modalForm").modal('hide');
                        errorMsg(jqXHR.status + " - " + errorThrown);
                    }
                });
            }
        });

        $(document).on('click', '#btnEdit', function() {
            method = "update";

            Swal.fire({
                title: 'Mendapatkan Data',
                text: 'Tunggu Sebentar...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            });
            
            const id = $(this).attr('data-id');
            $("input").removeClass('is-invalid');

            $.ajax({
                url: `{{ route('admin.produk.kategori.edit', '')}}/${id}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    Swal.close();
                    $("#form")[0].reset();
                    $("#modalForm").modal('show');
                    $("#modalFormTitle").text("Ubah Kategori Produk");

                    $("input[name='id']").val(res.id);
                    $("input[name='name']").val(res.name);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $("#modalForm").modal('hide');
                    errorMsg(jqXHR.status + " - " + errorThrown);
                }
            });
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