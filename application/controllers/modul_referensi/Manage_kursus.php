<?php 
class Manage_kursus extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		$a['page'] = "manage_kursus/index_manage_kursus"; //view
		$this->load->view('struktur/body',$a);
	}

}
?>