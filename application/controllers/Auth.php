<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('st');
    }

    public function index(){
        $this->form_validation->set_rules('username','Username','trim|required|min_length[5]',[
            'min_length' => 'Username too short'
        ]);
        $this->form_validation->set_rules('password','Password','trim|required|min_length[5]',[
            'min_length' => 'Password too short'
        ]);
        if($this->form_validation->run() == false){
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');   
        }else{
            $this->_login();
        }

    }

    private function _login(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->db->get_where('t_user', ['username' => $username])->row_array();
            if($user){
                //cek aktif atau tidak
                if($user['status'] == 'aktif' || 'Aktif'){
                    //cek password
                    if(password_verify($password, $user['password'])){
                        $data = [
                            'username' => $user['username'],
                            'id_role' => $user['id_role'],
                            'id_user' => $user['id_user']
                        ];
                        $this->session->set_userdata($data);
                        if($user['id_role'] == 1){
                            redirect('index.php/Admin');
                        }elseif($user['id_role'] == 2){
                            redirect('index.php/staf');
                        }elseif($user['id_role'] == 3){
                            redirect('index.php/manager');
                        }else{
                            redirect('index.php/generalmanager');
                        }
                    }else{
                        $this->session->set_flashdata('message','<div class="alert
                        alert-danger" role="alert">Password salah</div>');
                        redirect('index.php/auth');
                    }

                }else{
                $this->session->set_flashdata('message','<div class="alert
                alert-danger" role="alert">Akun ini tidak aktif</div>');
                redirect('index.php/auth');
                }

            }else{
                $this->session->set_flashdata('message','<div class="alert
                alert-danger" role="alert">Username tidak terdaptar</div>');
                redirect('index.php/auth');
            }
          
    }

    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message','<div class="alert
        alert-success" role="alert">You Have Been Logout</div>');
        redirect('index.php/auth');

    }

    public function blocked(){
        $data['title'] = '403 Forbidden';
        $this->load->view('errors/index', $data);
        
    }

}
