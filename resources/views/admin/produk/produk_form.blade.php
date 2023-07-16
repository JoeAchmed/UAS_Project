@extends('admin.layout.appadmin', ['title' => 'Tambah Produk'])
@section('content')

@section('title')
<span class="text-muted fw-bold"><a href="{{ route('admin.produk.list') }}">Produk</a>
    / <a href="{{ route('admin.produk.list') }}">List Produk</a> / </span> Tambah
@endsection

<!-- Hoverable Table rows -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header">Tambah Produk</h5>
    </div>
    <div class="container mb-3">
        <form autocomplete="off" id="form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ (isset($product) ? $product->id : '') }}">
            <div class="mb-3">
                <label for="name" class="form-label">Thumbnail</label>
                <input type="file" accept="image/*" class="form-control" name="thumbnail" id="thumbnail">
                <div id="thumbView" class="mt-2 text-center {{ (isset($product) ? '' : 'd-none') }}">
                    @if (isset($product))
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="w-25 text-center shadow"
                        alt="Thumbnail">
                    @endif
                </div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Gambar Detail</label>
                <input type="file" accept="image/*" class="form-control" name="img_details[]" id="img_details" multiple>
                <div id="imgDetailView" class="mt-2 sort {{ (isset($product) ? '' : 'd-none') }}">
                    @if (isset($product))
                    @foreach ($product_images as $item)
                    <img class="sort-grid shadow img-fluid" src="{{ asset('storage/' . $item->path) }}">
                    @endforeach
                    @endif
                </div>
            </div>
            @if (isset($product))
            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" name="sku" id="sku" placeholder="SKU Produk" readonly
                    value="{{ (isset($product) ? $product->sku : '') }}" />
            </div>
            @endif
            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Produk"
                    value="{{ (isset($product) ? $product->name : '') }}" />
            </div>
            <div class="mb-3">
                <label for="cat_id" class="form-label">Kategori Produk</label>
                <select name="cat_id" id="cat_id" class="form-select">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $item)
                    <option {{ isset($product) ? $item->id == $product->cat_id ? 'selected' : '' : '' }} value="{{
                        $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="acq_price" class="form-label">Harga Beli</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control iprice" name="acq_price" id="acq_price"
                                placeholder="Harga Beli"
                                value="{{ (isset($product) ? number_format($product->acq_price, 0, ',', '.') : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sell_price" class="form-label">Harga Jual</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control iprice" name="sell_price" id="sell_price"
                                placeholder="Harga Jual"
                                value="{{ (isset($product) ? number_format($product->sell_price, 0, ',', '.') : '') }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="discount" class="form-label">Diskon (%)</label>
                        <input type="number" class="form-control" name="discount"
                            value="{{ (isset($product) ? (!$product->discount ? '0' : floor($product->discount)) : '0') }}"
                            min="0" id="discount" placeholder="Diskon (%)" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stock"
                            value="{{ (isset($product) ? $product->stock : '0') }}"
                            min="0" id="stock" placeholder="Stok" />
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control"
                    placeholder="Masukan Deskripsi Produk">{{ (isset($product) ? $product->description : '') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="size" class="form-label">Ukuran</label>
                        <input type="text" class="form-control" name="size" id="size" placeholder="Ukuran Produk"
                            value="{{ (isset($product) ? $product->size : '') }}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="weight" class="form-label">Berat</label>
                        <input type="text" class="form-control" name="weight" id="weight" placeholder="Berat Produk"
                            value="{{ (isset($product) ? $product->weight : '') }}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="manufacturer" class="form-label">Produsen</label>
                        <input type="text" class="form-control" name="manufacturer" id="manufacturer"
                            value="{{ (isset($product) ? $product->manufacturer : '') }}" placeholder="Produsen" />
                    </div>
                </div>
            </div>

            <hr>

            <div class="float-end">
                <button type="button" class="btn btn-outline-secondary" id="btnBack">Kembali</button>
                <button type="button" class="btn btn-primary ms-1" id="btnSubmit">Simpan</button>
            </div>
        </form>
    </div>
</div>
<!--/ Hoverable Table rows -->
@endsection

@section('js')
@include('admin.components.alerts')
<script>
    var btnCounter = 0;
    var btnStts = true;

    $(function($) {
        $("input, select, textarea").on('change', function() {
            $(this).removeClass('is-invalid');
        });

        $('#thumbnail').on('click', function() {
            $('#thumbnail').val("");
            $('#thumbView').html("");
            $('#thumbView').addClass("d-none");
        });

        $('#img_details').on('click', function() {
            $('#img_details').val("");
            $('#imgDetailView').html("");
            $('#imgDetailView').addClass("d-none");

        });

        $('#thumbnail').on('change', function(e) {
            $('#thumbView').removeClass("d-none");

            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#thumbView').html('<img src="' + e.target.result + '" class="w-25 text-center shadow" alt="Thumbnail">');
            };
            reader.readAsDataURL(file);
        });

        $('#img_details').on('change', function(e) {
            $('#imgDetailView').removeClass("d-none");

            let files = e.target.files;
            let totalFile = e.target.files.length;

            $('#imgDetailView').html("");
            for (let i = 0; i < totalFile; i++) {
                let numImage = i + 1;
                let urlImage = URL.createObjectURL(event.target.files[i]);
                let imageCode = "<img class='sort-grid shadow img-fluid' src='" + urlImage + "'>";
                $('#imgDetailView').append(imageCode);
            }
        });

        $("#btnBack").on("click", function() {
            window.location.href = "{{ route('admin.produk.list') }}";
        });

        $("#btnSubmit").on('click', function() {
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
                let thumbnail = $("input[name='thumbnail']").val();
                let sku = $("input[name='sku']").val();
                let name = $("input[name='name']").val();
                let cat_id = $("select[name='cat_id']").val();
                let acq_price = $("input[name='acq_price']").val();
                let sell_price = $("input[name='sell_price']").val();
                let discount = $("input[name='discount']").val();
                let stock = $("input[name='stock']").val();
                let description = $("textarea[name='description']").val();
                let size = $("input[name='size']").val();
                let weight = $("input[name='weight']").val();
                let manufacturer = $("input[name='manufacturer']").val();
            
                var formData = new FormData();
                formData.append('_token', token);
                formData.append('id', id);
                formData.append('thumbnail', $('#thumbnail')[0].files[0]);
                formData.append('sku', sku);
                formData.append('name', name);
                formData.append('cat_id', cat_id);
                formData.append('acq_price', acq_price);
                formData.append('sell_price', sell_price);
                formData.append('discount', discount);
                formData.append('stock', stock);
                formData.append('description', description);
                formData.append('size', size);
                formData.append('weight', weight);
                formData.append('manufacturer', manufacturer);

                var files = $('#img_details')[0].files;
                for (var i = 0; i < files.length; i++) {
                    formData.append('img_details[]', files[i]);
                }

                var url;
                (!id ? url = "{{ route('admin.produk.create') }}" : url = "{{ route('admin.produk.update') }}");

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(res) {
                        if ($.isEmptyObject(res.err)) {
                            if (res.success) {
                                window.location.href = "{{ route('admin.produk.list') }}";
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
                                $("select[name='" + error + "']").addClass('is-invalid');
                                $("textarea[name='" + error + "']").addClass('is-invalid');


                                warningMsg(errors);
                                return;
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.close();
                        btnCounter = 0;

                        errorMsg(jqXHR.status + " - " + errorThrown);
                    }
                });
            }
        });
    });
</script>
@endsection