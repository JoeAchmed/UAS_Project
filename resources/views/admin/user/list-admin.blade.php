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
        <button type="button" class="btn btn-primary mx-4" style="max-height: 42px" id="btnAdd">
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
                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Nama User</label>
                        <input required type="text" class="form-control" name="name" id="name"
                            placeholder="Masukan Nama User" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input required type="email" class="form-control" name="email" id="email"
                            placeholder="Masukan Email User" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="phone_number" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            placeholder="Masukan No.HP User" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="address" class="form-label">Alamat</label>
                            <textarea
                              name="address"
                              id="address"
                              class="form-control"
                              placeholder="Masukkan Alamat"
                              aria-label="Masukkan Alamat"
                              aria-describedby="basic-icon-default-message2"
                            ></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="role" class="form-label">Pilih Role</label>
                        <select class="form-select" id="role" name="role" aria-label="Default select example">
                          <option selected disabled>--- Pilih Role User ---</option>
                          <option value="admin">Admin</option>
                          <option value="manager">Manager</option>
                          <option value="pelanggan">Pelanggan</option>
                        </select>
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

    $("#btnAdd").on("click", function() {
        method = "add";
        $("#form")[0].reset();
        $("#modalForm").modal('show');
        $("#modalFormTitle").text("Tambah Kategori Produk");

        $("input").removeClass('is-invalid');
    });
</script>
@endsection
