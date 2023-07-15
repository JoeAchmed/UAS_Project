@extends('admin.layout.appadmin', ['title' => "Kategori Produk"])
@section('content')

@section('title')
<span class="text-muted fw-bold"><a href="{{ url('/dbo') }}">Dashboard</a> / <a
        href="{{ route('admin.produk.list') }}">Produk</a> /</span> Kategori Produk
@endsection

<!-- Hoverable Table rows -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header">Data Kategori Produk</h5>
        <button type="button" class="btn btn-primary mx-4" style="max-height: 42px">
            <i class="menu-icon tf-icons bx bx-plus"></i>
            Tambah
        </button>
    </div>
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
<!--/ Hoverable Table rows -->
@endsection
@section('js')
<script>
    var tableData;

    $(function($) {
        tableData = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.produk.kategori.list') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection