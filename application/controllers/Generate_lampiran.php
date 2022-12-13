<?php



defined('BASEPATH') OR exit('No direct script access allowed');







class Generate_lampiran extends CI_Controller {







	public function __construct()



	{



		parent::__construct();



		$this->load->model('arsip_pribadi_model');



		$this->load->helper('url');    /***** LOADING HELPER TO AVOID PHP ERROR ****/



		$this->load->helper('file');



		$this->load->helper('download');	



	}



	public function gen_data_pribadi() {

		$context = 'pribadi';

		$q = $this->db->from('tbl_lampiran_pribadi')->get();

		// $q = $this->db->from('tbl_lampiran_pribadi')->where('id_user', 788)->get();

		if ($q->num_rows() > 0) {

			log_message('debug', 'processing lampiran'.$q->num_rows().' data');



			foreach ($q->result() as $key=>$dt) {

				log_message('debug', json_encode($dt));



				$arr = explode('.',$dt->nama_lampiran_asli);

				$title = $arr[0];



				$arrData = [

					'title' => $title,

					'id_data_keluarga' => '0',

					'filename' => $dt->nama_lampiran,

					'filename_ori' => $dt->nama_lampiran_asli,

					'context' => $context,

					'id_user' => $dt->id_user

				];



				//insert to table arsip

				if ($insert_id = $this->insert_arsip($arrData)) {



					$arrData['insert_id'] = $insert_id;

					//copy file

					if (!$this->copy_file($arrData)) {

						//delete table arsip

						$this->delete_arsip($context,$insert_id);

					}

				}



				log_message('debug','delay 5 miliseconds...');

				usleep(5);

			}

		}

		else {

			log_message('debug', 'tidak ada lampiran');

		}

	}



	public function gen_data_pendidikan() {

		$context = 'pendidikan';

		$q = $this->db->from('tbl_lampiran_pendidikan')->get();

		//$q = $this->db->from('tbl_lampiran_pendidikan')->where('id_user', 788)->get();

		if ($q->num_rows() > 0) {

			log_message('debug', 'processing lampiran'.$q->num_rows().' data');



			foreach ($q->result() as $key=>$dt) {

				log_message('debug', json_encode($dt));



				$arr = explode('.',$dt->nama_lampiran_asli);

				$title = $arr[0];



				$arrData = [

					'title' => $title,

					'filename' => $dt->nama_lampiran,

					'filename_ori' => $dt->nama_lampiran_asli,

					'context' => $context,

					'id_user' => $dt->id_user

				];



				//insert to table arsip

				if ($insert_id = $this->insert_arsip($arrData)) {



					$arrData['insert_id'] = $insert_id;

					//copy file

					if (!$this->copy_file($arrData)) {

						//delete table arsip

						$this->delete_arsip($context,$insert_id);

					}

				}



				log_message('debug','delay 5 miliseconds...');

				usleep(5);

			}

		}

		else {

			log_message('debug', 'tidak ada lampiran');

		}

	}



	public function gen_data_sk() {

		$context = 'sk';

		$q = $this->db->from('tbl_lampiran_sk')->get();

		//$q = $this->db->from('tbl_lampiran_sk')->where('id_user', 788)->get();

		if ($q->num_rows() > 0) {

			log_message('debug', 'processing lampiran : '.$q->num_rows().' data');

			echo 'processing lampiran'.$q->num_rows().' data<br />';



			foreach ($q->result() as $key=>$dt) {

				log_message('debug', json_encode($dt));

				echo json_encode($dt).'<br />';



				$arr = explode('.',$dt->nama_lampiran_asli);

				$title = $arr[0];



				$arrData = [

					'title' => $title,

					'filename' => $dt->nama_lampiran,

					'filename_ori' => $dt->nama_lampiran_asli,

					'context' => $context,

					'id_user' => $dt->id_user

				];



				//insert to table arsip

				if ($insert_id = $this->insert_arsip($arrData)) {



					$arrData['insert_id'] = $insert_id;

					//copy file

					if (!$this->copy_file($arrData)) {

						//delete table arsip

						$this->delete_arsip($context,$insert_id);

					}

				}



				log_message('debug','delay 5 miliseconds...');

				echo 'delay 5 miliseconds...<br /><br />';

				usleep(5);

			}

		}

		else {

			log_message('debug', 'tidak ada lampiran');

		}

	}



	public function gen_data_skp() {

		$context = 'skp';

		$q = $this->db->from('tbl_lampiran_skp')->get();

		//$q = $this->db->from('tbl_lampiran_skp')->where('id_user', 788)->get();

		if ($q->num_rows() > 0) {

			log_message('debug', 'processing lampiran'.$q->num_rows().' data');



			foreach ($q->result() as $key=>$dt) {

				log_message('debug', json_encode($dt));



				$arr = explode('.',$dt->nama_lampiran_asli);

				$title = $arr[0];



				$arrData = [

					'title' => $title,

					'filename' => $dt->nama_lampiran,

					'filename_ori' => $dt->nama_lampiran_asli,

					'context' => $context,

					'id_user' => $dt->id_user

				];



				//insert to table arsip

				if ($insert_id = $this->insert_arsip($arrData)) {



					$arrData['insert_id'] = $insert_id;

					//copy file

					if (!$this->copy_file($arrData)) {

						//delete table arsip

						$this->delete_arsip($context,$insert_id);

					}

				}



				log_message('debug','delay 5 miliseconds...');

				usleep(5);

			}

		}

		else {

			log_message('debug', 'tidak ada lampiran');

		}

	}



	private function insert_arsip($data) {

		$tblName = '';

		$ins = [

			'file_name_ori' => $data['filename_ori'],

			'file_name' => $data['filename'],

			'created_id' => $data['id_user'],

			'title' => $data['title']

		];

		switch ($data['context']) {

			case 'pribadi':

				$tblName = 'tbl_arsip_pribadi';

			break;

			case 'pendidikan':

				$tblName = 'tbl_arsip_pendidikan';

				$ins['id_tipe_pendidikan'] = 1;

			break;

			case 'sk':

				$tblName = 'tbl_arsip_sk';

				$ins['id_jenis_sk'] = 4;

			break;

			case 'skp':

				$tblName = 'tbl_arsip_skp';

			break;

		}



		$this->db->insert($tblName, $ins);

		$insert_id = $this->db->insert_id();



		// switch ($data['context']) {

		// 	case 'pribadi':

		// 		$this->db->update($tblName, ['id_data_keluarga' => $insert_id], ['id_arsip_pribadi' => $insert_id]);

		// 	break;

		// 	case 'pendidikan':

		// 		$this->db->update($tblName, ['id_pendidikan' => $insert_id], ['id_arsip_pendidikan' => $insert_id]);

		// 	break;

		// 	case 'sk':

		// 		$this->db->update($tblName, ['id_ref' => $insert_id], ['id_arsip_sk' => $insert_id]);

		// 	break;

		// 	case 'skp':

		// 		$this->db->update($tblName, ['id_dp3' => $insert_id], ['id_arsip_skp' => $insert_id]);

		// 	break;

		// }



		return $insert_id;

	}



	private function delete_arsip($context, $id) {

		$tblName = '';

		$idname = '';

		switch ($context) {

			case 'pribadi':

				$tblName = 'tbl_arsip_pribadi';

				$idname = 'id_arsip_pribadi';

			break;

			case 'pendidikan':

				$tblName = 'tbl_arsip_pendidikan';

				$idname = 'id_arsip_pendidikan';

			break;

			case 'pangkat':

				$tblName = 'tbl_arsip_sk';

				$idname = 'id_arsip_sk';

			break;

			case 'skp':

				$tblName = 'tbl_arsip_skp';

				$idname = 'id_arsip_skp';

			break;

		}



		$this->db->where($idname, $id)->delete($tblName);



		log_message('debug', 'rollback insert '.$tblName);

	}



	private function copy_file($data) {

		log_message('debug', 'copying file : '.json_encode($data));

		echo 'copying file : '.json_encode($data).'<br />';



		$status = false;

		$dirSrc = '';

		$pathSrc = '';

		$dirDest = '';

		$pathDest = '';



		switch ($data['context']) {

			case 'pribadi':

				$dirDest = './asset/upload/pribadi_new/pribadi_0_'.$data['insert_id'];

				$pathDest = $dirDest.'/'.$data['filename'];



				$dirSrc = './asset/upload/pribadi/pribadi'.$data['id_user'];

				$pathSrc = $dirSrc.'/'.$data['filename'];

			break;

			case 'pendidikan':

				$dirDest = './asset/upload/pendidikan_new/pendidikan_1_0_'.$data['insert_id'];

				$pathDest = $dirDest.'/'.$data['filename'];



				$dirSrc = './asset/upload/pendidikan/pendidikan'.$data['id_user'];

				$pathSrc = $dirSrc.'/'.$data['filename'];

			break;

			case 'sk':

				$dirDest = './asset/upload/SK_NEW/SK_4_0_'.$data['insert_id'];

				$pathDest = $dirDest.'/'.$data['filename'];



				$dirSrc = './asset/upload/SK/SK'.$data['id_user'];

				$pathSrc = $dirSrc.'/'.$data['filename'];

			break;

			case 'skp':

				$dirDest = './asset/upload/SKP_NEW/SKP_0_'.$data['insert_id'];

				$pathDest = $dirDest.'/'.$data['filename'];



				$dirSrc = './asset/upload/SKP/SKP'.$data['id_user'];

				$pathSrc = $dirSrc.'/'.$data['filename'];

			break;

		}



		log_message('debug','copying.. : '.$pathSrc.' to '.$pathDest);

		echo 'copying.. : '.$pathSrc.' to '.$pathDest.'<br />';



		if (file_exists($pathSrc)) {

			log_message('debug','DITEMUKAN');

			echo 'DITEMUKAN<br />';

			if (!is_dir($dirDest)) {

				mkdir($dirDest, 0775, true);

			}



			if (copy($pathSrc, $pathDest)) {

				log_message('debug','copy file success to : '.$pathSrc.' to '.$pathDest);

				echo 'copy file success to : '.$pathSrc.' to '.$pathDest.'<br />';

				$status = true;

			}

			else {

				log_message('debug','copy file failed from : '.$pathSrc.' to '.$pathDest);

				echo 'copy file failed from : '.$pathSrc.' to '.$pathDest.'<br />';

			}

		}

		else {

			log_message('debug', 'file source tidak ditemukan : '.$pathSrc);

			echo 'file source tidak ditemukan : '.$pathSrc.'<br />';

		}

		

		return $status;

	}

	public function gen_data_sk_old() {
		#$q = $this->db->from('tbl_arsip_sk_20201218')->get();
		$q = $this->db->query('select * from tbl_arsip_sk_20201218 where file_name_ori not in (SELECT file_name_ori FROM tbl_arsip_sk)');
		if ($q->num_rows() > 0) {
			log_message('debug', 'processing lampiran : '.$q->num_rows().' data');
			echo 'processing lampiran'.$q->num_rows().' data<br />';
			
			foreach ($q->result() as $key=>$dt) {
				log_message('debug', json_encode($dt));
				echo json_encode($dt).'<br />';
				
				$arrData = [
					'id_ref' => $dt->id_ref,
					'id_jenis_sk' => $dt->id_jenis_sk,
					'title' => $dt->title,
					'file_name' => $dt->file_name,
					'file_name_ori' => $dt->file_name_ori,
					'created_id' => $dt->created_id,
					'created_at' => $dt->created_at
				];

				if ($this->db->insert('tbl_arsip_sk', $arrData)) {
					$insert_id = $this->db->insert_id();
					
					$dirDest = './asset/upload/SK/SK_4_'.$dt->id_ref.'_'.$insert_id;
					$pathDest = $dirDest.'/'.$dt->file_name;
					
					$dirSrc = './asset/upload/SKbak/SK_4_'.$dt->id_ref.'_'.$dt->id_arsip_sk;
					$pathSrc = $dirSrc.'/'.$dt->file_name;
					
					if (file_exists($pathSrc)) {
						echo 'DITEMUKAN<br />';

						if (!is_dir($dirDest)) {
							mkdir($dirDest, 0775, true);
						}

						if (copy($pathSrc, $pathDest)) {
							echo 'copy file success to : '.$pathSrc.' to '.$pathDest.'<br />';
						}
						else {
							$this->db->delete('tbl_arsip_sk', array('id_arsip_sk' => $dt->id_arsip_sk));
						}
					}
					else {
						$this->db->delete('tbl_arsip_sk', array('id_arsip_sk' => $dt->id_arsip_sk));
						echo 'TIDAK DITEMUKAN<br />';
					}
				}
				
				echo 'delay 5 miliseconds...<br /><br />';

				usleep(5);
			}
		}
		else {
			log_message('debug', 'tidak ada lampiran');
		}
	}
	
	public function gen_data_pendidikan_old() {
		#$q = $this->db->from('tbl_arsip_sk_20201218')->get();
		$q = $this->db->query('select * from tbl_arsip_pendidikan_20201218 where file_name_ori not in (SELECT file_name_ori FROM tbl_arsip_pendidikan)');
		if ($q->num_rows() > 0) {
			log_message('debug', 'processing lampiran : '.$q->num_rows().' data');
			echo 'processing lampiran'.$q->num_rows().' data<br />';
			
			foreach ($q->result() as $key=>$dt) {
				log_message('debug', json_encode($dt));
				echo json_encode($dt).'<br />';
				
				$arrData = [
					'id_pendidikan' => $dt->id_pendidikan,
					'id_tipe_pendidikan' => $dt->id_tipe_pendidikan,
					'title' => $dt->title,
					'file_name' => $dt->file_name,
					'file_name_ori' => $dt->file_name_ori,
					'created_id' => $dt->created_id,
					'created_at' => $dt->created_at
				];

				if ($this->db->insert('tbl_arsip_pendidikan', $arrData)) {
					$insert_id = $this->db->insert_id();
					
					$dirDest = './asset/upload/pendidikan/pendidikan_'.$dt->id_pendidikan.'_'.$insert_id;
					$pathDest = $dirDest.'/'.$dt->file_name;
					
					$dirSrc = './asset/upload/pendidikanbak/pendidikan_'.$dt->id_pendidikan.'_'.$dt->id_arsip_pendidikan;
					$pathSrc = $dirSrc.'/'.$dt->file_name;
					
					if (file_exists($pathSrc)) {
						echo 'DITEMUKAN<br />';

						if (!is_dir($dirDest)) {
							mkdir($dirDest, 0775, true);
						}

						if (copy($pathSrc, $pathDest)) {
							echo 'copy file success to : '.$pathSrc.' to '.$pathDest.'<br />';
						}
						else {
							$this->db->delete('tbl_arsip_pendidikan', array('id_arsip_pendidikan' => $insert_id));
						}
					}
					else {
						$this->db->delete('tbl_arsip_pendidikan', array('id_arsip_pendidikan' => $insert_id));
						echo 'TIDAK DITEMUKAN<br />';
					}
				}
				
				echo 'delay 5 miliseconds...<br /><br />';

				usleep(5);
			}
		}
		else {
			log_message('debug', 'tidak ada lampiran');
		}
	}
	
	public function gen_data_skp_old() {
		#$q = $this->db->from('tbl_arsip_sk_20201218')->get();
		$q = $this->db->query('select * from tbl_arsip_skp_20201218 where file_name_ori not in (SELECT file_name_ori FROM tbl_arsip_skp)');
		if ($q->num_rows() > 0) {
			log_message('debug', 'processing lampiran : '.$q->num_rows().' data');
			echo 'processing lampiran'.$q->num_rows().' data<br />';
			
			foreach ($q->result() as $key=>$dt) {
				log_message('debug', json_encode($dt));
				echo json_encode($dt).'<br />';
				
				$arrData = [
					'id_dp3' => $dt->id_dp3,
					'title' => $dt->title,
					'file_name' => $dt->file_name,
					'file_name_ori' => $dt->file_name_ori,
					'created_id' => $dt->created_id,
					'created_at' => $dt->created_at
				];

				if ($this->db->insert('tbl_arsip_skp', $arrData)) {
					$insert_id = $this->db->insert_id();
					
					$dirDest = './asset/upload/SKP/SKP_'.$dt->id_dp3.'_'.$insert_id;
					$pathDest = $dirDest.'/'.$dt->file_name;
					
					$dirSrc = './asset/upload/SKPbak/SKP_'.$dt->id_dp3.'_'.$dt->id_arsip_skp;
					$pathSrc = $dirSrc.'/'.$dt->file_name;
					
					if (file_exists($pathSrc)) {
						echo 'DITEMUKAN<br />';

						if (!is_dir($dirDest)) {
							mkdir($dirDest, 0775, true);
						}

						if (copy($pathSrc, $pathDest)) {
							echo 'copy file success to : '.$pathSrc.' to '.$pathDest.'<br />';
						}
						else {
							$this->db->delete('tbl_arsip_skp', array('id_arsip_skp' => $insert_id));
						}
					}
					else {
						$this->db->delete('tbl_arsip_skp', array('id_arsip_skp' => $insert_id));
						echo 'TIDAK DITEMUKAN<br />';
					}
				}
				
				echo 'delay 5 miliseconds...<br /><br />';

				usleep(5);
			}
		}
		else {
			log_message('debug', 'tidak ada lampiran');
		}
	}
}



