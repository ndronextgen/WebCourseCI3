<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mst_site_menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list()
    {
        $q = "select *, (select menu_name from site_menus where menu_id = a.menu_parent LIMIT 1) as menu_parent_name
			from site_menus a 
            WHERE menu_parent != 0
			order by CONCAT(menu_parent_name,'_',menu_position) ASC";
        echo json_encode($this->db->query($q)->result_array());
    }
}
