<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('informasi_model');
        $this->load->library('func_table');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $c = $this->config;
            $view_data = [
                'judul_lengkap'     => $c->item('nama_aplikasi_full'),
                'judul_pendek'      => $c->item('nama_aplikasi_pendek'),
                'instansi'          => $c->item('nama_instansi'),
                'credit'            => $c->item('credit_aplikasi'),
                'alamat'            => $c->item('alamat_instansi'),
                'page_name'         => "Master Informasi",
                'menu_open'         => "master"
            ];

            $this->load->view('dashboard_admin/master_informasi/index.php', $view_data);
        } else {
            header('location:' . base_url() . '');
        }
    }

    public function form($id = 0)
    {
        $v = $this->form_validation;
        $v->set_rules('title', "Judul Informasi", 'trim|required');
        $v->set_rules('tgl_mulai', "Tanggal Awal", 'trim|required');
        $v->set_rules('tgl_akhir', "Tanggal Akhir", 'trim|required');

        if ($v->run() == FALSE) {
            $c = $this->config;
            $view_data = [
                'judul_lengkap'     => $c->item('nama_aplikasi_full'),
                'judul_pendek'      => $c->item('nama_aplikasi_pendek'),
                'instansi'          => $c->item('nama_instansi'),
                'credit'            => $c->item('credit_aplikasi'),
                'alamat'            => $c->item('alamat_instansi'),
                'page_name'         => $id ? "Ubah Master Informasi" : "Tambah Master Informasi",
                'menu_open'         => "master",
                'model_info'        => $this->informasi_model->get_one($id)
            ];
            $view_data['permission'] =  unserialize($view_data['model_info']->permission);
            $this->load->view('dashboard_admin/master_informasi/form.php', $view_data);
            return;
        }

        $i = @$this->input;
        $data = [
            "title"         => $i->post('title'),
            "tgl_mulai"     => $i->post('tgl_mulai'),
            "tgl_akhir"     => $i->post('tgl_akhir'),
            "permission"    => serialize($i->post('permission'))
        ];
        $save = $this->informasi_model->save($data, $id);
        if ($save) {
            $this->session->set_flashdata("success", "Master Informasi Berhasil Disimpan");
        } else {
            $this->session->set_flashdata("error", "Master Informasi Gagal Disimpan");
        }

        redirect(base_url("admin/master_informasi"));
    }

    public function select2_value($type)
    {
        $data = [];
        $q = @$this->input->get("q");
        if ($type == "pegawai") {
            $where["CONCAT(id_pegawai,'_',nama_pegawai) LIKE '%$q%'"] = NULL;
            $data = $this->config_popup_model->get_list_pegawai([], $where);
        } elseif ($type == "lokasi_kerja") {
            $where["CONCAT(id_lokasi_kerja,'_',lokasi_kerja) LIKE '%$q%'"] = NULL;
            $data = $this->config_popup_model->get_list_lokasi_kerja([], $where);
        } else {
            $where["CONCAT(id_sub_lokasi_kerja,'_',sub_lokasi_kerja) LIKE '%$q%'"] = NULL;
            $data = $this->config_popup_model->get_list_sub_lokasi_kerja([], $where);
        }
        echo json_encode($data);
    }
}
