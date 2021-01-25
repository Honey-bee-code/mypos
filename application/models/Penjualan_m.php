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
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "HBC".date('ymd').$no;
        return $invoice;
    }
}