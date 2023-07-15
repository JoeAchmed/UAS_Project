@extends('admin.layout.appadmin', ['title' => 'Daftar Pesanan'])
@section('content')
@section('title')
    <span class="text-muted fw-bold"><a href="{{ url('/dbo') }}">Dashboard</a> / </span> Pesanan
@endsection

<!-- Hoverable Table rows -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header">Data Pesanan</h5>
    </div>
    <div class="container mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="tableData">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Nama Pembeli</th>
                        <th>Email</th>
                        <th>Nomer HP</th>
                        {{-- <th>Nama Produk</th> --}}
                        {{-- <th>Harga Awal</th> --}}
                        {{-- <th>Discount</th> --}}
                        {{-- <th>Harga Akhir</th> --}}
                        {{-- <th>Jumlah Barang</th> --}}
                        <th>Subtotal</th>
                        <th>Tanggal Transaksi</th>
                        <th>Status Pesanan</th>
                        <th>Detail Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="showModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" id="form">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Pesanan</label>
                        <input type="text" class="form-control" name="status" id="status" value="done"
                            placeholder="Masukan Nama Kategori" disabled />
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

<!--/ Hoverable Table rows -->
@endsection
@section('js')
<script>
    var tableData;

    $(function($) {
        $("input").on('keypress', function() {
            $(this).removeClass('is-invalid');
        });

        tableData = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.pesanan.list') }}",
            columns: [{
                    data: 'invoice',
                    name: 'invoice',
                    className: 'text-center', // Kolom id akan berada di tengah
                    render: function(data) {
                        return `<strong>${data}</strong>`;
                    },
                },
                {
                    data: 'customer_name',
                    name: 'customer_name',
                },
                {
                    data: 'customer_email',
                    name: 'customer_email',
                },
                {
                    data: 'customer_phone',
                    name: 'customer_phone',
                    className: 'text-center',
                    render: function(data) {
                        return data ?? "-";
                    },
                },
                {
                    data: 'shipping_price',
                    name: 'shipping_price',
                    className: 'text-right',
                    render: function(data) {
                        return data ? data.toLocaleString('ID') : "-";
                    },
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
                        const badgeClass = data == 'inprogress' ? 'warning' : 'success';
                        return `<span class="badge bg-${badgeClass}">${data}</span>`;
                    },
                    className: 'text-center'
                },
                {
                    data: 'detail',
                    name: 'detail',
                    orderable: false,
                    searchable: false,
                    className: 'text-center' // Kolom detail akan berada di tengah
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center' // Kolom action akan berada di tengah
                },
            ]
        });

        $(document).on('click', '#btnEdit', function() {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda yakin ingin merubah status pesanan ini menjadi selesai?",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#F46A6A',
                confirmButtonColor: '#34C38F',
                confirmButtonText: 'Ya, Ubah',
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

                    const id = $(this).attr('data-id');
                    $("input").removeClass('is-invalid');

                    $.ajax({
                        url: `{{ route('admin.pesanan.edit', '') }}/${id}`,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(res) {
                            Swal.close();
                            var id = $(this).attr('data-id');
                            var token = $('#editForm input[name="_token"]').val();
                            $.ajax({
                                url: "{{ route('admin.pesanan.ubah_status') }}",
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    id: res.id,
                                    _token: token,
                                    status: "done"
                                },
                                success: function(res) {
                                    if (res.success) {
                                        window.location.href =
                                            "{{ route('admin.pesanan.list') }}";
                                    } else {
                                        Swal.close();
                                        errorMsg(res.msg);
                                    }
                                },
                                error: function(jqXHR, textStatus,
                                    errorThrown) {
                                    Swal.close();
                                    errorMsg(jqXHR.status + " - " +
                                        errorThrown);
                                }
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $("#showModal").modal('hide');
                            errorMsg(jqXHR.status + " - " + errorThrown);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
