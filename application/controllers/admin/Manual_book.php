<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manual_book extends CI_Controller {

	/*
		***	Controller : dashboard_admin.php
	*/

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('url','download'));
		
	}

	public function mpublic() 
	{

		$fileContents = file_get_contents(base_url('asset/upload/manual_book/manual_book_siadik_publik_2022.10.22.pdf')); 
		$file= 'Manual Book SI-ADiK Publik 2022.10.22.pdf';//nama_file
		force_download($file, $fileContents);
	}

	public function madmin() 
	{

		$fileContents = file_get_contents(base_url('asset/upload/manual_book/manual_book_siadik_admin_2022.05.23.pdf')); 
		$file= 'Manual Book SI-ADiK Admin 2022.05.23.pdf';//nama_file
		force_download($file, $fileContents);
	}
}

/* End of file dashboard_admin.php */
/* Location: ./application/controllers/dashboard_admin.php */