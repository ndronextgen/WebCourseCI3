<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('menu_list')) {
    function menu_list()
    {
        $ci = &get_instance();
        $menus = $ci->menu_model->getParentIdBy(["menu_parent" => 1, 'menu_type' => 'publik']);
        // $menus = $ci->menu_model->get_all_where(["where_in" => ["menu_parent" => [1], 'menu_type' => 'publik']]);
        $arr = [];
        foreach ($menus as $item) {
            $submenu = $ci->menu_model->get_all_where(["menu_parent" => $item->menu_id, 'menu_type' => 'publik']);
            if ($submenu->num_rows() > 0) {
                $item->submenu = $submenu->result();
            }
            $arr[] = $item;
        }
        return $arr;
    }
}

if (!function_exists('menuHtml')) {
    function menuHtml()
    {
        $ci = &get_instance();
        $menus = menu_list();
        $notif = count_notify();
        $html = '<div class="navbar-custom-menu">';
        $html .= '<ul class="nav navbar-nav">';
        foreach ($menus as $key => $main_menu) :
            $submenu        = get_array_value((array) $main_menu, "submenu");
            $active_class   = active_menu($main_menu->menu_url, $submenu);
            $expend_class   = "";
            if ($submenu) :
                $expend_class = "dropdown user user-menu";
            endif;

            $html .= '<li class="' . $active_class . " " . $expend_class . '">';
            if (!$submenu) {
                $html .= '<a href="' . base_url($main_menu->menu_url) . '">';
                if (!empty($main_menu->menu_icon)) :
                    $html .= '<i class="' . $main_menu->menu_icon . '"></i>';
                endif;
                $html .= '<span style="margin-left: 5px;">' . $main_menu->menu_name . '</span>';
                if (!empty($notif[$main_menu->menu_code])) :
                    $html .= $notif[$main_menu->menu_code];
                endif;
                if (!empty($main_menu->isInfo)) :
                    $html .= '<span class="label label-success">Baru</span>';
                endif;
                $html .= '</a>';
            } else {
                $html .= '<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
                if (!empty($main_menu->menu_icon)) :
                    $html .= '<i class="' . $main_menu->menu_icon . '"></i>';
                endif;
                $html .= '<span class="hidden-xs" style="margin-left: 5px;">' . $main_menu->menu_name . ' &nbsp;';
                if (!empty($notif[$main_menu->menu_code])) :
                    $html .= $notif[$main_menu->menu_code];
                endif;
                if (!empty($main_menu->isInfo)) :
                    $html .= '<span class="label label-success">Baru</span>';
                endif;
                $html .= '<i class="caret"></i></span>';
                $html .= '</a>';
                $html .= '<ul class="dropdown-menu">';
                foreach ($submenu as $sub_main_menu) :
                    $active_class = active_menu($sub_main_menu->menu_url, $submenu);
                    $html .= '<li class="' . $active_class . '"><a href="' . base_url($sub_main_menu->menu_url) . '">';
                    $html .= '<i class="fa fa-angle-right"></i>' . $sub_main_menu->menu_name . '&nbsp;';
                    if (!empty($notif[$sub_main_menu->menu_code])) :
                        $html .= $notif[$sub_main_menu->menu_code];
                    endif;
                    $html .= '</a></li>';
                endforeach;
                $html .= '</ul>';
            }
            $html .= '</li>';
        endforeach;
        $html .= menu_profil();
        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('count_notify')) {
    function count_notify()
    {
        $ci = &get_instance();
        // === notif count ===
        $count_see = $ci->func_table->count_see_sk($ci->session->userdata('id_pegawai'));
        $count_see_tj = $ci->func_table->count_see_tj($ci->session->userdata('username'));
        $count_see_kaku    = $ci->func_table->count_see_kaku($ci->session->userdata('username'));
        $count_see_verifikasi = $ci->func_table->count_see_verifikasi($ci->session->userdata('id_pegawai'));
        $count_see_verifikasi_tj = $ci->func_table->count_see_verifikasi_tunjangan($ci->session->userdata('username'));
        $count_see_verifikasi_kaku = $ci->func_table->count_see_verifikasi_kariskarsu($ci->session->userdata('username'));
        $count_see_verifikasi_hukdis = $ci->func_table->count_see_verifikasi_hukdis($ci->session->userdata('username'));
        $count_see_verifikasi_tp = $ci->func_table->count_see_verifikasi_tp($ci->session->userdata('username'));
        $count_see_verifikasi_karir = $ci->func_table->count_see_verifikasi_karir($ci->session->userdata('username'));

        $notif = [];
        if ($count_see > 0 || $count_see_tj > 0 || $count_see_kaku > 0) :
            $notif['kertas_kerja'] = '<span class="badge btn-warning btn-flat">' . ($count_see + $count_see_tj + $count_see_kaku) . '</span>';
        endif;
        if ($count_see > 0) :
            $notif['skp'] = '<span class="badge btn-warning btn-flat">' . $count_see . '</span>';
        endif;
        if ($count_see_tj > 0) :
            $notif['sptk'] = '<span class="badge btn-warning btn-flat">' . $count_see_tj . '</span>';
        endif;
        if ($count_see_kaku > 0) :
            $notif['spkk'] = '<span class="badge btn-warning btn-flat">' . $count_see_kaku . '</span>';
        endif;

        return $notif;
    }
}

if (!function_exists('menu_profil')) {
    function menu_profil()
    {
        $ci = &get_instance();
        $id_pegawai = $ci->session->userdata('id_pegawai');
        $q = $ci->db->get_where("tbl_data_pegawai", ['id_pegawai' => $id_pegawai])->row();
        $html = '<li class="dropdown user user-menu">';
        $html .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
        $ft = $q->foto;
        if ($ft == "") {
            $ft = "nofoto.png";
            $html .= '<img src="' . base_url() . 'asset/foto_pegawai/no-image/' . $ft . '" class="user-image" alt="User Image" style="" />';
        } else {
            $html .= '<img src="' . base_url() . 'asset/foto_pegawai/thumb/' . $ft . '" class="user-image" alt="User Image" style="" />';
        }
        $nama = str_replace("&nbsp;", " ", $ci->func_table->name_format($ci->session->userdata('nama')));
        $html .= '<span class="hidden-xs">' . $nama . '<i class="caret"></i></span>';
        $html .= '</a>';
        $html .= '<ul class="dropdown-menu">';
        $html .= '<li><a href="<?php echo "https://dcktrp.jakarta.go.id/satuakses/app/profile" ?>" target="_blank"><i class="icon-off"></i> Profil</a></li>';
        $html .= '<li><a href="' . base_url() . 'app/logout"><i class="icon-off"></i> Log Out</a></li>';
        $html .= '</ul>';
        $html .= '</li>';
        return $html;
    }
}

if (!function_exists('active_menu')) {

    function active_menu($menu = "", $submenu = array())
    {
        $ci = &get_instance();
        $segment = $ci->uri->segments;
        $controller_name = strtolower(get_class($ci));
        if (COUNT($ci->uri->segments) > 1 && $menu === implode('/', $segment)) {
            return "active";
        } elseif ($menu === $controller_name) {
            return "active";
        } else if ($submenu && count($submenu)) {
            foreach ($submenu as $sub_menu) {
                if (get_array_value((array) $sub_menu, "menu_url") === $controller_name) {
                    return "active";
                } else if (get_array_value((array) $sub_menu, "menu_parent") === $controller_name) {
                    return "active";
                }
            }
        }
    }
}
