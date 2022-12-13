<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masa_pensiun extends CI_Controller {

	/*
		***	Controller : datatable_pegawai.php
	*/

	public function __construct()
    {
        parent::__construct();
		
	}
	
	public function datatable_list() {
		$masa_pensiun = $this->input->post('masa_pensiun');
		$user_view = $this->session->userdata('username');
		$cond = '';
		if ($masa_pensiun != '0') {
			if ($masa_pensiun > 3) {
				$cond .= " and substring(a.tgl_pensiun,1,4) = '".$masa_pensiun."'";
			}
			else {
				$cond .= ' and a.masa_pensiun = '.$masa_pensiun;
			}
		}

		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}
		
		$q = "
			select a.* from (
				select id_pegawai, nip, nrk, nama_pegawai, tanggal_lahir as str_tgl_lahir, jml,
						str_to_date(substring(nip,1,8), '%Y%m%d') as date_tgl_lahir,
						id_jabatan, timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) as usia, 
						if (id_jabatan = 2351, ((58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now())) * 1), 
							((58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) * 1))
						) as masa_pensiun,
						if (id_jabatan = 2351, 
							(timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))), 
							(timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))) 
						) as masa_pensiun_bln,
						if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
							(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
						) as tgl_pensiun,
						
						DATE_SUB(
							if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
								(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
							)
							, INTERVAL 6 MONTH) as warning_6b,
						if(DATE_SUB(
							if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
								(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
							)
							, INTERVAL 6 MONTH) <= CURRENT_DATE(),'1', '0') as kuning,

							DATE_SUB(
								if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
									(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
								)
								, INTERVAL 12 MONTH) as warning_12b,
							if(DATE_SUB(
								if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
									(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
								)
								, INTERVAL 12 MONTH) <= CURRENT_DATE(),'1', '0') as kuning12,
						lokasi_kerja 
				from tbl_data_pegawai
				LEFT JOIN(
					SELECT count(*) as jml, user_view, nrk as nomor_rk
					FROM masa_pensiun_see WHERE user_view='$user_view'
					GROUP BY user_view, nrk
				) as see ON see.nomor_rk = tbl_data_pegawai.nrk
				) a 
				where a.masa_pensiun > 0 $cond 
				order by a.tgl_pensiun asc
		";
		
		$rs = $this->db->query($q);

		echo json_encode($rs->result());
	}
}

/* End of file dashboard_admin.php */
/* Location: ./application/api/datatable_pegawai.php */