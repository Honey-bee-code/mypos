<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Pengguna
    <small>Yang boleh menggunakan aplikasi ini</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Pengguna</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Pengguna</h3>
            <div class="pull-right">
                <a href="<?=site_url('user/tambah')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-user-plus"></i> Tambah Data</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabel">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Username</th>
                        <!-- <th>Password</th> -->
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Level</th>
                        <th>Photo</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                        <td class="text-center" width="5%"><?=$no++?></td>
                        <td><?=$data->username?></td>
                        <!-- <td><?=$data->password?></td> -->
                        <td><?=$data->nama?></td>
                        <td><?=$data->alamat?></td>
                        <td><?=$data->level == 1 ? "Admin" : "Kasir"?></td>
                        <td>
                            <?php if($data->photo != null){ ?>
                            <img src="<?=base_url('uploads/photos/'.$data->photo)?>" style="width: 100px">
                            <?php } ?>
                        </td>
                        <td class="text-center" width="140px">
                            <form action="<?=site_url('user/hapus')?>" method="post">
                                <input type="hidden" name="userid" value="<?=$data->id_user?>">
                                <a href="<?=site_url('user/edit/' .$data->id_user)?>" class="btn btn-success btn-xs">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
