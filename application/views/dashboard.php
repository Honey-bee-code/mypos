<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?=$total_barang?></h3>
          <p>Data Barang</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag">
          </i>
        </div>
        <a href="<?=site_url('barang')?>" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?=$total_pelanggan?></h3>
          <p>Data Pelanggan</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker">
          </i>
        </div>
        <a href="<?=site_url('customer')?>" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>

</section>
