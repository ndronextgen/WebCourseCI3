<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo base_url(); ?>"><?php echo $judul_pendek; ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="<?php echo base_url(); ?>"><i class="icon-home icon-white"></i> Beranda</a></li>
			  <li class="dropdown">
			  	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-book icon-white"></i> Master <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url(); ?>admin/master_status_pegawai"><i class="icon-tag"></i> Status Pegawai</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/master_golongan"><i class="icon-random"></i> Golongan</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/master_eselon"><i class="icon-retweet"></i> Eselon</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/master_jabatan"><i class="icon-hdd"></i> Jabatan</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/master_penghargaan"><i class="icon-filter"></i> Penghargaan</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/master_hukuman"><i class="icon-briefcase"></i> Hukuman</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/master_lokasi_kerja"><i class="icon-briefcase"></i> Lokasi Kerja</a></li>
                </ul>
              </li>
			  <li class="dropdown">
			  	<a href="http://dcktrp.jakarta.go.id/e-cuti/" target="_blank" class="" data-toggle=""><i class="icon-comment icon-white"></i> Cuti Pegawai <b class=""></b></a>
              </li>
			  <li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-tasks icon-white"></i> Kertas Kerja <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					<li><a href="<?php echo base_url(); ?>admin/surat_hukdis"><i class="icon-question-sign"></i> Surat Hukdis</a></li>
            <li><a href="<?php echo base_url(); ?>admin/surat_keterangan"><i class="icon-question-sign"></i> Surat Keterangan</a></li>
				  </ul>
			  </li>
			  <li class="dropdown">
			  	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-tasks icon-white"></i> Pencarian & Laporan <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <!--<li><a href="<?php echo base_url(); ?>laporan_pegawai_unit_satuan"><i class="icon-tag"></i> Laporan Pegawai - Unit Kerja dan Satuan Kerja</a></li>-->
                  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_penempatan_kerja"><i class="icon-question-sign"></i> Laporan Pegawai - Penempatan Kerja</a></li>
				  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_status_golongan"><i class="icon-eye-open"></i> Laporan Pegawai - Golongan</a></li>
				  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_status_pegawai"><i class="icon-eye-open"></i> Laporan Pegawai - Status Pegawai</a></li>
				  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_pendidikan"><i class="icon-eye-open"></i> Laporan Pegawai - Pendidikan</a></li>
				  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_hukuman"><i class="icon-eye-open"></i> Laporan Pegawai - Hukuman</a></li>
				  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_jenis_kelamin"><i class="icon-eye-open"></i> Laporan Pegawai - Jenis Kelamin</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_ikut_pelatihan"><i class="icon-ok-sign"></i> Laporan Pegawai - Mengikuti Pelatihan</a></li> 
				  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_tugas_izin_belajar"><i class="icon-ok-sign"></i> Laporan Pegawai - Tugas & Izin Belajar</a></li> 
				  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_masa_pensiun"><i class="icon-ok-sign"></i> Laporan Pegawai - Masa Pensiun</a></li> 
				  <li><a href="<?php echo base_url(); ?>admin/laporan_pegawai_naik_pangkat"><i class="icon-ok-sign"></i> Laporan Pegawai - yang akan Naik Pangkat</a></li> 
                </ul>
              </li> 
            </ul>
            <div class="btn-group pull-right">
			  <button class="btn btn-primary"><i class="icon-user icon-white"></i> <?php echo $this->session->userdata('nama'); ?></button>
			  <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
				<li><a href="<?php echo base_url(); ?>app/change_password"><i class="icon-wrench"></i> Pengaturan Akun</a></li>
				<li><a href="<?php echo base_url(); ?>manage_user"><i class="icon-tasks"></i> Manajemen User</a></li>
				<li><a href="<?php echo base_url(); ?>app/logout"><i class="icon-off"></i> Log Out</a></li>
			  </ul>
			</div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	
