<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wilayah extends CI_Controller {

	/*
		***	Controller : pegawai.php
	*/
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('wilayah_model');
        $this->load->helper('url');    /***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('file');
	}
	
	public function get_provinsi_data(){
		$kode_provinsi=$this->input->post('kode_provinsi');
		$data=$this->wilayah_model->data_provinsi($kode_provinsi);
		
		echo json_encode($data);
	}
	
	public function gen_dropdown_kabupaten(){
		$kode_provinsi=$this->input->post('kode_provinsi');
		$data=$this->wilayah_model->kabupaten_list($kode_provinsi);
		
		echo $data;
	}
	
	public function get_kabupaten_data(){
		$kode_kabupaten=$this->input->post('kode_kabupaten');
		$data=$this->wilayah_model->data_kabupaten($kode_kabupaten);
		
		echo json_encode($data);
	}
	
	public function gen_dropdown_kecamatan(){
		$kode_kabupaten=$this->input->post('kode_kabupaten');
		$nama_kecamatan=$this->input->post('nama_kecamatan');
		$data=$this->wilayah_model->kecamatan_list($kode_kabupaten, $nama_kecamatan);
		
		echo $data;
	}
	
	public function get_kecamatan_data(){
		$kode_kecamatan=$this->input->post('kode_kecamatan');
		$data=$this->wilayah_model->data_kecamatan($kode_kecamatan);
		
		echo json_encode($data);
	}
	
	public function gen_dropdown_kelurahan(){
		$kode_kecamatan=$this->input->post('kode_kecamatan');
		$nama_kelurahan=$this->input->post('nama_kelurahan');
		$data=$this->wilayah_model->kelurahan_list($kode_kecamatan, $nama_kelurahan);
		
		echo $data;
	}

	public function get_kelurahan_data(){
		$kode_kelurahan=$this->input->post('kode_kelurahan');
		$data=$this->wilayah_model->data_kelurahan($kode_kelurahan);
		
		echo json_encode($data);
	}
}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */