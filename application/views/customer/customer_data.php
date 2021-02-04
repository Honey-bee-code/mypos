<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Customers
    <small>Pelanggan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Customers</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Pelanggan</h3>
            <div class="pull-right">
                <a href="<?=site_url('customer/tambah')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Data</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="tabel-customer">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Alamat</th>
                        <th>Total Belanja</th>
                        <!-- <th>Created</th> -->
                        <!-- <th>Updated</th> -->
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
$("#tabel-customer").DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
        "url" : "<?=site_url('customer/get_json')?>",
        "type" : "POST"
    },
    "columns" : [
        { "data" : "no", width:40 },
        { "data" : "nama", width:150 },
        { "data" : "gender", width:70 },
        { "data" : "phone", width:120 },
        { "data" : "alamat", width:150 },
        { "data" : "total_belanja", width:80 },
        { "data" : "opsi", width:100 }
    ],
    "columnDefs" : [
        { "targets" : [0, 6], "orderable" : false },
        { "targets" : [2, -1], "className" : "text-center" }
    ]
})
</script>