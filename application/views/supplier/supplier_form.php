<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Suppliers
    <small>Pemasok Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Suppliers</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Data Supplier</h3>
            <div class="pull-right">
                <a href="<?=site_url('supplier')?>" class="btn btn-warning btn-sm">
                <i class="fa fa-undo"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?=site_url('supplier/proses')?>" method="post">
                        <input type="hidden" name="id" value="<?=$row->id_supplier?>">
                        <div class="form-group">
                            <label for="nama">Nama Supplier *</label>
                            <input type="text" name="nama_supplier" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Phone *</label>
                            <input type="number" name="phone" value="<?=$row->phone?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Alamat *</label>
                            <textarea name="alamat_supplier" class="form-control" required><?=$row->alamat?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nama">Keterangan</label>
                            <textarea name="keterangan" class="form-control" ><?=$row->keterangan?></textarea>
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
