<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generalmanager extends CI_Controller {
     
    public function __construct(){
        parent::__construct();
        is_logged_in();
        $this->load->model('ManagerModel');
        $this->load->model('KeuanganModel');
        $this->load->helper('tgl_indo');
        $this->load->helper('rupiah');
        }

    public function index(){
        $data['title'] = 'Manager';
        $status = array('status_invoice'=>5);
        $status2 = array('status_invoice'=>3);
        $status3 = array('status_invoice'=>0);
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $data['userall']= $this->db->get('t_user')->num_rows();
        $data['selesai']= $this->db->get_where('t_invoice',$status)->num_rows();
        $data['mulai']= $this->db->get_where('t_invoice',$status2)->num_rows();
        $data['masuk']= $this->db->get_where('t_invoice',$status3)->num_rows();
        $data['perusahaan']= $this->db->get('t_perusahaan')->num_rows();
        $data['data'] = $this->KeuanganModel->laporan_pendapatan_grafik_harian()->result();
        $data['data2'] = $this->KeuanganModel->laporan_pendapatan_grafik_perbulan()->result();
        $this->load->view('manager/index', $data);
        $this->load->view('templates/footer');
     
    }

    public function list_user(){
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $user['users'] = $this->ManagerModel->list_user()->result_array();
        $data['roles'] = $this->ManagerModel->role()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('manager/list-user', $user);
        $this->load->view('templates/footer');

    }
    public function list_notaris(){
        $data['title'] = 'Data Notaris';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['notaris'] = $this->ManagerModel->getData('t_notaris')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('manager/list_notaris', $data);
        $this->load->view('templates/footer');

    }
    public function list_order(){
        $data['title'] = 'Jenis Akad';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['orders'] = $this->ManagerModel->getData('t_order')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('manager/list_order', $data);
        $this->load->view('templates/footer');

    }
    public function list_perusahaan(){
        $data['title'] = 'List Perusahaan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->ManagerModel->getData('t_perusahaan')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('manager/list_perusahaan', $data);
        $this->load->view('templates/footer');

    }
    public function tambah_user(){
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $user['users'] = $this->ManagerModel->list_user()->result_array();
        $data['roles'] = $this->ManagerModel->role()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('manager/tambah_user');
        $this->load->view('templates/footer');
        
    }
    public function tambah_notaris(){
        $nama = $this->input->post('nama_notaris');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $email = $this->input->post('email');

        $data= array(
            'nama_notaris' => $nama,
            'alamat' => $alamat,
            'telp' => $telp,
            'email' => $email,
        );
        $query= $this->db->insert('t_notaris', $data);
        if($query){
            $this->session->set_flashdata('sukses','<div class="alert
            alert-success" role="alert">Berhasil !</div>');
            redirect('index.php/manager/list_notaris', 'refresh');
        }else{
            $this->session->set_flashdata('error','<div class="alert
            alert-danger" role="alert">Gagal !</div>');
            redirect('index.php/manager/list_notaris', 'refresh');
        }
        
    }

    public function tambah_order(){
        $nama = $this->input->post('order');
        $data= array(
            'jns_order' => $nama,
        );
        $query= $this->db->insert('t_order', $data);
        if($query){
            $this->session->set_flashdata('sukses','<div class="alert
            alert-success" role="alert">Berhasil !</div>');
            redirect('index.php/manager/list_order', 'refresh');
        }else{
            $this->session->set_flashdata('error','<div class="alert
            alert-danger" role="alert">Gagal !</div>');
            redirect('index.php/manager/list_order', 'refresh');
        }
        
    }


    public function proses_tambah_user(){
        $this->form_validation->set_rules('username','Username','required|trim|min_length[5]|is_unique[t_user.username]',[
        'is_unique' => 'Username sudah terdapftar'
        ]);
        $this->form_validation->set_rules('password1','Password','required|trim|min_length[8]|matches[password2]',[
                'matches' => 'password dont match!',
                'min_length'=> 'Password too short'
                ]);
        $this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');
        $this->form_validation->set_rules('name','Name','required|trim');
        $this->form_validation->set_rules('hp','HP','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email'); 
        $this->form_validation->set_rules('role','Role','required|trim');
        $this->form_validation->set_rules('status','Status','required|trim');

        if($this->form_validation->run() == false){
            $data['title'] = 'Data User';
            $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $user['users'] = $this->ManagerModel->list_user()->result_array();
            $data['roles'] = $this->ManagerModel->role()->result_array();
            $this->load->view('templates/header', $data);
          
            $this->load->view('manager/tambah_user');
            $this->load->view('templates/footer');
        
        }else{
            $data = [
                'username' => htmlspecialchars($this->input->post('username',true)),
                'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT ),
                'nama_user' => htmlspecialchars($this->input->post('name',true)),
                'hp' => htmlspecialchars($this->input->post('hp',true)),
                'email' => htmlspecialchars($this->input->post('email',true)), 
                'id_role' =>htmlspecialchars($this->input->post('role',true)),
                'status' =>htmlspecialchars($this->input->post('status',true)),
            ];

            $this->db->insert('t_user', $data);
            $this->session->set_flashdata('message','<div class="alert
            alert-success" role="alert">Congratulation !</div>');
            redirect('index.php/manager/list_user', 'refresh');


        }
    }

    public function hapus_data($id){
        $where = array('id_user' => $id);
        $res= $this->ManagerModel->hapus_data($where,'t_user');
        if($res){
            redirect('index.php/manager/list_user', 'refresh');
        }else{
         echo "<h2>Delete Data Gagal </h2>";
        }
    }

    public function hapus_order($id){
        $where = array('id_order' => $id);
        $res= $this->ManagerModel->hapus_data($where,'t_order');
        if($res){
            redirect('index.php/manager/list_order', 'refresh');
        }else{
         echo "<h2>Delete Data Gagal </h2>";
        }
    }
    public function hapus_notaris($id){
        $where = array('id_notaris' => $id);
        $res= $this->ManagerModel->hapus_data($where,'t_notaris');
        if($res){
            redirect('index.php/manager/list_notaris', 'refresh');
        }else{
         echo "<h2>Delete Data Gagal </h2>";
        }
    }

    public function edit_data($id){
        $data1['title'] = 'Data User';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $user= $this->ManagerModel->GetUser("where id_user = '$id' ");
        $data = array(
            "id_user" => $user[0]['id_user'],
            "username" => $user[0]['username'],
            "password" => $user[0]['password'],
            "nama_user" => $user[0]['nama_user'],
            "hp" => $user[0]['hp'],
            "email" => $user[0]['email'],
            "id_role" => $user[0]['id_role'],
            "status" => $user[0]['status'],
        );
        $data['roles'] = $this->db->get('t_role')->result_array();
        
        $this->load->view('templates/header', $data1);
        $this->load->view('manager/form_edit', $data);
        $this->load->view('templates/footer');
    }
    public function do_update(){
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        // $password = $_POST['password1'];
        $nama_user = $_POST['name'];
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
                'id_role' => $role,
                'status' => $status,
            );
            $where = array('id_user' => $id_user);
            $res = $this->ManagerModel->UpdateData('t_user', $data_update, $where);
            if($res){
                redirect('index.php/manager/list_user', 'refresh');
            }else{
             echo "<h2>Update Data Gagal </h2>";
            }
        }else{
            $data_update = array(
                'password' =>password_hash($pass1,PASSWORD_DEFAULT ),
                'nama_user' => $nama_user,
                'hp' => $hp,
                'email' => $email,
                'id_role' => $role,
                'status' => $status,
            );
            $where = array('id_user' => $id_user);
            $res = $this->ManagerModel->UpdateData('t_user', $data_update, $where);
            if($res){
                redirect('index.php/manager/list_user', 'refresh');
            }else{
             echo "<h2>Update Data Gagal </h2>";
            }

        }

    }
    public function list_invoice_all(){
        $data['title'] = 'Monitoring Akad';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $id= array('id_role' => 3);
        $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices'] = $this->KeuanganModel->list_order()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('manager/list_invoice_all', $data);
        $this->load->view('templates/footer');
    }

    public function restore_invoice($id_invoice){
        $data= array(
            'status_invoice'=>3,
        );
        $where = array('id_invoice' => $id_invoice);
        $res = $this->ManagerModel->UpdateData('t_invoice', $data, $where);
        if($res){
            redirect('index.php/manager/list_invoice_all', 'refresh');
        }else{
         echo "<h2>Update Data Gagal </h2>";
        }

    }

    public function restore_penagihan($id_invoice){
        $data= array(
            'status_invoice'=>4,
        );
        $where = array('id_invoice' => $id_invoice);
        $res = $this->ManagerModel->UpdateData('t_invoice', $data, $where);
        if($res){
            redirect('index.php/manager/list_invoice_all', 'refresh');
        }else{
         echo "<h2>Update Data Gagal </h2>";
        }

    }
    public function edit_notaris($id){
        $data1['title'] = 'Data User';
        $where = array('id_notaris' => $id);
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $notaris= $this->db->get_where('t_notaris',$where)->result_array();
        // var_dump ($notaris); die;
        $data = array(
            "id_notaris" => $notaris[0]['id_notaris'],
            "nama_notaris" => $notaris[0]['nama_notaris'],
            "alamat" => $notaris[0]['alamat'],
            "telp" => $notaris[0]['telp'],
            "email" => $notaris[0]['email'],
        );
        $this->load->view('templates/header', $data1);
        $this->load->view('manager/edit_notaris', $data);
        $this->load->view('templates/footer');
    }

    public function proses_ubah_notaris(){
        $id_notaris = $_POST['id_notaris'];
        $nama = $_POST['nama_notaris'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $data_update = array(
            "nama_notaris" => $nama,
            "alamat" => $alamat,
            "telp" => $telp,
            "email" => $email,
        );
        $where = array('id_notaris'=> $id_notaris);
        $res = $this->ManagerModel->UpdateData('t_notaris', $data_update, $where);
        if($res){
            redirect('index.php/manager/list_notaris', 'refresh');
        }else{
         echo "<h2>Update Data Gagal </h2>";
        }
    }

    public function edit_order($id){
        $data1['title'] = 'Data User';
        $where = array('id_order' => $id);
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $order= $this->db->get_where('t_order',$where)->result_array();
        // var_dump ($order); die;
        $data = array(
            "id_order" => $order[0]['id_order'],
            "jns_order" => $order[0]['jns_order'],
        );
        $this->load->view('templates/header', $data1);
        $this->load->view('manager/edit_order', $data);
        $this->load->view('templates/footer');
    }

    public function proses_ubah_order(){
        $id_order = $_POST['id_order'];
        $jns_order = $_POST['jns_order'];
        $data_update = array(
            "jns_order" => $jns_order,
        );
        $where = array('id_order'=> $id_order);
        $res = $this->ManagerModel->UpdateData('t_order', $data_update, $where);
        if($res){
            redirect('index.php/manager/list_order', 'refresh');
        }else{
         echo "<h2>Update Data Gagal </h2>";
        }
    }

    public function tambah_perusahaan(){
        $nama= $this->input->post('nama');
        $alamat= $this->input->post('alamat');
        $telp= $this->input->post('telp');
        $email= $this->input->post('email');
        $data = array(
            'nama_perusahaan'=>$nama,
            'alamat'=> $alamat,
            'tlp'=>$telp,
            'email'=>$email,
        );

        $this->db->insert('t_perusahaan', $data);
        $this->session->set_flashdata('sukses','<div class="alert
        alert-success" role="alert">Berhasil Ditambahkan</div>');
        redirect('index.php/manager/list_perusahaan');

    }

    public function hapus_perusahaan($id){
        $where = array('id_perusahaan' => $id);
        $res= $this->ManagerModel->hapus_data($where,'t_perusahaan');
        if($res){
            redirect('index.php/manager/list_perusahaan', 'refresh');
        }else{
         echo "<h2>Delete Data Gagal </h2>";
        }
    }

    public function edit_perusahaan($id){
        $data1['title'] = 'Data Perusahaan';
        $where = array('id_perusahaan' => $id);
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $perusahaan= $this->db->get_where('t_perusahaan',$where)->result_array();
        // var_dump ($perusahaan); die;
        $data = array(
            "id_perusahaan" => $perusahaan[0]['id_perusahaan'],
            "nama_perusahaan" => $perusahaan[0]['nama_perusahaan'],
            "alamat" => $perusahaan[0]['alamat'],
            "tlp" => $perusahaan[0]['tlp'],
            "email" => $perusahaan[0]['email'],
        );
        $this->load->view('templates/header', $data1);
        $this->load->view('manager/edit_perusahaan', $data);
        $this->load->view('templates/footer');
    }

    public function proses_ubah_perusahaan(){
        $id_perusahaan = $_POST['id_perusahaan'];
        $nama_perusahaan = $_POST['nama_perusahaan'];
        $alamat = $_POST['alamat'];
        $tlp = $_POST['telp'];
        $email = $_POST['email'];
        $data_update = array(
            "nama_perusahaan" => $nama_perusahaan,
            "alamat" => $alamat,
            "tlp" => $tlp,
            "email" => $email,
        );
        $where = array('id_perusahaan'=> $id_perusahaan);
        $res = $this->ManagerModel->UpdateData('t_perusahaan', $data_update, $where);
        if($res){
            redirect('index.php/manager/list_perusahaan', 'refresh');
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
            "id_role" => $user[0]['id_role'],
            "status" => $user[0]['status'],
            "email" => $user[0]['email'],
        );
        // var_dump($data['users']); die;
        $this->load->view('templates/header', $data1);
        $this->load->view('manager/profile', $data);
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
            $res = $this->KeuanganModel->UpdateData('t_user', $data_update, $where);
            if($res){
                $this->session->set_flashdata('sukses','<div class="alert
                alert-success" role="alert">Data Berhasil Diubah</div>');
                redirect('index.php/manager/profile');
            }else{
                $this->session->set_flashdata('gagal','<div class="alert
                alert-danger" role="alert">Data Gagal Diubah</div>');
                redirect('index.php/manager/profile');
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
            $res = $this->KeuanganModel->UpdateData('t_user', $data_update, $where);
            if($res){
                $this->session->set_flashdata('sukses','<div class="alert
                alert-success" role="alert">Data Berhasil Diubah</div>');
                redirect('index.php/manager/profile');
            }else{
                $this->session->set_flashdata('gagal','<div class="alert
                alert-danger" role="alert">Data Gagal Diubah</div>');
                redirect('index.php/manager/profile');
            }

        }
    }

    public function list_atm(){
        $data['title'] = 'Data Rekening';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['rekening'] = $this->ManagerModel->getData('t_rekening')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('manager/list_rekening', $data);
        $this->load->view('templates/footer');

    }
    public function tambah_rekening(){
        $no_rekening= $this->input->post('nomor');
        $nama_bank= $this->input->post('nama_bank');
        $nasabah= $this->input->post('nasabah');
        
        $data = array(
            'no_rekening'=>$no_rekening,
            'nama_bank'=> $nama_bank,
            'nama_nasabah'=>$nasabah,
            
        );

        $this->db->insert('t_rekening', $data);
        $this->session->set_flashdata('sukses','<div class="alert
        alert-success" role="alert">Berhasil Ditambahkan</div>');
        redirect('index.php/manager/list_atm');
    }

    public function edit_atm($id){
        $data1['title'] = 'Data User';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $rekening= $this->ManagerModel->GetAtm("where id_rekening = '$id' ");
        $data = array(
            "id_rekening" => $rekening[0]['id_rekening'],
            "no_rekening" => $rekening[0]['no_rekening'],
            "nama_bank" => $rekening[0]['nama_bank'],
            "nama_nasabah" => $rekening[0]['nama_nasabah'],
        );
        
        $this->load->view('templates/header', $data1);
        $this->load->view('manager/edit_rekening', $data);
        $this->load->view('templates/footer');
    }

    public function proses_edit_atm(){
            $id_rekening = $_POST['id_rekening'];
            $nomor = $_POST['nomor'];
            $nama_bank = $_POST['nama_bank'];
            $nasabah = $_POST['nasabah'];

            $data_update = array(

                'no_rekening' => $nomor,
                'nama_bank' => $nama_bank,
                'nama_nasabah' => $nasabah,
            );
            $where = array('id_rekening' => $id_rekening);
            $res = $this->ManagerModel->UpdateData('t_rekening', $data_update, $where);
            if($res){
                $this->session->set_flashdata('berhasil','<div class="alert
                alert-success" role="alert">Data Berhasil Diubah</div>');
                redirect('index.php/manager/list_atm', 'refresh');
            }else{
                $this->session->set_flashdata('gagal','<div class="alert
                alert-danger" role="alert">Data Gagal Diubah</div>');
                redirect('index.php/manager/list_atm', 'refresh');
            }
    }

    public function view_invoice($no_invoice){
        $where = array('id_invoice' => $no_invoice);
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['detail'] = $this->ManagerModel->input_invoice($no_invoice)->result_array();
        $data['invoice']= $this->ManagerModel->invoice($no_invoice)->result_array();
        $data['invoices_sub'] =$this->ManagerModel->sub_invoice($no_invoice)->result_array();
        $data['berita'] = $this->db->get_where('t_berita_acara',$where)->result_array();
        $this->load->view('templates/header', $data1);
        $this->load->view('manager/view_invoice', $data);
        $this->load->view('templates/footer');
    }
    public function cetak_invoice($id_invoice){
        $where = array('id_invoice'=>$id_invoice);
        $data['detail'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $notaris= $this->db->get('t_notaris')->result_array();
        $content= $this->db->get_where('t_invoice',$where)->result_array();

        $data = array(
            "no_invoice" => $content[0]['no_invoice'],
            "jns_order1" => $content[0]['jns_order1'],
            "nasabah" => $content[0]['nasabah'],
            "nama_notaris" => $notaris[0]['nama_notaris'],
        );
        $query = ('SELECT * FROM t_lap_invoice WHERE id_invoice ='.$id_invoice);
        $data['invoice'] = $this->db->query($query)->result_array();
        $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
        FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
        // var_dump($data['t_inv2']); die;
        $this->load->view('manager/cetak_invoice',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));

    }
    
    public function cetak_sub_invoice($id_invoice){
        $where = array('id_invoice'=>$id_invoice);
        $data['detail'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $notaris= $this->db->get('t_notaris')->result_array();
        $content= $this->db->get_where('t_invoice',$where)->result_array();

        $data = array(
            "no_invoice" => $content[0]['no_invoice'],
            "jns_order1" => $content[0]['jns_order1'],
            "nasabah" => $content[0]['nasabah'],
            "nama_notaris" => $notaris[0]['nama_notaris'],
        );
        $query = ('SELECT * FROM t_lap_sub_invoice WHERE id_invoice ='.$id_invoice);
        $data['sub_invoice'] = $this->db->query($query)->result_array();
        $data['t_sub_inv2'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_sub_inv2 
        FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_sub_inv2;
        // var_dump($data['t_inv2']); die;
        $this->load->view('manager/cetak_sub_invoice',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));

    }
    public function print_bukti_pembayaran($id_invoice){
        // $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
        $data['title'] = 'Laporan';
        $data['id_invoice'] = $id_invoice;
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices_sub'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_rekening ON t_lap_invoice.id_rekening = t_rekening.id_rekening
        WHERE t_lap_invoice.id_invoice='.$id_invoice)->result_array();

        $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_rekening ON t_lap_sub_invoice.id_rekening = t_rekening.id_rekening
        WHERE t_lap_sub_invoice.id_invoice='.$id_invoice)->result_array();
        
        $data['banks'] = $this->db->get('t_rekening')->result_array();
        
        $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
        FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
         $data['t_inv_sub'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv2 
         FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
      
        $this->load->view('templates/header', $data);
        $this->load->view('manager/cetak_bukti_pembayaran',$data);
        $this->load->view('templates/footer');
        // $html = $this->output->get_output();
        // $this->load->library('dompdf_gen');
        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $sekarang = date("d:F:Y:h:m:s");
        // $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));

    }
    public function print_bukti_pembayaran_out($id_invoice){
        // $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
        $data['title'] = '';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices_sub'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_rekening ON t_lap_invoice.id_rekening = t_rekening.id_rekening
        WHERE t_lap_invoice.id_invoice='.$id_invoice)->result_array();

        $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_rekening ON t_lap_sub_invoice.id_rekening = t_rekening.id_rekening
        WHERE t_lap_sub_invoice.id_invoice='.$id_invoice)->result_array();
        
        $data['banks'] = $this->db->get('t_rekening')->result_array();
        
        
        $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
        FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
         $data['t_inv_sub'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv2 
         FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
      
        $this->load->view('manager/print_bukti_pembayaran',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));

    }

    public function export_word_bukti_laporan($id_invoice){
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bukti.doc");
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices_sub'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_rekening ON t_lap_invoice.id_rekening = t_rekening.id_rekening
        WHERE t_lap_invoice.id_invoice='.$id_invoice)->result_array();

        $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_rekening ON t_lap_sub_invoice.id_rekening = t_rekening.id_rekening
        WHERE t_lap_sub_invoice.id_invoice='.$id_invoice)->result_array();
        
        $data['banks'] = $this->db->get('t_rekening')->result_array();
        
        $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
        FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
         $data['t_inv_sub'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv2 
         FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
      
        $this->load->view('manager/print_bukti_pembayaran',$data);

    }

    public function export_excell_bukti_laporan($id_invoice){
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bukti.xls");
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices_sub'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_rekening ON t_lap_invoice.id_rekening = t_rekening.id_rekening
        WHERE t_lap_invoice.id_invoice='.$id_invoice)->result_array();

        $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_rekening ON t_lap_sub_invoice.id_rekening = t_rekening.id_rekening
        WHERE t_lap_sub_invoice.id_invoice='.$id_invoice)->result_array();
        
        $data['banks'] = $this->db->get('t_rekening')->result_array();
        
        $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
        FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
         $data['t_inv_sub'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv2 
         FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
      
        $this->load->view('manager/print_bukti_pembayaran',$data);

    }
    public function export_word($id_invoice){
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=berita_acara.doc");
        $where = array('id_invoice'=>$id_invoice);
        $data['detail'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $berita= $this->db->get_where('t_berita_acara',$where)->result_array();
        $query = ('SELECT * FROM t_invoice WHERE id_invoice ='.$id_invoice);
        $invoice = $this->db->query($query)->result_array();
        $data = array(
            "jns_order1" => $invoice[0]['jns_order1'],
            "nasabah" => $invoice[0]['nasabah'],
            "berita" => $berita[0]['berita'],
        );
        $this->load->view('manager/print_berita',$data);
    }

    public function view_berita($id_invoice){
        $where = array('id_invoice'=> $id_invoice);
        $data1['title'] = 'View Berita Acara';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['detail'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $notaris= $this->db->get('t_notaris')->result_array();
        $data['berita']= $this->db->get_where('t_berita_acara',$where)->result_array();

        $this->load->view('templates/header', $data1);
        $this->load->view('manager/view_berita', $data);
        $this->load->view('templates/footer'); 
       
       
    }
    public function print_berita($id_invoice){
        $where = array('id_invoice'=>$id_invoice);
        $data['detail'] = $this->ManagerModel->input_invoice($id_invoice)->result_array();
        $berita= $this->db->get_where('t_berita_acara',$where)->result_array();

        $query = ('SELECT * FROM t_invoice WHERE id_invoice ='.$id_invoice);
        $invoice = $this->db->query($query)->result_array();
        $data = array(
            "jns_order1" => $invoice[0]['jns_order1'],
            "nasabah" => $invoice[0]['nasabah'],
            "berita" => $berita[0]['berita'],
        );
        $this->load->view('manager/print_berita',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
    }

    public function laporan(){
        // $where = array('no_invoice' => $no_invoice);
        $data1['title'] = 'Laporan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['rekening'] = $this->db->get('t_rekening')->result_array();
        $data['laporan_all'] = $this->KeuanganModel->laporan()->result_array();

        $this->load->view('templates/header', $data1);
        $this->load->view('manager/laporan',$data);
        $this->load->view('templates/footer');
    }
     // cetak semua data
     public function print_all(){
        $data['rekening'] = $this->db->get('t_rekening')->result_array();
        $data['laporan_print'] = $this->ManagerModel->laporan_all()->result_array();
        $data['ket'] = 'SELURUHNYA';
        $data['t_inv'] = $this->db->query('SELECT SUM(total_lap_invoice) AS t_inv 
        FROM t_pemasukan')->row()->t_inv;
        $data['t_sub_inv'] = $this->db->query('SELECT SUM(total_lap_sub_invoice) AS t_sub_inv 
        FROM t_pemasukan')->row()->t_sub_inv;
        // var_dump($data); die;
        $this->load->view('manager/cetak_laporan',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_Paper('A4','potrait');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
        }

        // cetak data berdasarkan tanggal
    public function cari_laporan(){
        $data1['title'] = 'Cari Laporan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
        $data['awal'] = $this->input->post('awal'); 
        $data['akhir'] = $this->input->post('akhir'); 
        $data['rekening'] = $this->db->get('t_rekening')->result_array();
        $data['laporan_print'] = $this->ManagerModel->view_by_month($awal,$akhir)->result_array();
        $data['t_inv'] = $this->ManagerModel->total_inv($awal,$akhir)->row()->t_inv;
        $data['t_sub_inv'] = $this->ManagerModel->total_sub_inv($awal,$akhir)->row()->t_sub_inv;
       
        $this->load->view('templates/header', $data1);
        $this->load->view('manager/cari_laporan',$data);
        $this->load->view('templates/footer');
      
    }
    public function export_word_laporan(){
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=laporan_pemasukan.doc");
        $data['laporan_all'] = $this->KeuanganModel->laporan()->result_array();
        $data['ket'] = 'SELURUHNYA';
        $this->load->view('manager/cetak_laporan_pendapatan',$data);
    }

    public function export_excell_laporan(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment;Filename=laporan_pemasukan.xls");
        $data['laporan_all'] = $this->KeuanganModel->laporan()->result_array();
        $data['ket'] = 'SELURUHNYA';
        $this->load->view('manager/cetak_laporan_pendapatan',$data);
    }
    public function print_cari(){
        $data1['title'] = 'Manager';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
        $data['awal'] = $this->input->post('awal'); 
        $data['akhir'] = $this->input->post('akhir'); 

        $data['laporan_pendapatan'] = $this->KeuanganModel->view_by_month1($awal,$akhir)->result_array();
        // var_dump($data['laporan_pendapatan']); die;
        $data['t_inv'] = $this->KeuanganModel->total_inv($awal,$akhir)->row()->t_inv;
        $data['t_sub_inv'] = $this->KeuanganModel->total_sub_inv($awal,$akhir)->row()->t_sub_inv;
    
        $this->load->view('keuangan/cetak_laporan',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_Paper('A4','potrait');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
    }

   
     // laporan pengeluaran

     public function pengeluaran(){
        $data['title'] = 'Laporan Pengeluaran';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['pengeluaran'] = $this->ManagerModel->pengeluaran()->result_array();
        $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
        $data['users'] = $this->db->get('t_user')->result_array();
        // var_dump($data['users']); die;
        $this->load->view('templates/header', $data);
        $this->load->view('manager/laporan_pengeluaran',$data);
        $this->load->view('templates/footer');

    }
     // print all pengeluaran
     public function print_all_pengeluaran(){
        $data['pengeluaran'] = $this->ManagerModel->pengeluaran()->result_array();
        $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
        $data['users'] = $this->db->get('t_user')->result_array();
        $data['ket'] = 'SELURUHNYA';
        $data['biaya'] = $this->db->query('SELECT SUM(biaya_pengeluaran) AS biaya 
        FROM t_pengeluaran')->row()->biaya;
        $this->load->view('manager/cetak_laporan_pengeluaran',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
        }

        public function export_word_pengeluaran(){
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=pengeluaran.doc");
            $data['pengeluaran'] = $this->ManagerModel->pengeluaran()->result_array();
            $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
            $data['users'] = $this->db->get('t_user')->result_array();
            $data['ket'] = 'SELURUHNYA';
            $data['biaya'] = $this->db->query('SELECT SUM(biaya_pengeluaran) AS biaya 
            FROM t_pengeluaran')->row()->biaya;
            $this->load->view('manager/cetak_laporan_pengeluaran',$data);
        }

        public function export_excell_pengeluaran(){
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment;Filename=pengeluaran.xls");
            $data['pengeluaran'] = $this->ManagerModel->pengeluaran()->result_array();
            $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
            $data['users'] = $this->db->get('t_user')->result_array();
            $data['ket'] = 'SELURUHNYA';
            $data['biaya'] = $this->db->query('SELECT SUM(biaya_pengeluaran) AS biaya 
            FROM t_pengeluaran')->row()->biaya;
            $this->load->view('manager/cetak_laporan_pengeluaran',$data);
        }   

        // Cari Pengeluaran
        public function cari_pengeluaran(){
            $data['title'] = 'Keuangan';
            $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $awal = $this->input->post('awal');
            $akhir = $this->input->post('akhir');
            $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
            $data['awal'] = $this->input->post('awal'); 
            $data['akhir'] = $this->input->post('akhir'); 
            $data['pengeluaran'] = $this->ManagerModel->cari_laporan_pengeluaran($awal,$akhir)->result_array();
            $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
            $data['users'] = $this->db->get('t_user')->result_array();
            
            $data['biaya'] = $this->ManagerModel->total_biaya_pengeluaran($awal,$akhir)->row()->biaya;  
            $this->load->view('templates/header', $data);
            $this->load->view('manager/cari_laporan_pengeluaran',$data);
            $this->load->view('templates/footer');
 
        }
        public function print_cari_pengeluaran(){
            $data['title'] = 'Keuangan';
            $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $awal = $this->input->post('awal');
            $akhir = $this->input->post('akhir');
            $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
            $data['awal'] = $this->input->post('awal'); 
            $data['akhir'] = $this->input->post('akhir'); 
            $data['pengeluaran'] = $this->ManagerModel->cari_laporan_pengeluaran($awal,$akhir)->result_array();
            $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
            $data['users'] = $this->db->get('t_user')->result_array();
            
            $data['biaya'] = $this->ManagerModel->total_biaya_pengeluaran($awal,$akhir)->row()->biaya;  
            $this->load->view('manager/cetak_laporan_pengeluaran',$data);
            $html = $this->output->get_output();
            $this->load->library('dompdf_gen');
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $sekarang = date("d:F:Y:h:m:s");
            $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
        }
        public function export_word_pengeluaran_by_tanggal($awal,$akhir){
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=pengeluaran_by_tanggal.doc");
            $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
            $data['awal'] = $this->input->post('awal'); 
            $data['akhir'] = $this->input->post('akhir'); 
            $data['pengeluaran'] = $this->ManagerModel->cari_laporan_pengeluaran($awal,$akhir)->result_array();
            $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
            $data['users'] = $this->db->get('t_user')->result_array();
            
            $data['biaya'] = $this->ManagerModel->total_biaya_pengeluaran($awal,$akhir)->row()->biaya;  
            $this->load->view('manager/cetak_laporan_pengeluaran',$data);
           
        }

        public function export_excell_pengeluaran_by_tanggal($awal,$akhir){
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment;Filename=pengeluaran_by_tanggal.xls");
            $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
            $data['awal'] = $this->input->post('awal'); 
            $data['akhir'] = $this->input->post('akhir'); 
            $data['pengeluaran'] = $this->ManagerModel->cari_laporan_pengeluaran($awal,$akhir)->result_array();
            $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
            $data['users'] = $this->db->get('t_user')->result_array();
            
            $data['biaya'] = $this->ManagerModel->total_biaya_pengeluaran($awal,$akhir)->row()->biaya;  
            $this->load->view('manager/cetak_laporan_pengeluaran',$data);
        }

        public function laporan_pendapatan(){
            // $where = array('no_invoice' => $no_invoice);
            $data1['title'] = 'Keuangan';
            $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $awal = $this->input->post('awal');
            $akhir = $this->input->post('akhir');
            $data['rekening'] = $this->db->get('t_rekening')->result_array();
            $data['laporan_pendapatan'] = $this->KeuanganModel->laporan_pendapatan()->result_array();
            // var_dump($data['laporan_pendapatan']); die;
    
            $this->load->view('templates/header', $data1);
            $this->load->view('manager/laporan_pendapatan',$data);
            $this->load->view('templates/footer');
        }

        public function print_all_pendapatan(){
            $data['rekening'] = $this->db->get('t_rekening')->result_array();
            $data['laporan_print'] = $this->KeuanganModel->laporan_all()->result_array();
            $data['ket'] = 'SELURUHNYA';
            $data['t_inv'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv 
            FROM t_lap_invoice')->row()->t_inv;
            $data['t_sub_inv'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_sub_inv 
            FROM t_lap_sub_invoice')->row()->t_sub_inv;
             $data['laporan_pendapatan'] = $this->KeuanganModel->laporan_pendapatan()->result_array();
            // var_dump($data); die;
            $this->load->view('manager/cetak_laporan',$data);
            $html = $this->output->get_output();
            $this->load->library('dompdf_gen');
            $this->dompdf->set_Paper('A4','potrait');
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $sekarang = date("d:F:Y:h:m:s");
            $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
            }

            public function export_word_pendapatan(){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=laporan_pendapatan.doc");
                $data['laporan_pendapatan'] = $this->KeuanganModel->laporan_pendapatan()->result_array();
                $this->load->view('manager/cetak_laporan',$data);
            }

            public function export_excell_pendapatan(){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=laporan_pendapatan.xls");
                $data['laporan_pendapatan'] = $this->KeuanganModel->laporan_pendapatan()->result_array();
                $this->load->view('manager/cetak_laporan',$data);
            }
            public function cari_laporan_pendapatan(){
                $data1['title'] = 'Keuangan';
                $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $awal = $this->input->post('awal');
                $akhir = $this->input->post('akhir');
                $data['ket'] = 'Dari : '.$awal.' - '.$akhir;
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                $data['laporan_print'] = $this->KeuanganModel->view_by_month($awal,$akhir)->result_array();
                // var_dump($awal); die;
                $data['t_inv'] = $this->KeuanganModel->total_inv($awal,$akhir)->row()->t_inv;
                $data['t_sub_inv'] = $this->KeuanganModel->total_sub_inv($awal,$akhir)->row()->t_sub_inv;
               
                $this->load->view('templates/header', $data1);
                $this->load->view('manager/cari_laporan',$data);
                $this->load->view('templates/footer');
              
            }
            public function export_word_laporan_by_tanggal($awal, $akhir){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=laporan_by_tanggal.doc");
              
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                $data['laporan_pendapatan'] = $this->KeuanganModel->view_by_month1($awal,$akhir)->result_array();
               
                $this->load->view('manager/cetak_laporan',$data);
            }

            public function export_excell_laporan_by_tanggal($awal, $akhir){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=laporan_by_tanggal.xls");
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                $data['laporan_pendapatan'] = $this->KeuanganModel->view_by_month1($awal,$akhir)->result_array();
                $this->load->view('manager/cetak_laporan',$data);
            }

            public function print_all_laporan(){
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                // $data['laporan_print'] = $this->KeuanganModel->laporan_all()->result_array();
                $data['laporan_all'] = $this->KeuanganModel->laporan()->result_array();
                // var_dump($data['laporan_all']); die;
                $this->load->view('manager/cetak_laporan_pendapatan',$data);
                $html = $this->output->get_output();
                $this->load->library('dompdf_gen');
                $this->dompdf->set_Paper('A4','potrait');
                $this->dompdf->load_html($html);
                $this->dompdf->render();
                $sekarang = date("d:F:Y:h:m:s");
                $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
                }

                public function cari_laporan_pemasukan(){
                    $data1['title'] = 'Manager';
                    $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                    $awal = $this->input->post('awal');
                    $akhir = $this->input->post('akhir');
                    $data['ket'] = 'Dari : '.$awal.' - '.$akhir;
                    $data['awal'] = $this->input->post('awal'); 
                    $data['akhir'] = $this->input->post('akhir'); 
                    $data['rekening'] = $this->db->get('t_rekening')->result_array();
                    $data['laporan_print'] = $this->KeuanganModel->view_by_month_pemasukan($awal,$akhir)->result_array();
                    // var_dump($awal); die;
                    $data['t_inv'] = $this->KeuanganModel->total_inv($awal,$akhir)->row()->t_inv;
                    $data['t_sub_inv'] = $this->KeuanganModel->total_sub_inv($awal,$akhir)->row()->t_sub_inv;
                   
                    $this->load->view('templates/header', $data1);
                    $this->load->view('manager/cari_laporan_pemasukan',$data);
                    $this->load->view('templates/footer');
                  
                }
                public function print_cari_pemasukan(){
                    $data1['title'] = 'Manager';
                    $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                    $awal = $this->input->post('awal');
                    $akhir = $this->input->post('akhir');
                    $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                    $data['awal'] = $this->input->post('awal'); 
                    $data['akhir'] = $this->input->post('akhir'); 
                    $data['laporan_all'] = $this->KeuanganModel->view_by_month_pemasukan($awal,$akhir)->result_array();
                       
                    $this->load->view('manager/cetak_laporan_pendapatan',$data);
                    $html = $this->output->get_output();
                    $this->load->library('dompdf_gen');
                    $this->dompdf->set_Paper('A4','potrait');
                    $this->dompdf->load_html($html);
                    $this->dompdf->render();
                    $sekarang = date("d:F:Y:h:m:s");
                    $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
                }
    
                public function export_word_pemasukan_by_tanggal($awal, $akhir){
                    header("Content-type: application/vnd.ms-word");
                    header("Content-Disposition: attachment;Filename=pemasukan_by_tanggal.doc");
                  
                    $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                    $data['awal'] = $this->input->post('awal'); 
                    $data['akhir'] = $this->input->post('akhir'); 
                    $data['rekening'] = $this->db->get('t_rekening')->result_array();
                    $data['laporan_all'] = $this->KeuanganModel->view_by_month_pemasukan($awal,$akhir)->result_array();
               
                    $this->load->view('manager/cetak_laporan_pendapatan',$data);
                }
    
                public function export_excell_pemasukan_by_tanggal($awal, $akhir){
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment;Filename=pemasukan_by_tanggal.xls");
                    $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                    $data['awal'] = $this->input->post('awal'); 
                    $data['akhir'] = $this->input->post('akhir'); 
                    $data['rekening'] = $this->db->get('t_rekening')->result_array();
                    $data['laporan_all'] = $this->KeuanganModel->view_by_month_pemasukan($awal,$akhir)->result_array();
               
                 $this->load->view('manager/cetak_laporan_pendapatan',$data);
                 
                }
                public function laporan_keuangan(){
                    // $where = array('no_invoice' => $no_invoice);
                    $data1['title'] = 'Manager';
                    $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                    $awal = $this->input->post('awal');
                    $akhir = $this->input->post('akhir');
                    $data['rekening'] = $this->db->get('t_rekening')->result_array();
                    $data['laporan_keuangan'] = $this->KeuanganModel->laporan_keuangan()->result_array();
                    $this->load->view('templates/header', $data1);
                    $this->load->view('manager/laporan_keuangan',$data);
                    $this->load->view('templates/footer');
                }
                public function print_laporan_keseluruhan(){  
                    $data['laporan_keuangan'] = $this->KeuanganModel->laporan_keuangan()->result_array();
                    $this->load->view('manager/cetak_laporan_keuangan',$data);
                    $html = $this->output->get_output();
                    $this->load->library('dompdf_gen');
                    $this->dompdf->set_Paper('A4','potrait');
                    $this->dompdf->load_html($html);
                    $this->dompdf->render();
                    $sekarang = date("d:F:Y:h:m:s");
                    $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
                    }
        
                   
                    public function export_word_laporan_keuangan(){
                        header("Content-type: application/vnd.ms-word");
                        header("Content-Disposition: attachment;Filename=laporan_keuangan.doc");
                        $data['laporan_keuangan'] = $this->KeuanganModel->laporan_keuangan()->result_array();
                        $this->load->view('manager/cetak_laporan_keuangan',$data);
                    }
        
                    public function export_excell_laporan_keuangan(){
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: attachment;Filename=laporan_keuangan.xls");
                        $data['laporan_keuangan'] = $this->KeuanganModel->laporan_keuangan()->result_array();
                        $this->load->view('manager/cetak_laporan_keuangan',$data);
                    }
        
                    public function cari_laporan_keuangan(){
                        $data1['title'] = 'Manager';
                        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                        $awal = $this->input->post('awal');
                        $akhir = $this->input->post('akhir');
                        $data['ket'] = 'Dari : '.$awal.' - '.$akhir;
                        $data['awal'] = $this->input->post('awal'); 
                        $data['akhir'] = $this->input->post('akhir'); 
                       
                        $data['laporan_keuangan'] = $this->KeuanganModel->view_by_month_keuangan($awal,$akhir)->result_array();               
                        $this->load->view('templates/header', $data1);
                        $this->load->view('manager/cari_laporan_keuangan',$data);
                        $this->load->view('templates/footer');
                      
                    }
                    public function print_cari_keuangan(){
                        $data1['title'] = 'Manager';
                        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                        $awal = $this->input->post('awal');
                        $akhir = $this->input->post('akhir');
                        $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                        $data['awal'] = $this->input->post('awal'); 
                        $data['akhir'] = $this->input->post('akhir'); 
                        $data['laporan_keuangan'] = $this->KeuanganModel->view_by_month_keuangan($awal,$akhir)->result_array();
                    
                        $this->load->view('manager/cetak_laporan_keuangan',$data);
                        $html = $this->output->get_output();
                        $this->load->library('dompdf_gen');
                        $this->dompdf->set_Paper('A4','potrait');
                        $this->dompdf->load_html($html);
                        $this->dompdf->render();
                        $sekarang = date("d:F:Y:h:m:s");
                        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
                    }   

                    public function export_word_keuangan_by_tanggal($awal, $akhir){
                        header("Content-type: application/vnd.ms-word");
                        header("Content-Disposition: attachment;Filename=laporan_keuangan_by_tanggal.doc");
                      
                        $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                        $data['awal'] = $this->input->post('awal'); 
                        $data['akhir'] = $this->input->post('akhir'); 
                        $data['laporan_keuangan'] = $this->KeuanganModel->view_by_month_keuangan($awal,$akhir)->result_array();
                    
                        $this->load->view('manager/cetak_laporan_keuangan',$data);
                    }
        
                    public function export_excell_keuangan_by_tanggal($awal, $akhir){
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: attachment;Filename=laporan_keuangan_by_tanggal.xls");
                        $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                        $data['awal'] = $this->input->post('awal'); 
                        $data['akhir'] = $this->input->post('akhir'); 
                        $data['rekening'] = $this->db->get('t_rekening')->result_array();
                        $data['laporan_keuangan'] = $this->KeuanganModel->view_by_month_keuangan($awal,$akhir)->result_array();
                    
                        $this->load->view('manager/cetak_laporan_keuangan',$data);
                    }










}