<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kategori
    <small>Kategori Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Kategori</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Data Kategori</h3>
            <div class="pull-right">
                <a href="<?=site_url('kategori')?>" class="btn btn-warning btn-sm">
                <i class="fa fa-undo"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?=site_url('kategori/proses')?>" method="post">
                        <input type="hidden" name="id" value="<?=$row->id_kategori?>">
                        <div class="form-group">
                            <label for="nama">Nama Kategori *</label>
                            <input type="text" name="nama_kategori" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>" class="btn btn-success btn-sm"><i class="fa fa-send"></i> Simpan</button>
                            <button type="reset" class="btn btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
