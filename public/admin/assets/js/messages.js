function successMsg(msg) {
	Swal.fire({
		icon: "success",
		title: "Berhasil",
		text: msg,
		confirmButtonColor: "#28a745",
	});
}

function warningMsg(msg) {
	Swal.fire({
		icon: "warning",
		title: "Peringatan",
		text: msg,
		confirmButtonColor: "#3085d6",
	});
}

function errorMsg(msg) {
	Swal.fire({
		icon: "error",
		title: "Gagal",
		text: msg,
		confirmButtonColor: "#3085d6",
	});
}