<?php

// BEGIN JOE - 7 JUL 2022
// Letakkan visitor counter di page footer
$app = &get_instance();
$app->load->model('visitor_model');
$visitor = $app->visitor_model->visitor_login_count();
// END JOE - 7 JUL 2022

// BEGIN JOE - 7 JUL 2022
// Letakkan visitor counter di page footer
echo '<a href="' . base_url() . 'admin/data_visitor">';
// BEGIN JOE - 11 JUL 2022
// Dibuat bentuk tabel
echo '<table style="background-color: #c4b9b9; border: 1px solid #1F4690; color: black; font-size: 12px; font-family: "Times New Roman";">';
echo '  <tr style="border-radius: 10px;">';
echo '      <th colspan=2 style="text-align: center; background-color: #282e33; color: #dedcdc; padding-left: 10px; padding-right: 10px;">'; //background-color: #876e6c
echo '                      ' . 'PENGUNJUNG ';
echo '      </th>';
echo '  </tr>';
echo '  <tr style="background-color: #FFFF66; font-weight: bold;">'; //class="bg-warning"
echo '      <td style="padding-left: 5px;">';
echo '                  • Hari Ini';
echo '      </td>';
echo '      <td style="text-align: right; padding-right: 5px;">';
echo '                  ' . $visitor['visitor_today'] . '';
echo '      </td>';
echo '  </tr>';
echo '  <tr style="background-color: #66FF66; font-weight: bold;">'; //class="bg-success"
echo '      <td style="padding-left: 5px;">';
echo '                  • Total';
echo '      </td>';
echo '      <td style="text-align: right; padding-right: 5px;">';
echo '                  ' . $visitor['visitor_total'] . '';
echo '      </td>';
echo '  </tr>';
echo '  <tr style="background-color: #6666FF; font-weight: bold;">'; //class="bg-info"
echo '      <td style="padding-left: 5px;">';
echo '                  • Online';
echo '      </td>';
echo '      <td style="text-align: right; padding-right: 5px;">';
echo '                  ' . $visitor['visitor_online'];
echo '      </td>';
echo '  </tr>';
echo '</table>';
// END JOE - 11 JUL 2022
echo '</a>';
// END JOE - 7 JUL 2022
