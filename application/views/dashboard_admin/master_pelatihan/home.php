<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $judul_lengkap.' - '.$instansi; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/docs.css" rel="stylesheet">
	
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/application.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap-tooltip.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/colorbox/colorbox.css" />
	<script src="<?php echo base_url(); ?>asset/colorbox/jquery.colorbox.js"></script>
	<script>
		  $(document).ready(function(){
			  //Examples of how to assign the ColorBox event to elements
			  $(".small-box").colorbox({rel:'group', iframe:true, width:"700", height:"90%"});
	
		  });
	</script>
  </head>

  <body>
	
    <div class="container">
	
	<div class="well">
	  <div class="row">
		<div class="">
		  <h3><center><?php echo $judul_lengkap.'<br/> '.$instansi; ?></h3>
		</div>
		<div class="span">
		  <p><center><?php echo $alamat; ?></p>
		</div>
	  </div>
	</div>

  <div class="well">
	<div class="navbar navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">
		  <a class="brand" href="#">Master Pelatihan</a>
		  <div class="nav-collapse">
			<ul class="nav">
			  <li><a href="<?php echo base_url(); ?>admin/master_pelatihan/tambah" class="small-box"><i class="icon-plus-sign icon-white"></i> Tambah Data Pelatihan</a></li>
			</ul>
		  </div>
		<div class="span6 pull-right">
		<?php echo form_open('admin/master_pelatihan/cari','class="navbar-form pull-right"'); ?>
		  <input type="text" class="span3" name="cari" placeholder="Masukkan kata kunci pencarian">
		  <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>
		<?php echo form_close(); ?>
		</div>
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->
  
	  <section>
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Pelatihan</th>
        <th>Level</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
	<?php
		$no=$tot+1;
		foreach($status_pegawai->result_array() as $dp)
		{
	?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $dp['nama_pelatihan']; ?></td>
        <td><?php echo $dp['level']; ?></td>
		<td>
	        <div class="btn-group">
	          <a class="btn btn-small small-box" href="<?php echo base_url(); ?>admin/master_pelatihan/detail/<?php echo $dp['id_master_pelatihan']; ?>"><i class="icon-ok-circle"></i> Lihat Detail</a>
	          <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="<?php echo base_url(); ?>admin/master_pelatihan/edit/<?php echo $dp['id_master_pelatihan']; ?>" class="small-box"><i class="icon-pencil"></i> Edit Data</a></li>
	            <li><a href="<?php echo base_url(); ?>admin/master_pelatihan/hapus/<?php echo $dp['id_master_pelatihan']; ?>" onClick="return confirm('Anda yakin..???');"><i class="icon-trash"></i> Hapus Data</a></li>
	          </ul>
	        </div><!-- /btn-group -->
		</td>
      </tr>
	 <?php
	 		$no++;
	 	}
	 ?>
    </tbody>
  </table>
  
	<div class="custom-pagination pagination-centered"><?php echo $paginator; ?></div>
	
</section>
  </div>

      <footer class="well">
        <p><?php echo $credit; ?></p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
