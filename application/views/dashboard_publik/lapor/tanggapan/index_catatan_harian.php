<?php
$Gid				= $this->session->userdata('ses_Gid');
$user_type		= $this->session->userdata('ses_user_type');
$E2Nama    	= $this->session->userdata('ses_unite2');
$E3Nama    	  = $this->session->userdata('ses_unite3');
$E4Nama    	  = $this->session->userdata('ses_unite4');
$FingerBadgeNumber    = $this->session->userdata('ses_FingerBadgeNumber');
#hak_akses
if ($user_type == 'admin') {
	#gid admin
	if ($Gid == '1') {
		$de_2 = '';
		$peg = '';
	} else {
		$de_2 = 'avoid-clicks';
		$peg = '';
	}
} else if ($user_type == 'pegawai') {
	$de_2 = 'avoid-clicks';
	$peg = 'avoid-clicks';
} else { #end user_type
	$de_2 = 'avoid-clicks';
	$peg = 'avoid-clicks';
} #end user_type
?>

<section class="content-header">
	<h1>
		Laporan harian
		<small>Lingkungan Hidup & Kehutanan</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('i/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Laporan harian</a></li>
	</ol>
</section>

<!-- PAGE CONTENT BEGINS -->
<div class="row no-print">
	<div class="col-xs-12">
		<div class="box no-print">
			<table class='table borderless no-print'>
				<tr>
					<td>
						<select id="filter_unite2" onchange="get_pegawai()" class="form-control input-sm <?php echo $de_2; ?>">
							<option value="">[Pilih Satker]</option>
							<?php
							foreach ($this->db->query("SELECT * from unite2 order by E2Kode;")->result() as $d) {
								echo '<option value="' . $d->E2Nama . '"';
								if ($E2Nama == $d->E2Nama) {
									echo " selected";
								}
								echo '>' . $d->E2Nama . '</option>';
							}
							?>
						</select>
						<input type='hidden' value='<?php echo $E3Nama; ?>' id='filter_unite3'>
						<input type='hidden' value='<?php echo $E4Nama; ?>' id='filter_unite4'>
					</td>

					<td>
						<select id="filter_pegawai" class="selectpicker form-control input-sm <?php echo $peg; ?>" data-style="btn btn-primary btn-sm" data-show-subtext='true' data-live-search='true' style="padding: 0px 0px !important;">
							<option value="">[Pilih Pegawai]</option>
						</select>
					</td>

					<td>
						<select id="filter_tahun" class="form-control input-sm">
							<?php $tahun = date('Y');
							foreach ($this->db->query("SELECT * from master_tahun order by Tahun;")->result() as $d) {
								echo '<option value="' . $d->Tahun . '"';
								if ($tahun == $d->Tahun) {
									echo " selected";
								}
								echo '>' . $d->Tahun . '</option>';
							}
							?>
						</select>
					</td>

					<td>
						<select id="filter_bulan" class="form-control input-sm">

							<?php $bulan = date('m');
							foreach ($this->db->query("SELECT * from master_bulan order by Kode ASC;")->result() as $d) {
								echo '<option value="' . $d->Kode . '"';
								if ($bulan == $d->Kode) {
									echo " selected";
								}
								echo '>' . $d->Bulan . '</option>';
							}
							?>
						</select>
					</td>

					<td>
						<button class="btn btn-sm btn-primary" id="fillet_btn" onclick="filter()"><i class="fa fa-filter"></i> Filter</button>
						<button class="btn btn-sm btn-primary" id="fillet_btn" onclick="reload_table()"><i class="fa fa-refresh"></i></button>
						<!-- <button class="btn btn-sm btn-primary" id="print_pdf" onclick="printPDaF()"><i class="fa fa-filter"></i> PrintPDF</button> -->
					</td>
				</tr>
			</table>
		</div>

	</div><!-- /.col -->
</div><!-- /.row -->
<div id="ajax_table"></div>
<script type="text/javascript">
	$(document).ready(function() {

		var unite2 = $('#filter_unite2').val();
		var unite3 = $('#filter_unite3').val();
		var unite4 = $('#filter_unite4').val();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('i/getdata/Getpegawai/getpegawai_all') ?>",
			data: "unite2=" + unite2 + "&FingerBadgeNumber=" + '<?php echo $FingerBadgeNumber; ?>' + "&unite3=" + unite3 + "&unite4=" + unite4,
			beforeSend: function(f) {
				$("select#filter_pegawai").html('<option>Loading...</option>');
				$('select#filter_pegawai').val(f).trigger("change");
			},
			success: function(data) {
				$('select#filter_pegawai').html(data);
				$("#filter_pegawai").selectpicker('refresh').empty().append(data).selectpicker('refresh').trigger('change');
				filter();
			}
		});

		$('#filter_unite2').change(function() {
			var unite2 = $('#filter_unite2').val();
			var unite3 = $('#filter_unite3').val();
			var unite4 = $('#filter_unite4').val();
			var FingerBadgeNumber = $('#filter_pegawai').val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('i/getdata/Getpegawai/getpegawai_all') ?>",
				data: "unite2=" + unite2 + "&FingerBadgeNumber=" + FingerBadgeNumber + "&unite3=" + unite3 + "&unite4=" + unite4,
				beforeSend: function(f) {
					$("select#filter_pegawai").html('<option>Loading...</option>');
					$('select#filter_pegawai').val(f).trigger("change");
				},
				success: function(data) {
					$('select#filter_pegawai').html(data);
					$('select#filter_pegawai').val(data).trigger("change");
					$('#filter_pegawai').selectpicker('refresh');
				}
			});
		});

	});
</script>
<script type="text/javascript">
	var unite2 = $("#filter_unite2").val();
	var unite3 = $("#filter_unite3").val();
	var unite4 = $("#filter_unite4").val();
	var pegawai = $("#filter_pegawai").val();
	var tahun = $("#filter_tahun").val();
	var bulan = $("#filter_bulan").val();

	if (pegawai == '') {

	} else {
		$.ajax({
			type: "POST",
			data: {
				unite2: unite2,
				unite3: unite3,
				unite4: unite4,
				pegawai: pegawai,
				tahun: tahun,
				bulan: bulan
			},
			url: "<?php echo site_url('i/laporan_harian/Laporan_harian/filter') ?>",
			beforeSend: function(f) {
				var percentVal = '<img src="<?php echo base_url("ws_assets/img/loading.gif"); ?>" style="width:3em;position:fixed;">';
				$('#ajax_table').html(percentVal);
			},
			success: function(data) {
				$('#ajax_table').html(data);
			}
		});
	}

	function filter() {
		var unite2 = $("#filter_unite2").val();
		var unite3 = $("#filter_unite3").val();
		var unite4 = $("#filter_unite4").val();
		var pegawai = $("#filter_pegawai").val();
		var tahun = $("#filter_tahun").val();
		var bulan = $("#filter_bulan").val();
		if (pegawai == '') {

		} else {
			$.ajax({
				type: "POST",
				data: {
					unite2: unite2,
					unite3: unite3,
					unite4: unite4,
					pegawai: pegawai,
					tahun: tahun,
					bulan: bulan
				},
				url: "<?php echo site_url('i/laporan_harian/Laporan_harian/filter') ?>",
				beforeSend: function(f) {
					var percentVal = '<img src="<?php echo base_url("ws_assets/img/loading.gif"); ?>" style="width:3em;position:fixed;">';
					$('#ajax_table').html(percentVal);
				},
				success: function(data) {
					$('#ajax_table').html(data);
				}
			});
		}
	}

	function reload_table() {
		table.ajax.reload(null, false); //reload datatable ajax 
	}

	function getcatatan(Id) {
		$.ajax({
			type: "post",
			data: {
				Id
			},
			url: "<?php echo site_url('i/laporan_harian/Laporan_harian/modal_laporan_harian'); ?>",
			beforeSend: function(s) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
			},
			success: function(data) {
				$('#modal_all .modal-dialog').addClass('modalan');
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$("#modal_all .modal-title").text("Buat Laporan Harian");
		$("#modal_all .modal-footer").addClass("hidden");

		$('#modal_all').modal('show'); // show bootstrap modal
		$('#modal_all').modal({
			backdrop: false,
			keyboard: true
		});
	}
</script>