<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Penjualan
    <small>Transaksi Penjualan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Transaksi</li>
    <li class="active">Penjualan</li>
  </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="tanggal">Tanggal</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" id="tanggal" value="<?=date('Y-m-d')?>" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="user">Kasir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="user" value="<?=$this->fungsi->user_login()->nama?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="customer">Pelanggan</label>
                            </td>
                            <td>
                                <div>
                                    <select name="" id="customer" class="form-control">
                                        <option value="">Umum</option>
                                        <?php foreach($customer as $key => $value){ ?>
                                            <option value="<?=$value->id_customer?>"><?=$value->nama?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                               <label for="barcode">Barcode</label> 
                            </td>
                            <td>
                                <div class="form-group input-group">
                                    <input type="hidden" id="id_barang">
                                    <input type="hidden" id="stok">
                                    <input type="hidden" id="harga">
                                    <input type="text" id="barcode" class="form-control" autofocus>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-barang">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="qty">Qty</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="qty" value="1" min="1" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div>
                                    <button type="button" id="tambah_keranjang" class="btn btn-primary">
                                        <i class="fa fa-cart-plus"> Tambah ke Keranjang</i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <div align="right">
                        <h4>Kode Transaksi <b><span id="invoice"><?= $invoice ?></span></b></h4>
                        <h1><b><span id="grand_total2" style="font-size:50pt">0</span></b></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="data"></div>

    <div class="row">
        <div class="col-lg">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="30px">No.</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right" width="10%">Diskon Barang</th>
                                <th class="text-right" width="15%">Total</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tabel_keranjang">
                            <?php $this->view('transaksi/penjualan/penjualan_data') ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="sub_total">Sub Total</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="sub_total" value="" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="diskon">Diskon</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="diskon" value="0" min="0" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="grand_total">Total Semua</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="grand_total" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top" width="30%">
                                <label for="cash">Bayar</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="cash" value="0" min="0" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="change">Uang Kembali</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="change" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top">
                                <label for="note">Nota</label>
                            </td>
                            <td>
                                <div>
                                    <textarea id="note" rows="3" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div>
                <button id="cancel_payment" class="btn btn-flat btn-warning">
                    <i class="fa fa-refresh"></i> Batalkan
                </button>
                <br><br>
                <button id="proses_payment" class="btn btn-flat btn-lg btn-success">
                    <i class="fa fa-paper-plane-o"></i> Proses Pembayaran
                </button>
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
                                data-harga="<?=$data->harga?>"
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
<div class="modal fade" id="modal-barang-edit">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Keranjang Barang</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="cartid_barang"> <!-- wajib ada, hampir lupa -->
                <div class="form-group">
                    <label for="barcode_barang">Produk barang</label>
                    <div class="row">
                        <div class="col-lg-5">
                            <input type="text" id="barcode_barang" class="form-control" readonly>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" id="produk_barang" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga_barang">Harga</label>
                    <input type="number" id="harga_barang" class="form-control">
                </div>
                <div class="form-group">
                    <label for="qty_barang">Qty</label>
                    <input type="number" id="qty_barang" class="form-control">
                </div>
                <div class="form-group">
                    <label for="diskon_barang">Diskon per barang</label>
                    <input type="number" id="diskon_barang" class="form-control">
                </div>
                <div class="form-group">
                    <label for="total_barang">Total setelah diskon</label>
                    <input type="number" id="total_barang" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" id="update_keranjang" class="btn btn-flat btn-primary">
                        <i class="fa fa-paper-plane"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '#pilih', function(){
    $('#id_barang').val($(this).data('id'))
    $('#barcode').val($(this).data('barcode'))
    $('#harga').val($(this).data('harga'))
    $('#stok').val($(this).data('stok'))
    $('#modal-barang').modal('hide')
})

$(document).on('click', '#tambah_keranjang', function(){
    var idBarang = $('#id_barang').val()
    var harga = $('#harga').val()
    var stok = $('#stok').val()
    var qty = $('#qty').val()
    if(id_barang == ''){
        alert('Produk / barang belum dipilih')
        $('#barcode').focus()
    } else if(stok < 1) {
        alert('Stok tidak mencukupi')
        $('#id_barang').val('')
        $('#barcode').val('')
        $('#barcode').focus()
    } else {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('penjualan/proses')?>',
            data: {'tambah_keranjang' : true, 'id_barang' : idBarang, 'harga' : harga, 'qty' : qty},
            dataType: 'json',
            success: function(result){
                        if(result.success == true) {
                            $('#tabel_keranjang').load('<?=site_url('penjualan/cart_data')?>', function(){

                            })
                            $('#id_barang').val('')
                            $('#barcode').val('')
                            $('#qty').val(1)
                            $('#barcode').focus('')
                        } else {
                            alert('Gagal menambahkan barang ke keranjang')
                        }
                    }

            })
        }
})

$(document).on('click', '#edit_keranjang', function() {
    $('#cartid_barang').val($(this).data('cartid'))
    $('#barcode_barang').val($(this).data('barcode'))
    $('#produk_barang').val($(this).data('produk'))
    $('#harga_barang').val($(this).data('harga'))
    $('#qty_barang').val($(this).data('qty'))
    $('#total_sebelum').val($(this).data('harga') * $(this).data('qty'))
    $('#diskon_barang').val($(this).data('diskon'))
    $('#total_barang').val($(this).data('total'))
})
function hitung_edit_modal() {
    var harga = $('#harga_barang').val()
    var qty = $('#qty_barang').val()
    var diskon = $('#diskon_barang').val()
    
    total_sebelum = harga * qty
    $('#total_sebelum').val(total_sebelum)
    
    total = (harga - diskon) * qty
    $('#total_barang').val(total)
}
$(document).on('keyup mouseup', '#harga_barang, #qty_barang, #diskon_barang', function() {
    hitung_edit_modal()
})

$(document).on('click', '#hapus_keranjang', function(){
    if(confirm('Apakah anda yakin')){
        var cart_id = $(this).data('cartid')
        $.ajax({
            type: 'POST',
            url: '<?=site_url('penjualan/cart_del')?>',
            dataType: 'json',
            data: {'id_cart' : cart_id},
            success: function(result) {
                if(result.success == true) {
                    $('#tabel_keranjang').load('<?=site_url('penjualan/cart_data')?>', function(){

                    })
                } else {
                    alert('Gagal menghapus barang dari keranjang')
                }
            }
        })
    }
})

$(document).on('click', '#update_keranjang', function(){
    var cart_id = $('#cartid_barang').val()
    var harga = $('#harga_barang').val()
    var qty = $('#qty_barang').val()
    var diskon = $('#diskon_barang').val()
    var total = $('#total_barang').val()
    if(harga == '' || harga < 1){
        alert('Harga tidak boleh kosong')
        $('#harga_barang').focus()
    } else if(qty == '' || qty < 1) {
        alert('Qty minimal 1')
        $('#qty_barang').focus('')
    } else {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('penjualan/proses')?>',
            data: {'edit_keranjang' : true, 'id_cart' : cart_id, 'harga' : harga, 
                    'qty' : qty, 'diskon' : diskon, 'total' : total},
            dataType: 'json',
            success: function(result){
                        if(result.success == true) {
                            $('#tabel_keranjang').load('<?=site_url('penjualan/cart_data')?>', function(){

                            })
                            // alert('Data keranjang barang berhasil di update')
                            $('#modal-barang-edit').modal('hide');
                        } else {
                            alert('Data keranjang barang tidak bisa di update')
                        }
                    }

            })
            // alert('proses')
        }
})

</script>