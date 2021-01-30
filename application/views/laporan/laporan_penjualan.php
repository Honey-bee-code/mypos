<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Laporan Penjualan
    <small>Sales Report</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li><a href="#">Laporan</a></li>
    <li class="active">Penjualan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Penjualan</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Diskon</th>
                        <th>Total Akhir</th>
                        <th>Kasir</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                        <td class="text-center" width="5%"><?=$no++?></td>
                        <td><?=$data->invoice?></td>
                        <td><?=$data->tanggal?></td>
                        <td><?=$data->nama_customer == null ? "Umum" : $data->nama_customer?></td>
                        <td class="text-right"><?=indo_currency($data->total_harga)?></td>
                        <td class="text-right"><?=$data->diskon?></td>
                        <td class="text-right"><?=indo_currency($data->harga_semua)?></td>
                        <td><?=$data->kasir?></td>
                        <td class="text-center" width="180px">
                            <button class="btn btn-default btn-xs">Detail</button>
                                <a href="<?=site_url('penjualan/cetak/' .$data->id_penjualan)?>" target="_blank" class="btn btn-info btn-xs">
                                    <i class="fa fa-print"></i> Cetak
                                </a>
                                <a href="<?=site_url('penjualan/hapus/' .$data->id_penjualan)?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs">
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
