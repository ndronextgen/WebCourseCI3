<?php 
class Golongan_darah extends CI_Controller{

	public function __construct(){
		parent::__construct();
		//$this->load->model('i/modul_referensi/m_golongan_darah','adm');
		$this->load->library('func_table');
		$this->load->library('upload');
	}

	public function index() {
		$a['gol'] 		= $this->db->query("SELECT * from master_golongandarah")->result();
		$a['page'] = "i/modul_referensi/golongan_darah/index_golongan_darah";
		$this->load->view('struktur/body',$a);
	}
	function filter() {
		$unite1 	= $this->input->post('unite1');
		$unite2 	= $this->input->post('unite2');
		$unite3 	= $this->input->post('unite3');
		$kd_prop 	= $this->input->post('kd_prop');
		$kd_kab 	= $this->input->post('kd_kab');
		$kd_kec 	= $this->input->post('kd_kec');
		//
		$a['unite1'] 		= $this->input->post('unite1');
		$a['unite2'] 		= $this->input->post('unite2');
		$a['unite3'] 		= $this->input->post('unite3');
		$a['kd_prop'] 		= $this->input->post('kd_prop');
		$a['kd_kab'] 		= $this->input->post('kd_kab');
		$a['kd_kec'] 		= $this->input->post('kd_kec');
		

		$this->load->view('modul_referensi/golongan_darah/ajax_table', $a);
	}

	public function table_golongan_darah()
	{
		$unite1 	= $this->input->post('unite1');
		$unite2 	= $this->input->post('unite2');
		$unite3 	= $this->input->post('unite3');
		$kd_prop 	= $this->input->post('kd_prop');
		$kd_kab 	= $this->input->post('kd_kab');
		$kd_kec 	= $this->input->post('kd_kec');
		

		$listing 		= $this->adm->listing($unite1, $unite2, $unite3,$kd_prop, $kd_kab, $kd_kec);
		$jumlah_filter 	= $this->adm->jumlah_filter($unite1, $unite2, $unite3,$kd_prop, $kd_kab, $kd_kec);
		$jumlah_semua 	= $this->adm->jumlah_semua($unite1, $unite2, $unite3,$kd_prop, $kd_kab, $kd_kec);
		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			
			$no++;
			$row = array();	
			$jml_c = $this->func_table->get_jml_catatan($key->Ucode);
			$drop = '<button type="button" class="btn btn-danger active btn-sm" onclick="delete_data('."'".$key->Id."'".')"><i class="fa fa-trash-o"></i></button';
			$adop = '
			<button type="button" class="btn btn-warning active btn-sm" onclick="edit_data('."'".$key->Id."'".')"><i class="fa fa-edit"></i></button>'.$drop.'';
			$catatan = '<button type="button" class="btn btn-default active btn-sm" onclick="getcatatan('."'".$key->Ucode."'".')"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;'.$jml_c.'</button';
			

			$row[] = $adop;
			$row[] = $catatan;
			$row[] = $key->NamaPegawai;
			$row[] = $key->NIP;
			$row[] = $key->Jabatan;
			$row[] = date("d/m/Y", strtotime($key->Lahir_tgl)).'/'.$key->JenisKelamin;
			$row[] = $key->Nilai_ct;
			$row[] = '<span style="color:red;">'.$key->Unite1.'</span> /'.'<span style="color:red;">'.$key->Unite2.'</span> /'.'<span style="color:blue;">'.$key->Unite3.'</span> /'.'<span style="color:green;">'.$key->Unite4.'</span>';
			$row[] = $key->JenisKasus;
			//$row[] = $key->Konfirmasi_gejala;
			$row[] = $key->JenisPerawatan;
			$row[] = $key->Kronologis;
			$row[] = $key->StatusKondisi;
			$row[] = $key->NamaPegawai2;
			$row[] = $key->NIP2;
			$row[] = $key->Jabatan2;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $jumlah_semua->jml,
						"recordsFiltered" => $jumlah_filter->jml,
						"data" => $data,
				);

		echo json_encode($output);
	}


	

}
?>