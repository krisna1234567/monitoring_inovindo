<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('KeuanganModel');
        $this->load->helper('tgl_indo');
        $this->load->helper('rupiah');
        // $this->load->library('cetak_pdf');

        is_logged_in();
        }
    
    public function index(){
        $data['title'] = 'Admin';
        $status = array('status_invoice'=>5);
        $status2 = array('status_invoice'=>3);
        $status3 = array('status_invoice'=>0);
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['userall']= $this->db->get('t_user')->num_rows();
        $data['selesai']= $this->db->get_where('t_invoice',$status)->num_rows();
        $data['mulai']= $this->db->get_where('t_invoice',$status2)->num_rows();
        $data['masuk']= $this->db->get_where('t_invoice',$status3)->num_rows();
        $data['data'] = $this->KeuanganModel->laporan_pendapatan_grafik_harian()->result();
        $data['data2'] = $this->KeuanganModel->laporan_pendapatan_grafik_perbulan()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function list_order(){
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $id= array('id_role' => 3);
        $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
        $data['perusahaan'] = $this->db->get('t_perusahaan')->result_array();
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices'] = $this->KeuanganModel->list_order_all()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/list-order', $data);
        $this->load->view('templates/footer');
    }
    public function list_invoice_all(){
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $id= array('id_role' => 3);
        $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices'] = $this->KeuanganModel->list_order()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/list_invoice_all', $data);
        $this->load->view('templates/footer');
        
    }
    public function input_invoice($id_invoice){
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $id= array('id_role' => 3);
        $where =array('id_invoice' => $id_invoice);
        $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['invoices_sub'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
        $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->result_array();
        $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->result_array();
        $data['t_sub_inv'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_sub_inv2 
        FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_sub_inv2;

         $data['t_inv'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_sub_inv2 
         FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_sub_inv2;
        $this->load->view('templates/header', $data);
        $this->load->view('admin/input_invoice', $data);
        $this->load->view('templates/footer');

    }
    public function proses_input_invoice($no_invoice1){
        $i =0;
        $no_invoice = $this->input->post('id_invoice');
        $tgl_invoice = $this->input->post('tgl_invoice');
        $nama = $this->input->post('nama');
        $biaya = $this->input->post('biaya');
        $keterangan = $this->input->post('keterangan');
        if($nama[0] !== null){
            foreach($nama as $row){
                $data=[
                    'id_invoice' => $no_invoice,
                    'tgl_pemasukan' => $tgl_invoice,
                    'nama_lap_invoice' => $row,
                    'biaya_lap_invoice'=>$biaya[$i],
                    'ket_lap_invoice'=>$keterangan[$i],
                ];
                $insert = $this->db->insert('t_lap_invoice',$data);
                if($insert){
                    $i++;
                }
            }
        }
        $arr['success'] = true;
        $arr['notif'] = '<div class="alert alert success"><i class ="fa fa-check"></i>Data Berhasil disimpan
        </div> ';
        // $id = $this->uri->segment(3);
        $id2= urldecode($no_invoice1);
        $this->session->set_flashdata('input_invoice','<div class="alert
        alert-success" role="alert">Berhasil Input Invoice</div>');
        redirect('index.php/admin/input_invoice/'.$id2, 'refresh');
        return $this->output->set_output(json_encode($arr));
       
    }
    public function proses_input_sub_invoice($no_invoice1){
        $i =0;
        $no_invoice = $this->input->post('id_invoice');
        $tgl_invoice = $this->input->post('tgl_invoice');
        $nama = $this->input->post('nama');
        $biaya = $this->input->post('biaya');
        $keterangan = $this->input->post('keterangan');
        if($nama[0] !== null){
            foreach($nama as $row){
                $data=[
                    'id_lap_sub_invoice'=>'',
                    'id_invoice' => $no_invoice,
                    'tgl_pemasukan' => $tgl_invoice,
                    'nama_lap_sub_invoice' => $row,
                    'biaya_lap_sub_invoice'=>$biaya[$i],
                    'ket_lap_sub_invoice'=>$keterangan[$i],
                ];
                $insert = $this->db->insert('t_lap_sub_invoice',$data);
                if($insert){
                    $i++;
                }
            }
        }
        $arr['success'] = true;
        $arr['notif'] = '<div class="alert alert success"><i class ="fa fa-check"></i>Data Berhasil disimpan
        </div> ';
        $id2= urldecode($no_invoice1);
        $this->session->set_flashdata('input_sub_invoice','<div class="alert
        alert-success" role="alert">Berhasil Input Sub Invoice</div>');
        redirect('index.php/admin/input_invoice/'.$id2, 'refresh');
        return $this->output->set_output(json_encode($arr));
       
    }

    public function update_invoice($no_invoice1){
        $no_invoice = $_POST['id_invoice'];
        $id_lap_invoice = $this->input->post('id');
        $nama_lap = $_POST['nama'];
        $biaya_lap = $_POST['biaya'];
        $keterangan_lap = $_POST['keterangan'];
        $result = array();
        foreach($id_lap_invoice AS $key =>$val){
            $result[]= array(
                'id_lap_invoice' => $id_lap_invoice[$key],
                'nama_lap_invoice' => $nama_lap[$key],
                'biaya_lap_invoice' => $biaya_lap[$key],
                'ket_lap_invoice' => $keterangan_lap[$key]
            );
        } 
        $id2= urldecode($no_invoice1);
        $this->db->update_batch('t_lap_invoice',$result,'id_lap_invoice');
        $this->session->set_flashdata('update_invoice','<div class="alert
        alert-success" role="alert">Invoice Telah Diupdate</div>');
        redirect('index.php/admin/input_invoice/'.$id2, 'refresh');
    }

    public function update_sub_invoice($no_invoice1){
        // $no_invoice = $_POST['no_invoice'];
        $id_lap_sub_invoice = $this->input->post('id_sub');
        $nama_lap = $_POST['nama_sub'];
        $biaya_lap = $_POST['biaya_sub'];
        $keterangan_lap = $_POST['keterangan_sub'];
        $result2 = array();
        foreach($id_lap_sub_invoice AS $key => $val){
            $result2[]= array(
                'id_lap_sub_invoice' => $id_lap_sub_invoice[$key],
                'nama_lap_sub_invoice' => $nama_lap[$key],
                'biaya_lap_sub_invoice' => $biaya_lap[$key],
                'ket_lap_sub_invoice' => $keterangan_lap[$key]
            );
        } 
        $id2= urldecode($no_invoice1);
        $this->db->update_batch('t_lap_sub_invoice',$result2,'id_lap_sub_invoice');
        $this->session->set_flashdata('update_sub_invoice','<div class="alert
        alert-success" role="alert">Sub Invoice Telah diupdate</div>');
        redirect('index.php/admin/input_invoice/'.$id2, 'refresh');
    }

    public function tambah_invoice(){
            // foreach ($chek as $objek){
                $data = array(
                    'no_invoice' =>$this->input->post('no_invoice'),
                    'tgl_invoice' => $this->input->post('tgl'),
                    'id_user' =>'-',
                    'id_order' => '-',
                    'jns_order1' =>$this->input->post('konsumen'),
                    'nasabah' =>'-',
                    'deadline_akta'=>'',
                    'lama_pengerjaan'=>0,
                    'status_invoice'=>0,
                    'tgl_mulai' => '',

                );
                // var_dump($data); die;
                $res = $this->db->insert('t_invoice', $data);
                if($res){
                    $this->session->set_flashdata('sukses','<div class="alert
                    alert-success" role="alert">Berhasil ditambahkan</div>');
                    redirect('index.php/admin/list_order', 'refresh');
                }else{
                    $this->session->set_flashdata('error','<div class="alert
                    alert-danger" role="alert">Gagal !</div>');
    
                }

            
    }  
    public function edit_invoice_sub($id_invoice){
        $where = array('id_invoice' => $id_invoice);
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
        $data['invoice']= $this->KeuanganModel->invoice($id_invoice)->result_array();
        $data['invoices_sub'] =$this->KeuanganModel->sub_invoice($id_invoice)->result_array();
      
        $this->load->view('templates/header', $data1);
        $this->load->view('admin/edit_invoice', $data);
        $this->load->view('templates/footer');
    }
    public function view_invoice($no_invoice){
        $where = array('id_invoice' => $no_invoice);
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['detail'] = $this->KeuanganModel->input_invoice($no_invoice)->result_array();
        $data['invoice']= $this->KeuanganModel->invoice($no_invoice)->result_array();
        $data['invoices_sub'] =$this->KeuanganModel->sub_invoice($no_invoice)->result_array();
        $data['berita'] = $this->db->get_where('t_berita_acara',$where)->result_array();
        $this->load->view('templates/header', $data1);
        $this->load->view('admin/view_invoice', $data);
        $this->load->view('templates/footer');
    }
    public function kirim_invoice($no_invoice){
        $data_update = array(
            'status_invoice' => 1,
        );
        $id = urldecode($no_invoice);
        $where = array('id_invoice' => $no_invoice);
        $res = $this->KeuanganModel->Kirim_invoice('t_invoice', $data_update, $where);
        $this->session->set_flashdata('kirim','<div class="alert
        alert-success" role="alert">Proses Kirim Invoice Dan Sub Invoice</div>');
        redirect('index.php/admin/view_order/'.$id, 'refresh');
    }

    public function finish_invoice1($no_invoice){
        $data_update = array(
            'status_invoice' => 5,
        );
        $id = urldecode($no_invoice);
        $where = array('id_invoice' => $no_invoice);
        $res = $this->KeuanganModel->Kirim_invoice('t_invoice', $data_update, $where);
        $this->session->set_flashdata('kirim','<div class="alert
        alert-success" role="alert">Akad Selesai</div>');
        redirect('index.php/admin/list_invoice_all', 'refresh');
    }
    public function finish_invoice($id_invoice, $id_lap_invoice,$tgl_invoice){
        $where = array('id_lap_invoice' => $id_lap_invoice);
        $data = array('id_invoice'=> $id_invoice,
        'tgl_invoice' => $tgl_invoice
        );
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['t_lap_invoice'] = $this->db->get_where('t_lap_invoice',$where)->result_array();
    
        $data['banks'] = $this->KeuanganModel->getData('t_rekening');
        $this->load->view('templates/header', $data);
        $this->load->view('admin/proses_finish', $data);
        $this->load->view('templates/footer');

       
    }
    public function finish_sub_invoice($id_invoice, $id_lap_invoice,$tgl_invoice){
        $where = array('id_lap_sub_invoice' => $id_lap_invoice);
        $data = array('id_invoice'=> $id_invoice,
                'tgl_invoice' => $tgl_invoice
                );
             
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['t_lap_sub_invoice'] = $this->db->get_where('t_lap_sub_invoice',$where)->result_array();
        // var_dump($data['t_lap_sub_invoice']); die;
        $data['banks'] = $this->KeuanganModel->getData('t_rekening');
       
      
        $this->load->view('templates/header', $data);
        $this->load->view('admin/proses_sub_finish', $data);
        $this->load->view('templates/footer');

       
    }
    public function proses_finish(){
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $id= array('id_role' => 3);
        
        $id_lap_invoice = $this->input->post('id_lap_invoice');
        $id_invoice = $this->input->post('id_invoice');
        // $biaya = $this->input->post('biaya');
        $id_rekening = $this->input->post('id_rekening');
        $keterangan = $this->input->post('keterangan');
    
        $tgl_invoice = $this->input->post('tgl_invoice');
        $where1 = array('id_lap_invoice' => $id_lap_invoice);
        // $data1 = array(
        //     'status' => 1,
        // );
        
        $data = array(
            'id_rekening' => $id_rekening,
            'ket_lap_invoice' => $keterangan,
            'tgl_pemasukan' => $tgl_invoice,
            'status' => 1,
        );

        $id = urldecode($id_invoice);
        $this->KeuanganModel->UpdateData('t_lap_invoice', $data, $where1);
        // $this->db->insert('t_pemasukan_invoice', $data);
        // $this->db->insert('t_pemasukan_sub_invoice', $data2);
        $this->session->set_flashdata('finish','<div class="alert
        alert-success" role="alert">Invoice Telah Dibukukan</div>');
        redirect('index.php/admin/input_invoice/'.$id, 'refresh');
    }

    public function proses_finish_sub(){
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $id= array('id_role' => 3);
       
        $id_lap_sub_invoice = $this->input->post('id_lap_sub_invoice');
        $id_invoice = $this->input->post('id_invoice');
        // $biaya = $this->input->post('biaya');
        $id_rekening = $this->input->post('id_rekening');
        $keterangan = $this->input->post('keterangan');
    
        $tgl_invoice = $this->input->post('tgl_invoice');
        $where1 = array('id_lap_sub_invoice' => $id_lap_sub_invoice);
        // $data1 = array(
        //     'status' => 1,
        // );
        $data = array(
            'id_rekening' => $id_rekening,
            'ket_lap_sub_invoice' => $keterangan,
            'tgl_pemasukan' => $tgl_invoice,
            'status' => 1,
        );
      
        $id = urldecode($id_invoice);
        $this->KeuanganModel->UpdateData('t_lap_sub_invoice', $data, $where1);
        // $this->db->insert('t_pemasukan_sub_invoice', $data);
        // $this->db->insert('t_pemasukan_invoice', $data1);
        $this->session->set_flashdata('finish2','<div class="alert
        alert-success" role="alert">Sub Invoice Telah Dibukukan</div>');
        redirect('index.php/admin/input_invoice/'.$id, 'refresh');
    }


    public function cetak_invoice($id_invoice){
        $where = array('id_invoice'=>$id_invoice);
        $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
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
        $this->load->view('admin/cetak_invoice',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));

    }


    public function cetak_sub_invoice($id_invoice){
        $where = array('id_invoice'=>$id_invoice);
        $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
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
        $this->load->view('admin/cetak_sub_invoice',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));

    }
       

    public function edit_invoice($id_invoice){
        $where = array('id_invoice' => $id_invoice);
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $order= $this->KeuanganModel->GetStaf($where, 't_invoice');
        $data = array(
            "id_invoice" => $order[0]['id_invoice'],
            "no_invoice" => $order[0]['no_invoice'],
            "tgl_invoice" => $order[0]['tgl_invoice'],
            "id_user" => $order[0]['id_user'],
            "id_order" => $order[0]['id_order'],
            "jns_order1" => $order[0]['jns_order1'],
            "nasabah" => $order[0]['nasabah'],
            "deadline_akta" => $order[0]['deadline_akta'],
            "lama_pengerjaan" => $order[0]['lama_pengerjaan'],
            "status_invoice" => $order[0]['status_invoice'],
        );
        $id= array('id_role' => 3);
        $data['jns_invo'] = $this->db->get('t_order')->result_array();
        $data['perusahaan'] = $this->db->get('t_perusahaan')->result_array();
        $data['users'] =$this->KeuanganModel->GetStaf($id, 't_user');
        $data['orders'] = $this->KeuanganModel->getData('t_order');
       
        $this->load->view('templates/header', $data1);
        $this->load->view('admin/form_edit_order', $data);
        $this->load->view('templates/footer');
    }

    public function view_order($no_invoice){
        $where = array('id_invoice' => $no_invoice);
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['orders'] = $this->KeuanganModel->input_invoice($no_invoice)->result_array();
      
            $this->load->view('templates/header', $data1);
            $this->load->view('admin/view_order_bukukan', $data);
            $this->load->view('templates/footer');
    }

    public function proses_edit(){
        // $chek = $this->input->post('jns_invoice');
        // $warna = implode(", ",$chek);
        $id_invoice = $_POST['id_invoice'];
        $no_invoice = $_POST['no_invoice'];
        $tgl_invoice = $_POST['tgl'];
        // $id_order = $_POST['jns_invoice'];
        $jns_order1 = $_POST['jns_order1'];
        // $nasabah = $_POST['nasabah'];
        $data_update = array(
            'no_invoice' => $no_invoice,
            'tgl_invoice' => $tgl_invoice,
            'jns_order1' => $jns_order1,
            
        );
        $where = array('id_invoice' => $id_invoice);
        $this->KeuanganModel->UpdateData('t_invoice', $data_update, $where);
        $this->session->set_flashdata('sukses','<div class="alert
        alert-success" role="alert">Berhasil diubah</div>');
        redirect('index.php/admin/list_order', 'refresh');
    }

    public function report_invoice(){
        $awal = $this->input->post('awal');
        $awal = $this->input->post('akhir');
        return $this->KeuanganModel->report_invoice($awal, $akhir)->result_array();

    }

    public function laporan(){
        // $where = array('no_invoice' => $no_invoice);
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['rekening'] = $this->db->get('t_rekening')->result_array();
        $data['laporan_all'] = $this->KeuanganModel->laporan()->result_array();

        $this->load->view('templates/header', $data1);
        $this->load->view('admin/laporan',$data);
        $this->load->view('templates/footer');
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
        $this->load->view('admin/laporan_pendapatan',$data);
        $this->load->view('templates/footer');
    }
    public function laporan_keuangan(){
        // $where = array('no_invoice' => $no_invoice);
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['rekening'] = $this->db->get('t_rekening')->result_array();
        $data['laporan_keuangan'] = $this->KeuanganModel->laporan_keuangan()->result_array();
        // var_dump($data['laporan_keuangan']); die;
        $this->load->view('templates/header', $data1);
        $this->load->view('admin/laporan_keuangan',$data);
        $this->load->view('templates/footer');
    }
    // cetak data berdasarkan tanggal
    public function cari_laporan(){
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
        $this->load->view('admin/cari_laporan',$data);
        $this->load->view('templates/footer');
      
    }
    public function cari_laporan_pemasukan(){
        $data1['title'] = 'Keuangan';
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
        $this->load->view('admin/cari_laporan_pemasukan',$data);
        $this->load->view('templates/footer');
      
    }


    public function print_cari(){
        $data1['title'] = 'Keuangan';
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
    
        $this->load->view('admin/cetak_laporan',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_Paper('A4','potrait');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
    }

    public function print_cari_pemasukan(){
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
        $data['awal'] = $this->input->post('awal'); 
        $data['akhir'] = $this->input->post('akhir'); 
        $data['laporan_all'] = $this->KeuanganModel->view_by_month_pemasukan($awal,$akhir)->result_array();
           
        $this->load->view('admin/cetak_laporan_pendapatan',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_Paper('A4','potrait');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
    }

    // cetak semua data
    public function print_all(){
        $data['rekening'] = $this->db->get('t_rekening')->result_array();
        $data['laporan_print'] = $this->KeuanganModel->laporan_all()->result_array();
        $data['ket'] = 'SELURUHNYA';
        $data['t_inv'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv 
        FROM t_lap_invoice')->row()->t_inv;
        $data['t_sub_inv'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_sub_inv 
        FROM t_lap_sub_invoice')->row()->t_sub_inv;
         $data['laporan_pendapatan'] = $this->KeuanganModel->laporan_pendapatan()->result_array();
        // var_dump($data); die;
        $this->load->view('admin/cetak_laporan',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_Paper('A4','potrait');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
        }

         // cetak semua data
    public function print_all_laporan(){
        $data['rekening'] = $this->db->get('t_rekening')->result_array();
        // $data['laporan_print'] = $this->KeuanganModel->laporan_all()->result_array();
        $data['laporan_all'] = $this->KeuanganModel->laporan()->result_array();
        // var_dump($data['laporan_all']); die;
        $this->load->view('admin/cetak_laporan_pendapatan',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_Paper('A4','potrait');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
        }



        //Pengeluaran 
    public function list_pengeluaran(){
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['pengeluaran'] = $this->KeuanganModel->pengeluaran()->result_array();
        $data['list_pengeluaran'] = $this->db->query('SELECT * FROM t_list_pengeluaran 
        ORDER BY id_list_pengeluaran DESC')->result_array();
        $where = array('id_role'=>2);
        $data['users'] = $this->db->get_where('t_user',$where)->result_array();
        // var_dump($data['users']); die;
        $this->load->view('templates/header', $data);
        $this->load->view('admin/list_pengeluaran',$data);
        $this->load->view('templates/footer');
    }
    // tambah pengeluaran
    public function tambah_pengeluaran(){
        $nama= $this->input->post('nama');
        $tgl= $this->input->post('tgl');
        $biaya= $this->input->post('biaya');
        $keterangan= $this->input->post('keterangan');
        $petugas= $this->input->post('petugas');
        $data = array(
            'id_list_pengeluaran'=>$nama,
            'tgl_pengeluaran'=>$tgl,
            'biaya_pengeluaran'=>$biaya,
            'ket_pengeluaran'=>$keterangan,
            'id_user'=>$petugas,
        );

        $this->db->insert('t_pengeluaran', $data);
        $this->session->set_flashdata('sukses','<div class="alert
        alert-success" role="alert">Berhasil Ditambahkan</div>');
        redirect('index.php/admin/list_pengeluaran');

    }

    // list pengeluaran
    public function list_pengeluaran_add(){
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
        // var_dump($data['pengeluaran']); die;
        $this->load->view('templates/header', $data);
        $this->load->view('admin/list_pengeluaran_add',$data);
        $this->load->view('templates/footer');
    }

    public function list_pengeluaran_add_new(){
        $nama= $this->input->post('nama');
        $data = array(
            'nama_list_pengeluaran'=>$nama,
        );

        $this->db->insert('t_list_pengeluaran', $data);
        $this->session->set_flashdata('sukses','<div class="alert
        alert-success" role="alert">Berhasil Ditambahkan</div>');
        redirect('index.php/admin/list_pengeluaran_add');

    }

    // laporan pengeluaran

    public function pengeluaran(){
        $data['title'] = 'Keuangan';
        $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['pengeluaran'] = $this->KeuanganModel->pengeluaran()->result_array();
        $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
        $data['users'] = $this->db->get('t_user')->result_array();
        // var_dump($data['users']); die;
        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan_pengeluaran',$data);
        $this->load->view('templates/footer');

    }
    // print all pengeluaran
    public function print_all_pengeluaran(){
        $data['pengeluaran'] = $this->KeuanganModel->pengeluaran()->result_array();
        $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
        $data['users'] = $this->db->get('t_user')->result_array();
        $data['ket'] = 'SELURUHNYA';
        $data['biaya'] = $this->db->query('SELECT SUM(biaya_pengeluaran) AS biaya 
        FROM t_pengeluaran')->row()->biaya;
        $this->load->view('admin/cetak_laporan_pengeluaran',$data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
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
            $data['pengeluaran'] = $this->KeuanganModel->cari_laporan_pengeluaran($awal,$akhir)->result_array();
            $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
            $data['users'] = $this->db->get('t_user')->result_array();
            
            $data['biaya'] = $this->KeuanganModel->total_biaya_pengeluaran($awal,$akhir)->row()->biaya;  
            $this->load->view('templates/header', $data);
            $this->load->view('admin/cari_laporan_pengeluaran',$data);
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
            $data['pengeluaran'] = $this->KeuanganModel->cari_laporan_pengeluaran($awal,$akhir)->result_array();
            $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
            $data['users'] = $this->db->get('t_user')->result_array();
            
            $data['biaya'] = $this->KeuanganModel->total_biaya_pengeluaran($awal,$akhir)->row()->biaya;  
            $this->load->view('admin/cetak_laporan_pengeluaran',$data);
            $html = $this->output->get_output();
            $this->load->library('dompdf_gen');
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $sekarang = date("d:F:Y:h:m:s");
            $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
        }

        public function list_perusahaan(){
            $data['title'] = 'Keuangan';
            $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $data['list_perusahaan'] = $this->db->get('t_perusahaan')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('admin/list_perusahaan',$data);
            $this->load->view('templates/footer');

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
            redirect('index.php/admin/list_perusahaan');
    
        }
    

        public function list_jns_order(){
            $data['title'] = 'Keuangan';
            $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $data['list_jns_order'] = $this->db->get('t_order')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('admin/list_jns_order',$data);
            $this->load->view('templates/footer');

        }

        // jenis order

        public function tambah_jns_order(){
            $nama = $this->input->post('jns_order');
            $data= array(
                'jns_order' => $nama,
            );
            $query= $this->db->insert('t_order', $data);
            if($query){
                $this->session->set_flashdata('sukses','<div class="alert
                alert-success" role="alert">Berhasil !</div>');
                redirect('index.php/admin/list_jns_order', 'refresh');
            }else{
                $this->session->set_flashdata('error','<div class="alert
                alert-danger" role="alert">Gagal !</div>');
                redirect('index.php/admin/list_jns_order', 'refresh');
            }
            
        }
        public function hapus_order($id){
            $where = array('id_order' => $id);
            $res= $this->KeuanganModel->hapus_data($where,'t_order');
            if($res){
                redirect('index.php/admin/list_jns_order', 'refresh');
            }else{
             echo "<h2>Delete Data Gagal </h2>";
            }
        }
        public function edit_order($id){
            $data1['title'] = 'Form Edit User';
            $where = array('id_order' => $id);
            $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $order= $this->db->get_where('t_order',$where)->result_array();
            // var_dump ($order); die;
            $data = array(
                "id_order" => $order[0]['id_order'],
                "jns_order" => $order[0]['jns_order'],
            );
            $this->load->view('templates/header', $data1);
            $this->load->view('admin/edit_order', $data);
            $this->load->view('templates/footer');
        }
        public function proses_edit_order(){
            $id_order = $_POST['id_order'];
            $jns_order = $_POST['jns_order'];
            $data_update = array(
                "jns_order" => $jns_order,
            );
            $where = array('id_order'=> $id_order);
            $res = $this->KeuanganModel->UpdateData('t_order', $data_update, $where);
            if($res){
                redirect('index.php/admin/list_jns_order', 'refresh');
            }else{
             echo "<h2>Update Data Gagal </h2>";
            }
        }


        public function hapus_pengeluaran($id){
            $where = array('id_list_pengeluaran' => $id);
            $res= $this->KeuanganModel->hapus_data($where,'t_list_pengeluaran');
            if($res){
                redirect('index.php/admin/list_pengeluaran_add', 'refresh');
            }else{
             echo "<h2>Delete Data Gagal </h2>";
            }
        }

        public function edit_list_pengeluaran($id){
            $data1['title'] = 'Form Edit User';
            $where = array('id_list_pengeluaran' => $id);
            $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $list_peneluaran= $this->db->get_where('t_list_pengeluaran',$where)->result_array();
            // var_dump ($list_peneluaran); die;
            $data = array(
                "id_list_pengeluaran" => $list_peneluaran[0]['id_list_pengeluaran'],
                "nama_list_pengeluaran" => $list_peneluaran[0]['nama_list_pengeluaran'],
            );
            $this->load->view('templates/header', $data1);
            $this->load->view('admin/edit_list_pengeluaran', $data);
            $this->load->view('templates/footer');
        }

        public function proses_edit_list_pengeluaran(){
            $id_list_pengeluaran = $_POST['id_list_pengeluaran'];
            $nama_list_pengeluaran = $_POST['nama_list_pengeluaran'];
            $data_update = array(
                "nama_list_pengeluaran" => $nama_list_pengeluaran,
            );
            $where = array('id_list_pengeluaran'=> $id_list_pengeluaran);
            $res = $this->KeuanganModel->UpdateData('t_list_pengeluaran', $data_update, $where);
            if($res){
                redirect('index.php/admin/list_pengeluaran_add', 'refresh');
            }else{
             echo "<h2>Update Data Gagal </h2>";
            }

        }

        public function edit_pengeluaran($id){
            $data1['title'] = 'Form Edit Pengeluaran';
            $where = array('id_pengeluaran' => $id);
            $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
           
            $order= $this->db->get_where('t_pengeluaran',$where)->result_array();
            // var_dump ($order); die;
            $data = array(
                "id_list_pengeluaran" => $order[0]['id_list_pengeluaran'],
                "id_pengeluaran" => $order[0]['id_pengeluaran'],
                "tgl_list_pengeluaran" => $order[0]['tgl_pengeluaran'],
                "biaya_pengeluaran" => $order[0]['biaya_pengeluaran'],
                "ket_pengeluaran" => $order[0]['ket_pengeluaran'],
                "id_user" => $order[0]['id_user'],
            );
            $data['list_pengeluaran'] = $this->KeuanganModel->list_pengeluaran()->result_array();
           $id_user = array('id_role'=>2);
            $data['users'] = $this->db->get_where('t_user',$id_user)->result_array();

            $this->load->view('templates/header', $data1);
            $this->load->view('admin/edit_pengeluaran', $data);
            $this->load->view('templates/footer');
        }
        public function proses_edit_pengeluaran(){
            $id_pengeluaran = $_POST['id_pengeluaran'];
            $id_list_pengeluaran = $_POST['id_list_pengeluaran'];
            $tgl = $_POST['tgl'];
            $nominal = $_POST['nominal'];
            $keterangan = $_POST['keterangan'];
            $petugas = $_POST['petugas'];
            $data_update = array(
                "id_list_pengeluaran" => $id_list_pengeluaran,
                "tgl_pengeluaran" => $tgl,
                "biaya_pengeluaran" => $nominal,
                "ket_pengeluaran" => $keterangan,
                "id_user" => $petugas,
            );
            $where = array('id_pengeluaran'=> $id_pengeluaran);
            $res = $this->KeuanganModel->UpdateData('t_pengeluaran', $data_update, $where);
            if($res){
                redirect('index.php/admin/list_pengeluaran', 'refresh');
            }else{
             echo "<h2>Update Data Gagal </h2>";
            }
        }

        public function edit_perusahaan($id){
            $data1['title'] = 'Keuangan';
            $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $where =array('id_perusahaan' => $id);
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
            $this->load->view('admin/edit_perusahaan', $data);
            $this->load->view('templates/footer');
        }

        public function proses_edit_perusahaan(){
            $id_perusahaan = $_POST['id_perusahaan'];
            $nama_perusahaan = $_POST['nama_perusahaan'];
            $alamat = $_POST['alamat'];
            $tlp = $_POST['tlp'];
            $email = $_POST['email'];
            $data_update = array(
                "nama_perusahaan" => $nama_perusahaan,
                "alamat" => $alamat,
                "tlp" => $tlp,
                "email" => $email,
               
            );
            $where = array('id_perusahaan'=> $id_perusahaan);
            $res = $this->KeuanganModel->UpdateData('t_perusahaan', $data_update, $where);
            if($res){
                redirect('index.php/admin/list_perusahaan', 'refresh');
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
            $this->load->view('admin/profile', $data);
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
                    redirect('index.php/admin/profile');
                }else{
                    $this->session->set_flashdata('gagal','<div class="alert
                    alert-danger" role="alert">Data Gagal Diubah</div>');
                    redirect('index.php/admin/profile');
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
                    redirect('index.php/admin/profile');
                }else{
                    $this->session->set_flashdata('gagal','<div class="alert
                    alert-danger" role="alert">Data Gagal Diubah</div>');
                    redirect('index.php/admin/profile');
                }
    
            }
    
        }

        public function mulai_invoice($id_invoice){
        $where = array('id_invoice' => $id_invoice);
        $data1['title'] = 'Keuangan';
        $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
        $data['invoice'] = $this->KeuanganModel->input_invoice1($id_invoice)->result_array();
        // var_dump($data); die;
        $id= array('id_role' => 3);
        $data['users'] =$this->KeuanganModel->GetStaf($id, 't_user');
       
        $this->load->view('templates/header', $data1);
        $this->load->view('admin/pilih_petugas', $data);
        $this->load->view('templates/footer');
        }
    
        public function proses_mulai_invoice(){
            $id_invoice = $this->input->post('id_invoice');
            $id_user = $this->input->post('id_user');
            $waktu= $this->KeuanganModel->waktu("where id_invoice = '$id_invoice' ");
            $tgl_invoice = $waktu[0]['tgl_invoice'];
            // var_dump($tgl_invoice); die;
            date_default_timezone_set('Asia/Jakarta');
            $today = date("Y-m-d");
            $total = date('Y-m-d', strtotime('+30 days', strtotime($today)));
            $data_update = array(
                'id_user' => $id_user,
                'deadline_akta' => $total,
                'status_invoice' => 3,
                'tgl_mulai' => $today,
            );
            $where = array('id_invoice' => $id_invoice);
            $res = $this->KeuanganModel->UpdateData('t_invoice', $data_update, $where);
            $this->session->set_flashdata('message','<div class="alert
            alert-success" role="alert">Petugas telah pilih</div>');
            if($res){
                redirect('index.php/admin/list_order', 'refresh');
            }else{
             echo "<h2>Update Data Gagal </h2>";
            }
        }
        public function dibukukan_semua($no_invoice){
                $where = array('id_invoice'=>$no_invoice);
                $data['title'] = 'Bukukan Keseluruhan';
                $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $data['pemasukan'] = $this->db->get_where('t_pemasukan',$where)->result_array();
                // var_dump($data['pemasukan']); die;
                if($data['pemasukan'] == null){
                    $data['id_invoice'] = $no_invoice;
                    $data['t_lap_inv'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv 
                    FROM t_lap_invoice WHERE id_invoice= '.$no_invoice)->row()->t_inv;
                    $data['t_lap_sub_inv'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv 
                    FROM t_lap_sub_invoice WHERE id_invoice= '.$no_invoice)->row()->t_inv;
                    $data['banks'] = $this->KeuanganModel->getData('t_rekening');
    
                    $this->load->view('templates/header', $data);
                    $this->load->view('admin/all_book', $data);
                    $this->load->view('templates/footer');
                }else{
                    $data['id_invoice'] = $no_invoice;
                    $data['t_lap_inv'] = $this->db->query('SELECT SUM(total_lap_invoice) AS t_inv 
                    FROM t_pemasukan WHERE id_invoice= '.$no_invoice)->row()->t_inv;
                    $data['t_lap_sub_inv'] = $this->db->query('SELECT SUM(total_lap_sub_invoice) AS t_inv 
                    FROM t_pemasukan WHERE id_invoice= '.$no_invoice)->row()->t_inv;
                    $data['banks'] = $this->KeuanganModel->getData('t_rekening');
    
                    $this->load->view('templates/header', $data);
                    $this->load->view('admin/all_book_update', $data);
                    $this->load->view('templates/footer');
                  

                }
        }

        public function proses_bukukan_semua($no_invoice){
            $no_invoice = $this->input->post('id_invoice');
            $biaya = $this->input->post('biaya');
            $biaya_sub = $this->input->post('biaya_sub');
            $keterangan = $this->input->post('keterangan');
            $today = date("Y-m-d");

            $where1 = array('id_invoice' => $no_invoice);
            $data1 = array(
                'status_invoice' => 2,
            );
            $this->KeuanganModel->UpdateData('t_invoice', $data1, $where1);
            if(empty($biaya)){
                $data = array(
                    'id_invoice' => $no_invoice,
                    'id_rekening_inv' => '-',
                    'id_rekening_sub' => '-',
                    'total_lap_invoice' => 0,
                    'total_lap_sub_invoice' => $biaya_sub,
                    'ket_pemasukan' => $keterangan,
                    'tgl_pemasukan' => $today,
                );
              
                $id = urldecode($no_invoice);
                $this->db->insert('t_pemasukan', $data);
                $this->session->set_flashdata('finish','<div class="alert
                alert-success" role="alert">Invoice & Sub Invoice Telah Dibukukan</div>');
                redirect('index.php/admin/view_order/'.$id, 'refresh');

            }elseif(empty($biaya_sub)){
                $data = array(
                    'id_invoice' => $no_invoice,
                    'id_rekening_inv' => '-',
                    'id_rekening_sub' => '-',
                    'total_lap_invoice' => $biaya,
                    'total_lap_sub_invoice' => '0',
                    'ket_pemasukan' => $keterangan,
                    'tgl_pemasukan' => $today,
                );
              
                $id = urldecode($no_invoice);
                $this->db->insert('t_pemasukan', $data);
                $this->session->set_flashdata('finish','<div class="alert
                alert-success" role="alert">Invoice & Sub Invoice Telah Dibukukan</div>');
                redirect('index.php/admin/view_order/'.$id, 'refresh');
            }else{
                $data = array(
                    'id_invoice' => $no_invoice,
                    'id_rekening_inv' => '-',
                    'id_rekening_sub' => '-',
                    'total_lap_invoice' => $biaya,
                    'total_lap_sub_invoice' => $biaya_sub,
                    'ket_pemasukan' => $keterangan,
                    'tgl_pemasukan' => $today,
                );
              
                $id = urldecode($no_invoice);
                $this->db->insert('t_pemasukan', $data);
                $this->session->set_flashdata('finish','<div class="alert
                alert-success" role="alert">Invoice & Sub Invoice Telah Dibukukan</div>');
                redirect('index.php/admin/view_order/'.$id, 'refresh');
            }

        }

        public function proses_bukukan_semua_update($no_invoice){
            $no_invoice = $this->input->post('id_invoice');
            $biaya = $this->input->post('biaya');
            $biaya_sub = $this->input->post('biaya_sub');
            $keterangan = $this->input->post('keterangan');
            $today = date("Y-m-d");

            $where1 = array('id_invoice' => $no_invoice);
            $data1 = array(
                'status_invoice' => 2,
            );
            $this->KeuanganModel->UpdateData('t_invoice', $data1, $where1);

            $data = array(
                'id_invoice' => $no_invoice,
                'id_rekening_inv' => '-',
                'id_rekening_sub' => '-',
                'total_lap_invoice' => $biaya,
                'total_lap_sub_invoice' => $biaya_sub,
                'ket_pemasukan' => $keterangan,
                'tgl_pemasukan' => $today,
            );
                         
                $id = urldecode($no_invoice);
                $this->KeuanganModel->UpdateData('t_pemasukan', $data, $where1);
                $this->session->set_flashdata('finish','<div class="alert
                alert-success" role="alert">Invoice & Sub Invoice Telah Dibukukan</div>');
                redirect('index.php/admin/view_order/'.$id, 'refresh');
            

        }
        public function dibukukan_semua_sub($no_invoice){
            $data['title'] = 'Bukukan Keseluruhan';
        
            $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            
            $status = array('status'=>0);
            $data['bukukan_semua_sub']=$this->db->query('SELECT * FROM t_lap_sub_invoice WHERE id_invoice='.$no_invoice.'
            && status=0')->result_array();
            if($data['bukukan_semua_sub']){
                $data['t_lap_sub_inv'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv_sub 
                FROM t_lap_sub_invoice WHERE id_invoice= '.$no_invoice.' && status=0')->row()->t_inv_sub;
                $data['banks'] = $this->KeuanganModel->getData('t_rekening');

                $this->load->view('templates/header', $data);
                $this->load->view('admin/all_book_sub', $data);
                $this->load->view('templates/footer');
            }else{
                $id = urldecode($no_invoice);
                $this->session->set_flashdata('gagal1','<div class="alert
                alert-success" role="alert">Sub Invoice sudah dibukukan semua</div>');
                    redirect('index.php/admin/input_invoice/'.$id, 'refresh');
            }   
            
        }
        public function proses_bukukan_semua_sub(){
           
            $no_invoice = $this->input->post('id_invoice');
            $biaya = $this->input->post('biaya');
            $id_rekening = $this->input->post('id_rekening');
            $keterangan = $this->input->post('keterangan');
            $today = date("Y-m-d");
            $where1 = array('id_invoice' => $no_invoice);
            $data1 = array(
                'status' => 1,
            );
            $this->KeuanganModel->UpdateData('t_lap_sub_invoice', $data1, $where1);
            $data = array(
                'id_invoice' => $no_invoice,
                'id_rekening' => $id_rekening,
                'biaya_pemasukan_sub_invoice' => $biaya,
                'ket_bank' => $keterangan,
                'tgl_sub_invoice' => $today,
            );
            $data2 = array(
                'id_invoice' => $no_invoice,
                'id_rekening' => $id_rekening,
                'biaya_pemasukan_invoice' =>0,
                'ket_bank' => $keterangan,
                'tgl_pemasukan' => $today,
            );
    
            $id = urldecode($no_invoice);
            $this->db->insert('t_pemasukan_sub_invoice', $data);
            $this->db->insert('t_pemasukan_invoice', $data2);
            $this->session->set_flashdata('finish','<div class="alert
            alert-success" role="alert">Sub Invoice Telah Dibukukan</div>');
            redirect('index.php/admin/view_order/'.$id, 'refresh');

        }

        public function report_invoice_sub($no_invoice){
            $data['title'] = 'Bukukan Keseluruhan';
          
                $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $data['id_invoice'] = $no_invoice;
                $where = array('id_invoice'=>$no_invoice);
                $data['pemasukan_inv'] = $this->db->query('SELECT id_rekening FROM t_pemasukan_invoice
                WHERE id_invoice='.$no_invoice)->result_array();
                $data['pemasukan_sub_inv'] = $this->db->query('SELECT id_rekening FROM t_pemasukan_sub_invoice
                WHERE id_invoice='.$no_invoice)->result_array();
                $data['pemasukan'] = $this->db->get_where('t_pemasukan',$where);
                
                if($data['pemasukan_inv'] && $data['pemasukan_sub_inv']){
                    if($data['pemasukan']){
                        $id = urldecode($no_invoice);
                        $this->session->set_flashdata('gagal3','<div class="alert
                        alert-danger" role="alert">Anda Sudah Melakukan Report</div>');
                            redirect('index.php/keuangan/view_order/'.$id, 'refresh');    
                    }else{
                        $data['report_invoice'] = $this->db->query('SELECT SUM(biaya_pemasukan_invoice) AS t_inv 
                        FROM t_pemasukan_invoice WHERE id_invoice= '.$no_invoice)->row()->t_inv;
        
                         $data['report_sub_invoice'] = $this->db->query('SELECT SUM(biaya_pemasukan_sub_invoice) AS t_inv2 
                         FROM t_pemasukan_sub_invoice WHERE id_invoice= '.$no_invoice)->row()->t_inv2;
            
                        $this->load->view('templates/header', $data);
                        $this->load->view('admin/report_invoice', $data);
                        $this->load->view('templates/footer'); 
                    }
                }else{
                    $id = urldecode($no_invoice);
                    $this->session->set_flashdata('gagal2','<div class="alert
                    alert-danger" role="alert">Invoice belum dibukukan</div>');
                        redirect('index.php/admin/view_order/'.$id, 'refresh');
                }


        }
        public function proses_report_invoice_sub(){
           
            $no_invoice = $this->input->post('id_invoice');
            $keterangan = $this->input->post('keterangan');
            $id_inv = $this->input->post('id_inv');
            $id_sub_inv = $this->input->post('id_sub_inv');
            $t_invoice = $this->input->post('t_invoice');
            $t_s_invoice = $this->input->post('t_s_invoice');
            $today = date("Y-m-d");

            $data = array(
                'id_invoice' => $no_invoice,
                'id_rekening_inv' => $id_inv,
                'id_rekening_sub' => $id_sub_inv,
                'total_lap_invoice' =>$t_invoice,
                'total_lap_sub_invoice' => $t_s_invoice,
                'ket_pemasukan' => $keterangan,
                'tgl_pemasukan' => $today,
            );
    
            $id = urldecode($no_invoice);
            $this->db->insert('t_pemasukan', $data);
            $this->session->set_flashdata('finish','<div class="alert
            alert-success" role="alert">Invoice dan Sub Invoice Sudah Dibukukan</div>');
            redirect('index.php/admin/view_order/'.$id, 'refresh');

        }

        public function cetak_bukti($id_invoice){
            $data1['title'] = 'Bukukan Keseluruhan';
            $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $where = array('id_invoice'=>$id_invoice);
            $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
            
            $notaris= $this->db->get('t_notaris')->result_array();
            $content= $this->db->get_where('t_invoice',$where)->result_array();
         
            $data = array(
                "id_invoice" => $content[0]['id_invoice'],
                "no_invoice" => $content[0]['no_invoice'],
                "jns_order1" => $content[0]['jns_order1'],
                "nasabah" => $content[0]['nasabah'],
                "nama_notaris" => $notaris[0]['nama_notaris'],
            );
            $data['invoice'] = $this->KeuanganModel->cetak_bukti($id_invoice)->result_array();
            $data['berita'] = $this->db->get_where('t_berita_acara',$where)->result_array();
            $this->load->view('templates/header', $data1);
            $this->load->view('admin/cetak_bukti', $data);
            $this->load->view('templates/footer'); 
          
        }
        public function proses_cetak_bukti($id_invoice){
            $where = array('id_invoice'=> $id_invoice);
            $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
            $notaris= $this->db->get('t_notaris')->result_array();
            $content= $this->db->get_where('t_invoice',$where)->result_array();
            $id_invoice = $this->input->post('id_invoice');
            $berita = $this->input->post('berita');

            $data = array(
                "id_invoice" => $id_invoice,
                "berita" => $berita,
            );

            $this->db->insert('t_berita_acara',$data);
            $id = urldecode($id_invoice);
            $this->session->set_flashdata('gagal2','<div class="alert
            alert-danger" role="alert">Invoice belum dibukukan</div>');
            redirect('index.php/admin/cetak_bukti/'.$id, 'refresh');
           
        }

        public function view_berita($id_invoice){
            $where = array('id_invoice'=> $id_invoice);
            $data1['title'] = 'View Berita Acara';
            $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
            $notaris= $this->db->get('t_notaris')->result_array();
            $data['berita']= $this->db->get_where('t_berita_acara',$where)->result_array();

            $this->load->view('templates/header', $data1);
            $this->load->view('admin/view_berita', $data);
            $this->load->view('templates/footer'); 
           
           
        }
        public function lihat_invoice($id_invoice){
            $data['title'] = 'Keuangan';
            $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
            $id= array('id_role' => 3);
            $where =array('id_invoice' => $id_invoice);
            $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
            $data['jns_invo'] = $this->db->get('t_order')->result_array();
            $data['invoices_sub'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
            $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->result_array();
            $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('admin/lihat_invoice', $data);
            $this->load->view('templates/footer');
    

        }

        public function bukukan_all($no_invoice){
            $data_update = array(
                'status_invoice' => 2,
            );
            $id = urldecode($no_invoice);
            $where = array('id_invoice' => $no_invoice);
            $res = $this->KeuanganModel->Kirim_invoice('t_invoice', $data_update, $where);
            $this->session->set_flashdata('kirim2','<div class="alert
            alert-success" role="alert">Invoice Dan Sub Invoice Selesai Dibukukan</div>');
            redirect('index.php/admin/view_order/'.$id, 'refresh');
            }

            public function print_berita($id_invoice){
                $where = array('id_invoice'=>$id_invoice);
                $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
                $berita= $this->db->get_where('t_berita_acara',$where)->result_array();

                $query = ('SELECT * FROM t_invoice WHERE id_invoice ='.$id_invoice);
                $invoice = $this->db->query($query)->result_array();
                $data = array(
                    "jns_order1" => $invoice[0]['jns_order1'],
                    "nasabah" => $invoice[0]['nasabah'],
                    "berita" => $berita[0]['berita'],
                );
                $this->load->view('keuangan/print_berita',$data);
                $html = $this->output->get_output();
                $this->load->library('dompdf_gen');
                $this->dompdf->load_html($html);
                $this->dompdf->render();
                $sekarang = date("d:F:Y:h:m:s");
                $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
            }
            public function edit_berita($id_invoice){
                $where = array('id_invoice' => $id_invoice);
                $data1['title'] = 'Keuangan';
                $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $order= $this->KeuanganModel->GetStaf($where, 't_berita_acara');
                $data = array(
                    "id_invoice" => $order[0]['id_invoice'],
                    "berita" => $order[0]['berita'],
                );
               
                $this->load->view('templates/header', $data1);
                $this->load->view('admin/edit_berita', $data);
                $this->load->view('templates/footer');
            }

            public function proses_edit_berita($id_invoice1){
                $id_invoice = $_POST['id_invoice'];
                $berita= $_POST['berita'];
                $data_update = array(
                    'id_invoice' => $id_invoice,
                    'berita' => $berita,
                    
                );
                $where = array('id_invoice' => $id_invoice);
                $id = urldecode($id_invoice1);
                $this->KeuanganModel->UpdateData('t_berita_acara', $data_update, $where);
                $this->session->set_flashdata('sukses','<div class="alert
                alert-success" role="alert">Berhasil diubah</div>');
                redirect('index.php/admin/cetak_bukti/'.$id, 'refresh');
            }
            public function export_word($id_invoice){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=berita_acara.doc");
                $where = array('id_invoice'=>$id_invoice);
                $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
                $berita= $this->db->get_where('t_berita_acara',$where)->result_array();
                $query = ('SELECT * FROM t_invoice WHERE id_invoice ='.$id_invoice);
                $invoice = $this->db->query($query)->result_array();
                $data = array(
                    "jns_order1" => $invoice[0]['jns_order1'],
                    "nasabah" => $invoice[0]['nasabah'],
                    "berita" => $berita[0]['berita'],
                );
                $this->load->view('admin/print_berita',$data);
            }
            public function export_word_laporan_sub_invoice($id_invoice){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=sub_invoice.doc");

                $where = array('id_invoice'=>$id_invoice);
                $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
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
                $this->load->view('admin/cetak_sub_invoice',$data);

            }
            public function export_excell_laporan_sub_invoice($id_invoice){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=sub_invoice.xls");
                $where = array('id_invoice'=>$id_invoice);
                $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
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
                $this->load->view('admin/cetak_sub_invoice',$data);

            }
            public function export_word_laporan_invoice1($id_invoice){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=invoice.doc");

                 $where = array('id_invoice'=>$id_invoice);
                $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
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
                 $this->load->view('admin/cetak_invoice',$data);
            }
            public function export_excell_laporan_invoice1($id_invoice){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=invoice.xls");
                $where = array('id_invoice'=>$id_invoice);
                $data['detail'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
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
                 $this->load->view('admin/cetak_invoice',$data);
            }

            public function export_word_laporan(){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=laporan.doc");
                $data['laporan_all'] = $this->KeuanganModel->laporan()->result_array();
                $data['ket'] = 'SELURUHNYA';
                $this->load->view('admin/cetak_laporan_pendapatan',$data);
            }

            public function export_excell_laporan(){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=laporan.xls");
                $data['laporan_all'] = $this->KeuanganModel->laporan()->result_array();
                $data['ket'] = 'SELURUHNYA';
                $this->load->view('admin/cetak_laporan_pendapatan',$data);
            }
            public function export_word_laporan_by_tanggal($awal, $akhir){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=laporan_by_tanggal.doc");
              
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                $data['laporan_pendapatan'] = $this->KeuanganModel->view_by_month1($awal,$akhir)->result_array();
               
                $this->load->view('admin/cetak_laporan',$data);
            }

            public function export_excell_laporan_by_tanggal($awal, $akhir){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=laporan_by_tanggal.xls");
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                $data['laporan_pendapatan'] = $this->KeuanganModel->view_by_month1($awal,$akhir)->result_array();
                $this->load->view('admin/cetak_laporan',$data);
            }


            public function export_word_pemasukan_by_tanggal($awal, $akhir){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=pemasukan_by_tanggal.doc");
              
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                $data['laporan_all'] = $this->KeuanganModel->view_by_month_pemasukan($awal,$akhir)->result_array();
           
                $this->load->view('admin/cetak_laporan_pendapatan',$data);
            }

            public function export_excell_pemasukan_by_tanggal($awal, $akhir){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=pemasukan_by_tanggal.xls");
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                $data['laporan_all'] = $this->KeuanganModel->view_by_month_pemasukan($awal,$akhir)->result_array();
           
             $this->load->view('admin/cetak_laporan_pendapatan',$data);
             
            }
            public function export_word_pengeluaran(){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=pengeluaran.doc");
                $data['pengeluaran'] = $this->KeuanganModel->pengeluaran()->result_array();
                $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
                $data['users'] = $this->db->get('t_user')->result_array();
                $data['ket'] = 'SELURUHNYA';
                $data['biaya'] = $this->db->query('SELECT SUM(biaya_pengeluaran) AS biaya 
                FROM t_pengeluaran')->row()->biaya;
                $this->load->view('admin/cetak_laporan_pengeluaran',$data);
            }

            public function export_excell_pengeluaran(){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=pengeluaran.xls");
                $data['pengeluaran'] = $this->KeuanganModel->pengeluaran()->result_array();
                $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
                $data['users'] = $this->db->get('t_user')->result_array();
                $data['ket'] = 'SELURUHNYA';
                $data['biaya'] = $this->db->query('SELECT SUM(biaya_pengeluaran) AS biaya 
                FROM t_pengeluaran')->row()->biaya;
                $this->load->view('admin/cetak_laporan_pengeluaran',$data);
            }

            public function export_word_pengeluaran_by_tanggal($awal,$akhir){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=pengeluaran_by_tanggal.doc");
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['pengeluaran'] = $this->KeuanganModel->cari_laporan_pengeluaran($awal,$akhir)->result_array();
                $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
                $data['users'] = $this->db->get('t_user')->result_array();
                
                $data['biaya'] = $this->KeuanganModel->total_biaya_pengeluaran($awal,$akhir)->row()->biaya;  
                $this->load->view('admin/cetak_laporan_pengeluaran',$data);
               
            }

            public function export_excell_pengeluaran_by_tanggal($awal,$akhir){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=pengeluaran_by_tanggal.xls");
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['pengeluaran'] = $this->KeuanganModel->cari_laporan_pengeluaran($awal,$akhir)->result_array();
                $data['list_pengeluaran'] = $this->db->get('t_list_pengeluaran')->result_array();
                $data['users'] = $this->db->get('t_user')->result_array();
                
                $data['biaya'] = $this->KeuanganModel->total_biaya_pengeluaran($awal,$akhir)->row()->biaya;  
                $this->load->view('admin/cetak_laporan_pengeluaran',$data);
            }

            public function pembayaran_invoice($id_invoice){
                $data['title'] = 'Keuangan';
                $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $id= array('id_role' => 3);
                $where =array('id_invoice' => $id_invoice);
                $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
                $data['jns_invo'] = $this->db->get('t_order')->result_array();
                $data['invoices_sub'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
                $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_pemasukan_invoice
                ON t_lap_invoice.id_invoice = t_pemasukan_invoice.id_invoice WHERE t_lap_invoice.id_invoice='.$id_invoice.'
                GROUP BY t_lap_invoice.id_lap_invoice')->result_array();

                $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_pemasukan_sub_invoice
                ON t_lap_sub_invoice.id_invoice = t_pemasukan_sub_invoice.id_invoice 
                WHERE t_lap_sub_invoice.id_invoice='.$id_invoice.' GROUP BY t_lap_sub_invoice.id_lap_sub_invoice')->result_array();
                $data['banks'] = $this->KeuanganModel->getData('t_rekening');
                $this->load->view('templates/header', $data);
                $this->load->view('admin/lihat_pembayaran', $data);
                $this->load->view('templates/footer');

            }
            public function print_bukti_pembayaran($id_invoice){
                // $data['stafs'] =$this->KeuanganModel->GetStaf($id, 't_user');
                $data['title'] = 'Keuangan';
                $data['id_invoice'] = $id_invoice;
                $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $data['jns_invo'] = $this->db->get('t_order')->result_array();
                $data['invoices_sub'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
                $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_rekening ON t_lap_invoice.id_rekening = t_rekening.id_rekening
                WHERE t_lap_invoice.id_invoice='.$id_invoice)->result_array();

                $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_rekening ON t_lap_sub_invoice.id_rekening = t_rekening.id_rekening
                WHERE t_lap_sub_invoice.id_invoice='.$id_invoice)->result_array();
                
                $data['banks'] = $this->KeuanganModel->getData('t_rekening');
                
                $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
                FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
                 $data['t_inv_sub'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv2 
                 FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
              
                $this->load->view('templates/header', $data);
                $this->load->view('admin/cetak_bukti_pembayaran',$data);
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
                $data['title'] = 'Data Perusahaan';
                $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $data['jns_invo'] = $this->db->get('t_order')->result_array();
                $data['invoices_sub'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
                $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_rekening ON t_lap_invoice.id_rekening = t_rekening.id_rekening
                WHERE t_lap_invoice.id_invoice='.$id_invoice)->result_array();

                $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_rekening ON t_lap_sub_invoice.id_rekening = t_rekening.id_rekening
                WHERE t_lap_sub_invoice.id_invoice='.$id_invoice)->result_array();
                
                $data['banks'] = $this->KeuanganModel->getData('t_rekening');
                
                $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
                FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
                 $data['t_inv_sub'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv2 
                 FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
              
                $this->load->view('admin/print_bukti_pembayaran',$data);
                $html = $this->output->get_output();
                $this->load->library('dompdf_gen');
                $this->dompdf->load_html($html);
                $this->dompdf->render();
                $sekarang = date("d:F:Y:h:m:s");
                $this->dompdf->stream("Cetak".$sekarang.".pdf",array('Attachment'=>0));
        
            }

            public function list_atm(){
                $data['title'] = 'Keuangan';
                $data['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $data['rekening'] = $this->KeuanganModel->getData('t_rekening');
                $this->load->view('templates/header', $data);
                $this->load->view('admin/list_rekening', $data);
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
                redirect('index.php/admin/list_atm');
            }

            public function edit_atm($id){
                $data1['title'] = 'Data User';
                $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $rekening= $this->KeuanganModel->GetAtm("where id_rekening = '$id' ");
                $data = array(
                    "id_rekening" => $rekening[0]['id_rekening'],
                    "no_rekening" => $rekening[0]['no_rekening'],
                    "nama_bank" => $rekening[0]['nama_bank'],
                    "nama_nasabah" => $rekening[0]['nama_nasabah'],
                );
                
                $this->load->view('templates/header', $data1);
                $this->load->view('admin/edit_rekening', $data);
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
        $res = $this->KeuanganModel->UpdateData('t_rekening', $data_update, $where);
        if($res){
            $this->session->set_flashdata('berhasil','<div class="alert
            alert-success" role="alert">Data Berhasil Diubah</div>');
            redirect('index.php/admin/list_atm', 'refresh');
        }else{
            $this->session->set_flashdata('gagal','<div class="alert
            alert-danger" role="alert">Data Gagal Diubah</div>');
            redirect('index.php/admin/list_atm', 'refresh');
        }
}
        public function export_word_bukti_laporan($id_invoice){
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=bukti.doc");
            $data['jns_invo'] = $this->db->get('t_order')->result_array();
            $data['invoices_sub'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
            $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_rekening ON t_lap_invoice.id_rekening = t_rekening.id_rekening
            WHERE t_lap_invoice.id_invoice='.$id_invoice)->result_array();

            $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_rekening ON t_lap_sub_invoice.id_rekening = t_rekening.id_rekening
            WHERE t_lap_sub_invoice.id_invoice='.$id_invoice)->result_array();
            
            $data['banks'] = $this->KeuanganModel->getData('t_rekening');
            
            $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
            FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
             $data['t_inv_sub'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv2 
             FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
          
            $this->load->view('admin/print_bukti_pembayaran',$data);

        }

        public function export_excell_bukti_laporan($id_invoice){
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=bukti.xls");
            $data['jns_invo'] = $this->db->get('t_order')->result_array();
            $data['invoices_sub'] = $this->KeuanganModel->input_invoice($id_invoice)->result_array();
            $data['lap_invoice'] = $this->db->query('SELECT * FROM t_lap_invoice JOIN t_rekening ON t_lap_invoice.id_rekening = t_rekening.id_rekening
            WHERE t_lap_invoice.id_invoice='.$id_invoice)->result_array();

            $data['lap_sub_invoice'] = $this->db->query('SELECT * FROM t_lap_sub_invoice JOIN t_rekening ON t_lap_sub_invoice.id_rekening = t_rekening.id_rekening
            WHERE t_lap_sub_invoice.id_invoice='.$id_invoice)->result_array();
            
            $data['banks'] = $this->KeuanganModel->getData('t_rekening');
            
            $data['t_inv2'] = $this->db->query('SELECT SUM(biaya_lap_invoice) AS t_inv2 
            FROM t_lap_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
             $data['t_inv_sub'] = $this->db->query('SELECT SUM(biaya_lap_sub_invoice) AS t_inv2 
             FROM t_lap_sub_invoice WHERE id_invoice='.$id_invoice)->row()->t_inv2;
          
            $this->load->view('admin/print_bukti_pembayaran',$data);

        }

        public function print_laporan_keseluruhan(){  
            $data['laporan_keuangan'] = $this->KeuanganModel->laporan_keuangan()->result_array();
            $this->load->view('admin/cetak_laporan_keuangan',$data);
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
                $this->load->view('admin/cetak_laporan_keuangan',$data);
            }

            public function export_excell_laporan_keuangan(){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=laporan_keuangan.xls");
                $data['laporan_keuangan'] = $this->KeuanganModel->laporan_keuangan()->result_array();
                $this->load->view('admin/cetak_laporan_keuangan',$data);
            }

            public function cari_laporan_keuangan(){
                $data1['title'] = 'Keuangan';
                $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $awal = $this->input->post('awal');
                $akhir = $this->input->post('akhir');
                $data['ket'] = 'Dari : '.$awal.' - '.$akhir;
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
               
                $data['laporan_keuangan'] = $this->KeuanganModel->view_by_month_keuangan($awal,$akhir)->result_array();               
                $this->load->view('templates/header', $data1);
                $this->load->view('admin/cari_laporan_keuangan',$data);
                $this->load->view('templates/footer');
              
            }
            public function print_cari_keuangan(){
                $data1['title'] = 'Keuangan';
                $data1['user'] = $this->db->get_where('t_user',['username'=>$this->session->userdata('username')])->row_array();
                $awal = $this->input->post('awal');
                $akhir = $this->input->post('akhir');
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['laporan_keuangan'] = $this->KeuanganModel->view_by_month_keuangan($awal,$akhir)->result_array();
            
                $this->load->view('admin/cetak_laporan_keuangan',$data);
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
            
                $this->load->view('admin/cetak_laporan_keuangan',$data);
            }

            public function export_excell_keuangan_by_tanggal($awal, $akhir){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=laporan_keuangan_by_tanggal.xls");
                $data['ket'] = 'Dari : '.longdate_indo($awal).' - '.longdate_indo($akhir);
                $data['awal'] = $this->input->post('awal'); 
                $data['akhir'] = $this->input->post('akhir'); 
                $data['rekening'] = $this->db->get('t_rekening')->result_array();
                $data['laporan_keuangan'] = $this->KeuanganModel->view_by_month_keuangan($awal,$akhir)->result_array();
            
                $this->load->view('admin/cetak_laporan_keuangan',$data);
            }

            public function export_word_pendapatan(){
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=laporan_pendapatan.doc");
                $data['laporan_pendapatan'] = $this->KeuanganModel->laporan_pendapatan()->result_array();
                $this->load->view('admin/cetak_laporan',$data);
            }

            public function export_excell_pendapatan(){
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment;Filename=laporan_pendapatan.xls");
                $data['laporan_pendapatan'] = $this->KeuanganModel->laporan_pendapatan()->result_array();
                $this->load->view('admin/cetak_laporan',$data);
            }
    



            
}