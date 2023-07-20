@extends('adminlte::page')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('title', 'Inventori App')
@section('plugins.Datatables', true)
@section('plugins.JqueryUI', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <h3>Input Barang Masuk</h3>


    <div class="card card-secondary">
        <div class="card-header">

        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <form method="GET" action="/tampilkanbarang" id="form-tampilkan">
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <select name="nama_barang" id="nama_barang" class="form-control">
                                <option value="">--PILIH NAMA BARANG--</option>
                                @foreach ($namabrg as $brg)
                                    <option value="{{ $brg->id }}">
                                        {{ $brg->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control">
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-success" name="add" id="add">Tampilkan</button>
            </div>
            </form>
        </div>
    </div>

    <form action="{{ route('databarangmasuk.store') }}" method="post">
        @csrf
        <div class="card card-secondary">
            <div class="card-body">
                <table class="table table-bordered table-hover" id="tabledata">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>


                </table>

            </div>

        </div>

        <div class="card card-secondary">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Tanggal Masuk</label>
                    <input type="text" name="tanggal_masuk" id="tanggal_masuk" class="form-control"
                        value="{{ $date }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>


            </div>

        </div>
    </form>



@stop

@push('css')
@endpush


@section('js')
    <script src="js/app.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var harga = document.getElementById('harga');
        harga.addEventListener('keyup', function(e) {
            harga.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }
    </script>

    <script>
        $(document).on('click', '#add', function() {
            var namaBarang = $('#nama_barang').val();
            var jumlahBarang = $('#jumlah').val();

            $.ajax({
                url: '/tampilkanbarang', // Ganti dengan URL yang sesuai untuk endpoint tampilkan
                type: 'GET',
                data: {
                    nama_barang: namaBarang,
                    jumlah: jumlahBarang,
                    // jumlah_barang: '{{ session('jumlah') }}'
                },
                success: function(response) {
                    if (response.length > 0) {
                        var data = response[0];
                        var harga = data.harga;
                        var totalharga = jumlahBarang * harga;
                        $('#tabledata').append(`
                    <tbody>
                        <tr>
                            <td><input type="text" name="kode_barang[]" class="form-control" value="${data.kode_barang}"></td>
                            <td><input type="text" name="nama_barang[]" class="form-control" value="${data.nama_barang}"></td>
                            <td><input type="text" name="satuan[]" class="form-control" value="${data.satuan}"></td>
                            <td><input type="text" name="jumlah[]" class="form-control" value="${jumlahBarang}"></td>
                            <td><input type="text" name="harga[]" class="form-control" value="${data.harga}"></td>
                            <td><input type="text" name="totalharga[]" class="form-control" value="${totalharga}"></td>
                            <td><button type="button" class="btn btn-danger hapusdata">Hapus</button></td>
                        </tr>
                    </tbody>`);
                    }
                }
            });
        });


        //Hapus Kolom
        $(document).on('click', '.hapusdata', function(event) {
            event.stopPropagation();
            $(this).closest('tr').remove();
        })
    </script>
    @if (Session::has('successsubmit'))
        <script>
            swal("Good Job", "Data anda berhasil di submit", "success")
        </script>
    @endif




@stop
