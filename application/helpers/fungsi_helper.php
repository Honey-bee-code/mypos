<?php

function sudah_login() {
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    if($user_session){
        redirect('dashboard');
    }
}

function tidak_login() {
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    if(!$user_session){
        redirect('auth/login');
    }
}

function cek_admin() {
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->user_login()->level != 1){
        redirect('dashboard');
    }
}

function indo_currency($value){
return 'Rp. ' . number_format($value, 0, ",", ".");
}

function indo_date($tanggal){
    $d = substr($tanggal, 8, 2);
    $m = substr($tanggal, 5, 2);
    $y = substr($tanggal, 0, 4);
    return $d.'-'.$m.'-'.$y;
}