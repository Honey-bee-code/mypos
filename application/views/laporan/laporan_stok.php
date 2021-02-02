<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Laporan Stok
    <small>Barang Masuk / Barang Keluar</small>
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
            <h3 class="box-title">Data Stok</h3>
            
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabel">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama Barang</th>
                        <th>Tipe Data</th>
                        <th>Detail</th>
                        <th>Nama Supplier</th>
                        <th>Qty</th>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach($row as $key => $data) { ?>
                    <tr>
                        <td class="text-center" width="5%"><?=$no++?></td>
                        <td><?=$data->nama_barang?></td>
                        <td><?=ucfirst($data->tipe)?></td>
                        <td><?=$data->detail?></td>
                        <td><?=$data->supplier?></td>
                        <td><?=$data->qty?></td>
                        <td><?=$data->tanggal?></td>
                        <td><?=ucfirst($data->user)?></td>
                        <td class="text-center" width="140px">
                            <a class="btn btn-default btn-xs" id="detail_klik"
                            data-toggle="modal" 
                            data-target="#modal-detail"
                            data-tipe="<?=ucfirst($data->tipe)?>"
                            data-barcode="<?=$data->barcode?>"
                            data-namabarang="<?=$data->nama_barang?>"
                            data-supplier="<?=$data->supplier?>"
                            data-detail="<?=$data->detail?>"
                            data-qty="<?=$data->qty?>"
                            data-tanggal="<?=indo_date($data->tanggal)?>">
                                <i class="fa fa-eye"></i> Detail
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
                <h4 class="modal-title">Detail Data Stok</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <body>
                        <tr>
                            <th style="width: 35%">Tipe Data</th>
                            <td><span id="tipe"></span></td>
                        </tr>
                        <tr>
                            <th style="width: 35%">Barcode</th>
                            <td><span id="barcode"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <td><span id="namabarang"></span></td>
                        </tr>
                        <tr>
                            <th>Supplier</th>
                            <td><span id="supplier"></span></td>
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
            $('#tipe').text($(this).data('tipe'));
        })
    })
</script>