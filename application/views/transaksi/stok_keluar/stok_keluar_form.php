<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Stok Keluar
    <small>Barang Keluar (rusak, kadaluarsa, hilang, dsb)</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Transaksi</li>
    <li class="active">Stok Keluar</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Stok Keluar</h3>
            <div class="pull-right">
                <a href="<?=site_url('stok/keluar')?>" class="btn btn-warning btn-sm">
                <i class="fa fa-undo"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?=site_url('stok/proses_keluar')?>"  method="post">
                    <!-- <?=validation_errors()?> -->
                        <div class="form-group <?=form_error('tanggal') ? 'has-error' : null?>">
                            <label>Tanggal *</label>
                            <input type="date" name="tanggal" value="<?=date('Y-m-d')?>" class="form-control">
                            <?=form_error('tanggal')?>
                        </div>
                        <div>
                            <label for="barcode">Barcode *</label>
                        </div>
                        <div class="form-group input-group <?=form_error('barcode') ? 'has-error' : null?>">
                            <input type="hidden" name="id_barang" id="id_barang">
                            <input type="text" name="barcode" id="barcode" value="<?=set_value('barcode')?>" class="form-control"  autofocus">
                            <?=form_error('barcode')?>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" 
                                data-target="#modal-barang">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang *</label>
                            <input type="text" name="nama_barang" id="nama_barang" value="<?=set_value('nama_barang')?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="nama_unit">Satuan Barang</label>
                                    <input type="text" name="nama_unit" id="nama_unit" value="<?=set_value('nama_unit')?>" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="stok">Stok Awal</label>
                                    <input type="text" name="stok" id="stok" value="<?=set_value('stok')?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group <?=form_error('detail') ? 'has-error' : null?>">
                            <label for="detail">Detail Barang *</label>
                            <input type="text" name="detail"  id="detail" value="<?=set_value('detail')?>" class="form-control" placeholder="Hilang / rusak / kadaluarsa / dll" >
                            <?=form_error('detail')?>
                        </div>
                        
                        <div class="form-group <?=form_error('qty') ? 'has-error' : null?>">
                            <label>QTY *</label>
                            <input type="number" name="qty" id="qty" class="form-control">
                            <?=form_error('qty')?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" id="submit" class="btn btn-success btn-sm"><i class="fa fa-send"></i> Simpan</button>
                            <button type="reset" class="btn btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-barang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Silahkan Pilih Barang</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped" id="tabel">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Nama</th>
                            <th>Unit</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($barang as $key => $data){ ?>
                        <tr>
                            <td><?=$data->barcode?></td>
                            <td><?=$data->nama?></td>
                            <td><?=$data->nama_unit?></td>
                            <td class="text-right"><?=indo_currency($data->harga)?></td>
                            <td class="text-right"><?=$data->stok?></td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-info" id="pilih" 
                                data-id="<?=$data->id_barang?>"
                                data-barcode="<?=$data->barcode?>"
                                data-nama="<?=$data->nama?>"
                                data-unit="<?=$data->nama_unit?>"
                                data-stok="<?=$data->stok?>">
                                    <i class="fa fa-check"></i> Pilih
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '#pilih', function(){
    var id_barang = $(this).data('id');
    var barcode = $(this).data('barcode');
    var nama = $(this).data('nama');
    var nama_unit = $(this).data('unit');
    var stok = $(this).data('stok');
    $('#id_barang').val(id_barang);
    $('#barcode').val(barcode);
    $('#nama_barang').val(nama);
    $('#nama_unit').val(nama_unit);
    $('#stok').val(stok);
    $('#modal-barang').modal('hide');
})

</script>