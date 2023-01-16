<!-- <section id="data-hukuman" class="content"> -->
<div class="callout callout-info">
	<h4>Verifikasi Surat Keterangan Pegawai</h4>
	<p>Fasilitas Untuk melakukan Verifikasi Surat Keterangan Pegawai</p>
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
					<table id="table_verifikasi" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="text-align: center;">No.</th>
								<th width='0px'>Aksi</th>
								<th>Jenis Surat</th>
								<th>Nama Pegawai</th>
								<th width='0px' style="text-align: center;">Status Trakhir</th>
								<th>Keperluan/Keterangan</th>
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
	tableVerifikasi = $('#table_verifikasi').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('verifikasi/table_data_verifikasi') ?>",
			"type": "POST"
		},
		"columnDefs": [{
			"targets": [-0],
			"orderable": false,
		}],
		// set column align
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
		}, {
			"sClass": "left"
		}],
		fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[7] == "21" || aData[7] == "22") {
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

	function form_verifikasi_kep(Id) {
		$.ajax({
			url: "<?php echo site_url('Verifikasi/form_verifikasi_kep'); ?>",
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
		$('.modal-title').text('Form Verkifikasi Surat Pegawai'); // Set Title to Bootstrap modal title
	}
</script>