<?php  if( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('generateCode')){

    function generateCode(){
        $possible ='123456789';
        $operator = '123';
        $a = substr($possible, mt_rand(0,strlen($possible)-1), 1);
        $b = substr($possible, mt_rand(0,strlen($possible)-1), 1);
        $c = substr($possible, mt_rand(0,strlen($operator)-1), 1);
        $str_num = array(
            "Satu",
            "Dua",
            "Tiga",
            "Empat",
            "Lima",
            "Enam",
            "Tujuh",
            "Delapan",
            "Sembilan",
        );

        if($c=='1'){
            $res = $a + $b;
            $text_opr = "Ditambah";
        }elseif($c=='2'){
            $res = $a * $b;
            $text_opr = "Dikali";
        }else{
            $res = $a - $b;
            $text_opr = "Dikurang";
        }
        $code['res'] = $res;
        $code['text'] = "Berapa ".$a.' '.$text_opr.' '. $b . '?';
        return $code;


    }

}