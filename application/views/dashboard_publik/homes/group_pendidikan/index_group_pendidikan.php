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
	<h4>Pendidikan</h4>
	<p>Berisi data riwarat pendidikan Formal dan Pendidikan non-formal. Silahkan dilengkapi.</p>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#formal" data-toggle="tab" onclick="pendidikan('formal')"><i class="fa fa-angle-double-right"></i> Riwayat Pendidikan Formal</a></li>
				<li class=""><a href="#nonformal" data-toggle="tab" onclick="pendidikan('nonformal')"><i class="fa fa-angle-double-right"></i> Riwayat Pendidikan Non-Formal</a></li>
			</ul>
			<!-- ----- -->
			<div class="tab-content">
				<div id="pendidikan_ajax" class="tab-pane active"></div>
			</div>
			<!-- ------ -->
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
<!-- </section> -->

<script type="text/javascript">
	function pendidikan(type) {
		if (type == "formal") {
			var urls = "<?php echo site_url('Dashboard_publik/data_formal'); ?>";
		} else if (type == "nonformal") {
			var urls = "<?php echo site_url('Dashboard_publik/data_nonformal'); ?>";
		}

		$.ajax({
			type: "POST",
			url: urls,
			beforeSend: function(b) {
				var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
				$('#pendidikan_ajax').html(percentVal);
			},
			success: function(s) {
				$('#pendidikan_ajax').html(s);
			}
		});
	}
	pendidikan('formal');
</script>