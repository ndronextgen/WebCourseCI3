<!-- <section id="group-pribadi" class="content"> -->
<style type="text/css">
	td {
		padding: 0 20px;
		width: auto;
		vertical-align: baseline;
	}
</style>

<div class="callout callout-info">
	<h4>Data Pribadi</h4>
	<p>Berisi data keluarga, dan data riwayat lainnya seperti KTP dll. Silahkan dilengkapi.</p>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#keluarga" data-toggle="tab" onclick="pribadi('keluarga')"><i class="fa fa-angle-double-right"></i> Data Keluarga</a></li>
				<li class=""><a href="#lainnya" data-toggle="tab" onclick="pribadi('lainnya')"><i class="fa fa-angle-double-right"></i> Data Pribadi Lainnya</a></li>
			</ul>
			<!-- ----- -->
			<div class="tab-content">
				<div id="pribadi_ajax" class="tab-pane active"></div>
			</div>
			<!-- ------ -->
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
<!-- </section> -->

<script type="text/javascript">
	function pribadi(type) {
		if (type == "keluarga") {
			var urls = "<?php echo site_url('Dashboard_publik/data_keluarga'); ?>";
		} else if (type == "lainnya") {
			var urls = "<?php echo site_url('Dashboard_publik/data_lainnya'); ?>";
		}

		$.ajax({
			type: "POST",
			url: urls,
			beforeSend: function(b) {
				var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
				$('#pribadi_ajax').html(percentVal);
			},
			success: function(s) {
				$('#pribadi_ajax').html(s);
			}
		});
	}
	pribadi('keluarga');

	function set_notif_to_admin(module_id) {
		$.ajax({
			url: '<?php echo base_url("app/set_notif_to_admin") ?>',
			type: 'post',
			data: {
				page: 1,
				module: module_id
			},
			success: function(data) {
				// alert('ok!');
			}
		})
	}
</script>