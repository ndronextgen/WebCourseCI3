<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Gaji_Pokok extends CI_Controller {

	public function edit()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$a['instansi'] = $this->config->item('nama_instansi');
			$a['credit'] = $this->config->item('credit_aplikasi');
			$a['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_gaji_pokok'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_gaji_pokok",$id);
			$d = array();
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_gaji_pokok;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['id_golongan'] = $dt->id_golongan; 
				$d['nomor_sk'] = $dt->nomor_sk; 
				$d['tanggal_sk'] = $dt->tanggal_sk; 
				$d['gaji_pokok'] = $dt->gaji_pokok; 
				$d['tanggal_mulai'] = $dt->tanggal_mulai;
			}
			$d['st'] = "edit";
			$d['golongan'] = $this->db->get("tbl_master_golongan");
			$this->load->view('master/header',$a);
			$this->load->view('dashboard_admin/master/data_gaji_pokok/input',$d);
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
			$d['id_golongan'] = "";
			$d['nomor_sk'] = "";
			$d['tanggal_sk'] = "";
			$d['gaji_pokok'] = "";
			$d['tanggal_mulai'] = "";
			
			$d['st'] = "tambah";
			$d['golongan'] = $this->db->get("tbl_master_golongan");
			$this->load->view('master/header',$d);
			$this->load->view('dashboard_admin/master/data_gaji_pokok/input',$d);
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
			$id['id_gaji_pokok'] = $this->uri->segment(4);
			$this->db->delete("tbl_data_gaji_pokok",$id);
			$this->session->set_flashdata('suksehapusgaji', 'Data Gaji Pokok Berhasil Di Hapus...');
			redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-gaji');
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
			$this->form_validation->set_rules('id_golongan', 'Golongan', 'trim|required');
			$this->form_validation->set_rules('nomor_sk', 'Nomor SK', 'trim|required');
			$this->form_validation->set_rules('tanggal_sk', 'Tanggal SK', 'trim|required');
			$this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'trim|required');
			$this->form_validation->set_rules('tanggal_mulai', 'TMT', 'trim|required');
			
			$id['id_gaji_pokok'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$q = $this->db->get_where("tbl_data_gaji_pokok",$id);
					$d = array();
					foreach($q->result() as $dt)
					{
						$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
						$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
						$a['instansi'] = $this->config->item('nama_instansi');
						$a['credit'] = $this->config->item('credit_aplikasi');
						$a['alamat'] = $this->config->item('alamat_instansi');
					
						$d['id_param'] = $dt->id_gaji_pokok;
						$d['id_pegawai'] = $dt->id_pegawai; 
						$d['id_golongan'] = $dt->id_golongan; 
						$d['nomor_sk'] = $dt->nomor_sk; 
						$d['tanggal_sk'] = $dt->tanggal_sk;  
						$d['gaji_pokok'] = $dt->tanggal_sk; 
						$d['tanggal_mulai'] = $dt->tanggal_mulai;    
					}
					$d['st'] = $st;
					$d['golongan'] = $this->db->get("tbl_master_golongan");
					$this->load->view('master/header',$a);
					$this->load->view('dashboard_admin/master/data_gaji_pokok/input',$d);
				}
				else if($st=="tambah")
				{
					$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
					$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
					$a['instansi'] = $this->config->item('nama_instansi');
					$a['credit'] = $this->config->item('credit_aplikasi');
					$a['alamat'] = $this->config->item('alamat_instansi');
					
					$d['id_param'] = "";
					$d['id_pegawai'] = $this->session->userdata("kode_pegawai");
					$d['id_golongan'] = "";
					$d['nomor_sk'] = "";
					$d['tanggal_sk'] = "";
					$d['gaji_pokok'] = "";
					$d['tanggal_mulai'] = "";
					$d['st'] = $st;
					$d['golongan'] = $this->db->get("tbl_master_golongan");
					$this->load->view('master/header',$a);
					$this->load->view('dashboard_admin/master/data_gaji_pokok/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['id_pegawai'] = $this->input->post("id_pegawai");
					$upd['id_golongan'] = $this->input->post("id_golongan");
					$upd['nomor_sk'] = $this->input->post("nomor_sk");
					$upd['tanggal_sk'] = $this->input->post("tanggal_sk");
					$upd['gaji_pokok'] = $this->input->post("gaji_pokok");
					$upd['tanggal_mulai'] = $this->input->post("tanggal_mulai");
					
					
					$this->db->update("tbl_data_gaji_pokok",$upd,$id);
					$this->session->set_flashdata('sukseseditgaji', 'Data Riwayat Gaji Pokok Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-gaji');
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] = $this->input->post("id_pegawai");
					$in['id_golongan'] = $this->input->post("id_golongan");
					$in['nomor_sk'] = $this->input->post("nomor_sk");
					$in['tanggal_sk'] = $this->input->post("tanggal_sk");
					$in['gaji_pokok'] = $this->input->post("gaji_pokok");
					$in['tanggal_mulai'] = $this->input->post("tanggal_mulai");
					
					$this->db->insert("tbl_data_gaji_pokok",$in);
					$this->session->set_flashdata('suksesgaji', 'Data Riwayat Gaji Pokok Berhasil Di Tambah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-gaji');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file data_gaji_pokok.php */
/* Location: ./application/controllers/data_gaji_pokok.php */