<script>
    @if (session()->has('success'))
        Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "{{ session('success') }}",
            confirmButtonColor: "#28a745",
        });
    @endif
    @if (session()->has('warning'))
        Swal.fire({
            icon: "warning",
            title: "Peringatan",
            text: "{{ session('warning') }}",
            confirmButtonColor: "#3085d6",
        });
    @endif
    @if (session()->has('danger'))
        Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "{{ session('danger') }}",
            confirmButtonColor: "#3085d6",
        });
    @endif
    @if (session()->has('info'))
        Swal.fire({
            icon: "info",
            title: "Info",
            text: "{{ session('info') }}",
            confirmButtonColor: "#3085d6",
        });
    @endif
</script>