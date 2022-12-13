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

		$fileContents = file_get_contents(base_url('asset/upload/manual_book/Manual_Book_SIADIK_Publik_19102022.pdf')); 
		$file='Manual_Book_SIADIK_Publik_19102022.pdf';//nama_file
		force_download($file, $fileContents);
	}

	public function madmin() 
	{

		$fileContents = file_get_contents(base_url('asset/upload/manual_book/Manual_Book_SIADIK_Admin_230522.pdf')); 
		$file='Manual_Book_SIADIK_Admin_230522.pdf';//nama_file
		force_download($file, $fileContents);
	}
}

/* End of file dashboard_admin.php */
/* Location: ./application/controllers/dashboard_admin.php */