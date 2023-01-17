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
            $view_data['permission']       =  unserialize($view_data['model_info']->permission);
            $view_data["pegawai"]          = $this->informasi_model->get_where_in("tbl_data_pegawai", "id_pegawai", @$view_data['permission']['pegawai']);
            $view_data["lokasi_kerja"]     = $this->informasi_model->get_where_in("tbl_master_lokasi_kerja", "id_lokasi_kerja", @$view_data['permission']['lokasi_kerja']);
            $view_data["sub_lokasi_kerja"] = $this->informasi_model->get_where_in("tbl_master_sub_lokasi_kerja", "id_sub_lokasi_kerja", @$view_data['permission']['sub_lokasi_kerja']);
            $view_data["site_menu"]        = $this->informasi_model->get_where_in("site_menus", "menu_id", @$view_data['model_info']->site_menu);
            $this->load->view('dashboard_admin/master_informasi/form.php', $view_data);
            return;
        }

        $i = @$this->input;
        $data = [
            "title"             => $i->post('title'),
            "tgl_mulai"         => $i->post('tgl_mulai'),
            "tgl_akhir"         => $i->post('tgl_akhir'),
            "site_menu"         => $i->post('site_menu'),
            "permission"        => serialize($i->post('permission'))
        ];
        $save = $this->informasi_model->save($data, $id);
        if ($save) {
            $this->session->set_flashdata("success", "Master Informasi Berhasil Disimpan");
        } else {
            $this->session->set_flashdata("error", "Master Informasi Gagal Disimpan");
        }

        redirect(base_url("admin/master_informasi"));
    }

    function update_position()
    {
        $order = $this->input->post('order');
        $save = 0;
        foreach ($order as $key => $val) {
            $data = [
                'position' => $val['position']
            ];
            if ($this->informasi_model->save($data, $val['id'])) $save += 1;
        }

        if ($save > 0) {
            echo json_encode(array("success" => true, 'message' => "Berhasil diperbaharui."));
        } else {
            echo json_encode(array("success" => false, 'message' => "Gagal diperbaharui."));
        }
    }

    function delete()
    {
        $v = $this->form_validation;
        $v->set_rules('id', "id", 'required');
        if ($v->run() == FALSE) {
            echo json_encode(array("success" => false, 'message' => validation_errors()));
            exit();
        }
        $id = $this->input->post('id');

        if ($this->informasi_model->delete($id)) {
            echo json_encode(array("success" => true, 'message' => "Data Berhasil dihapus"));
        } else {
            echo json_encode(array("success" => false, 'message' => "Data Gagal dihapus"));
        }
    }

    public function select2_value($type, $id = 0)
    {
        $data = [];
        $q = @$this->input->get("q");
        if ($type == "pegawai") {
            $where["CONCAT(id_pegawai,'_',nama_pegawai) LIKE '%$q%'"] = NULL;
            $data = $this->informasi_model->get_list_pegawai([], $where);
        } elseif ($type == "lokasi_kerja") {
            $where["CONCAT(id_lokasi_kerja,'_',lokasi_kerja) LIKE '%$q%'"] = NULL;
            $data = $this->informasi_model->get_list_lokasi_kerja([], $where);
        } elseif ($type == "sub_lokasi_kerja") {
            $where["CONCAT(id_lokasi_kerja,'_',lokasi_kerja) LIKE '%$q%'"] = NULL;
            $data = $this->informasi_model->get_list_lokasi_kerja([], $where);
        } else {
            $where['menu_parent'] = 1;
            $where["CONCAT(menu_id,'_',menu_name) LIKE '%$q%'"] = NULL;
            $data = $this->informasi_model->get_list_site_menus($id, $where);
        }
        echo json_encode($data);
    }
}
