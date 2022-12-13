<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Penghargaan extends CI_Controller {

	/*
		***	Controller : data_penghargaan.php
	*/

	public function edit()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$a['instansi'] = $this->config->item('nama_instansi');
			$a['credit'] = $this->config->item('credit_aplikasi');
			$a['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_penghargaan'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_penghargaan",$id);
			$d = array();
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_penghargaan;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['id_master_penghargaan'] = $dt->id_master_penghargaan; 
				$d['pemberi_penghargaan'] = $dt->pemberi_penghargaan;
				$d['uraian'] = $dt->uraian; 
				$d['nomor_sk'] = $dt->nomor_sk; 
				$d['tgl_sk_penghargaan'] = $dt->tgl_sk_penghargaan; 
			}
			$d['st'] = "edit";
			$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
			$this->load->view('dashboard_admin/master/header',$a);
			$this->load->view('dashboard_admin/master/data_penghargaan/input',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
	public function tambah()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			
			$d['id_param'] = "";
			$d['id_pegawai'] = $this->uri->segment(4);
			$d['id_master_penghargaan'] = "";
			$d['pemberi_penghargaan'] = "";
			$d['uraian'] = "";
			$d['nomor_sk'] = "";
			$d['tgl_sk_penghargaan'] = "";
			
			$d['st'] = "tambah";
			$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
			$this->load->view('dashboard_admin/master/header',$d);
			$this->load->view('dashboard_admin/master/data_penghargaan/input',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function hapus()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$id['id_penghargaan'] = $this->uri->segment(4);
			$this->db->delete("tbl_data_penghargaan",$id);
			$this->session->set_flashdata('suksehapuspenghargaan', 'Data Penghargaan Berhasil Di Hapus...');
			redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-penghargaan');
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function simpan()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$this->form_validation->set_rules('id_master_penghargaan', 'Nama Penghargaan', 'trim|required');
			$this->form_validation->set_rules('pemberi_penghargaan', 'Pemberi Penghargaan', 'trim|required');
			$this->form_validation->set_rules('nomor_sk', 'Nomor SK', 'trim|required');
			$this->form_validation->set_rules('tgl_sk_penghargaan', 'Tanggal SK', 'trim|required');
			
			$id['id_penghargaan'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
					$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
					$a['instansi'] = $this->config->item('nama_instansi');
					$a['credit'] = $this->config->item('credit_aplikasi');
					$a['alamat'] = $this->config->item('alamat_instansi');
			
					$q = $this->db->get_where("tbl_data_penghargaan",$id);
					$d = array();
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_penghargaan;
						$d['id_pegawai'] = $dt->id_pegawai;
						$d['id_master_penghargaan'] = $dt->id_master_penghargaan;
						$d['pemberi_penghargaan'] = $dt->pemberi_penghargaan;
						$d['uraian'] = $dt->uraian;
						$d['nomor_sk'] = $dt->nomor_sk;
						$d['tgl_sk_penghargaan'] = $dt->tgl_sk_penghargaan;
					}
					$d['st'] = $st;
					$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_penghargaan/input',$d);
				}
				else if($st=="tambah")
				{
					$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
					$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
					$a['instansi'] = $this->config->item('nama_instansi');
					$a['credit'] = $this->config->item('credit_aplikasi');
					$a['alamat'] = $this->config->item('alamat_instansi');
			
					$d['id_param'] = "";
					$d['id_pegawai'] =  $this->session->userdata("kode_pegawai");
					$d['id_master_penghargaan'] = "";
					$d['pemberi_penghargaan'] = "";
					$d['uraian'] = "";
					$d['nomor_sk'] = "";
					$d['tgl_sk_penghargaan'] = "";
			
					$d['st'] = $st;
					$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_penghargaan/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['id_pegawai'] =  $this->input->post("id_pegawai");
					$upd['id_master_penghargaan'] = $this->input->post("id_master_penghargaan");
					$upd['pemberi_penghargaan'] = $this->input->post("pemberi_penghargaan");
					$upd['uraian'] = $this->input->post("uraian");
					$upd['nomor_sk'] = $this->input->post("nomor_sk");
					$upd['tgl_sk_penghargaan'] = $this->input->post("tgl_sk_penghargaan");
					
					$this->db->update("tbl_data_penghargaan",$upd,$id);
					$this->session->set_flashdata('sukseseditpenghargaan', 'Data Penghargaan Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-penghargaan');
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] =  $this->input->post("id_pegawai");
					$in['id_master_penghargaan'] = $this->input->post("id_master_penghargaan");
					$in['pemberi_penghargaan'] = $this->input->post("pemberi_penghargaan");
					$in['uraian'] = $this->input->post("uraian");
					$in['nomor_sk'] = $this->input->post("nomor_sk");
					$in['tgl_sk_penghargaan'] = $this->input->post("tgl_sk_penghargaan");
					
					$this->db->insert("tbl_data_penghargaan",$in);
					$this->session->set_flashdata('suksespenghargaan', 'Data Penghargaan Berhasil Di Tambah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-penghargaan');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file data_penghargaan.php */
/* Location: ./application/controllers/data_penghargaan.php */