<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status_surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jabatan_model');
        $this->load->model('app_Login_Model');
        $this->load->model('srt_ket_model');
        $this->load->model('riwayat_jabatan_model');
        $this->load->model('history_srt_ket_model');
        $this->load->model('informasi_model');
        $this->load->library('func_table');
        $this->load->library('func_wa_sk');
        $this->load->helper(array('url', 'download'));
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
            $d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $d['instansi'] = $this->config->item('nama_instansi');
            $d['credit'] = $this->config->item('credit_aplikasi');
            $d['alamat'] = $this->config->item('alamat_instansi');

            $id['id_pegawai'] = $this->session->userdata('id_pegawai');
            $this->session->set_userdata($id);
            $data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);

            // === notif count ===
            $count_see = $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
            $count_see_tj = $this->func_table->count_see_tj($this->session->userdata('username'));
            $count_see_kaku    = $this->func_table->count_see_kaku($this->session->userdata('username'));
            $count_see_verifikasi = $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
            $count_see_verifikasi_tj = $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
            $count_see_verifikasi_kaku = $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));
            $count_see_verifikasi_hukdis = $this->func_table->count_see_verifikasi_hukdis($this->session->userdata('username'));
            $count_see_verifikasi_tp = $this->func_table->count_see_verifikasi_tp($this->session->userdata('username'));
            $count_see_verifikasi_karir = $this->func_table->count_see_verifikasi_karir($this->session->userdata('username'));

            $status_verifikasi = $this->func_table->status_verifikasi_user($this->session->userdata('id_pegawai'));
            if ($status_verifikasi == 'kepegawaian' || $status_verifikasi == 'sekdis' || $status_verifikasi == 'sudinupt') {
                $d['status_user'] = 'true';
            } else {
                $d['status_user'] = 'false';
            }

            if ($data_pegawai->num_rows() > 0) {
                $q = $this->db->get_where("tbl_data_pegawai", $id);
                $set_detail = $q->row();
                $this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

                foreach ($q->result() as $data) {
                    $d['id_param'] = $data->id_pegawai;
                    $d['nip'] = $data->nip;
                    $d['nrk'] = $data->nrk;
                    $d['email'] = $data->email;
                    $d['telepon'] = $data->telepon;
                    $d['nama_pegawai'] = $data->nama_pegawai;
                    $d['gelar'] = $data->gelar;
                    $d['status_pegawai'] = $data->status_pegawai;
                    $d['id_jabatan'] = $data->id_jabatan;
                    $d['id_bidang'] = $data->id_bidang;
                    $d['lokasi_kerja'] = $data->lokasi_kerja;
                    $d['seksi'] = $data->seksi;
                    $d['masa_kerja'] = $data->masa_kerja;
                    $d['usia'] =  $data->usia;
                    $d['jenis_kelamin'] = $data->jenis_kelamin;
                    $d['tempat_lahir'] =  $data->tempat_lahir;
                    $d['tanggal_lahir'] = $data->tanggal_lahir;
                    $d['agama'] = $data->agama;
                    $d['status_nikah'] = $data->status_nikah;
                    $d['alamat_pegawai'] =  $data->alamat;
                    $d['longitude'] = $data->longitude;
                    $d['latitude'] = $data->latitude;
                    $d['pendidikan'] = $data->pendidikan;
                    $d['pendidikan_bkd'] = $data->pendidikan_bkd;
                    $d['asal_sekolah'] = $data->asal_sekolah;
                    $d['tgl_lulus'] = $data->tgl_lulus;
                    $d['id_golongan'] = $data->id_golongan;
                    $d['id_eselon'] = $data->id_eselon;
                    $d['nomor_sk_pangkat'] = $data->nomor_sk_pangkat;
                    $d['tanggal_sk_pangkat'] = $data->tanggal_sk_pangkat;
                    $d['tanggal_mulai_pangkat'] = $data->tanggal_mulai_pangkat;
                    $d['tanggal_pengangkatan_cpns'] = $data->tanggal_pengangkatan_cpns;
                    $d['id_status_jabatan'] = $data->id_status_jabatan;
                    $d['status_pegawai_pangkat'] = $data->status_pegawai_pangkat;
                    $d['nomor_sk_jabatan'] = $data->nomor_sk_jabatan;
                    $d['tanggal_sk_jabatan'] = $data->tanggal_sk_jabatan;
                    $d['tanggal_mulai_jabatan'] = $data->tanggal_mulai_jabatan;
                    $d['foto'] = $data->foto;
                    $d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
                    $d['id_satuan_kerja'] = $data->id_satuan_kerja;
                    $d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
                    $d['tmt_eselon'] = $data->tmt_eselon;
                }

                $d['st'] = "edit";

                $this->load->helper('url');

                // === notif count ===
                $d['count_see'] = $count_see;
                $d['count_see_tj'] = $count_see_tj;
                $d['count_see_kaku'] = $count_see_kaku;
                $d['count_see_verifikasi'] = $count_see_verifikasi;
                $d['count_see_verifikasi_tj'] = $count_see_verifikasi_tj;
                $d['count_see_verifikasi_kaku'] = $count_see_verifikasi_kaku;
                $d['count_see_verifikasi_hukdis'] = $count_see_verifikasi_hukdis;
                $d['count_see_verifikasi_tp'] = $count_see_verifikasi_tp;
                $d['count_see_verifikasi_karir'] = $count_see_verifikasi_karir;

                //$this->load->view('master/header3',$d);				
                $this->load->view('dashboard_publik/home/status_surat', $d);
            } else {
                header('location:' . base_url() . '');
            }
        } else {
            header('location:' . base_url() . '');
        }
    }
}
