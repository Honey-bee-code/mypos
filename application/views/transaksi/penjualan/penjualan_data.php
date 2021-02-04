<?php $no = 1;
if($keranjang->num_rows() > 0) {
    foreach($keranjang->result() as $k => $data){ ?>
<tr>
    <td><?=$no++?>.</td>
    <td class="barcode"><?=$data->barcode?></td>
    <td><?=$data->nama_barang?></td>
    <td class="text-right"><?=($data->harga_keranjang)?></td>
    <td class="text-right"><?=$data->qty?></td>
    <td class="text-right"><?=$data->diskon_per_barang?></td>
    <td class="text-right" id="total"><?=$data->total?></td>
    <td class="text-center" width="140px">
        <button id="edit_keranjang" data-toggle="modal" data-target="#modal-barang-edit"
            data-cartid="<?=$data->id_keranjang?>"
            data-barcode="<?=$data->barcode?>"
            data-produk="<?=$data->nama_barang?>"
            data-stok="<?=$data->stok?>"
            data-harga="<?=$data->harga_keranjang?>"
            data-qty="<?=$data->qty?>"
            data-diskon="<?=$data->diskon_per_barang?>"
            data-total="<?=$data->total?>"
            class="btn btn-xs btn-primary">
            <i class="fa fa-pencil"></i> Edit
        </button>
        <button id="hapus_keranjang" data-cartid="<?=$data->id_keranjang?>" class="btn btn-xs btn-danger">
            <i class="fa fa-trash"></i> Hapus
        </button>
    </td>
</tr>
<?php } } else { ?>
<tr>
    <td colspan="8" class="text-center">Tidak ada barang</td>
</tr>
<?php } ?>