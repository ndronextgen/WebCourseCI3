<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config_popup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('config_popup_model');
        $this->load->library('func_table');
    }

    function index()
    {
        $v = $this->form_validation;
        $v->set_rules('type[]', "Tipe", 'trim|required');
        $v->set_rules('value[]', "Value", 'required');
        if ($v->run() === TRUE) {
            $i = $this->input;
            $this->db->truncate('config_popup');
            $types  = $i->post("type");
            $values = $i->post("value");
            foreach ($types as $i => $type) :
                $data = [
                    'type'  => $type,
                    'value' => implode(',', $values[$type])
                ];
                $this->config_popup_model->insert($data);
            endforeach;
            $s = $this->session;
            $s->set_flashdata("success", "Config Berhasil disimpan.");
            redirect(base_url("admin/config_popup"));
        } else {
            $c         = $this->config;

            $pegawai            = $this->config_popup_model->getRowby(["type" => "pegawai"]);
            $lokasi_kerja       = $this->config_popup_model->getRowby(["type" => "lokasi_kerja"]);
            $sub_lokasi_kerja   = $this->config_popup_model->getRowby(["type" => "sub_lokasi_kerja"]);
            $view_data = [
                'judul_lengkap'     => $c->item('nama_aplikasi_full'),
                'judul_pendek'      => $c->item('nama_aplikasi_pendek'),
                'instansi'          => $c->item('nama_instansi'),
                'credit'            => $c->item('credit_aplikasi'),
                'alamat'            => $c->item('alamat_instansi'),
                'page_name'         => "Configurasi Popup Informasi",
                'menu_open'         => "master",
                'pegawai'           => $this->config_popup_model->get_where_in("tbl_data_pegawai", "id_pegawai", explode(",", $pegawai->value)),
                'lokasi_kerja'      => $this->config_popup_model->get_where_in("tbl_master_lokasi_kerja", "id_lokasi_kerja", explode(",", $lokasi_kerja->value)),
                'sub_lokasi_kerja'  => $this->config_popup_model->get_where_in("tbl_master_sub_lokasi_kerja", "id_sub_lokasi_kerja", explode(",", $sub_lokasi_kerja->value))
            ];

            $this->load->view('dashboard_admin/config_popup/index.php', $view_data);
        }
    }

    function select2_value($type)
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
