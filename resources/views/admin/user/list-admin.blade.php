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
            <form enctype="multipart/form-data" autocomplete="off" id="form" method="POST"
                action="{{ route('admin.user-create.admin') }}">
                @csrf
                <div class="modal-body">
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
                    <div class="form-group mb-2 form-password-toggle" id="password-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="basic-default-password2" />
                            <span id="basic-default-password2" class="input-group-text cursor-pointer"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="phone_number" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            placeholder="Masukan No.HP User" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" id="address" class="form-control" placeholder="Masukkan Alamat" aria-label="Masukkan Alamat"
                            aria-describedby="basic-icon-default-message2"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="role" class="form-label">Pilih Role</label>
                        <select required class="form-select" id="role" name="role"
                            aria-label="Default select example">
                            <option selected disabled>--- Pilih Role User ---</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="pelanggan">Pelanggan</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <input type="file" accept="image/*" class="form-control" name="image_url" id="image_url"
                            multiple>
                        <div id="imgDetailView" class="mt-2 sort {{ isset($product) ? '' : 'd-none' }}">
                            @if (isset($product))
                                @foreach ($product_images as $item)
                                    <img class="sort-grid shadow img-fluid"
                                        src="{{ asset('storage/' . $item->path) }}">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan</button>
                </div>
            </form>
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
        $("#modalFormTitle").text("Tambah User");

        $("input").removeClass('is-invalid');
    });

    // $(document).on('click', '#btnEdit', function() {
    //     method = "update";
    //     const id = $(this).attr('data-id');

    //     console.log(tableData, "ceeekk");

    //     $("#form")[0].reset();
    //     $("#modalForm").modal('show');
    //     $("#modalFormTitle").text("Edit User");
    //     $("#password-group").addClass("d-none");

    //     $("input").removeClass('is-invalid');

    //     // Mengisi nilai ke dalam form
    //     $("#id").val(id);
    //     $("#name").val(userData.name);
    //     $("#email").val(userData.email);
    //     $("#phone_number").val(userData.phone_number);
    //     $("#address").val(userData.address);
    //     $("#role").val(userData.role);

    //     // Menampilkan gambar produk jika ada
    //     if (userData.image_url) {
    //         $("#imgDetailView").removeClass('d-none');
    //         // Anda perlu mengganti bagian ini dengan cara menampilkan gambar sesuai kebutuhan (misalnya menggunakan <img> tag)
    //     }

    //     $("#modalForm").modal('show');
    //     $("#modalFormTitle").text("Edit User");
    //     $("input").removeClass('is-invalid');
    // });
    $(document).on('click', '#btnEdit', function() {
        method = "update";
        const id = $(this).attr('data-id');

        // Kirim AJAX request ke endpoint untuk mengambil data pengguna
        $.ajax({
            url: '/dbo/user/admin/' + id, // Ganti dengan URL endpoint yang benar di server
            type: 'GET',
            success: function({data}) {

                console.log(data, "ngetes");
                // Mengisi nilai ke dalam form
                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#phone_number").val(data.phone_number);
                $("#address").val(data.address);
                $("#role").val(data.role);

                // Menampilkan gambar produk jika ada
                if (data.image_url) {
                    $("#imgDetailView").removeClass('d-none');
                    // Anda perlu mengganti bagian ini dengan cara menampilkan gambar sesuai kebutuhan (misalnya menggunakan <img> tag)
                }

                $("#modalForm").modal('show');
                $("#modalFormTitle").text("Edit User");
                $("input").removeClass('is-invalid');
                $("#password-group").addClass("d-none");
                $("#form").attr("action", "/dbo/user/admin/" + data.id);
                
            },
            error: function(xhr, status, error) {
                // Menangani kesalahan jika permintaan gagal
                console.log(
                error); // Anda dapat menampilkan pesan kesalahan ke pengguna sesuai kebutuhan
            }
        });
    });
</script>
@endsection
