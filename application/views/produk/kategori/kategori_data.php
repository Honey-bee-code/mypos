<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kategori
    <small>Jenis Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Kategori</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Kategori</h3>
            <div class="pull-right">
                <a href="<?=site_url('kategori/tambah')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Data</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabel">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama</th>
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
                        <td><?=$data->created?></td>
                        <td><?=$data->updated?></td>
                        <td class="text-center" width="140px">
                                <a href="<?=site_url('kategori/edit/' .$data->id_kategori)?>" class="btn btn-success btn-xs">
                                    <i class="fa fa-pencil"></i> Update
                                </a>
                                <a href="<?=site_url('kategori/hapus/' .$data->id_kategori)?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs">
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
