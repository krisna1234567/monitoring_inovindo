<?php  if( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('rupiah')){
    function rupiah($angka){
        $hasil_rupiah ="Rp. ".number_format($angka, 0, ",", ",");
        return $hasil_rupiah;
    }
}

if(!function_exists('rupiah2')){
    function rupiah2($angka){
        $hasil_rupiah =number_format($angka, 0, ",", ".");
        return $hasil_rupiah;
    }
}

    function penyebut($nilai){
        $nilai = abs($nilai);
        $huruf = array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepulih","sebelas");
        $temp ="";
        if($nilai<12){
            $temp= " ".$huruf[$nilai];
        }elseif ($nilai < 20){
            $temp = penyebut($nilai-10). " belas";
        }elseif($nilai < 100){
            $temp = penyebut($nilai/10). " puluh". penyebut($nilai % 10);
        }elseif($nilai < 200){
            $temp = " seratus" . penyebut($nilai-100);
        }elseif($nilai < 1000){
            $temp = penyebut($nilai/100). " ratus". penyebut($nilai % 100);
        }elseif($nilai < 2000){
            $temp = " seribu". penyebut($nilai-1000);
        }elseif($nilai < 1000000){
            $temp = penyebut($nilai/1000). " ribu". penyebut($nilai % 1000);
        }elseif($nilai < 1000000000){
            $temp = penyebut($nilai/1000000). " juta". penyebut($nilai % 1000000);
        }
        elseif($nilai < 1000000000000){
            $temp = penyebut($nilai/1000000000). " milyar". penyebut(fmod($nilai % 1000000000));
        }elseif($nilai < 1000000000000000){
            $temp = penyebut($nilai/1000000000000). " tryliun". penyebut(fmod($nilai % 1000000000000));
        }
        return $temp;
    }

    function terbilang($nilai){
        if($nilai<0){
            $hasil = "minus ". trim(penyebut($nilai));
        }else{
            $hasil = trim(penyebut($nilai));
        }
        return $hasil;
    }

