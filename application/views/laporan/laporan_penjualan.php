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
        <div class="box-header with-border">
            <h3 class="box-title">Filter Data</h3>
        </div>
        <div class="box-body">
            <form action="" method="post">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: left">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal1" value="<?=@$post['tanggal1']?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: left">Kasir</label>
                            <div class="col-sm-9">
                                <select name="kasir" class="form-control">
                                    <option value="">- Semua -</option>
                                    <?php foreach($kasir as $k => $data) { ?>
                                    <option value="<?=$data->id_user?>" <?=@$post['kasir'] == $data->id_user ? 'selected' : ''?>><?=ucfirst($data->username)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: left">Pelanggan</label>
                            <div class="col-sm-9">
                                <select name="customer" class="form-control">
                                    <option value="">- Semua -</option>
                                    <option value="null" <?=@$post['customer'] == 'null' ? 'selected' : ''?>>Umum</option>
                                    <?php foreach($customer as $c => $data) { ?>
                                    <option value="<?=$data->id_customer?>" <?=@$post['customer'] == $data->id_customer ? 'selected' : ''?>><?=$data->nama?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: left">Invoice</label>
                            <div class="col-sm-9">
                                <input type="text" name="invoice" value="<?=@$post['invoice']?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">s/d</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal2" value="<?=@$post['tanggal2']?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="pull-right">
                        <button type="submit" name="reset" class="btn btn-flat">Reset</button>
                        <button type="submit" name="filter" class="btn btn-info btn-flat">
                            <i class="fa fa-search"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
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
                    $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                        <td class="text-center" width="5%"><?=$no++?></td>
                        <td><?=$data->invoice?></td>
                        <td><?=indo_date($data->tanggal)?></td>
                        <td><?=$data->id_customer == null ? "Umum" : $data->nama_customer?></td>
                        <td class="text-right"><?=indo_currency($data->total_harga)?></td>
                        <td class="text-right"><?=$data->diskon?></td>
                        <td class="text-right"><?=indo_currency($data->harga_semua)?></td>
                        <td><?=ucfirst($data->kasir)?></td>
                        <td class="text-center" width="180px">
                            <button class="btn btn-default btn-xs" id="detail" 
                            data-toggle="modal" 
                            data-target="#modal-detail"
                            data-sale_id="<?=$data->id_penjualan?>"
                            data-invoice="<?=$data->invoice?>"
                            data-customer="<?=$data->id_customer == null ? "Umum" : $data->nama_customer?>"
                            data-tanggal="<?=$data->tanggal_input?>"
                            data-total="<?=indo_currency($data->total_harga)?>"
                            data-kasir="<?=ucfirst($data->kasir)?>"
                            data-diskon="<?=indo_currency($data->diskon)?>"
                            data-bayar="<?=indo_currency($data->bayar)?>"
                            data-total_akhir="<?=indo_currency($data->harga_semua)?>"
                            data-kembalian="<?=indo_currency($data->kembalian)?>"
                            data-catatan="<?=$data->nota?>"
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
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                <?=$pagination?>
            </ul>
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
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tr>
                        <th style="width:20%">Invoice</th>
                        <td style="width:30%"><span id="invoice"></span></td>
                        <th style="width:20%">Pelanggan</th>
                        <td style="width:30%"><span id="customer"></span></td>
                    </tr>
                    <tr>
                        <th>Diinput</th>
                        <td><span id="tanggal"></span></td>
                        <th>Kasir</th>
                        <td><span id="kasir"></span></td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><span id="total"></span></td>
                        <th>Bayar</th>
                        <td><span id="bayar"></span></td>
                    </tr>
                    <tr>
                        <th>Diskon</th>
                        <td><span id="diskon"></span></td>
                        <th>Kembalian</th>
                        <td><span id="kembalian"></span></td>
                    </tr>
                    <tr>
                        <th>Total Akhir</th>
                        <td><span id="total_akhir"></span></td>
                        <th>Catatan</th>
                        <td><span id="catatan"></span></td>
                    </tr><tr>
                        <th>Produk</th>
                        <td colspan="3"><span id="produk"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '#detail', function(){
    $('#invoice').text($(this).data('invoice'));
    $('#customer').text($(this).data('customer'));
    $('#tanggal').text($(this).data('tanggal'));
    $('#kasir').text($(this).data('kasir'));
    $('#total').text($(this).data('total')); 
    $('#diskon').text($(this).data('diskon')); 
    $('#bayar').text($(this).data('bayar')); 
    $('#total_akhir').text($(this).data('total_akhir')); 
    $('#kembalian').text($(this).data('kembalian')); 
    $('#catatan').text($(this).data('catatan')); 

    var produk = '<table class="table no-margin">'
    produk += '<tr><th>Barang</th><th>Harga</th><th>Qty</th><th>Disk</th><th>total</th></tr>'

    $.getJSON('<?=site_url('laporan/produk/')?>'+$(this).data('sale_id'), function(data) {
        $.each(data, function(key, val){
            produk += '<tr><td>'+val.nama+'</td><td>'+val.harga+'</td><td>'+val.qty+'</td><td>'+val.diskon_barang+'</td><td>'+val.total+'</td></tr>'
        })
        produk += '</table>'
        $('#produk').html(produk)
    })

})
</script>