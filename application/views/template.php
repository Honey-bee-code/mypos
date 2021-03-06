<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AplikasiKu</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="icon" href="<?=base_url('assets/images/bee.png')?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="<?=base_url()?>assets/googlefont.css">
    <!-- Sweetalert -->
    <style>
        .swal2-popup {
            font-size: 1.6rem !important;
        }
    </style>
</head>
<body class="hold-transition skin-purple sidebar-mini <?=$this->uri->segment(1) == 'penjualan' ? 'sidebar-collapse' : null?>">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url('dashboard')?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="<?=base_url()?>assets/dist/img/bee.png" style="width: 40px"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="<?=base_url()?>assets/dist/img/bee.png" style="width: 40px"><b>Aplikasi</b>Ku</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php 
                                $pp = base_url('uploads/photos/'.$this->fungsi->user_login()->photo);
                                $dp = base_url('assets/images/picture.jpg');
                                $null = base_url('uploads/photos/');
                            ?>
                            <img src="<?=$pp == $null ? $dp : $pp?>" class="user-image" alt="User Image" style="height: 30px; width: 30px; border-radius: 50%; object-fit: cover; ">
                            <span class="hidden-xs"><?=$this->session->userdata('username')?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?=$pp == $null ? $dp : $pp?>" class="img-circle" alt="User Image" style="height: 110px; width: 110px; border-radius: 50%; object-fit: cover; ">
                                <p><?=$this->fungsi->user_login()->nama?>
                                    <small><?=$this->fungsi->user_login()->alamat?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?=site_url('auth/logout')?>" class="btn  btn-flat bg-red">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?=$pp == $null ? $dp : $pp?>" class="img-circle" alt="User Image" style="height: 30px; width: 30px; border-radius: 50%; object-fit: cover; ">
                </div>
                <div class="pull-left info">
                    <p><?=ucfirst($this->fungsi->user_login()->username)?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU NAVIGASI</li>
                <li <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : ''?>>
                    <a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li <?=$this->uri->segment(1) == 'customer' ? 'class="active"' : ''?>>
                    <a href="<?=site_url('customer')?>"><i class="fa fa-users"></i> <span>Pelanggan</span></a>
                </li>
                <li class="treeview <?=$this->uri->segment(1) == 'stok' || $this->uri->segment(1) == 'penjualan' ? 'active' : ''?>">
                    <a href="#">
                        <i class="fa fa-shopping-cart"></i><span>Transaksi</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?=$this->uri->segment(1) == 'penjualan' ? 'class="active"' : ''?>>
                            <a href="<?=site_url('penjualan')?>"><i class="fa fa-circle-o"></i> Penjualan</a>
                        </li>
                        <li <?=$this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'masuk' ? 'class="active"' : ''?>>
                            <a href="<?=site_url('stok/masuk')?>"><i class="fa fa-circle-o"></i> Stok Masuk</a>
                        </li>
                        <li <?=$this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'keluar' ? 'class="active"' : ''?>>
                            <a href="<?=site_url('stok/keluar')?>"><i class="fa fa-circle-o"></i> Stok Keluar</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?=$this->uri->segment(1) == 'laporan' ? 'active' : ''?>">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i><span>Laporan</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?=$this->uri->segment(1) == 'laporan' || $this->uri->segment(1) == 'penjualan' ? 'class="active"' : ''?>><a href="<?=site_url('laporan/penjualan')?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
                        <li <?=$this->uri->segment(1) == 'laporan' || $this->uri->segment(1) == 'stok' ? 'class="active"' : ''?>><a href="<?=site_url('laporan/stok')?>"><i class="fa fa-circle-o"></i> Stok</a></li>
                    </ul>
                </li>
                <li <?=$this->uri->segment(1) == 'supplier' ? 'class="active"' : ''?>><a href="<?=site_url('supplier')?>"><i class="fa fa-truck"></i> <span>Suppliers</span></a></li>
                <li class="treeview <?=$this->uri->segment(1) == 'kategori' || $this->uri->segment(1) == 'unit' || $this->uri->segment(1) == 'barang' ? 'active' : ''?>" >
                    <a href="#">
                        <i class="fa fa-archive"></i><span>Produk</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?=$this->uri->segment(1) == 'kategori' ? 'class="active" ' : ''?>><a href="<?=site_url('kategori')?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
                        <li <?=$this->uri->segment(1) == 'unit' ? 'class="active"' : ''?>><a href="<?=site_url('unit')?>"><i class="fa fa-circle-o"></i> Unit</a></li>
                        <li <?=$this->uri->segment(1) == 'barang' ? 'class="active"' : ''?>><a href="<?=site_url('barang')?>"><i class="fa fa-circle-o"></i> Barang</a></li>
                    </ul>
                </li>
                <?php if($this->fungsi->user_login()->level == 1) { ?> 
                <li class="header">Administrasi</li>
                <li <?=$this->uri->segment(1) == 'user' ? 'class="active"' : ''?>><a href="<?=site_url('user')?>"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>
                
                <?php } ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    
    <!-- jQuery 3 -->
    <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- DataTables -->
    <script src="<?=base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- variabel isi_konten ada di library Template -->
        <?php echo $isi_konten ?> 
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy <?=date('Y');?><a href="https://api.whatsapp.com/send?phone=6285237585803&text=Assalamualaikum,%20Haloo%20honeybeecode.com,%20Saya%20butuh%20bantuan,.." style="color: white; text-decoration: none"> Kaligrafi Lombok</a></strong>
    </footer>
</div>


<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- Sweetalert -->
<script src="<?=base_url()?>assets/sweetalert/sweetalert2.min.js"></script>


<script>
    $(document).ready(function(){
        $('#tabel').DataTable()
        $('#tabel1').DataTable()
    })
</script>

</body>
</html>
