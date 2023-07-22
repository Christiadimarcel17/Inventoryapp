{{-- Modal untuk tambah publikasi penelitian Internal --}}
<div class="modal fade" id="modal-tambahpermintaan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Permintaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formpermintaan" name="formpermintaan" class="form-horizontal" method="post">


                <!-- Modal -->
                <div class="modal-body">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="Katpub">Nama Barang</label>
                            <input type="hidden" name="id_permintaan" id="id_permintaan">
                            <input type="hidden" name="methodType" id="methodType" value="POST">
                            <select name="nama_barang" id="nama_barang" class="form-control">
                                <option value="">--PILIH NAMA BARANG--</option>
                                @foreach ($barang as $brg)
                                    <option value="{{ $brg->id }}">
                                        {{ $brg->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Katpub">Tanggal Masuk</label>
                            <input type="text" class="form-control" name="tanggal_req" id="tanggal_req" value="{{$date}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Katpub">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan">
                        </div>




                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary " value="create"
                                id="save-data">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
