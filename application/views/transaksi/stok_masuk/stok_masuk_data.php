<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Stok Masuk
    <small>Barang Masuk / Pembelian</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Transaksi</li>
    <li class="active">Stok Masuk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Histori Stok Masuk</h3>
            <div class="pull-right">
                <a href="<?=site_url('stok/masuk/tambah')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Data</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabel">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Barcode</th>
                        <th>Barang</th>
                        <th>Supplier</th>
                        <th>Qty</th>
                        <th>Tanggal</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach($row as $key => $data) { ?>
                    <tr>
                        <td class="text-center" width="5%"><?=$no++?></td>
                        <td><?=$data->barcode?></td>
                        <td><?=$data->nama_barang?></td>
                        <td><?=$data->nama_supplier?></td>
                        <td class="text-right"><?=$data->qty?></td>
                        <td class="text-center"><?=indo_date($data->tanggal)?></td>
                        <td class="text-center" width="140px">
                                <a class="btn btn-default btn-xs">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                                <a href="<?=site_url('stok/masuk/hapus/' .$data->id_stok)?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs">
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
