<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Naik_pangkat extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function datatable_list() {
        $cond = '';
        $masa_pangkat = $this->input->post('masa_pangkat');
        $user_view = $this->session->userdata('username');
        $lokasi = $this->input->post('lokasi');
        
        $nextYear = (strtotime("+ 1 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
        $next2Year = (strtotime("+ 2 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
        $next3Year = (strtotime("+ 3 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
        $arrSelection = array(
            $nextYear => '1 Tahun',
            $next2Year => '2 Tahun',
            $next3Year => '3 Tahun'
        );
        
        $now_year = date('Y');
        $arrYear = array();
        for ($i=$now_year; $i<($now_year+3); $i++) {
            $arrSelection[$i] = $i;
            $arrYear[$i] = $i;
        }
        
        if ($masa_pangkat != '' && $masa_pangkat != '0') {
            if (array_key_exists($masa_pangkat, $arrYear)) {
                $cond .= " and substr(date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year),1,4) = '".$masa_pangkat."'";
            }
            else {
                $cond .= " and (timestampdiff(day,now(),date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) > 0 AND timestampdiff(day,now(),date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) <= '".$masa_pangkat."')";
            }
        }

        $condLokasi = 'where 1=1';
        if ($lokasi != '' && $lokasi != '0') {
            $condLokasi .= " and b.lokasi_kerja = ".$lokasi;
        }

        if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
            $condLokasi .= ' and b.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
        }

        $q = "
                select c.*, 
                d.tanggal_sk, d.tanggal_mulai as tmt_pangkat_terakhir, 
                date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year) as tgl_naik_pangkat,
                if(DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 0 MONTH) >= CURRENT_DATE() AND DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 6 MONTH)<= CURRENT_DATE(),'1', '0') as kuning,
                substr(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),1,4) as tahun_naik_pangkat,
                timestampdiff(day,now(),date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) as masa_hari_naik_pangkat,
                e.golongan, e.uraian
            from 
            (
                select b.id_pegawai, b.nama_pegawai, b.nip, b.nrk,jml,
                        (
                            select a.id_riwayat_pangkat
                            from tbl_data_riwayat_pangkat a
                            where a.id_pegawai = b.id_pegawai ".$cond." 
                            order by date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year) desc 
                            limit 1
                        ) as id_pangkat
                from tbl_data_pegawai b 
                LEFT JOIN(
					SELECT count(*) as jml, user_view, nrk as nomor_rk
					FROM naik_pangkat_see WHERE user_view='$user_view'
					GROUP BY user_view, nrk
				) as see ON see.nomor_rk = b.nrk
                ".$condLokasi." 
            ) c 
            left join tbl_data_riwayat_pangkat d on d.id_riwayat_pangkat = c.id_pangkat 
            left join tbl_master_golongan e on e.id_golongan = d.id_golongan
            where c.id_pangkat is not null 
            order by kuning DESC, tgl_naik_pangkat ASC ";
        
		$rs = $this->db->query($q);

		echo json_encode($rs->result());
	}
}