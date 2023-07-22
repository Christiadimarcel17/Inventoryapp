@extends('adminlte::page')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('title', 'Inventori App')
@section('plugins.Datatables', true)
@section('plugins.JqueryUI', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <h3>Data Barang keluar</h3>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-secondary">
                    <div class="card-header">
                        <a href="{{ route('databarangkeluar.create') }}" class="btn btn-warning">Input Barang Keluar</a>
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
                                                    <th>Tanggal Keluar</th>
                                                    <th>Nama Barang</th>
                                                    <th>Total Harga</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($brg as $row)
                                                @php
                                                    $namabarang = json_decode($row->nama_barang,true);
                                                    $jumlahbarang = json_decode($row->jumlah,true);
                                                    $totalharga = json_decode($row->totalharga,true);
                                                    $id = $row->id;
                                                    $tanggal_keluar = $row->tanggal_keluar;
                                                    $keterangan = $row->keterangan;
                                                @endphp
                                                @foreach ($namabarang as $key => $value )
                                                    <tr>

                                                        <td>{{$tanggal_keluar}}</td>
                                                        <td>{{$value}}</td>
                                                        <td>Rp{{ number_format($totalharga[$key])}}</td>
                                                        <td>{{$keterangan}}</td>
                                                        <td>
                                                            <a href="{{route('editbrgkeluar',['id' => $id, 'nama' => $value, 'jumlah' => $jumlahbarang[$key], 'totalharga' => $totalharga[$key], 'tgl' => $tanggal_keluar, 'ket' => $keterangan])}}" class="btn btn-success">Detail</a>
                                                            <form
                                                                    action="{{ route('hapusbarangkel', ['id' => $id, 'nama' => $value]) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                                </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
                </div>
            </div>
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
