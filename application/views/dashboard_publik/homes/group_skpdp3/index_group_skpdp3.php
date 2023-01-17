<style type="text/css">
	.left {
		text-align: left;
	}

	.center {
		text-align: center;
	}
</style>

<!-- <section id="group-pendidikan" class="content"> -->
<div class="callout callout-info">
	<h4>SKP/DP3</h4>
	<p>Berisi data SKP/DP3. Silahkan dilengkapi.</p>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#data_skp" data-toggle="tab" onclick="skpdp3('data_skp')"><i class="fa fa-angle-double-right"></i> Data SKP</a></li>
				<li class=""><a href="#datadp3" data-toggle="tab" onclick="skpdp3('data_dp3')"><i class="fa fa-angle-double-right"></i> Data DP3</a></li>
			</ul>
			<!-- ----- -->
			<div class="tab-content">
				<div id="skpdp3_ajax" class="tab-pane active"></div>
			</div>
			<!-- ------ -->
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
<!-- </section> -->

<script type="text/javascript">
	function skpdp3(type) {
		if (type == "data_skp") {
			var urls = "<?php echo site_url('Dashboard_publik/data_skp'); ?>";
		} else if (type == "data_dp3") {
			var urls = "<?php echo site_url('Dashboard_publik/data_dp3'); ?>";
		}

		$.ajax({
			type: "POST",
			url: urls,
			beforeSend: function(b) {
				var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
				$('#skpdp3_ajax').html(percentVal);
			},
			success: function(s) {
				$('#skpdp3_ajax').html(s);
			}
		});
	}
	skpdp3('data_skp');

	function reload_table_skp() {
		tableskp.ajax.reload(null, false); //reload datatable ajax
	}

	function reload_table_dp3() {
		tabledp3.ajax.reload(null, false); //reload datatable ajax
	}
</script>