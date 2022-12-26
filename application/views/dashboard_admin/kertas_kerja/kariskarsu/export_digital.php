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
  height: 100px; 
  text-align: center;
  position: relative;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
<table class='wbo' cellspacing="0" cellpadding="0" width="99%">
		<tr>
        <td width='50%'></td>
        <td align='right' colspan='3'>LAMPIRAN 1-B : SURAT EDARAN KEPALA BAKN</td>
    </tr>
    <tr>
        <td width='50%'></td>
        <td align='right'>NOMOR</td>
        <td align='right' width='1px'> : </td>
        <td align='right' width='120px'><?php echo $Data_kariskarsu->Nomor_surat; ?></td>
    </tr>
    <tr>
        <td width='50%'></td>
        <td align='right'>TANGGAL</td>
        <td align='right'> : </td>
        <td align='right'><?php echo $this->func_table->tgl_indonesia($Data_kariskarsu->Tanggal_verifikasi); ?></td>
    </tr>
    <tr>
      <td width='50%'></td>
      <td align='right' colspan='3'><hr style='width:50%; text-align:right;'></td>
    </tr>
    <tr>
      <td width='50%' align='right'></td>
      <td align='center' colspan='3'>Kepada</td>
    </tr>
    <tr>
      <td width='50%' align='right'></td>
      <td align='right' colspan='3'>Yth. Bapak Kepala Badan Kepegawaian Daerah</td>
    </tr>
    <tr>
      <td width='50%' align='right'></td>
      <td align='center' colspan='3'>di&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width='50%' align='right'></td>
      <td align='center' colspan='3'>&nbsp;&nbsp;&nbsp;&nbsp;<span style='text-decoration: underline;'>Jakarta</span></td>
    </tr>
</table>
 
          <p style='text-decoration: underline;text-align:center;margin:0; font-size:18px;'>
          <?php 
                if($Data_kariskarsu->Perkawinan_ke == '1'){ 
                    echo 'LAPORAN PERKAWINAN PERTAMA';
                } else {
                    echo 'LAPORAN PERKAWINAN JANDA / DUDA';
                }
            ?>
          </p>

          <!-- right -->
          <table class='wbo' width='90%' cellspacing="0" cellpadding="3">
            <tr>
                                <td width='1px'>1.</td>
                                <td colspan='4'>Yang bertandatangan dibawah ini:</td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>a.</td>
                                <td width='200px'>Nama Lengkap</td>
                                <td width='1px'>:</td>
                                <td><?php echo ucwords(strtolower($Data->nama_pegawai)); ?></td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>b.</td>
                                <td>NIP / Nomor Identitas</td>
                                <td>:</td>
                                <td><?php echo $Data->nip; ?></td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>c.</td>
                                <td>Pangkat / Golongan Ruang</td>
                                <td>:</td>
                                <td><?php echo ucwords(strtolower($Data->uraian)) . ' ' . $Data->golongan; ?></td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>d.</td>
                                <td>Jabatan / Pekerjaan</td>
                                <td>:</td>
                                <td><?php echo ucwords(strtolower($Data->nama_jabatan)); ?></td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>e.</td>
                                <td>Satuan Organisasi</td>
                                <td>:</td>
                                <td><?php echo str_replace('Dan','dan',ucwords(strtolower($Data->nama_lokasi_kerja))); ?></td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>f.</td>
                                <td>Instansi</td>
                                <td>:</td>
                                <td>Pemerintah Provinsi DKI Jakarta</td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>g.</td>
                                <td>Tempat / Tanggal Lahir</td>
                                <td>:</td>
                                <td><?php echo $Data->tempat_lahir . ' / ' . $this->func_table->tgl_indonesia($Data->tanggal_lahir); ?></td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>h.</td>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?php echo $Data->jenis_kelamin; ?></td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>i.</td>
                                <td>Agama</td>
                                <td>:</td>
                                <td><?php echo $Data->agama; ?></td>
                            </tr>
                            <tr>
                                <td width='1px' valign='top'>&nbsp;</td>
                                <td width='2px' valign='top'>j.</td>
                                <td valign='top'>Alamat / tempat tinggal</td>
                                <td valign='top'>:</td>
                                <td valign='top'><?php echo ucwords(strtolower($Data->alamat)); ?></td>
                            </tr>
                            <!-- <tr>
                                <td colspan='5'>&nbsp;</td>
                            </tr> -->
                            <tr>
                                <td colspan='5'>Dengan ini memberitahukan dengan hormat, bahwa saya: </td>
                            </tr>
                            <tr>
                                <td colspan='5'>
                                <table class='table no-border' cellspacing='0' cellpadding='3'>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>a.</td>
                                      <td width='200px'>Pada Tanggal</td>
                                      <td width='1px'>:</td>
                                      <td><?php echo $this->func_table->tgl_indonesia($Data_kariskarsu_komp->tanggal_nikah); ?></td>
                                  </tr>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>b.</td>
                                      <td>di</td>
                                      <td>:</td>
                                      <td><?php echo $Data_kariskarsu_komp->tempat_nikah; ?></td>
                                  </tr>

                                  <tr>
                                      <td colspan='5'>telah melangsungkan perkawinan  lagi dengan wanita / pria sebagai tersebut dibawah ini :</td>
                                  </tr>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>a.</td>
                                      <td width='200px'>Nama :</td>
                                      <td width='1px'>:</td>
                                      <td><?php echo $Data_kariskarsu_komp->nama_anggota_keluarga; ?></td>
                                  </tr>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>b.</td>
                                      <td>NIP / Nomor Identitas</td>
                                      <td>:</td>
                                      <td><?php echo $Data_kariskarsu_komp->nik; ?></td>
                                  </tr>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>c.</td>
                                      <td width='200px'>Pangkat / Golongan Ruang:</td>
                                      <td width='1px'>:</td>
                                      <td><?php echo $Data_kariskarsu_komp->pangkat_golongan; ?></td>
                                  </tr>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>d.</td>
                                      <td>Jabatan / Pekerjaan</td>
                                      <td>:</td>
                                      <td><?php echo $Data_kariskarsu_komp->pekerjaan_sekolah; ?></td>
                                  </tr>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>e.</td>
                                      <td>Tempat / Tanggal Lahir</td>
                                      <td width='1px'>:</td>
                                      <td><?php echo $Data_kariskarsu_komp->tempat_lahir. ' / ' .$this->func_table->tgl_indonesia($Data_kariskarsu_komp->tanggal_lahir_keluarga); ?></td>
                                  </tr>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>f.</td>
                                      <td>Agama</td>
                                      <td>:</td>
                                      <td><?php echo $Data_kariskarsu_komp->agama; ?></td>
                                  </tr>
                                  <tr>
                                      <td width='1px'>&nbsp;</td>
                                      <td width='2px'>g.</td>
                                      <td>Alamat</td>
                                      <td>:</td>
                                      <td><?php echo $Data_kariskarsu_komp->alamat_new; ?></td>
                                  </tr>
                              </table>
                              </td>
                            </tr>
                            <tr>
                              <td width='1px'>2.</td>
                              <td colspan='4'>Sebagai bukti bersama ini kami lampirkan :</td>
                          </tr>
                          <tr>
                              <td width='1px'>&nbsp;</td>
                              <td width='2px'>a.</td>
                              <td width='200px' colspan='3'>Salinan sah Surat Nikah / Akta Perkawinan dalam rangkap 3 ( tiga ) yang dilegalisir;</td>
                          </tr>
                          <tr>
                              <td width='1px'>&nbsp;</td>
                              <td width='2px'>b.</td>
                              <td width='200px' colspan='3'>Pas foto hitam putih isteri / suami saya ukuran 2 X 3 cm sebanyak 3 ( tiga ) lembar;</td>
                          </tr>
                          <tr>
                              <td width='1px'>&nbsp;</td>
                              <td width='2px'>c.</td>
                              <td width='200px' colspan='3'>Fotocopy Surat Kematian / Akta Cerai / Surat Keterangan Cerai rangkap 3 ( tiga ) lembar.</td>
                          </tr>

                          <tr>
                              <td width='1px'>3.</td>
                              <td colspan='4'>Berhubung dengan itu, maka  saya mengharap agar :</td>
                          </tr>
                          <tr>
                              <td width='1px'>&nbsp;</td>
                              <td width='2px'>a.</td>
                              <td width='200px' colspan='3'>Dicatat perkawinan tersebut dalam Daftar Keluarga saya;</td>
                          </tr>
                          <tr>
                              <td width='1px'>&nbsp;</td>
                              <td width='2px'>b.</td>
                              <td width='200px' colspan='3'>Diselesaikan KARIS / KARSU bagi isteri / suami saya</td>
                          </tr>

                          <tr>
                              <td width='1px'>4.</td>
                              <td colspan='4'>Demikian laporan ini saya buat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.</td>
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
      NIP. <?php echo (isset($penandatangan->nip) ? $penandatangan->nip : ''); ?><br>
      <img class="image1" src="<?php echo $stamp; ?>">
      
    </p>
  </div>
  <div class="column" style="width:15%;"></div>
  <div class="column" style="width:40%;">
  <img class="image_sign_pegawai" src="<?php echo $signature_pegawai; ?>">
  <p style="position:absulute;z-index:21 !important;margin-top:-140px;padding-top:15px;">
    Hormat Saya,<br><br><br><br><br>

    <?php echo (isset($Data->nama_pegawai) ? ucwords(strtolower($Data->nama_pegawai)) : ''); ?><br>
    NIP. <?php echo (isset($Data->nip) ? $Data->nip : ''); ?><br>
    </p>
    
  </div>
</div>