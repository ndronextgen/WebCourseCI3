<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_skp_dp3 extends CI_Controller {

	public function edit()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$a['instansi'] = $this->config->item('nama_instansi');
			$a['credit'] = $this->config->item('credit_aplikasi');
			$a['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_dp3'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_dp3",$id);
			$d = array();
			foreach($q->result() as $dt)
			{				
				$d['id_param'] = $dt->id_dp3;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['uraian'] = $dt->uraian; 
				$d['tahun'] = $dt->tahun; 
				$d['orientasi'] = $dt->orientasi; 
				$d['integritas'] = $dt->integritas; 
				$d['komitmen'] = $dt->komitmen;
				$d['disiplin'] = $dt->disiplin; 
				$d['kesetiaan'] = $dt->kesetiaan; 
				$d['prestasi'] = $dt->prestasi; 
				$d['tanggung_jawab'] = $dt->tanggung_jawab; 
				$d['ketaatan'] = $dt->ketaatan;
				$d['kejujuran'] = $dt->kejujuran; 
				$d['kerjasama'] = $dt->kerjasama; 
				$d['prakarsa'] = $dt->prakarsa; 
				$d['kepemimpinan'] = $dt->kepemimpinan; 
				$d['rata_rata'] = $dt->rata_rata;
				$d['atasan'] = $dt->atasan; 
				$d['penilai'] = $dt->penilai;
			}
			$d['st'] = "edit";
			$this->load->view('dashboard_admin/master/header',$a);
			$this->load->view('dashboard_admin/master/data_skp/input',$d);
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
			$d['uraian'] = "";
			$d['tahun'] = "";
			$d['orientasi'] = "";
			$d['integritas'] = "";
			$d['komitmen'] = "";
			$d['disiplin'] = "";
			$d['kesetiaan'] = "";
			$d['prestasi'] = "";
			$d['tanggung_jawab'] = "";
			$d['ketaatan'] = "";
			$d['kejujuran'] = "";
			$d['kerjasama'] = "";
			$d['prakarsa'] = "";
			$d['kepemimpinan'] = "";
			$d['rata_rata'] = "";
			$d['atasan'] = "";
			$d['penilai'] = "";
			
			$d['st'] = "tambah";
			$this->load->view('dashboard_admin/master/header',$d);
			$this->load->view('dashboard_admin/master/data_skp/input',$d);
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
			$id['id_dp3'] = $this->uri->segment(4);
			$this->db->delete("tbl_data_dp3",$id);
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
			$this->form_validation->set_rules('dp3', 'Gaji Pokok', 'trim|required');
			$this->form_validation->set_rules('tanggal_mulai', 'TMT', 'trim|required');
			
			$id['id_dp3'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$q = $this->db->get_where("tbl_data_dp3",$id);
					$d = array();
					foreach($q->result() as $dt)
					{
						$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
						$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
						$a['instansi'] = $this->config->item('nama_instansi');
						$a['credit'] = $this->config->item('credit_aplikasi');
						$a['alamat'] = $this->config->item('alamat_instansi');
					
						$d['id_param'] = $dt->id_dp3;
						$d['id_pegawai'] = $dt->id_pegawai; 
						$d['id_golongan'] = $dt->id_golongan; 
						$d['nomor_sk'] = $dt->nomor_sk; 
						$d['tanggal_sk'] = $dt->tanggal_sk;  
						$d['dp3'] = $dt->tanggal_sk; 
						$d['tanggal_mulai'] = $dt->tanggal_mulai;    
					}
					$d['st'] = $st;
					$d['golongan'] = $this->db->get("tbl_master_golongan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_dp3/input',$d);
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
					$d['dp3'] = "";
					$d['tanggal_mulai'] = "";
					$d['st'] = $st;
					$d['golongan'] = $this->db->get("tbl_master_golongan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_dp3/input',$d);
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
					$upd['dp3'] = $this->input->post("dp3");
					$upd['tanggal_mulai'] = $this->input->post("tanggal_mulai");
					
					
					$this->db->update("tbl_data_dp3",$upd,$id);
					$this->session->set_flashdata('sukseseditgaji', 'Data Riwayat Gaji Pokok Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-gaji');
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] = $this->input->post("id_pegawai");
					$in['id_golongan'] = $this->input->post("id_golongan");
					$in['nomor_sk'] = $this->input->post("nomor_sk");
					$in['tanggal_sk'] = $this->input->post("tanggal_sk");
					$in['dp3'] = $this->input->post("dp3");
					$in['tanggal_mulai'] = $this->input->post("tanggal_mulai");
					
					$this->db->insert("tbl_data_dp3",$in);
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

/* End of file data_dp3.php */
/* Location: ./application/controllers/data_dp3.php */