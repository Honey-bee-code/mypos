<!-- Content Header (Page header) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.7/cropper.min.css" crossorigin="anonymous"/>


<section class="content-header">
  <h1>
    Pengguna
    <small>Yang boleh menggunakan aplikasi ini</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Pengguna</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Data Pengguna</h3>
            <div class="pull-right">
                <a href="<?=site_url('user')?>" class="btn btn-warning btn-sm">
                <i class="fa fa-undo"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="" enctype="multipart/form-data" method="post">
                        <!-- <?=validation_errors()?> -->
                        <div class="form-group <?=form_error('nama') ? 'has-error' : null?>">
                            <label for="nama">Nama *</label>
                            <input type="text" name="nama" value="<?=set_value('nama')?>" class="form-control">
                            <?=form_error('nama')?>
                        </div>
                        <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                            <label for="username">Username *</label>
                            <input type="text" name="username" value="<?=set_value('username')?>" class="form-control">
                            <?=form_error('username')?>
                        </div>
                        <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                            <label for="password">Password *</label>
                            <input type="password" name="password" value="<?=set_value('password')?>" class="form-control">
                            <?=form_error('password')?>
                        </div>
                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                            <label for="passconf">Konfirmasi Password *</label>
                            <input type="password" name="passconf" value="<?=set_value('passconf')?>" class="form-control">
                            <?=form_error('passconf')?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control"><?=set_value('alamat')?></textarea>
                        </div>
                        <div class="form-group <?=form_error('level') ? 'has-error' : null?>">
                            <label for="level">Level *</label>
                            <select name="level" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="1" <?=set_value('level') == 1 ? "selected" : null?>>Admin</option>
                                <option value="2" <?=set_value('level') == 2 ? "selected" : null?>>Kasir</option>
                            </select>
                            <?=form_error('level')?>
                        </div>

                        <div class="form-group">
                            <label>Photo</label>
                            <br>
                            <img class="card-img-top img-fluid " onclick="$('#photo').click()" id="img" 
                                src="<?=site_url('assets/images/picture.jpg')?>">
                            <br>
                            <small>(Biarkan kosong jika tidak ada gambar)</small>
                            <input name="photo"  id="photo" type="file" accept="image/*" class="form-control">
                        </div>
                        
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-send"></i> Simpan</button>
                            <button type="reset" class="btn btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    <div class="modal fade" id="modalcrop">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                <img id='modalimg' class='img-fluid' src="" />
                </div>
            </div>
            <div class="modal-footer">
                <button type='button' class='btn btn-danger btn-sm' onclick='cropping()'>Crop Gambar</button>
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.7/cropper.min.js" crossorigin="anonymous"></script>
    <script>
    //Global Variabel (Optional)
    var croppers=null;
    var file=null;

    //Trigger Ketika Input Type File di Click
    $('#photo').change(function () {
        fileCount = this.files.length;
        if(fileCount && (this.files[0].type=="image/jpeg"||this.files[0].type=="image/jpg"||this.files[0].type=="image/png")){
            //Menampilkan Gambar ke Modal
            $('#modalimg').attr("src",URL.createObjectURL(event.target.files[0]));

            //Menampilkan Popup Modal
            $('#modalcrop').modal('show');

            //Memberikan Timeout/Waktu Jeda selama 0.5 Detik Untuk Menyiapkan Cropper JS
            setTimeout(function(){
                const image = document.getElementById('modalimg');
                var height = $('#img').height();
                var width = $('#img').width();

                //Parameter dari Cropper JS (Baca di https://fengyuanchen.github.io/cropperjs/)
                var cropper = new Cropper(image, {
                  viewMode: 3,
                  aspectRatio: 4 / 4,
                  movable: false,
                  zoomable: false,
                  width:width,
                  height:height,
                  crop(event) {
                  },
                });

                //Assignment hasil cropper ke variabel Global Croppers
                croppers=cropper;
            },500);
        }else{alert('Ekstensi File Harus Image');}
      });

      //Fungsi Ketika Tombol Crop Gambar di Jalankan
      function cropping(){
        croppers.getCroppedCanvas({height:160,width:160}).toBlob(function(blob){
          //Untuk mengganti tampilan dengan gambar yang sudah di crop
            $("#img").attr('src',''+URL.createObjectURL(blob));
            // $("#photo").attr('data',''+URL.createObjectURL(blob));

          //menyimpan hasil gambar yang sudah di potong ke dalam variabel global file

          //Menutup Popup Modal
          $('#modalcrop').modal('hide');
        },'image/jpeg',0.8);
        
    }

    </script>

