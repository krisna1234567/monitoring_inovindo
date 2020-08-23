<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KeuanganModel extends CI_Model {

    public function list_order(){
       $this->db->select('*');
       $this->db->from('t_invoice');
       $this->db->join('t_user','t_user.id_user=t_invoice.id_user');
    //    $this->db->join('t_order','t_order.id_order=t_invoice.id_order');
       $this->db->order_by('id_invoice desc');
       $query = $this->db->get();
       return $query;
    }
    public function list_order_all(){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_perusahaan','t_perusahaan.nama_perusahaan=t_invoice.jns_order1');
        $this->db->order_by('id_invoice desc');
        $query = $this->db->get();
        return $query;
     }

     public function laporan(){
       $query= 'SELECT p.tgl_invoice,p.no_invoice,p.jns_order1,p.nasabah, p.id_invoice, invoice.total_invoice,
        sub_invoice.total_sub_invoice FROM t_invoice p 
            LEFT JOIN (SELECT id_invoice, 
                    SUM(biaya_lap_invoice)total_invoice FROM t_lap_invoice WHERE status=1 
                    GROUP BY id_invoice) invoice ON p.id_invoice= invoice.id_invoice
            LEFT JOIN (SELECT id_invoice,
                    SUM(biaya_lap_sub_invoice) total_sub_invoice
                    FROM t_lap_sub_invoice WHERE status=1 
                    GROUP BY id_invoice) sub_invoice
                    ON p.id_invoice=sub_invoice.id_invoice';
            $hasil = $this->db->query($query);
        return $hasil;
     }
     public function view_by_month_pemasukan($awal, $akhir){
        $query= "SELECT p.tgl_invoice,p.no_invoice,p.jns_order1,p.nasabah, p.id_invoice, invoice.total_invoice,
        sub_invoice.total_sub_invoice FROM t_invoice p 
            LEFT JOIN (SELECT id_invoice, tgl_pemasukan,
                    SUM(biaya_lap_invoice)total_invoice FROM t_lap_invoice WHERE status=1 
                    GROUP BY id_invoice) invoice ON p.id_invoice= invoice.id_invoice
            LEFT JOIN (SELECT id_invoice, tgl_pemasukan,
                    SUM(biaya_lap_sub_invoice) total_sub_invoice
                    FROM t_lap_sub_invoice WHERE status=1 
                    GROUP BY id_invoice) sub_invoice
                    ON p.id_invoice=sub_invoice.id_invoice
                    WHERE MONTH(p.tgl_invoice) BETWEEN MONTH('$awal') AND MONTH('$akhir')";
             $hasil = $this->db->query($query);
         return $hasil;
      }
     public function laporan_pendapatan(){
       $query = 'SELECT p.tgl_invoice,p.no_invoice,p.jns_order1,p.nasabah, p.id_invoice, invoice.total_invoice, 
       sub_invoice.total_sub_invoice FROM t_invoice p 
                LEFT JOIN (SELECT id_invoice, 
                            SUM(biaya_lap_invoice) total_invoice 
                            FROM t_lap_invoice GROUP BY id_invoice) invoice 
                            ON p.id_invoice= invoice.id_invoice
                LEFT JOIN (SELECT id_invoice,
                            SUM(biaya_lap_sub_invoice) total_sub_invoice
                            FROM t_lap_sub_invoice GROUP BY id_invoice) sub_invoice
                            ON p.id_invoice=sub_invoice.id_invoice';
        $cek = $this->db->query($query);
        return $cek;
     }
     public function laporan_pendapatan_invoice(){
        $query = "SELECT tbl.tgl_pemasukan, SUM(tbl.biaya_lap_invoice) as total
                    FROM (SELECT biaya_lap_invoice, tgl_pemasukan FROM t_lap_invoice UNION ALL
                    SELECT biaya_lap_sub_invoice,tgl_pemasukan FROM t_lap_sub_invoice ) tbl
                    GROUP BY MONTH(tbl.tgl_pemasukan)";
         $cek = $this->db->query($query);
         return $cek;
      }
      public function laporan_pendapatan_sub_invoice(){
         $query = "SELECT tbl.tgl_pemasukan, SUM(tbl.biaya_lap_invoice) as total_pemasukan
                    FROM (SELECT biaya_lap_invoice, tgl_pemasukan FROM t_lap_invoice WHERE status =1 UNION ALL
                    SELECT biaya_lap_sub_invoice,tgl_pemasukan FROM t_lap_sub_invoice WHERE status =1 ) tbl
                    GROUP BY MONTH(tbl.tgl_pemasukan)";
          $cek = $this->db->query($query);
          return $cek;
       }

     public function input_invoice($no_invoice){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_perusahaan','t_perusahaan.nama_perusahaan=t_invoice.jns_order1');
        $this->db->where('t_invoice.id_invoice =', $no_invoice);
        $query = $this->db->get();
        return $query;
     }

     public function input_invoice1($no_invoice){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_user','t_user.id_user=t_invoice.id_user');
        // $this->db->join('t_order','t_order.id_order=t_invoice.id_order');
        $this->db->where('t_invoice.id_invoice =', $no_invoice);
        $query = $this->db->get();
        return $query;
     }
   
    public function GetInvoice($where){
        $no_invoice = array('no_invoice'=> $where);
        $this->db->select('*');
        $this->db->from('t_lap_invoice');
        $this->db->where($no_invoice);
        $query = $this->db->get();
        return $query;  
    
    }
    public function Get_lap_invoice($where){
        $this->db->select('*');
        $this->db->from('t_lap_sub_invoice');
        $this->db->where('no_invoice =', $where);
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
    public function GetAtm($where=""){
        $data = $this->db->query('select * from t_rekening '.$where);
        return $data->result_array();
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
    public function Kirim_invoice($tableName, $data, $where){
        $res = $this->db->update($tableName, $data, $where);
        return $res;
    }
    public function waktu($where){
        $data = $this->db->query('select tgl_invoice, deadline_akta from t_invoice '.$where);
        return $data->result_array();
    }

    public function report_invoice($awal, $akhir){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_lap_invoice','t_lap_invoice.no_invoice=t_invoice.no_invoice');
        $this->db->join('t_lap_sub_invoice','t_lap_sub_invoice.no_invoice=t_invoice.no_invoice');
        $this->db->where('t_invoice.tgl_invoice >=', $awal);
        $this->db->where('t_invoice.tgl_invoice <=', $akhir);
        $this->db->order_by('no_invoice desc');
        $query = $this->db->get();
        return $query;
     }
     public function laporan_invoice_all(){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_lap_invoice','t_lap_invoice.no_invoice=t_invoice.no_invoice');
        $this->db->join('t_lap_sub_invoice','t_lap_sub_invoice.no_invoice=t_invoice.no_invoice');
        $this->db->order_by('t_invoice.no_invoice desc');
        $query = $this->db->get();
        return $query;
     }
     public function total_invoice($no_invoice){
        $this->db->select("(SELECT SUM(biaya_lap_invoice) FROM t_lap_invoice WHERE id_invoice=$no_invoice && status=1) AS biaya_lap_invoice",FALSE);
        $query1 = $this->db->get('t_lap_invoice');
         if($query1->num_rows()>0){
            return $query1->row()->biaya_lap_invoice;
        }else{
            return 0;
        }
     }
     public function total_sub_invoice($no_invoice){
        $this->db->select("(SELECT SUM(biaya_lap_sub_invoice) FROM t_lap_sub_invoice WHERE id_invoice=$no_invoice) AS biaya_lap_sub_invoice",FALSE);
        $query2 = $this->db->get('t_lap_sub_invoice');
        if($query2->num_rows()>0){
            return $query2->row()->biaya_lap_sub_invoice;
        }else{
            return 0;
        }
     }

    public function view_by_month($awal, $akhir){
      $query= "SELECT p.tgl_invoice,p.no_invoice,p.jns_order1,p.nasabah, p.id_invoice, invoice.total_invoice, 
      sub_invoice.total_sub_invoice FROM t_invoice p 
               LEFT JOIN (SELECT id_invoice, 
                           SUM(biaya_lap_invoice) total_invoice 
                           FROM t_lap_invoice GROUP BY id_invoice) invoice 
                           ON p.id_invoice= invoice.id_invoice
               LEFT JOIN (SELECT id_invoice,
                           SUM(biaya_lap_sub_invoice) total_sub_invoice
                           FROM t_lap_sub_invoice GROUP BY id_invoice) sub_invoice
                           ON p.id_invoice=sub_invoice.id_invoice
                          WHERE MONTH(p.tgl_invoice) BETWEEN MONTH('$awal') AND MONTH('$akhir')";
                           
        $hasil = $this->db->query($query);
        return $hasil; 
    }
    public function view_by_month1($awal, $akhir){
        $query= "SELECT p.tgl_invoice,p.no_invoice,p.jns_order1,p.nasabah, p.id_invoice, invoice.total_invoice, 
        sub_invoice.total_sub_invoice FROM t_invoice p 
                 LEFT JOIN (SELECT id_invoice, 
                             SUM(biaya_lap_invoice) total_invoice 
                             FROM t_lap_invoice GROUP BY id_invoice) invoice 
                             ON p.id_invoice= invoice.id_invoice
                 LEFT JOIN (SELECT id_invoice,
                             SUM(biaya_lap_sub_invoice) total_sub_invoice
                             FROM t_lap_sub_invoice GROUP BY id_invoice) sub_invoice
                             ON p.id_invoice=sub_invoice.id_invoice
                            WHERE MONTH(p.tgl_invoice) BETWEEN MONTH('$awal') AND MONTH('$akhir')";
          $hasil = $this->db->query($query);
          return $hasil; 
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
 
    public function laporan_all(){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_pemasukan','t_pemasukan.id_invoice=t_invoice.id_invoice');
      
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
    public function list_pengeluaran(){
        $this->db->select('*');
        $this->db->from('t_list_pengeluaran');
        $this->db->order_by('id_list_pengeluaran','desc');
        return $this->db->get();
    }
    public function cetak_bukti($where){
        $this->db->select('*');
        $this->db->from('t_invoice');
        $this->db->join('t_user','t_user.id_user=t_invoice.id_user');
        // $this->db->join('t_order','t_order.id_order=t_invoice.id_order');
        $this->db->where('t_invoice.id_invoice ='.$where);
        $this->db->order_by('id_invoice desc');
        $query = $this->db->get();
        return $query;
     }

     public function laporan_keuangan(){
        $query= "SELECT p.tgl_invoice, COALESCE(invoice.total_invoice,0) AS total_invoice,
        COALESCE(sub_invoice.total_sub_invoice,0) AS total_sub_invoice, 
         COALESCE(invoice.total_pemasukan1,0) AS total_pemasukan_invoice, 
          COALESCE(sub_invoice.total_pemasukan2,0) AS total_pemasukan_sub_invoice, 
        SUM(COALESCE(invoice.total_invoice,0) + COALESCE(sub_invoice.total_sub_invoice,0)) AS pendapatan, 
        SUM(COALESCE(invoice.total_pemasukan1,0) + COALESCE(sub_invoice.total_pemasukan2,0)) AS pemasukan FROM t_invoice p 
        LEFT JOIN (SELECT tgl_pemasukan,
             SUM(biaya_lap_invoice) total_invoice,
             SUM(IF(status=1,biaya_lap_invoice,'0')) total_pemasukan1
             FROM t_lap_invoice GROUP BY MONTH(tgl_pemasukan)) invoice 
             ON MONTH(p.tgl_invoice)= MONTH(invoice.tgl_pemasukan)
        LEFT JOIN (SELECT tgl_pemasukan,
             SUM(biaya_lap_sub_invoice) total_sub_invoice,
             SUM(IF(status=1,biaya_lap_sub_invoice,'0')) total_pemasukan2
             FROM t_lap_sub_invoice GROUP BY MONTH(tgl_pemasukan)) sub_invoice
             ON p.tgl_invoice=sub_invoice.tgl_pemasukan
             GROUP BY MONTH(p.tgl_invoice)";
             $hasil = $this->db->query($query);
         return $hasil;
      }
      public function laporan_pendapatan_grafik_harian(){
        $query= "SELECT p.tgl_invoice, COALESCE(invoice.total_invoice,0) AS total_invoice,
        COALESCE(sub_invoice.total_sub_invoice,0) AS total_sub_invoice, 
         COALESCE(invoice.total_pemasukan1,0) AS total_pemasukan_invoice, 
          COALESCE(sub_invoice.total_pemasukan2,0) AS total_pemasukan_sub_invoice, 
        SUM(COALESCE(invoice.total_invoice,0) + COALESCE(sub_invoice.total_sub_invoice,0)) AS pendapatan, 
        SUM(COALESCE(invoice.total_pemasukan1,0) + COALESCE(sub_invoice.total_pemasukan2,0)) AS pemasukan FROM t_invoice p 
        LEFT JOIN (SELECT tgl_pemasukan,
             SUM(biaya_lap_invoice) total_invoice,
             SUM(IF(status=1,biaya_lap_invoice,'0')) total_pemasukan1
             FROM t_lap_invoice GROUP BY tgl_pemasukan) invoice 
             ON p.tgl_invoice= invoice.tgl_pemasukan
        LEFT JOIN (SELECT tgl_pemasukan,
             SUM(biaya_lap_sub_invoice) total_sub_invoice,
             SUM(IF(status=1,biaya_lap_sub_invoice,'0')) total_pemasukan2
             FROM t_lap_sub_invoice GROUP BY tgl_pemasukan) sub_invoice
             ON p.tgl_invoice=sub_invoice.tgl_pemasukan
             GROUP BY p.tgl_invoice";
             $hasil = $this->db->query($query);
         return $hasil;
      }
      public function laporan_pendapatan_grafik_perbulan(){
        $query= "SELECT p.tgl_invoice, COALESCE(invoice.total_invoice,0) AS total_invoice,
        COALESCE(sub_invoice.total_sub_invoice,0) AS total_sub_invoice, 
         COALESCE(invoice.total_pemasukan1,0) AS total_pemasukan_invoice, 
          COALESCE(sub_invoice.total_pemasukan2,0) AS total_pemasukan_sub_invoice, 
        SUM(COALESCE(invoice.total_invoice,0) + COALESCE(sub_invoice.total_sub_invoice,0)) AS pendapatan, 
        SUM(COALESCE(invoice.total_pemasukan1,0) + COALESCE(sub_invoice.total_pemasukan2,0)) AS pemasukan FROM t_invoice p 
        LEFT JOIN (SELECT tgl_pemasukan,
             SUM(biaya_lap_invoice) total_invoice,
             SUM(IF(status=1,biaya_lap_invoice,'0')) total_pemasukan1
             FROM t_lap_invoice GROUP BY MONTH(tgl_pemasukan)) invoice 
             ON MONTH(p.tgl_invoice)= MONTH(invoice.tgl_pemasukan)
        LEFT JOIN (SELECT tgl_pemasukan,
             SUM(biaya_lap_sub_invoice) total_sub_invoice,
             SUM(IF(status=1,biaya_lap_sub_invoice,'0')) total_pemasukan2
             FROM t_lap_sub_invoice GROUP BY MONTH(tgl_pemasukan)) sub_invoice
             ON p.tgl_invoice=sub_invoice.tgl_pemasukan
             GROUP BY MONTH(p.tgl_invoice)";
             $hasil = $this->db->query($query);
         return $hasil;
      }

      public function view_by_month_keuangan($awal, $akhir){
        $query= "SELECT p.tgl_invoice, COALESCE(invoice.total_invoice,0) AS total_invoice,
                COALESCE(sub_invoice.total_sub_invoice,0) AS total_sub_invoice, 
                COALESCE(invoice.total_pemasukan1,0) AS total_pemasukan_invoice, 
                COALESCE(sub_invoice.total_pemasukan2,0) AS total_pemasukan_sub_invoice, 
                SUM(COALESCE(invoice.total_invoice,0) + COALESCE(sub_invoice.total_sub_invoice,0)) AS pendapatan, 
                SUM(COALESCE(invoice.total_pemasukan1,0) + COALESCE(sub_invoice.total_pemasukan2,0)) AS pemasukan FROM t_invoice p 
            LEFT JOIN (SELECT tgl_pemasukan,
             SUM(biaya_lap_invoice) total_invoice,
             SUM(IF(status=1,biaya_lap_invoice,'0')) total_pemasukan1
             FROM t_lap_invoice GROUP BY MONTH(tgl_pemasukan)) invoice 
             ON MONTH(p.tgl_invoice)= MONTH(invoice.tgl_pemasukan)
             LEFT JOIN (SELECT tgl_pemasukan,
             SUM(biaya_lap_sub_invoice) total_sub_invoice,
             SUM(IF(status=1,biaya_lap_sub_invoice,'0')) total_pemasukan2
             FROM t_lap_sub_invoice GROUP BY MONTH(tgl_pemasukan)) sub_invoice
             ON p.tgl_invoice=sub_invoice.tgl_pemasukan
               WHERE MONTH(p.tgl_invoice) BETWEEN MONTH('$awal') AND MONTH('$akhir')
             GROUP BY MONTH(p.tgl_invoice)";
             $hasil = $this->db->query($query);
         return $hasil;
      }
   
   
}

