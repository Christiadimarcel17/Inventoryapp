{{-- Modal untuk tambah publikasi penelitian Internal --}}
<div class="modal fade" id="modal-tambahbarang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formdatabarang" name="formdatabarang" class="form-horizontal" method="post">


                <!-- Modal -->
                <div class="modal-body">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="Katpub">Nama_Barang</label>
                            <input type="hidden" name="id_barang" id="id_barang">
                            <input type="hidden" name="methodType" id="methodType" value="POST">
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang">
                        </div>
                        <div class="form-group">
                            <label for="Katpub">Supplier</label>
                            <select name="supplier" id="supplier" class="form-control">
                                <option value="">--PILIH SUPPLIER--</option>
                                <option value="Pt Indo TBK">PT INDO TBK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Katpub">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga">
                        </div>
                        <div class="form-group">
                            <label for="Katpub">Satuan</label>
                            <input type="text" class="form-control" name="satuan" id="satuan">
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
