<?php 
class Manage_akses extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('modul_admin/m_manage_admin','adm');
	}

	public function index() {
		$a['page'] = "modul_admin/manage_admin/index_manage_admin";
		$this->load->view('struktur/body',$a);
	}
	function filter() {

		$group 			= $this->adm->get_group()->result();
		$data['group'] 	= $group;

		$this->load->view('modul_admin/manage_admin/ajax_table', $data, FALSE);
	}

	public function table_manage_admin()
	{

		$TipeAdmin 	= $this->input->post('TipeAdmin');
		$Eselon1 	= $this->input->post('Eselon1');
		$Eselon2 	= $this->input->post('Eselon2');

		$listing 		= $this->adm->listing($TipeAdmin);
		$jumlah_filter 	= $this->adm->jumlah_filter($TipeAdmin);
		$jumlah_semua 	= $this->adm->jumlah_filter($TipeAdmin);
		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			
			$no++;
			$row = array();	
			$drop = '<button type="button"  class="btn-danger btn-xs" onclick="delete_admin('."'".$key->Id."'".')"><i class="fa fa-trash-o"></i></button';
			$adop = '
			<button type="button" class="btn-warning btn-xs" onclick="edit_admin('."'".$key->Id."'".')"><i class="fa fa-edit"></i></button>'.$drop.'';

			$row[] = $adop;
			$row[] = $key->Namagroup;
			$row[] = $key->Nama_lengkap;
			$row[] = $key->username;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $jumlah_semua->jml,
						"recordsFiltered" => $jumlah_filter->jml,
						"data" => $data,
				);

		echo json_encode($output);
	}

	
	/**
		* @author Indra Prayoga
		* @license PT Nebula Solusi Informasi
		* @copyright 2021
	*/

	public function manage_admin_tambah()
	{
		$a['type'] 		= "tambah";
		$a['Group_user'] 	= $this->adm->get_group()->result();
		$this->load->view('modul_admin/manage_admin/form/form', $a);
	}
	
	public function manage_admin_save()
	{
		if($this->input->is_ajax_request()) {

			$Username 		= $this->input->post('Username');
			$Password 		= $this->input->post('Password');
			$Nama_lengkap 	= $this->input->post('Nama_lengkap');
			$Gid 			= $this->input->post('Gid');

			$cek_username = $this->adm->cek_username($Username)->num_rows();
			if($cek_username > 0) {
				$output['status'] = false;
				$output['keterangan'] = "Username sudah digunakan, silahkan ketik username yang lain";
			} else {
				$output['status'] = true;
				$output['keterangan'] = "Tambah Pengguna Berhasil";
				$data['Username'] 		= $Username;
				$data['Gid'] 			= $Gid;
				$data['Password'] 		= md5($Password);
				$data['Nama_lengkap'] 	= $Nama_lengkap;

				$this->db->insert('tb_user', $data);
			}

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
	}

	public function manage_admin_edit()
	{
		$Id = $this->input->post('Id');

		$a['Id'] 			= $Id;
		$a['type'] 			= "edit";
		$a['Group_user'] 		= $this->adm->get_group()->result();
		$a['data_admin'] 	= $this->adm->get_admin($Id)->row();
		$this->load->view('modul_admin/manage_admin/form/form', $a);
	}
	public function manage_admin_update()
	{
		if($this->input->is_ajax_request()) {

			$Uid 			= $this->input->post('id');
			$Password 		= $this->input->post('Password');
			$Nama_lengkap 	= $this->input->post('Nama_lengkap');
			$Gid 			= $this->input->post('Gid');
			$data['Gid'] 			= $Gid;
			
			if(!empty($Password)) {
				$data['Password'] 		= md5($Password);
			}
			$data['Nama_lengkap'] 	= $Nama_lengkap;
			$this->db->update('tb_user', $data, ['Id' => $Id]);
		}
			
	}

	public function manage_admin_delete(){
		$Id = $this->input->post('Id');
		$this->db->delete('tb_user', ['Id' => $Id]);
		echo 'Data Berhasil Dihapus';
	}

}
?>