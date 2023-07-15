@extends('admin.layout.appadmin', ['title' => 'User Admin'])
@section('content')
@section('title')
    <span class="text-muted fw-bold"><a href="{{ url('/dbo') }}">Dashboard</a> / <a
            href="{{ route('admin.user.admin') }}">User</a> /</span> User Admin
@endsection

<!-- Hoverable Table rows -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header">Data List Admin</h5>
        <button type="button" class="btn btn-primary mx-4" style="max-height: 42px">
            <i class="menu-icon tf-icons bx bx-plus"></i>
            Tambah
        </button>
    </div>
    <div class="container mb-3">
        <table class="table table-hover" id="tableData">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Nama User</th>
                    <th>Alamat Email</th>
                    <th>Nomer HP</th>
                    <th>Tanggal Registrasi</th>
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
            ajax: "{{ route('admin.user.admin') }}",
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
