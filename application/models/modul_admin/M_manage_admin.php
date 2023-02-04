<?php
	
	class M_manage_admin extends CI_Model {

		function listing($TipeAdmin) {

			if(!empty($TipeAdmin)) {
				$TipeAdmin = "AND tb_user.Gid = '{$TipeAdmin}' ";
			} else {
				$TipeAdmin = "";
			}

			
			$number = $_POST['length'];
			$offset = $_POST['start'];
		
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (tb_user.Nama_lengkap LIKE '%$search%' OR mt_usergroup.Namagroup LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}

			$query = "SELECT
						tb_user.Id,
						tb_user.Gid,
						tb_user.username,
						tb_user.`password`,
						tb_user.Nama_lengkap,
						mt_usergroup.Namagroup
						FROM
						tb_user
						INNER JOIN mt_usergroup ON tb_user.Gid = mt_usergroup.Gid
						WHERE tb_user.Id != '' $TipeAdmin $k_search order by tb_user.Id desc
						limit $offset, $number";

			if($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
			return $query;	
		}

		function jumlah_semua() {
			$sQuery = "SELECT COUNT(Id) as jml FROM tb_user where Id != ''";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}

		function jumlah_filter($TipeAdmin) {

			if(!empty($TipeAdmin)) {
				$TipeAdmin = "AND tb_user.Gid = '{$TipeAdmin}' ";
			} else {
				$TipeAdmin = "";
			}

			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (tb_user.Nama_lengkap LIKE '%$search%' OR mt_usergroup.Namagroup LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}
			
			$sQuery = "SELECT COUNT(*) as jml FROM tb_user 
						INNER JOIN mt_usergroup ON tb_user.Gid = mt_usergroup.Gid
						where tb_user.Id !='' $TipeAdmin $k_search ";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}


		/**
			* @author Indra Prayoga
			* @license PT Nebula Solusi Informasi
			* @copyright 2021
		*/

		public function get_group()
		{
			return $this->db->get('mt_usergroup');
		}
		public function cek_username($username)
		{
			$this->db->select('Id');
			$this->db->from('tb_user');
			$this->db->where('username', $username);
			return $this->db->get();
		}
		
		public function get_admin($Id)
		{
			return $this->db->get_where('tb_user', ['Id' => $Id]);
		}
	}

?>