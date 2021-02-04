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
            <h3 class="box-title">Data Barang</h3>
            <div class="pull-right">
                <a href="<?=site_url('barang/tambah')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Data Barang</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabel">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Barcode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan Unit</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Stok</th>
                        <th>Gambar</th>

                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                     <?php 
                    $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                        <td class="text-center" width="5%"><?=$no++?></td>
                        <td>
                            <?=$data->barcode?><br>
                            <a href="<?=site_url('barang/barcode_qrcode/' .$data->id_barang)?>" class="btn btn-default btn-xs">
                                Cetak  <i class="fa fa-barcode"></i>  <i class="fa fa-qrcode"></i> 
                            </a>
                        </td>
                        <td><?=$data->nama?></td>
                        <td><?=$data->nama_kategori?></td>
                        <td><?=$data->nama_unit?></td>
                        <td style="text-align: right"><?=indo_currency($data->harga)?></td>
                        <td style="text-align: right"><?=indo_currency($data->diskon_barang)?></td>
                        <td style="text-align: right"><?=$data->stok?></td>
                        <td class="text-center">
                            <?php if($data->gambar != null){ ?>
                                <img src="<?=base_url('uploads/produk/'.$data->gambar)?>" style="width: 100px"> 
                            <?php } ?>
                        </td>
                        <td class="text-center" width="140px">
                                <a href="<?=site_url('barang/edit/' .$data->id_barang)?>" class="btn btn-success btn-xs">
                                    <i class="fa fa-pencil"></i> Update
                                </a>
                                <a href="<?=site_url('barang/hapus/' .$data->id_barang)?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
