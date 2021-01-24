<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Suppliers
    <small>Pemasok Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Suppliers</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Suppliers</h3>
            <div class="pull-right">
                <a href="<?=site_url('supplier/tambah')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Data</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabel">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama</th>
                        <th>Phone</th>
                        <th>Alamat</th>
                        <th>Keterangan</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                        <td class="text-center" width="5%"><?=$no++?></td>
                        <td><?=$data->nama?></td>
                        <td><?=$data->phone?></td>
                        <td><?=$data->alamat?></td>
                        <td><?=$data->keterangan?></td>
                        <td><?=$data->created?></td>
                        <td><?=$data->updated?></td>
                        <td class="text-center" width="140px">
                                <a href="<?=site_url('supplier/edit/' .$data->id_supplier)?>" class="btn btn-success btn-xs">
                                    <i class="fa fa-pencil"></i> Update
                                </a>
                                <!-- <a href="<?=site_url('supplier/hapus/' .$data->id_supplier)?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Hapus
                                </a> -->
                                <a href="#modalHapus" data-toggle="modal" onclick="$('#modalHapus #formHapus').attr('action', '<?=site_url('supplier/hapus/' .$data->id_supplier)?>')" class="btn btn-danger btn-xs">
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
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Yakin akan menghapus data ini?</h4>
            </div>
            <div class="modal-footer">
                <form id="formHapus" action="" method="post">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-danger" type="submit">Tentu Saja</button>
                </form>
            </div>
        </div>
    </div>
</div>