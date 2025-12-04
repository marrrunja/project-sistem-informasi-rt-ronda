export async function showAlertError(message) {
    return await Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
    });
}
export async function showAlertSuccess(message) {
    return await Swal.fire({
        title: "Berhasil!",
        icon: "success",
        text: message,
        draggable: true
    });
}

export async function showConfirm(text, icon, confirm) {
    return await Swal.fire({
        title: 'Kamu yakin?',
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirm
    });
}

export async function showMessage(text, icon, status) {
    return await Swal.fire({
        title: status,
        icon: icon,
        draggable: true,
        text:text
    });
}
