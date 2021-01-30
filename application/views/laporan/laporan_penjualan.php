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
                        <td><?=indo_date($data->tanggal)?></td>
                        <td><?=$data->nama_customer == null ? "Umum" : $data->nama_customer?></td>
                        <td class="text-right"><?=indo_currency($data->total_harga)?></td>
                        <td class="text-right"><?=$data->diskon?></td>
                        <td class="text-right"><?=indo_currency($data->harga_semua)?></td>
                        <td><?=$data->kasir?></td>
                        <td class="text-center" width="180px">
                            <button class="btn btn-default btn-xs" id="detail" 
                            data-toggle="modal" 
                            data-target="#modal-detail"
                            data-invoice="<?=$data->invoice?>"
                            data-customer="<?=$data->nama_customer == null ? "Umum" : $data->nama_customer?>"
                            data-tanggal="<?=$data->tanggal_input?>"
                            data-kasir="<?=$data->kasir?>"
                            >Detail</button>
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
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Detail Laporan Penjualan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                    <label>Invoice</label>
                    </div>
                    <div class="col-sm-3">
                        <span id="invoice"></span>
                    </div>
                    <div class="col-sm-3">
                        <label>Pelanggan</label>
                    </div>
                    <div class="col-sm-3">
                        <span id="customer"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Tanggal & waktu</label>
                    </div>
                    <div class="col-sm-3">
                        <span id="tanggal"></span>
                    </div>
                    <div class="col-sm-3">
                        <label>Kasir</label>
                    </div>
                    <div class="col-sm-3">
                        <span id="kasir"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#detail', function(){
            $('#invoice').text($(this).data('invoice'));
            $('#customer').text($(this).data('customer'));
            $('#tanggal').text($(this).data('tanggal'));
            $('#kasir').text($(this).data('kasir')); 
        })
    })
</script>