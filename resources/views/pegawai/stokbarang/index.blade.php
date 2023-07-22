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
                                                    <th>Stok</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($databarang as $barang)
                                                    <tr>
                                                        <td>{{ $barang->kode_barang }}</td>
                                                        <td>{{ $barang->supplier }}</td>
                                                        <td>{{ $barang->nama_barang }}</td>
                                                        <td>{{ $barang->satuan }}</td>

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

                @stop

                @push('css')
                @endpush


                @section('js')
                    <script src="js/app.js"></script>
                    <script src="{{ asset('js/databarang.js') }}"></script>
                    <script src="{{ asset('js/swal.js') }}"></script>

                    <script>
                        $(document).ready(function() {

                            $('#laravel_datatable').DataTable({

                            });
                        });
                    </script>



                @stop
