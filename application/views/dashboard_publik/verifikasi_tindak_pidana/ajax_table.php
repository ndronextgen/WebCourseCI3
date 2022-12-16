<!-- <section id="data-hukuman" class="content"> -->
<div class="callout callout-info">
	<h4>Verifikasi Tindak Pidana</h4>
	<p>Fasilitas Untuk melakukan Verifikasi Surat Tindak Pidana</p>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<div class="tab-content">
				<div class="page-header">
					<h4># Data Permintaan Verifikasi</h4>
				</div>
				<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
				<hr>
				<div class='table-responsive'>
					<table id="table_verifikasi_tindak_pidana" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width='1px'>No</th>
								<th width='80px' style="text-align: center;">Aksi</th>
								<th>Nama Pegawai</th>
								<th>Status</th>
								<th style="text-align: center;">Tanggal Dibuat</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
<!-- </section> -->

<script type="text/javascript">
	tableVerifikasi = $('#table_verifikasi_tindak_pidana').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('Verifikasi_tindak_pidana/table_data_verifikasi_tindak_pidana') ?>",
			"type": "POST"
		},
		"columnDefs": [{
			"targets": [-0],
			"orderable": false,
		}],
		fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[6] == "21" || aData[6] == "22") {
				/*mapping*/
				$("td:eq(0)", nRow).css('font-weight', 'bold');
				$("td:eq(1)", nRow).css('font-weight', 'bold');
				$("td:eq(2)", nRow).css('font-weight', 'bold');
				$(nRow).css('background-color', '#f7f7cd');
			}
		},

	});

	function form_verifikasi_tindak_pidana_kep(Id) {
		$.ajax({
			url: "<?php echo site_url('Verifikasi_tindak_pidana/form_verifikasi_tindak_pidana_kep'); ?>",
			data: {
				Id: Id
			},
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Verifikasi Surat Tindak Pidana'); // Set Title to Bootstrap modal title
	}
</script>