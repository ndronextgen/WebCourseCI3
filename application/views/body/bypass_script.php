<script type="text/javascript">
	notify_lapor();

	function notify_lapor() {
		$.ajax({
			url: "<?php echo site_url('admin/Data_lapor/notify_lapor') ?>",
			type: "POST",
			beforeSend: function(f) {
				var loading = '';
				$('span#count_lapor').html(loading);
			},
			success: function(s) {
				// console.log(s);
				var obj = JSON.parse(s);
				$('span#count_lapor').html(obj.notify_lapor);
			}
		});
	}
</script>