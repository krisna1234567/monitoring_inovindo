<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged_in();
        $this->load->model('StafModel');
        $this->load->helper('tgl_indo');
        }
    
    public function index(){
        
        $data['title'] = 'Staf Akta';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('staf/index', $data);
        $this->load->view('templates/footer');
      
    }

    public function list_order(){
        $data['title'] = 'Staf Akta';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $id= array('id_role' => 3);
        $data['stafs'] =$this->StafModel->GetStaf($id, 't_user');
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $where = $data['user']['id_user'];
        $data['invoices'] = $this->StafModel->list_order($where)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('staf/list-order', $data);
        $this->load->view('templates/footer');
    }

    public function detail_invoice($where){
        $where = array('id_invoice' => $where);
        $data1['title'] = 'Staf Akta';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $order= $this->db->get_where('t_invoice', $where)->result_array();        
        $data = array(
            "id_invoice" => $order[0]['id_invoice'],
            "no_invoice" => $order[0]['no_invoice'],
            "tgl_invoice" => $order[0]['tgl_invoice'],
            "id_user" => $order[0]['id_user'],
            "id_order" => $order[0]['id_order'],
            "jns_order1" => $order[0]['jns_order1'],
            "nasabah" => $order[0]['nasabah'],
            "deadline_akta" => $order[0]['deadline_akta'],
            "lama_pengerjaan" => $order[0]['deadline_akta'],
            "status_invoice" => $order[0]['status_invoice'],
        );
        $id= array('id_role' => 3);
        $data['users'] =$this->StafModel->GetStaf($id, 't_user');
        $data['orders'] = $this->StafModel->getData('t_order');
        $data['perusahaan'] = $this->StafModel->getData('t_perusahaan');
       
        $this->load->view('templates/header', $data1);
        $this->load->view('staf/detail_invoice', $data);
        $this->load->view('templates/footer');
    }

    public function proses_detail(){
        $id_invoice = $_POST['id_invoice'];
        $no_invoice = $_POST['no_invoice'];
        $jns_order1 = $_POST['jns_order1'];
        $nasabah = $_POST['nasabah'];
     
        $status_invoice = $_POST['status'];
        $data_update = array(
            'jns_order1' => $jns_order1,
            'nasabah' => $nasabah,
           
            'lama_pengerjaan' => 0,
            'status_invoice' => $status_invoice,
        );
        $where = array('id_invoice' => $id_invoice);
        $res = $this->StafModel->UpdateData('t_invoice', $data_update, $where);
        if($res){
            redirect('index.php/staf/list_order', 'refresh');
        }else{
         echo "<h2>Update Data Gagal </h2>";
        }
    }

    public function lihat_invoice($where){
        $data['title'] = 'Staf Akta';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $where = $where;
        $data1['invoices'] = $this->StafModel->lihat_order($where)->result_array();
       
        $this->load->view('templates/header', $data);
        $this->load->view('staf/lihat_invoice', $data1);
        $this->load->view('templates/footer');
    }

    public function mulai_invoice($id_invoice){

        $waktu= $this->StafModel->waktu("where id_invoice = '$id_invoice' ");
        $tgl_mulai = strtotime($waktu[0]['tgl_invoice']);
        $deadline = strtotime($waktu[0]['deadline_akta']);
        $todays_date = date("Y-m-d H:i:s");
        $interval =$deadline-$tgl_mulai;
        $selisih = floor($interval/(60*60*24));
        $data_update = array(
            'lama_pengerjaan' => $selisih,
            'status_invoice' => 1,
        );
        $where = array('id_invoice' => $id_invoice);
        $res = $this->StafModel->UpdateData('t_invoice', $data_update, $where);
        $this->session->set_flashdata('message','<div class="alert
        alert-success" role="alert">Invoice Sudah Dimulai</div>');
        if($res){
            redirect('index.php/staf/list_order', 'refresh');
        }else{
         echo "<h2>Update Data Gagal </h2>";
        }
    }

    public function finish($id_invoice){
        $data['title'] = 'Staf Akta';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data_update = array(
            'status_invoice' => 4,
        );
        $where = array('id_invoice' => $id_invoice);
        $res = $this->StafModel->UpdateData('t_invoice', $data_update, $where);
        $this->session->set_flashdata('message','<div class="alert
        alert-success" role="alert">Pengerjaan selesai dikerjakan</div>');
        if($res){
            redirect('index.php/staf/list_order', 'refresh');
        }else{
         echo "<h2>Update Data Gagal </h2>";
        }
    }

    public function profile(){
        $data1['title'] = 'Form Edit Profile';
        $where = array('username'=> $this->session->userdata('username'));
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $user= $this->db->get_where('t_user',$where)->result_array();
        $data = array(
            "id_user" => $user[0]['id_user'],
            "username" => $user[0]['username'],
            "nama_user" => $user[0]['nama_user'],
            "hp" => $user[0]['hp'],
            "status" => $user[0]['status'],
            "id_role" => $user[0]['id_role'],
            "email" => $user[0]['email'],
        );
        // var_dump($data['users']); die;
        $this->load->view('templates/header', $data1);
        $this->load->view('staf/profile', $data);
        $this->load->view('templates/footer');
    }
    public function proses_edit_profile(){
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        // $password = $_POST['password1'];
        $nama_user = $_POST['nama_user'];
        $hp = $_POST['hp'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        if(empty($pass1)){
            $data_update = array(
                'nama_user' => $nama_user,
                'hp' => $hp,
                'email' => $email,
                'status' => $status,
                'id_role' => $role,
               
            );
            $where = array('id_user' => $id_user);
            $res = $this->StafModel->UpdateData('t_user', $data_update, $where);
            if($res){
                $this->session->set_flashdata('sukses','<div class="alert
                alert-success" role="alert">Data Berhasil Diubah</div>');
                redirect('index.php/staf/profile');
            }else{
                $this->session->set_flashdata('gagal','<div class="alert
                alert-danger" role="alert">Data Gagal Diubah</div>');
                redirect('index.php/staf/profile');
            }
        }else{
            $data_update = array(
                'password' =>password_hash($pass1,PASSWORD_DEFAULT ),
                'nama_user' => $nama_user,
                'hp'=> $hp,
                'email' => $email,
                'status' => $status,
                'id_role' => $role,
            );
            $where = array('id_user' => $id_user);
            $res = $this->StafModel->UpdateData('t_user', $data_update, $where);
            if($res){
                $this->session->set_flashdata('sukses','<div class="alert
                alert-success" role="alert">Data Berhasil Diubah</div>');
                redirect('index.php/staf/profile');
            }else{
                $this->session->set_flashdata('gagal','<div class="alert
                alert-danger" role="alert">Data Gagal Diubah</div>');
                redirect('index.php/staf/profile');
            }

        }

    }

    public function list_invoice_all(){
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $id= array('id_role' => 3);
        $data['stafs'] =$this->StafModel->GetStaf($id, 't_user');
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices'] = $this->StafModel->list_order1()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('staf/list_invoice_all', $data);
        $this->load->view('templates/footer');
        
    }

    

      
    



    


}