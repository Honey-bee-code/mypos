<?php

Class Fungsi {

    protected $ci;

    function __construct() {
        $this->ci =& get_instance();
    }

    function user_login() {
        $this->ci->load->model('user_m');
        $userid = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($userid)->row();
        return $user_data;
    }

    function PdfGenerator($html, $namafile, $kertas, $orientasi) {
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($kertas, $orientasi);
        $dompdf->render();
        $dompdf->stream($namafile, array('Attachment' => 0)); //attachment untuk menampilkan html pdf
    }
}