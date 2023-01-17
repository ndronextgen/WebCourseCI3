<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
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
                'page_name'         => "Master Situs Menu",
                'menu_open'         => "master"
            ];

            $this->load->view('dashboard_admin/master_menu/index.php', $view_data);
        } else {
            header('location:' . base_url() . '');
        }
    }

    function modal_form()
    {
        $id = @$this->input->post('id');
        $view_data['model_info'] = $this->menu_model->get_one($id);
        $view_data['parents'] = $this->menu_model->get_all_where(["where_in" => ["menu_parent" => [0, 1]]]);
        $this->load->view('dashboard_admin/master_menu/modal_form.php', $view_data);
    }

    public function form($id = 0)
    {
        $v = $this->form_validation;
        $v->set_rules('menu_name', "Nama Menu", 'trim|required');
        $v->set_message("required", "%s wajib diisi, tidak boleh kosong.");

        if ($v->run() == FALSE) {
            echo json_encode(array("success" => false, 'message' => validation_errors()));
            exit();
        }

        $i = @$this->input;
        $data = [
            "menu_code"     => $i->post('menu_code'),
            "menu_name"     => $i->post('menu_name'),
            "menu_url"      => $i->post('menu_url'),
            "menu_icon"     => $i->post('menu_icon'),
            "menu_position" => $i->post('menu_position'),
            "menu_status"   => $i->post('menu_status'),
            "menu_type"     => $i->post('menu_type'),
            "menu_parent"   => $i->post('menu_parent')
        ];
        $save = $this->menu_model->save($data, $id);
        if ($save) {
            echo json_encode(array("success" => true, 'message' => 'Berhasil disimpan.'));
        } else {
            echo json_encode(array("success" => false, 'message' => "Gagal disimpan."));
        }
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
}
