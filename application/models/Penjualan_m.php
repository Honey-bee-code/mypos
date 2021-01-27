<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_m extends CI_Model {


    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice, 10, 4)) AS nomor_invoice 
                FROM t_penjualan 
                WHERE MID(invoice, 4, 6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->nomor_invoice) + 1;
            $no = sprintf("%'04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "HBC".date('ymd').$no;
        return $invoice;
    }

    public function get_cart($param = null)
    {
        $this->db->select('*, p_barang.nama as nama_barang, t_keranjang.harga as harga_keranjang'); //tanda (*) artinya semua field
        $this->db->from('t_keranjang');
        $this->db->join('p_barang', 't_keranjang.id_barang = p_barang.id_barang');
        if($param != null){
            $this->db->where($param);
        }
        $this->db->where('id_user', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($data)
    {
        $query = $this->db->query("SELECT MAX(id_keranjang) AS no_keranjang FROM t_keranjang");
        if($query->num_rows() > 0) {
            $row = $query->row();
            $nomor = ((int)$row->no_keranjang) + 1;
        } else {
            $nomor =  "1";
        }

        $param = array(
            'id_keranjang' => $nomor,
            'id_barang' => $data['id_barang'],
            'harga' => $data['harga'],
            'qty' => $data['qty'],
            'total' => ($data['harga'] * $data['qty']), // bisa dikasi kurung, bisa juga tidak
            'id_user' => $this->session->userdata('userid')
        );
        $this->db->insert('t_keranjang', $param);
    } 
}