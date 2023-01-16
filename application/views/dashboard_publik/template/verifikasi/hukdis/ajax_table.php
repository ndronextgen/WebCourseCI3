<!-- <section id="data-hukuman" class="content"> -->
<div class="callout callout-info">
	<h4>Verifikasi Surat Keterangan Hukuman Disiplin</h4>
	<p>Fasilitas Untuk melakukan Verifikasi Surat Keterangan Hukuman Disiplin</p>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<div class="tab-content">
				<!-- <div class="page-header"> -->
					<!-- <h4># Data Permintaan Verifikasi</h4> -->
				<!-- </div> -->
				<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
				<hr>
				<div class='table-responsive'>
					<table id="table_verifikasi_hukdis" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width='1px'>No</th>
								<th width='80px'>Aksi</th>
								<th>Nama Pegawai</th>
								<th>Tipe Surat</th>
								<!-- <th>Keterangan</th> -->
								<th>Status</th>
								<th>Tanggal Dibuat</th>
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
	tableVerifikasi = $('#table_verifikasi_hukdis').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('Verifikasi_hukdis/table_data_verifikasi_hukdis') ?>",
			"type": "POST"
		},
		"columnDefs": [{
			"targets": [-0],
			"orderable": false,
		}],
		"aoColumns": [{
			"sClass": "center"
		}, {
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "center"
		}, {
			"sClass": "left"
		}],
		fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[6] == "21" || aData[6] == "22") {
				/*mapping*/
				$("td:eq(0)", nRow).css('font-weight', 'bold');
				$("td:eq(1)", nRow).css('font-weight', 'bold');
				$("td:eq(2)", nRow).css('font-weight', 'bold');
				$("td:eq(3)", nRow).css('font-weight', 'bold');
				$("td:eq(4)", nRow).css('font-weight', 'bold');
				$("td:eq(5)", nRow).css('font-weight', 'bold');
				$(nRow).css('background-color', '#f7f7cd');
			}
		},

	});

	function form_verifikasi_hukdis_kep(Id) {
		$.ajax({
			url: "<?php echo site_url('Verifikasi_hukdis/form_verifikasi_hukdis_kep'); ?>",
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
		$('.modal-title').text('Form Verifikasi Surat Hukuman Disiplin'); // Set Title to Bootstrap modal title
	}
</script>