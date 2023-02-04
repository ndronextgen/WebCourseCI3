<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
        $a['page'] = "dashboard/index_dashboard"; //view
		$this->load->view('struktur/body',$a);
	}
}
