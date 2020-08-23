<?php  if( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('bulan')){
    function bulan($bln){
        switch ($bln){
            case 1:
                Return "Januari";
            break;
            case 2:
                Return "Februari";
            break;
            case 3:
                Return "Maret";
            break;
            case 4:
                Return "April";
            break;
            case 5:
                Return "Mei";
            break;
            case 6:
                Return "Juni";
            break;
            case 7:
                Return "Juli";
            break;
            case 8:
                Return "Agustus";
            break;
            case 9:
                Return "September";
            break;
            case 10:
                Return "Oktober";
            break;
            case 11:
                Return "November";
            break;
            case 12:
                Return "Desember";
            break;
        }
    }
}
if( ! function_exists('longdate_indo')){
    function longdate_indo($tanggal){
        date_default_timezone_set('Asia/Jakarta');
        $ubah = gmdate($tanggal, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];
        $bulan = bulan($pecah[1]);

        $nama=  date("l", mktime(0,0,0,$bln,$tgl,$thn));
        $nama_hari = "";
        if($nama=="Sunday"){ $nama_hari="Minggu";}
        elseif($nama=="Monday"){$nama_hari="Senin";}
        elseif($nama=="Tuesday"){$nama_hari="Selasa";}
        elseif($nama=="Wednesday"){$nama_hari="Rabu";}
        elseif($nama=="Thursday"){$nama_hari="Kamis";}
        elseif($nama=="Friday"){$nama_hari="Jumat";}
        elseif($nama=="Saturday"){$nama_hari="Sabtu";}
        return $nama_hari.', '.$tgl.' '.$bulan.' '.$thn;

    }

    if( ! function_exists('bulan_indo')){
        function bulan_indo($tanggal){
            date_default_timezone_set('Asia/Jakarta');
            $ubah = gmdate($tanggal, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tgl = $pecah[2];
            $thn = $pecah[0];
            $bulan = bulan($pecah[1]);
            return $tgl.' '.$bulan.' '.$thn;
    
        }
    }
    if( ! function_exists('bulan_indo2')){
        function bulan_indo2($tanggal){
            date_default_timezone_set('Asia/Jakarta');
            $ubah = gmdate($tanggal, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tgl = $pecah[2];
            $thn = $pecah[0];
            $bulan = bulan($pecah[1]);
            return $bulan.' '.$thn;
    
        }
    }
}