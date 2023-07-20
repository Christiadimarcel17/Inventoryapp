$(function () {

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
    $('#modal-tambahbarang').on('hidden.bs.modal', function () {
        document.getElementById("formdatabarang").reset(); //or $('#form2')[0].reset();
        //$(this).find('#formanggota')[0].reset();
    })











    /*------------------------------------------
    --------------------------------------------
    Create Databarang
    --------------------------------------------
//     --------------------------------------------*/


    $('#save-data').on('click', function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        var barang_id = $('#id_barang').val();
        var methodType = $('#methodType').val();


            var data={
            'nama_barang':$('#nama_barang').val(),
            'supplier':$('select[name=supplier]').val(),
            'harga':$('#harga').val(),
            'satuan':$('#satuan').val(),
            'keterangan':$('#keterangan').val(),

                }


        if (barang_id == null) {
            var urlAction = "/databarang";
        } else {
            var urlAction = '/databarang' +'/'+ barang_id;
        }

        $.ajax({
            data: data,
            url: urlAction,
            type: methodType,
            dataType: 'json',

            success: function (data) {

                $('#formdatabarang').trigger("reset");
                //$('#formanggota').get(0).reset();
                $('#modal-tambahbarang').modal('hide');

                suksesSimpan().then(function() {

                 location.reload();

                });



            },
            error: function (data) {
               // console.log('Error:', data);
               var errors = data.responseJSON;
               if($.isEmptyObject(errors)==false){
                $.each(errors.errors,function(key,value){
                    var ErrorID = '#'+ key + 'Error';
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
        $('body').on('click', '.deleteBarang', function (e) {
            e.preventDefault();
           //var anggota_id = $(this).data('id');
           var barang_id = $(this).data('id');

            swalDeleteQuestion().then((result) => {
                if (result.value) {

                    $.ajax({
                        type: "DELETE",
                        url: '/databarang/' + barang_id,
                        success: function (data) {
                            suksesDelete().then(function () {
                               location.reload();
                            });
                            // console.log("berhasil");
                        },
                        error: function (data) {
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
    $('body').on('click', '.editDatabarang', function () {
        var barang_id = $(this).data('id');
        $.get('/databarang' + '/' + barang_id + '/edit', function (data) {
            $('.modal-title').html("Barang");
            $('#methodType').val("PUT");
            $('#id_barang').val(data.id);
           $('#nama_barang').val(data.nama_barang);
           $('#harga').val(data.harga);
            $('#supplier').val(data.supplier);
            $('#satuan').val(data.satuan);
            $('#keterangan').val(data.keterangan);
        })
    });

 });
