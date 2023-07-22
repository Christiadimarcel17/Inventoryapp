
function swalDeleteQuestion() {
    return Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data ini akan dihapus! ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Saja!'
    })
}

function swalSKBPQuestion() {
    return Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anggota ini akan SKBP! ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    })
}

function swalBatalSKBPQuestion() {
    return Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anggota ini akan dibatalkan SKBP-nya! ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Batalkan!'
    })
}

function suksesSimpan() {
    return Swal.fire({
        position: 'top',
        type: 'success',
        title: 'Barang berhasil di simpan &#128515;',
        showConfirmButton: false,
       timer: 1500
    })
}

function suksesDelete() {
    return Swal.fire(
        'Deleted!',
        'Data berhasil dihapus.',
        'success'
    )
}

function suksesSKBP() {
    return Swal.fire(
        'SKBP!',
        'Anggota berhasil di-SKBP',
        'success'
    )
}

function suksesBatalSKBP() {
    return Swal.fire(
        'SKBP!',
        'SKBP berhasil dibatalkan',
        'success'
    )
}

function cekSBKP() {
    Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Anggota Masih ada Pinjaman/Tunggakan!',
      })
}

