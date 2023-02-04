<?php 
class Manage_kehadiran extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('i/modul_referensi/m_kehadiran','jp');
		$this->load->library('func_table');
		$this->load->library('func_api');
		$this->load->library('upload');
	}

	public function index() {
		$a['unite1'] 		= $this->db->query("SELECT * from unite1")->result();
		$a['page'] = "i/modul_referensi/manage_kehadiran/index_kehadiran";
		$this->load->view('struktur/body',$a);
	}
	function filter() {
		$unite1 	= $this->input->post('unite1');
		$unite2 	= $this->input->post('unite2');
		$Tanggal 	= $this->input->post('Tanggal');
		//
		$a['unite1'] 		= $this->input->post('unite1');
		$a['unite2'] 		= $this->input->post('unite2');
		$a['Tanggal'] 		= $this->input->post('Tanggal');
		

		$this->load->view('modul_referensi/manage_kehadiran/ajax_table', $a);
	}

	public function table_kehadiran()
	{
		$unite1 	= $this->input->post('unite1');
		$unite2 	= $this->input->post('unite2');
		$Tanggal 	= $this->input->post('Tanggal');
		

		$listing 		= $this->jp->listing($unite1, $unite2, $Tanggal);
		$jumlah_filter 	= $this->jp->jumlah_filter($unite1, $unite2, $Tanggal);
		$jumlah_semua 	= $this->jp->jumlah_semua($unite1, $unite2, $Tanggal);
		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			
			$no++;
			$row = array();	
			if($this->session->userdata('ses_Gid') == 3) {
				$adop = '<button type="button" class="btn btn-warning btn-sm" onclick="edit_jp('."'".$key->Id."'".')"><i class="fa fa-edit"></i></button>';
			} else {

				$adop = 'x';

			}

			if($this->session->userdata('ses_Gid') == 3) {

				$sinc = '<div id="'.$key->Id.'" style="float:left;padding:5px;"></div>
				<button type="button" class="btn btn-danger btn-sm" id="'.$key->Id.'" onclick="sinc('."'".$key->Id."'".', '."'".$key->Unite1."'".', '."'".$key->Unite2."'".', '."'".$key->Tanggal."'".')"><i class="fa fa-refresh"></i></button>';
			} else {

				$sinc = 'x';

			}
			$adop2 = '<button type="button" class="btn btn-warning btn-sm" onclick="edit_jp('."'".$key->Id."'".')"><i class="fa fa-edit"></i></button>';
			$sinc2 = '<div id="'.$key->Id.'" style="float:left;padding:5px;"></div>
				<button type="button" class="btn btn-danger btn-sm" id="'.$key->Id.'" onclick="sinc('."'".$key->Id."'".', '."'".$key->Unite1."'".', '."'".$key->Unite2."'".', '."'".$key->Tanggal."'".')"><i class="fa fa-refresh"></i></button>';
			$row[] = $adop2;
			$row[] = $sinc2;
			$row[] = $key->Unite1;
			$row[] = $key->Unite2;
			$row[] = $key->jml_hadir;
			$row[] = $key->Wfh;
			$row[] = $key->Wfo_s1;
			$row[] = $key->Wfo_s2;
			$row[] = $key->Perjadin;
			
			$row[] = $key->jml_lainnya;
			$row[] = $key->Tanggal;
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

	function form_kehadiran_edit() {
		$Id = $this->input->post('Id');
		$data_jdw = $this->db->query("SELECT * FROM tbl_jadwal WHERE Id='$Id'" )->row();

		$a['Id'] 		= $this->input->post('Id');
		$a['data_jdw'] 	= $data_jdw;
		$this->load->view('i/modul_referensi/manage_kehadiran/form_kehadiran_edit', $a);
	}

	function update_kehadiran() {

		$Id = $this->input->post('Id');
		$jml_hadir = $this->input->post('jml_hadir');
		$Wfh = $this->input->post('Wfh');
		$Perjadin = $this->input->post('Perjadin');
		$Wfo_s1 = $this->input->post('Wfo_s1');
		$Wfo_s2 = $this->input->post('Wfo_s2');
		$jml_lainnya = $this->input->post('jml_lainnya');

		$data['jml_hadir'] = $jml_hadir;
		$data['Wfh'] = $Wfh;
		$data['Perjadin'] = $Perjadin;
		$data['Wfo_s1'] = $Wfo_s1;
		$data['Wfo_s2'] = $Wfo_s2;
		$data['jml_lainnya'] = $jml_lainnya;

		$this->db->where('Id', $Id);
		$this->db->update('tbl_jadwal', $data);
		echo 'berhasil';

	}

	function get_data_unite2_harian()
	{
		
		$Unite1 = $this->input->POST('Unite1');
		$Unite2 = $this->input->POST('Unite2');
		$Tanggal = $this->input->POST('Tanggal');

		$str_unite2 = str_replace(' ', '%20', $Unite2);

		$get_url=$this->func_api->get_api_url_jadwal_e2($Unite1, $Unite2);
		$cont_api = 'Data_jadwal/unite2_harian?tgl='.$Tanggal.'&unite2='.$str_unite2;
		$url = $get_url.$cont_api;
		$get_http_response_code = $this->func_api->get_http_response_code($url);
		if ( $get_http_response_code == 200 ) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		  
			$server_output = curl_exec ($ch);
			curl_close ($ch);
		} else {
			$server_output = '';
		}

		if($server_output==''){
			$output = '[
							{
								"Unite2": "-",
								"Tanggal": "-",
								"jml_hadir": "-",
								"jml_hadir_wfh": "-",
								"jml_hadir_wfo_shift1": "-",
								"jml_hadir_wfo_shift2": "-",
								"jml_perjadin": "-",
								"ttl_peg": "-"
							}
						]';
		} else {
			$output = $server_output;
		}
		
		//echo $url;
		$data = json_decode($output, true);
		for ($row = 0; $row <= count($data)-1; $row++) {
			$rows['ttl_peg'] = $data[$row]['ttl_peg'];
			$rows['jml_hadir'] = $data[$row]['jml_hadir'];
			$rows['Wfh'] = $data[$row]['jml_hadir_wfh'];
			$rows['Wfo_s1'] = $data[$row]['jml_hadir_wfo_shift1'];
			$rows['Wfo_s2'] = $data[$row]['jml_hadir_wfo_shift2'];
			$rows['Perjadin'] = $data[$row]['jml_perjadin'];
			$rows['jml_lainnya'] = $data[$row]['jml_non_hadir'];
			$this->db->where('Unite1', $Unite1);
			$this->db->where('Unite2', $data[$row]['Unite2']);
			$this->db->where('Tanggal', $Tanggal);
			$this->db->update('tbl_jadwal', $rows);

		}
		// echo count($data);
		//echo count($output);

		//echo $output[0]['Unite2'];
		// foreach($output as $key){
		
		// }
		

		
		
		//print_r($output);
		
	}

}
?>