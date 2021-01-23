<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Barang
    <small>Data Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Barang</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Barcode Generator</h3>
            <div class="pull-right">
                <a href="<?=site_url('barang')?>" class="btn btn-warning btn-sm">
                <i class="fa fa-undo"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <?php
            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
            ?>
            <br>
            <?=$row->barcode?>
            <br><br>
            <!-- target _blank agar terbuka di tab baru -->
            <a href="<?=site_url('barang/barcode_print/' .$row->id_barang)?>" target="_blank" class="btn btn-default btn-sm"> 
                <i class="fa fa-print"></i> Cetak PDF
            </a>
        </div>
    </div>
</section>
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">QrCode Generator</h3>
        </div>
        <div class="box-body">
            <?php
              include "assets/phpqrcode/qrlib.php"; 
              $tempdir = "uploads/qrcode/qrcode-$row->barcode";
              //isi qrcode jika di scan
              $codeContents = $row->barcode; 
              $style = array(
                'border' => true,
                'padding' => 4,
                'fgcolor' => array(0,0,0),
                'bgcolor' => array(255,255,255)
                );
              //output gambar langsung ke browser, sebagai PNG
              QRcode::png($codeContents,$tempdir.".png",QR_ECLEVEL_L, 10,1);
              echo '<img src="'.base_url().''.$tempdir.'.png" style="width: 200px">'
            ?>
            <br>
            <?=$row->barcode?>
            <br><br>
            <!-- target _blank agar terbuka di tab baru -->
            <a href="<?=site_url('barang/qrcode_print/' .$row->id_barang)?>" target="_blank" class="btn btn-default btn-sm"> 
                <i class="fa fa-print"></i> Cetak PDF
            </a>
        </div>
    </div>
</section>