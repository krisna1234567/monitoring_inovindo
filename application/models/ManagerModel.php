<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerModel extends CI_Model {

    public function list_user(){
       $queryUser = 'SELECT * FROM t_user JOIN t_role ON t_user.id_role = t_role.id_role WHERE akses=1'; 
       return $this->db->query($queryUser);
    }
    public function role(){
        return $this->db->get('t_role');
    }
    public function getData($tableName){
        return $this->db->get($tableName);
    }
    public function hapus_data($where, $tableName){
        $res = $this->db->delete($tableName, $where);
        return $res;
    }
    public function GetUser($where=""){
        $data = $this->db->query('select * from t_user '.$where);
        return $data->result_array();
    }
    public function GetAtm($where=""){
        $data = $this->db->query('select * from t_rekening '.$where);
        return $data->result_array();
    }
    public function UpdateData($tableName, $data, $where){
        $res = $this->db->update($tableName, $data, $where);
        return $res;
    }
    public function input_invoice($no_invoice){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_user','t_user.id_user=t_invoice.id_user');
        // $this->db->join('t_order','t_order.id_order=t_invoice.id_order');
        $this->db->where('t_invoice.id_invoice =', $no_invoice);
        $query = $this->db->get();
        return $query;
     }

     public function invoice($where){
        $query = ('SELECT * FROM t_lap_invoice WHERE id_invoice ='.$where);
        $query = $this->db->query($query);
        return $query;  
    
    }
    public function sub_invoice($where){
        $query = ('SELECT * FROM t_lap_sub_invoice WHERE id_invoice ='.$where);
        $query = $this->db->query($query);
        return $query;  
    
    }
    public function laporan(){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_pemasukan','t_pemasukan.id_invoice=t_invoice.id_invoice');
        $query = $this->db->get();
        return $query;
     }
     public function laporan_all(){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_pemasukan','t_pemasukan.id_invoice=t_invoice.id_invoice');
      
        return $this->db->get(); 
    }
    public function view_by_month($awal, $akhir){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_pemasukan','t_pemasukan.id_invoice=t_invoice.id_invoice');
        $this->db->where('tgl_pemasukan >=', $awal); 
        $this->db->where('tgl_pemasukan <=', $akhir); 
        return $this->db->get(); 
    }
    public function view_by_month1($awal, $akhir){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_pemasukan','t_pemasukan.id_invoice=t_invoice.id_invoice');
        $this->db->where('tgl_pemasukan >=', $awal); 
        $this->db->where('tgl_pemasukan <=', $akhir); 
        return $this->db->get(); 
    }
    public function total_inv($awal,$akhir){
        $this->db->select_sum('total_lap_invoice',' t_inv');
        $this->db->from('t_pemasukan');
        $this->db->where('tgl_pemasukan >=', $awal); 
        $this->db->where('tgl_pemasukan <=', $akhir); 
        return $this->db->get(); 
    }
    public function total_sub_inv($awal,$akhir){
        $this->db->select_sum('total_lap_sub_invoice',' t_sub_inv');
        $this->db->from('t_pemasukan');
        $this->db->where('tgl_pemasukan >=', $awal); 
        $this->db->where('tgl_pemasukan <=', $akhir); 
        return $this->db->get();
    }

     // Pengeluaran
     public function pengeluaran(){
        $data = 'SELECT * FROM t_pengeluaran
        JOIN t_list_pengeluaran ON t_list_pengeluaran.id_list_pengeluaran=t_pengeluaran.id_list_pengeluaran
        JOIN t_user ON t_user.id_user=t_pengeluaran.id_user';
        $query = $this->db->query($data);
        return $query;
     }
     public function cari_laporan_pengeluaran($awal, $akhir){
        $this->db->select('*');
        $this->db->from('t_pengeluaran');
        $this->db->join('t_list_pengeluaran','t_list_pengeluaran.id_list_pengeluaran=t_pengeluaran.id_list_pengeluaran');
        $this->db->join('t_user','t_user.id_user=t_pengeluaran.id_user');
        $this->db->where('tgl_pengeluaran >=', $awal); 
        $this->db->where('tgl_pengeluaran <=', $akhir); 
        return $this->db->get(); 
    }
    public function total_biaya_pengeluaran($awal,$akhir){
        $this->db->select_sum('biaya_pengeluaran',' biaya');
        $this->db->from('t_pengeluaran');
        $this->db->where('tgl_pengeluaran >=', $awal); 
        $this->db->where('tgl_pengeluaran <=', $akhir); 
        return $this->db->get(); 
   
    }


}