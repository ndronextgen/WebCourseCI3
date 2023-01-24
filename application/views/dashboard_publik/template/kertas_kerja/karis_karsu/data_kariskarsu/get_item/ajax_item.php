<div class="row">
	<div class="col-md-12">
		<div class="box-body table-responsive">
			<div id='data_keluarga'></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	data_keluarga();

	function data_keluarga() {
		$.ajax({
			url: "<?php echo site_url('Kariskarsu/get_item_keluarga'); ?>",
			data: {
				Id: '<?php echo $id_pegawai; ?>',
				Kariskarsu_id: '<?php echo $Kariskarsu_id; ?>'
			},
			type: "POST",
			success: function(data) {
				$('#data_keluarga').html(data);
			}
		});
	}
</script>