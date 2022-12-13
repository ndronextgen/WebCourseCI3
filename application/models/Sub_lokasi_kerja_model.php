<?php
class Sub_lokasi_kerja_model extends CI_Model
{
 function list_by_lokasi_kerja($id_lokasi_kerja)
 {
  $this->db->where('id_lokasi_kerja', $id_lokasi_kerja);
  $this->db->order_by('sub_lokasi_kerja', 'ASC');
  $query = $this->db->get('tbl_master_sub_lokasi_kerja');
  $output = '<option value="">Seksi / Subbag / Satlak</option>';
  echo $id_lokasi_kerja;
  print_r($query->result());
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->id_sub_lokasi_kerja.'">'.$row->sub_lokasi_kerja.'</option>';
  }
  return $output;
 }
 
}

?>