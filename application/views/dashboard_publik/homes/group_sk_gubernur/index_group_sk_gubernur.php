<style type="text/css">
	.left {
		text-align: left;
	}

	.center {
		text-align: center;
	}
</style>

<div class="callout callout-info">
	<h4>SK Pegawai</h4>
	<p>Berisi data riwarat pangkat, riwayat jabatan dan data Riwarat SK lainnya. Silahkan dilengkapi.</p>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#pangkat" data-toggle="tab" onclick="sk_gub('pangkat')"><i class="fa fa-angle-double-right"></i> Riwayat Pangkat</a></li>
				<li class=""><a href="#jabatan" data-toggle="tab" onclick="sk_gub('jabatan')"><i class="fa fa-angle-double-right"></i> Riwayat Jabatan</a></li>
				<li class=""><a href="#jabatan" data-toggle="tab" onclick="sk_gub('sklainnya')"><i class="fa fa-angle-double-right"></i> Riwayat SK Lainnya</a></li>
			</ul>

			<div class="tab-content">
				<div id="sk_gub_ajax" class="tab-pane active"></div>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	function sk_gub(type) {
		if (type == "pangkat") {
			var urls = "<?php echo site_url('Dashboard_publik/data_pangkat'); ?>";
		} else if (type == "jabatan") {
			var urls = "<?php echo site_url('Dashboard_publik/data_jabatan'); ?>";
		} else if (type == "sklainnya") {
			var urls = "<?php echo site_url('Dashboard_publik/data_sklainnya'); ?>";
		}

		$.ajax({
			type: "POST",
			url: urls,
			beforeSend: function(b) {
				var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
				$('#sk_gub_ajax').html(percentVal);
			},
			success: function(s) {
				$('#sk_gub_ajax').html(s);
			}
		});
	}
	sk_gub('pangkat');
</script>