<?php 
class Manage_jumlah_pegawai extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('i/modul_referensi/m_jumlah_pegawai','jp');
		$this->load->library('func_table');
		$this->load->library('upload');
	}

	public function index() {
		$a['unite1'] 		= $this->db->query("SELECT * from unite1")->result();
		$a['page'] = "i/modul_referensi/manage_jumlah_pegawai/index_jumlah_pegawai";
		$this->load->view('struktur/body',$a);
	}
	function filter() {
		$unite1 	= $this->input->post('unite1');
		$unite2 	= $this->input->post('unite2');
		//
		$a['unite1'] 		= $this->input->post('unite1');
		$a['unite2'] 		= $this->input->post('unite2');
		

		$this->load->view('modul_referensi/manage_jumlah_pegawai/ajax_table', $a);
	}

	public function table_jumlah_pegawai()
	{
		$unite1 	= $this->input->post('unite1');
		$unite2 	= $this->input->post('unite2');
		

		$listing 		= $this->jp->listing($unite1, $unite2);
		$jumlah_filter 	= $this->jp->jumlah_filter($unite1, $unite2);
		$jumlah_semua 	= $this->jp->jumlah_semua($unite1, $unite2);
		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			
			$no++;
			$row = array();	
			$adop = '<button type="button" class="btn btn-warning active btn-sm" onclick="edit_jp('."'".$key->Id."'".')"><i class="fa fa-edit"></i></button>';
			$row[] = $adop;
			$row[] = $key->E1Nama;
			$row[] = $key->E2Nama;
			$row[] = $key->E3Nama;
			$row[] = $key->Jumlah_pegawai;
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

	function form_jumlah_pegawai_edit() {
		$Id = $this->input->post('Id');
		$data_covid = $this->db->query("SELECT * FROM unite3 WHERE Id='$Id'" )->row();

		$a['Id'] 		= $this->input->post('Id');
		$a['data_covid'] 	= $data_covid;
		$this->load->view('i/modul_referensi/manage_jumlah_pegawai/form_jumlah_pegawai_edit', $a);
	}


	function update_jumlah_pegawai() {

		$Id = $this->input->post('Id');
		$Jumlah_pegawai = $this->input->post('Jumlah_pegawai');


		//$new_name = 'I_'.round(microtime(true));


		//$data['Ucode']=$new_name;
		$data['Jumlah_pegawai']=$Jumlah_pegawai;
		$this->db->where('Id', $Id);
		$this->db->update('unite3', $data);
		echo 'berhasil';

	}

}
?>