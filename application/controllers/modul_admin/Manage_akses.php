<?php 
class Manage_akses extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		$a['page'] = "modul_admin/manage_akses/index_manage_akses";
		$this->load->view('struktur/body',$a);
	}
	

}
?>