@extends('admin.layout.appadmin', ['title' => 'User Pelanggan'])
@section('content')
@section('title')
<span class="text-muted fw-bold"><a href="{{ route('admin.user.customer') }}">User Management</a> /</span> User
Pelanggan
@endsection

<!-- Hoverable Table rows -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header">Data List Pelanggan</h5>
        {{-- <button type="button" class="btn btn-primary mx-4" style="max-height: 42px">
            <i class="menu-icon tf-icons bx bx-plus"></i>
            Tambah
        </button> --}}
    </div>
    <div class="container mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="tableData">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Nama User</th>
                        <th>Alamat Email</th>
                        <th>Nomer HP</th>
                        <th>Tanggal Registrasi</th>
                        <th>Status</th>
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
<script>
    var tableData;

    $(function($) {
        tableData = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.user.customer') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    className: 'text-center' // Kolom id akan berada di tengah
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'phone_number',
                    name: 'phone_number',
                    render: function(data) {
                        return data ?? "-";
                    },
                    className: 'text-center' // Kolom phone_number akan berada di tengah
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data) {
                        const dateObject = new Date(data);
                        const day = dateObject.getDate();
                        const month = dateObject.toLocaleString('default', {
                            month: 'long'
                        });
                        const year = dateObject.getFullYear();
                        return `${day} ${month} ${year}`;
                    },
                    className: 'text-center' // Kolom created_at akan berada di tengah
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data) {
                        const badgeClass = data == 0 ? 'secondary' : 'info';
                        return `<span class="badge bg-${badgeClass}">${data ? 'Aktif' : 'Nonaktif'}</span>`;
                    },
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center' // Kolom action akan berada di tengah
                },
            ],
            drawCallback: function(settings) {
                $("#tableData").closest('.col-sm-12').addClass("table-responsive");
            },
        });

        $(document).on('click', '#btnDelete', function() {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda yakin ingin menonaktifkan user ini?",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#F46A6A',
                confirmButtonColor: '#34C38F',
                confirmButtonText: 'Ya, Lanjutkan',
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
                        url: "{{ route('admin.deactivate.customer') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function(res) {
                            if (res.success) {
                                window.location.href = "{{ route('admin.user.customer') }}";
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

        $(document).on('click', '#btnActivate', function() {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda yakin ingin mengaktifkan kembali user ini?",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#F46A6A',
                confirmButtonColor: '#34C38F',
                confirmButtonText: 'Ya, Lanjutkan',
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

                    var token = $('#activateForm input[name="_token"]').val();
                    var id = $(this).attr('data-id');

                    $.ajax({
                        url: "{{ route('admin.activate.customer') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function(res) {
                            if (res.success) {
                                window.location.href = "{{ route('admin.user.customer') }}";
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