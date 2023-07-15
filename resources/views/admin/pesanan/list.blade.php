@extends('admin.layout.appadmin', ['title' => 'Daftar Pesanan'])
@section('content')
@section('title')
    <span class="text-muted fw-bold"><a href="{{ url('/dbo') }}">Dashboard</a> / </span> Pesanan
@endsection

<!-- Hoverable Table rows -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header">Data Pesanan</h5>
        <button type="button" class="btn btn-primary mx-4" style="max-height: 42px">
            <i class="menu-icon tf-icons bx bx-plus"></i>
            Tambah
        </button>
    </div>
    <div class="container mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="tableData">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Nama Produk</th>
                        <th>Harga Awal</th>
                        <th>Discount</th>
                        <th>Harga Akhir</th>
                        <th>Jumlah Barang</th>
                        <th>Subtotal</th>
                        <th>Tanggal Transaksi</th>
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
            ajax: "{{ route('admin.pesanan.list') }}",
            columns: [{
                    data: 'invoice',
                    name: 'invoice',
                    className: 'text-center font-bold' // Kolom id akan berada di tengah
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'sell_price',
                    name: 'sell_price',
                    render: function(data) {
                        return data ? data.toLocaleString('ID') : "-";
                    },
                },
                {
                    data: 'discount',
                    name: 'discount',
                    className: 'text-center text-bold text-danger', // Kolom id akan berada di tengah
                    render: function(data) {
                        return data ? `${data.toString().replace(/\.00$/, '')}%` : "-";
                    },
                },
                {
                    data: 'discount_price',
                    name: 'discount_price',
                    render: function(data, type, row) {
                        return data ? data.toLocaleString('ID') : row.sell_price.toLocaleString('ID');
                    },
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    className: 'text-center', // Kolom id akan berada di tengah
                    render: function(data) {
                        return data ? data.toLocaleString('ID') : "-";
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
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center' // Kolom action akan berada di tengah
                },
            ]
        });
    });
</script>
@endsection
