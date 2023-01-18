<!-- arsip sk -->
<section id="data-sk" class="content">
	<div class="callout callout-info">
		<h4>Arsip Digital SK</h4>
		Masukkan Data Scan Dokumen SK (SK Gubernur, Surat Tugas, SKP dan data yang berkaitan dengan kepegawaian). Format File : gif, jpg, jpeg, png dan pdf (Max : 5 MB)
	</div>

	<?php if ($this->session->flashdata('gagalupload')) { ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>GAGAL !!!</h4>
			<?php echo $this->session->flashdata('gagalupload'); ?>
		</div>
	<?php } ?>

	<?php if ($this->session->flashdata('gagalupload2')) { ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>GAGAL !!!</h4>
			<?php echo $this->session->flashdata('gagalupload'); ?>
		</div>
	<?php } ?>

	<?php if ($this->session->flashdata('gagalupload3')) { ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>GAGAL !!!</h4>
			<?php echo $this->session->flashdata('gagalupload3'); ?>
		</div>
	<?php } ?>

	<?php if ($this->session->flashdata('gagalupload4')) { ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>GAGAL !!!</h4>
			<?php echo $this->session->flashdata('gagalupload4'); ?>
		</div>
	<?php } ?>

	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<button class="btn btn-success" onclick="add_sk()"><i class="glyphicon glyphicon-plus"></i> Tambah Data SK</button>
					<button class="btn btn-default" onclick="reload_table_sk()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
					<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="sk" data-title="Download" title="Download">
						<i class="fa fa-download"></i> Download All
					</button>
					<br /><br />

					<table id="table_sk" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Judul SK</th>
								<th>Jenis SK</th>
								<th>Nama File</th>
								<th width='80px'>File</th>
								<!--<th width='180px'>Opsi</th>-->
								<th width='120px'>Aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->
<!-- end arsip sk -->

<br>

<script type="text/javascript">
	tablesk = $('#table_sk').DataTable({
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"order": [], //Initial no order.
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": "<?php echo site_url('arsip_sk/sk_datatables') ?>",
			"type": "POST"
		},
		//Set column definition initialisation properties.
		"columnDefs": [{
			"targets": [-1], //last column
			"orderable": false, //set not orderable
		}],
		"aoColumns": [{
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}],
	});
</script>