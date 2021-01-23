<!-- Content Header (Page header) -->
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
            <h3 class="box-title">Edit Data Pengguna</h3>
            <div class="pull-right">
                <a href="<?=site_url('user')?>" class="btn btn-warning btn-sm">
                <i class="fa fa-undo"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="userid" value="<?=$row->id_user?>">
                        <div class="form-group <?=form_error('nama') ? 'has-error' : null?>">
                            <label for="nama">Nama *</label>
                            <input type="text" name="nama" value="<?=$this->input->post('nama') ?? $row->nama?>" class="form-control"> <!--$this->input->post('nama') ? $this->input->post('nama') : $row->name -->
                            <?=form_error('nama')?>
                        </div>
                        <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                            <label for="username">Username *</label>
                            <input type="text" name="username" value="<?=$this->input->post('username') ?? $row->username?>" class="form-control">
                            <?=form_error('username')?>
                        </div>
                        <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                            <label for="password">Password</label><small> (Biarkan kosong jika tidak diganti)</small>
                            <input type="password" name="password" value="<?=$this->input->post('password')?>" class="form-control">
                            <?=form_error('password')?>
                        </div>
                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                            <label for="passconf">Konfirmasi Password</label>
                            <input type="password" name="passconf" value="<?=$this->input->post('passconf')?>" class="form-control">
                            <?=form_error('passconf')?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control"><?=$this->input->post('alamat') ?? $row->alamat?></textarea>
                        </div>
                        <div class="form-group <?=form_error('level') ? 'has-error' : null?>">
                            <label for="level">Level *</label>
                            <select name="level" class="form-control">
                                <?php $level = $this->input->post('level') ?? $row->level ?>
                                <option value="1" >Admin</option>
                                <option value="2" <?=$level == 2 ? 'selected' : null?>>Kasir</option>
                            </select>
                            <?=form_error('level')?>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <small>(Biarkan kosong jika tidak diganti)</small>
                            <?php if($row->photo != null){ ?>
                                        <div style="marrgin-bottom: 4px">
                                            <img src="<?=base_url('uploads/photos/'.$row->photo)?>" style="width: 80%"> 
                                        </div>
                                <?php    } ?>
                            <input type="file" name="photo" class="form-control" >
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
