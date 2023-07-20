@extends('adminlte::page')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('title', 'Inventori App')
@section('plugins.Datatables', true)
@section('plugins.JqueryUI', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <h3>Permintaan Barang</h3>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-secondary">
                    <div class="card-header">
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modal-tambahpermintaan">
                            <em class="fa fa-plus"></em> Permintaan Barang</button>
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
                                                    <th>Kode permintaan</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datapermintaan as $data)
                                                    <tr>
                                                        <td>{{ $data->kode_req_barang }}</td>
                                                        <td>{{ $data->tanggal_req }}</td>
                                                        <td>{{ $data->kode_barang }}</td>
                                                        <td>{{ $data->nama_barang }}</td>
                                                        @if ($data->status == 0)
                                                            <td><button class="btn btn-sm btn-danger">Konfirmasi</button>
                                                            </td>
                                                        @else
                                                            <td><button class="btn btn-sm btn-success">Disetujui</button>
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <button type="button" class="btn btn-warning editPermintaan"
                                                                data-toggle="modal" data-id="{{$data->id}}" data-placement="bottom"
                                                                title="Ubah data barang!"
                                                                data-target="#modal-tambahpermintaan">
                                                                Edit</button>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                data-id="{{ $data->id }}" data-original-title="Delete"
                                                                class="btn btn-danger deletePermintaan"> Hapus</a>
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

                    @include('pegawai.reqbarang.modal')

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

                    <script>
                        $(function() {

                            /*------------------------------------------
                             --------------------------------------------
                             Pass Header Token
                             --------------------------------------------
                             --------------------------------------------*/
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('#modal-tambahpermintaan').on('hidden.bs.modal', function() {
                                document.getElementById("formpermintaan").reset(); //or $('#form2')[0].reset();
                                //$(this).find('#formanggota')[0].reset();
                            })











                            /*------------------------------------------
                            --------------------------------------------
                            Create Request Permintaan
                            --------------------------------------------
                            //     --------------------------------------------*/


                            $('#save-data').on('click', function(e) {
                                e.preventDefault();
                                $(this).html('Sending..');
                                var permintaan_id = $('#id_permintaan').val();
                                var methodType = $('#methodType').val();


                                var data = {
                                    'nama_barang': $('select[name=nama_barang]').val(),
                                    'tanggal_req': $('#tanggal_req').val(),
                                    'keterangan': $('#keterangan').val(),

                                }


                                if (permintaan_id == null) {
                                    var urlAction = "/permintaanbarang";
                                } else {
                                    var urlAction = '/permintaanbarang' + '/' + permintaan_id;
                                }

                                $.ajax({
                                    data: data,
                                    url: urlAction,
                                    type: methodType,
                                    dataType: 'json',

                                    success: function(data) {

                                        $('#formpermintaan').trigger("reset");
                                        //$('#formanggota').get(0).reset();
                                        $('#modal-tambahpermintaan').modal('hide');

                                        suksesSimpan().then(function() {

                                            location.reload();

                                        });



                                    },
                                    error: function(data) {
                                        // console.log('Error:', data);
                                        var errors = data.responseJSON;
                                        if ($.isEmptyObject(errors) == false) {
                                            $.each(errors.errors, function(key, value) {
                                                var ErrorID = '#' + key + 'Error';
                                                $(ErrorID).removeClass("d-none");
                                                $(ErrorID).text(value)
                                            })
                                        }
                                        $('#save-data').html('Save Changes');
                                    }
                                });
                            });



                            /*------------------------------------------
                            --------------------------------------------
                            Delete Barang
                             --------------------------------------------
                            --------------------------------------------*/
                            $('body').on('click', '.deletePermintaan', function(e) {
                                e.preventDefault();
                                //var anggota_id = $(this).data('id');
                                var permintaan_id = $(this).data('id');

                                swalDeleteQuestion().then((result) => {
                                    if (result.value) {

                                        $.ajax({
                                            type: "DELETE",
                                            url: '/permintaanbarang/' + permintaan_id,
                                            success: function(data) {
                                                suksesDelete().then(function() {
                                                    location.reload();
                                                });
                                                // console.log("berhasil");
                                            },
                                            error: function(data) {
                                                console.log('Error:', data);
                                                //console.log("kaga");
                                            }
                                        });
                                    }
                                })
                            });

                            /*------------------------------------------
                                            --------------------------------------------
                                        Click to Edit Databarang
                                        --------------------------------------------
                                        --------------------------------------------*/
                            $('body').on('click', '.editPermintaan', function() {
                                var permintaan_id = $(this).data('id');
                                $.get('/permintaanbarang' + '/' + permintaan_id + '/edit', function(data) {
                                    $('.modal-title').html("Permintaan Barang");
                                    $('#methodType').val("PUT");
                                    $('#id_permintaan').val(data.id);
                                    $('#nama_barang').val(data.nama_barang);
                                    $('#tanggal_req').val(data.tanggal_req);
                                    $('#keterangan').val(data.keterangan);
                                })
                            });

                        });
                    </script>



                @stop
