<style>
p {
  font-family: Arial;
  font-size:12px;
}
table.wbo {
  margin: 0 auto;
  padding:10px;
  font-size:12px;
  font-family: Arial;
}
table.wbo2 {
  border-collapse: collapse;
  border: 1px solid #595959;
  margin: 0 auto;
  padding:10px;
  font-size:12px;
  font-family: Arial;
}
.image1 {
  position: absolute;
  z-index: 0;
  margin-bottom:150px;
  margin-top:-130px;
  margin-left:-140px;
  margin-right:20px;
  width:125px;
  height:125px;
  /* border:1px solid #000; */
}
.image_sign {
  position: relative;
  z-index: 0 !important;
  /* margin-bottom:-180px; */
  /* margin-top:150px; */
  margin-left:10px;
  margin-right:-10px;
  width:auto;
  height:120px !important;

  /* border:1px solid #000; */
}
.image_sign_pegawai {
  position: relative;
  z-index: 0 !important;
  margin-left:10px;
  margin-right:-10px;
  width:auto;
  height:130px !important;

  /* border:1px solid #000; */
}
.sign-left {
  width: 70mm;
}
.sign-right {
  text-align:center;
  width: 110mm;
}

* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 30%;
  height: 300px; 
  text-align: center;
  position: relative;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}


</style>
<table border="0" cellspacing="0" cellpadding="0" width="99%">
		<tr>
        <td align="center" style='font-family: "Arial Black", "Arial Bold", Gadget, sans-serif; font-size:16px;'><b>SURAT KETERANGAN<br>
UNTUK MENDAPATKAN PEMBAYARAN TUNJANGAN KELUARGA
</b></td>
    </tr>
</table>
<hr style='height: 4px;color: #000 !important;'>

          <!-- right -->
          <table class='wbo' width='90%' cellspacing="0" cellpadding="3">
              <tr>
                  <td width='150px'>Nama Lengkap</td>
                  <td width='1px'>:</td>
                  <td><?php echo $Data->nama_pegawai; ?></td>
              </tr>
              <tr>
                  <td>NIP / NRK</td>
                  <td>:</td>
                  <td><?php echo $Data->nip.' / '.$Data->nrk; ?></td>
              </tr>
              <tr>
                  <td>Tempat / Tanggal Lahir</td>
                  <td>:</td>
                  <td><?php echo $Data->tempat_lahir.' / '.$this->func_table->tgl_indonesia($Data->tanggal_lahir); ?></td>
              </tr>
              <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td><?php echo $Data->jenis_kelamin; ?></td>
              </tr>
              <tr>
                  <td>Agama</td>
                  <td>:</td>
                  <td><?php echo $Data->agama; ?></td>
              </tr>
              <tr>
                  <td>Status Kepegawaian</td>
                  <td>:</td>
                  <td><?php echo $Data->nama_status; ?></td>
              </tr>
              <tr>
                  <td>Jabatan Struktural</td>
                  <td>:</td>
                  <td><?php echo $Data->nama_jabatan; ?></td>
              </tr>
              
              <tr>
                  <td>Pangkat / Golongan</td>
                  <td>:</td>
                  <td><?php echo $Data->uraian.' '.$Data->golongan; ?></td>
              </tr>
              <tr>
                  <td>Pada Unit Kerja</td>
                  <td>:</td>
                  <td><?php echo $Data->nama_lokasi_kerja; ?></td>
              </tr>
              <tr>
                  <td>Masa kerja golongan</td>
                  <td>:</td>
                  <td>
                      <?php 
                          $tmt_awal=date($Data->tanggal_mulai_pangkat);
                          $date_now=date("Y-m-d h:i:sa");
                          $datetime1 = new DateTime($tmt_awal);//start time
                          $datetime2 = new DateTime($date_now);//end time
                          $durasi = $datetime1->diff($datetime2);
                          echo $durasi->format('%y Tahun %m Bulan');
                          //echo $Data->tanggal_mulai_pangkat; 
                      ?>
                  </td>
              </tr>
              <tr>
                  <td>Digaji menurut</td>
                  <td>:</td>
                  <td><?php echo $Data_tunjangan->Digaji_menurut; ?></td>
              </tr>
              <tr>
                  <td>Alamat / tempat tinggal</td>
                  <td>:</td>
                  <td><?php echo $Data->alamat; ?></td>
              </tr>
              <tr>
                  <td colspan='3'>&nbsp;</td>
              </tr>
              <tr>
                  <td colspan='3'>Menerangkan dengan sesungguhnya bahwa saya mempunyai susunan keluarga sebagai berikut:</td>
              </tr>
              
          </table>
          <br>
          <!-- end right -->

          <table border="1" class='wbo2' width='99%' cellspacing="0" cellpadding="3">
              <tr>
                  <td rowspan='2' style="width: 10px"><b>No</b></td>
                  <td align="center" rowspan='2'><b>NAMA ISTRI / SUAMI / ANAK TANGGUNGAN</b></td>
                  <td align="center" rowspan='2'><b>TEMPAT LAHIR</b></td>
                  <td align="center" colspan='2'><b>TANGGAL</b></td>
                  <td align="center" rowspan='2'><b>PEKERJAAN / NIP / NIK / SEKOLAH</b></td>
                  <td align="center" rowspan='2'><b>KETERANGAN (SUAMI / ISTRI / ANAK KANDUNG)</b></td>
                  <td align="center" rowspan='2'><b>MENDAPATKAN PEMBAYARAN TUNJANGAN( √ )</b></td>
              </tr>
              <tr>
                  <td><b>LAHIR</b></td>
                  <td><b>PERKAWINAN</b></td>
              </tr>
              <tbody>
                <?php 
                  $no=0;
                  $tgl_nikah = '';$tgl_lahir = '';
                  foreach($Data_tunjangan_komp as $list) { $no++ ?>
                  <tr>
                  <td style="width: 10px"><?php echo $no; ?></td>
                  <td><?php echo $list->nama_anggota_keluarga; ?></td>
                  <td><?php echo $list->tempat_lahir; ?></td>
                  <td><?php echo isset($list->tanggal_lahir_keluarga) ? date_format(date_create($list->tanggal_lahir_keluarga),"d/m/Y") : ''; ?></td>
                  <td><?php echo isset($list->tanggal_nikah) ? date_format(date_create($list->tanggal_nikah),"d/m/Y") : ''; ?></td>
                  <td><?php echo $list->pekerjaan_sekolah; ?></td>
                  <td><?php echo $list->uraian; ?></td>
                  <td align='center'>√</td>
                
              </tr>
              <?php } ?>
                  </tbody>
          </table>
          <br>
          <table class='wbo' width='90%' cellspacing="0" cellpadding="3">
              <tr>
                  <td colspan='3'>
                  Keterangan ini saya buat dengan sesungguhnya dan apabila keterangan ini ternyata <b>tidak benar (palsu), saya bersedia dituntut dimuka pengadilan berdasarkan Undang-undang yang berlaku, dan bersedia mengembalikan semua penghasilan yang telah saya terima yang seharusnya bukan menjadi hak saya.</b>
                  </td>
              </tr>
          </table>
          <br><br><br>

<div class="row">
  <div class="column" style="width:40%;">
    <img class="image_sign" src="<?php echo $signature; ?>">
    <p style="position:absulute;z-index:21 !important;margin-top:-150px;">
      Mengetahui :<br>
      <?php echo $ket_ttd ?><br><br><br><br>
      
      <?php echo (isset($penandatangan->nama_pegawai) ? ucwords(strtolower($penandatangan->nama_pegawai)) : ''); ?><br>
      NIP. <?php echo (isset($penandatangan->nip) ? $penandatangan->nip : ''); ?><br><br>
      <img class="image1" src="<?php echo $stamp; ?>"><br>
      
    </p>
  </div>
  <div class="column" style="width:15%;"></div>
  <div class="column" style="width:40%;">
  <img class="image_sign_pegawai" src="<?php echo $signature_pegawai; ?>">
  <p style="position:absulute;z-index:21 !important;margin-top:-140px;padding-top:15px;">
    Jakarta,&nbsp;<?php echo $Tanggal_indo; ?><br>
    Pegawai yang Bersangkutan,<br><br><br><br><br>

    <?php echo (isset($Data->nama_pegawai) ? ucwords(strtolower($Data->nama_pegawai)) : ''); ?><br>
    NIP. <?php echo (isset($Data->nip) ? $Data->nip : ''); ?><br>
    </p>
    
  </div>
</div>