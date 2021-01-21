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
            <h3 class="box-title">Histori Stok Keluar</h3>
            <div class="pull-right">
                <a href="<?=site_url('stok/keluar/tambah')?>" class="btn btn-primary btn-sm">
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
                        <th>Detail</th>
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
                        <td><?=$data->detail?></td>
                        <td class="text-right"><?=$data->qty?></td>
                        <td class="text-center"><?=indo_date($data->tanggal)?></td>
                        <td class="text-center" width="140px">
                                <a class="btn btn-default btn-xs" id="detail_klik"
                                data-toggle="modal" 
                                data-target="#modal-detail"
                                data-barcode="<?=$data->barcode?>"
                                data-namabarang="<?=$data->nama_barang?>"
                                data-detail="<?=$data->detail?>"
                                data-qty="<?=$data->qty?>"
                                data-tanggal="<?=indo_date($data->tanggal)?>">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                                <a href="<?=site_url('stok/keluar/hapus/' .$data->id_stok.'/'.$data->id_barang)?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs">
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Detail Stok Masuk</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <body>
                        <tr>
                            <th style="width: 35%">Barcode</th>
                            <td><span id="barcode"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <td><span id="namabarang"></span></td>
                        </tr>
                        <tr>
                            <th>Qty</th>
                            <td><span id="qty"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><span id="tanggal"></span></td>
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td><span id="detail"></span></td>
                        </tr>
                    </body>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#detail_klik', function(){
            var barcode = $(this).data('barcode');
            var namabarang = $(this).data('namabarang');
            var supplier = $(this).data('supplier');
            var qty = $(this).data('qty');
            var tanggal = $(this).data('tanggal');
            var detail = $(this).data('detail');
            $('#barcode').text(barcode); // pake text karena <span>
            $('#namabarang').text(namabarang);
            $('#supplier').text(supplier);
            $('#qty').text(qty);
            $('#tanggal').text(tanggal);
            $('#detail').text(detail);
        })
    })
</script>