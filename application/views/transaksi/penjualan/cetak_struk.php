<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <title>AplikasiKu - Cetak Struk</title>
        <style type="text/css">
            html { font-family: "Verdana, Arial"; }
            .content {
                width: 80mm;
                font-size: 12px;
                padding: 5px;
            }
            .title {
                text-align: center;
                font-size: 13px;
                padding-bottom: 5px;
                border-bottom: 1px dashed;
            }
            .head {
                margin-top: 5px;
                margin-bottom: 10px;
                padding-bottom: 10px;
                border-bottom: 1px solid;
            }
            table {
                width: 100%;
                font-size: 12px;
            }
            .thanks {
                margin-top:10px;
                padding-top: 10px;
                text-align: center;
                border-top: 1px dashed;
            }
            @media print {
                @page {
                    width: 80mm;
                    margin: 0mm;
                }
            }
        </style>
    </head>
    <body onload="window.print()">
        <div class="content">
            <div class="title">
                <b>HoneyBee-Store</b>
                <br>
                Perumahan Bellpark 1 Blok G17 Midang
                <br>
                <small>Gunungsari - Lombok Barat - NTB</small>
            </div>

            <div class="head">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width: 130px">
                            <?php
                            echo date("d/m/Y", strtotime($sale->tanggal))." ".date("H:i", strtotime($sale->tanggal_input));
                            ?>
                        </td>
                        <td>Kasir</td>
                        <td style="text-align: center; width: 10px"></td>
                        <td style="text-align: right">
                            <?=ucfirst($sale->kasir)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?=$sale->invoice?>
                        </td>
                        <td>Pelanggan</td>
                        <td style="text-align: center"></td>
                        <td style="text-align: right">
                            <?=ucfirst($sale->id_customer == null ? "Umum" : $sale->nama_customer)?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="transaction">
                <table class="transaction-table" cellspacing="0" cellpadding="0">
                    <?php
                    // $arr_discount = array();
                    foreach($sale_detail as $key => $value) { ?>
                    <tr>
                        <td></td>
                        <td style="width: 135px"><?=$value->nama?></td>
                        <td style="text-align: left;"><?=$value->qty?></td>
                        <td style="text-align: right; width: 70px"><?=indo_currency($value->harga)?></td>
                        <td style="text-align: right; width: 70px">
                            <?=indo_currency(($value->harga - $value->diskon_barang) * $value->qty)?>
                        </td>
                    </tr>

                    <?php 
                    if($value->diskon_barang > 0){
                        $arr_discount[] = $value->diskon_barang;
                        }
                    }

                        foreach($arr_discount as $key =>$value){ 
                    
                    // foreach($sale_detail as $key =>$value){ 
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align: right">Diskon <?=($key+1)?></td>
                        <!-- <td colspan="3" style="text-align: right">Diskon <?=($value->nama)?></td> -->
                        <td style="text-align: right"><?=indo_currency($value)?></td> <!--$value-->
                    </tr>
                    <?php }?>

                    <tr>
                        <td colspan="5" style="border-bottom: 1px dashed; padding-top: 5px"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td style="text-align: right; padding-top: 5px">Total Harga</td>
                        <td style="text-align: right; padding-top: 5px">
                            <?=indo_currency($sale->total_harga)?>
                        </td>
                    </tr>
                    <?php if($sale->diskon > 0) { ?>
                    <tr>
                        <td style="text-align: right; padding-bottom: 5px" colspan="4">Total Diskon</td>
                        <td style="text-align: right; padding-bottom: 5px"><?=indo_currency($sale->diskon)?></td>
                    </tr>
                    <?php } ?>
                    
                    <tr>
                        <td style="text-align: right; padding-bottom: 5px 0" colspan="4">Total Akhir</td>
                        <td style="text-align: right; padding-bottom: 5px 0"><?=indo_currency($sale->harga_semua)?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding-bottom: 5px" colspan="4">Bayar</td>
                        <td style="text-align: right; padding-bottom: 5px"><?=indo_currency($sale->bayar)?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right" colspan="4">Uang Kembali</td>
                        <td style="text-align: right"><?=indo_currency($sale->kembalian)?></td>
                    </tr>
                </table>
            </div>
            
            <div class="thanks">
                --- Terima Kasih ---
                <br>
                www.HoneyBeeCode.id
            </div>
        </div>
    </body>
</html>