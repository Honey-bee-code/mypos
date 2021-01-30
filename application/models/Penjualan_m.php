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

    public function hapus($param = null)
    {
        if($param != null) {
            $this->db->where($param);
        }
        $this->db->delete('t_keranjang');
    }
    public function kosongkan()
    {
        $this->db->truncate('t_keranjang');
    }

    public function update_cart_qty($post) {
        $sql = "UPDATE t_keranjang SET 
                harga = '$post[harga]',
                qty = qty + '$post[qty]',
                total = '$post[harga]' * qty
                WHERE id_barang = '$post[id_barang]'";
        $this->db->query($sql);
    }

    public function edit_cart($post)
    {
        $param = array(
            'harga' => $post['harga'],
            'qty' => $post['qty'],
            'diskon_barang' => $post['diskon'],
            'total' => $post['total'],
        );
        $this->db->where('id_keranjang' , $post['id_cart']);
        $this->db->update('t_keranjang', $param);
    }

    public function add_sale($post)
    {
        $param = array(
            'invoice' => $this->invoice_no(),
            'id_customer' => $post['id_customer'] == "" ? null : $post['id_customer'],
            'total_harga' => $post['subtotal'],
            'diskon' => $post['diskon'],
            'harga_semua' => $post['grandtotal'],
            'bayar' => $post['cash'],
            'kembalian' => $post['change'],
            'nota' => $post['catatan'],
            'tanggal' => $post['tanggal'],
            'id_user' => $this->session->userdata('userid'),
        );
        $this->db->insert('t_penjualan', $param);
        return $this->db->insert_id(); //insert_id bawaan CI untuk
    }
    function add_sale_detail($param) {
        $this->db->insert_batch('t_penjualan_detail', $param);
    }

    public function get_sale($id = null)
    {
        $this->db->select('*, customer.nama as nama_customer, user.username as kasir,
                            t_penjualan.created as tanggal_input');
        $this->db->from('t_penjualan');
        $this->db->join('customer', 't_penjualan.id_customer = customer.id_customer', 'left');
        $this->db->join('user', 't_penjualan.id_user = user.id_user');
        if($id != null) {
            $this->db>where('id_penjualan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_sale_detail($sale_id = null)
    {
        $this->db->from('t_penjualan_detail');
        $this->db->join('p_barang', 't_penjualan_detail.id_barang = p_barang.id_barang');
        if($sale_id != null) {
            $this->db->where('t_penjualan_detail.id_penjualan', $sale_id);
        }
        $query = $this->db->get();
        return $query;
    }
}