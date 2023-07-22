@extends('adminlte::page')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('title', 'Inventori App')
@section('plugins.Datatables', true)
@section('plugins.JqueryUI', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <h3>Data Barang</h3>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-secondary">
                    <div class="card-header">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-tambahbarang">
                            <em class="fa fa-plus"></em> Tambah Barang</button>
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-body">
                                        <table id="laravel_datatable" class="table table-bordered table-hover"
                                            style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Barang</th>
                                                    <th>Supplier</th>
                                                    <th>Nama Barang</th>
                                                    <th>Harga</th>
                                                    <th>Satuan</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($databarang as $barang)
                                                    <tr>
                                                        <td>{{ $barang->kode_barang }}</td>
                                                        <td>{{ $barang->supplier }}</td>
                                                        <td>{{ $barang->nama_barang }}</td>
                                                        <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                                        <td>{{ $barang->satuan }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning editDatabarang"
                                                                data-toggle="modal" data-id="{{ $barang->id }}"
                                                                data-placement="bottom" title="Ubah data barang!"
                                                                data-target="#modal-tambahbarang">
                                                                Edit</button>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                data-id="{{ $barang->id }}" data-original-title="Delete"
                                                                class="btn btn-danger deleteBarang"> Hapus</a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>

                    @include('pegawai.databarang.modal')

                @stop

                @push('css')
                @endpush


                @section('js')
                    <script src="js/app.js"></script>
                    <script src="{{ asset('js/databarang.js') }}"></script>
                    <script src="{{ asset('js/swal.js') }}"></script>
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
                        $(document).ready(function() {

                            $('#laravel_datatable').DataTable({

                            });
                        });
                    </script>



                @stop
