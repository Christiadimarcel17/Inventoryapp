@extends('adminlte::page')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('title', 'Inventori App')
@section('plugins.Datatables', true)
@section('plugins.JqueryUI', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <h3>Data Barang masuk</h3>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Detail Barang Keluar</h3>
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-body">
                                        <form action="">

                                            <div class="form-group">
                                                <label for="">Nama Barang</label>
                                                <input type="text" class="form-control" name="nama_barang[]"
                                                    value="{{ $nama }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Jumlah</label>
                                                <input type="text" class="form-control" name="jumlah"
                                                    value="{{ $jumlah }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Tanggal Masuk</label>
                                                <input type="text" class="form-control" name="tanggal_masuk"
                                                    value="{{ $tgl }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Harga</label>
                                                <input type="text" class="form-control" name="totalharga"
                                                    value="Rp {{ number_format($totalharga, 0, ',', '.') }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Keterangan</label>
                                                <input type="text" class="form-control" name="keterangan"
                                                    value="{{ $ket }}" readonly>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>



                @stop

                @push('css')
                @endpush


                @section('js')
                    <script src="js/app.js"></script>
                    <script src="{{ asset('js/databarang.js') }}"></script>

                @stop
