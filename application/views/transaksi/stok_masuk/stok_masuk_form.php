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
            <h3 class="box-title">Tambah Stok Masuk</h3>
            <div class="pull-right">
                <a href="<?=site_url('stok/masuk')?>" class="btn btn-warning btn-sm">
                <i class="fa fa-undo"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?=site_url('stok/proses')?>" method="post">
                        <div class="form-group">
                            <label>Tanggal *</label>
                            <input type="date" name="tanggal" value="<?=date('Y-m-d')?>" class="form-control" required>
                        </div>
                        <div>
                            <label for="barcode">Barcode *</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="hidden" name="id_barang" id="id_barang">
                            <input type="text" name="barcode" id="barcode" class="form-control" required autofocus">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-barang">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang *</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="nama_unit">Satuan Barang</label>
                                    <input type="text" name="nama_unit" id="nama_unit" value="-" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="stok">Inisial Stok</label>
                                    <input type="text" name="stok" id="stok" value="-" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Detail Barang *</label>
                            <input type="text" name="detail" id="detail" class="form-control" placeholder="Kulakan / tambahan / dll" required>
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="supplier" id="" class="form-control">
                                <option value="">- Pilih -</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>QTY *</label>
                            <input type="number" name="qty" id="qty" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="tambah" class="btn btn-success btn-sm"><i class="fa fa-send"></i> Simpan</button>
                            <button type="reset" class="btn btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
