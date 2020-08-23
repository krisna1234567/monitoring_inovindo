<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StafModel extends CI_Model {
    public function list_order1(){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_user','t_user.id_user=t_invoice.id_user');
        // $this->db->join('t_order','t_order.id_order=t_invoice.id_order');
        $this->db->order_by('id_invoice desc');
        $query = $this->db->get();
        return $query;
     }

    public function list_order($where){
       $this->db->select('*');
       $this->db->from('t_invoice');
       $this->db->join('t_user','t_user.id_user=t_invoice.id_user');
    //    $this->db->join('t_order','t_order.id_order=t_invoice.id_order');
       $this->db->where('t_user.id_user', $where);
       $this->db->order_by('id_invoice DESC');
       $query = $this->db->get();
       return $query;
    }
    public function lihat_order($where){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_user','t_user.id_user=t_invoice.id_user');
        // $this->db->join('t_order','t_order.id_order=t_invoice.id_order');
        $this->db->where('t_invoice.id_invoice', $where);
        $this->db->order_by('id_invoice DESC');
        $query = $this->db->get();
        return $query;
     }
    public function getData($table){
        return $this->db->get($table)->result_array();
    }
    public function hapus_data($where, $tableName){
        $res = $this->db->delete($tableName, $where);
        return $res;
    }
    public function GetStaf($where, $table){
        $data = $this->db->get_where($table,$where);
        return $data->result_array();
    }
    public function UpdateData($tableName, $data, $where){
        $res = $this->db->update($tableName, $data, $where);
        return $res;
    }
    public function waktu($where){
        $data = $this->db->query('select tgl_invoice, deadline_akta from t_invoice '.$where);
        return $data->result_array();
    }

}