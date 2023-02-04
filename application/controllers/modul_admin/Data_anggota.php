<?php 
class Data_anggota extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		$a['page'] = "modul_admin/data_anggota/index_data_anggota";
		$this->load->view('struktur/body',$a);
	}
	

}
?>