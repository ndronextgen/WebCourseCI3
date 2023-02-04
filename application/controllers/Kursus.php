<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kursus extends CI_Controller {
	public function index()
	{
        $a['page'] = "kursus/index_kursus"; //view
		$this->load->view('struktur/body',$a);
	}
}
