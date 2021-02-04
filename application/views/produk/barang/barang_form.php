<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Barang
    <small>Data Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Barang</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Data Barang</h3>
            <div class="pull-right">
                <a href="<?=site_url('barang')?>" class="btn btn-warning btn-sm">
                <i class="fa fa-undo"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php echo form_open_multipart('barang/proses') ?>
                    <!-- <form action="<?=site_url('barang/proses')?>" method="post"> -->
                        <input type="hidden" name="id" value="<?=$row->id_barang?>">
                        <div class="form-group">
                            <label>Barcode *</label>
                            <input type="text" name="barcode" value="<?=$row->barcode?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang *</label>
                            <input type="text" name="nama_barang" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori *</label>
                            <select name="kategori" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach($kategori->result() as $key => $data) { ?>
                                <option value="<?=$data->id_kategori?>" <?=$data->id_kategori == $row->id_kategori ? "selected" : null?>><?=$data->nama?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Satuan Unit *</label>
                            <?php echo form_dropdown('unit', $unit, $selected_unit, ['class' => 'form-control', 'required' => 'required']) ?>
                        </div>
                        <div class="form-group">
                            <label>Harga *</label>
                            <input type="number" name="harga" value="<?=$row->harga?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Diskon</label>
                            <input type="number" name="diskon" value="<?=$row->diskon_barang?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <?php if($page == 'edit'){
                                    if($row->gambar != null){ ?>
                                        <div style="marrgin-bottom: 4px">
                                            <img src="<?=base_url('uploads/produk/'.$row->gambar)?>" style="width: 80%"> 
                                        </div>
                                        <?php 
                                        }
                                    } ?>
                            <small>(Biarkan kosong jika tidak <?=$page == 'edit' ? 'diganti' : 'ada gambar'?>)</small>
                            <input type="file" name="gambar" class="form-control" >
                        </div>
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>" class="btn btn-success btn-sm"><i class="fa fa-send"></i> Simpan</button>
                            <button type="reset" class="btn btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                        </div>

                    <!-- </form> -->
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
