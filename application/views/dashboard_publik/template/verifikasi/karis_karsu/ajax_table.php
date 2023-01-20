<!-- <section id="data-hukuman" class="content"> -->
<div class="callout callout-info">
	<h4>Verifikasi Surat Permohonan KARIS/KARSU</h4>
	<p>Fasilitas Untuk melakukan Verifikasi Surat Permohonan KARIS/KARSU</p>
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
					<table id="table_verifikasi_kariskarsu" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="td_head" rowspan='2' style="vertical-align: middle; text-align: center;" width='0px'>No</th>
								<th class="td_head" rowspan='2' style="vertical-align: middle;" width='0px'>Aksi</th>
								<th class="td_head" rowspan='2' style="vertical-align: middle;">Nama Pegawai</th>
								<th class="td_head" rowspan='2' style="vertical-align: middle;">Perihal</th>
								<th class="td_head" rowspan='2' style="vertical-align: middle; text-align: center;" data-priority='1' width='0px'>Status</th>
								<th class="td_head" colspan='6' style="text-align: center;">File Pendukung</th>
								<th class="td_head" rowspan='2' style="vertical-align: middle;" width='0px'>Tanggal Dibuat</th>
							</tr>
							<tr>
								<th class="td_head" style="text-align: center;" width='0px'>Surat Nikah</th>
								<th class="td_head" style="text-align: center;" width='0px'>KK</th>
								<th class="td_head" style="text-align: center;" width='0px'>KTP Suami</th>
								<th class="td_head" style="text-align: center;" width='0px'>KTP Istri</th>
								<th class="td_head" style="text-align: center;" width='0px'>SK CPNS/PNS</th>
								<th class="td_head" style="text-align: center;" width='0px'>Foto</th>
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
	tableVerifikasi = $('#table_verifikasi_kariskarsu').DataTable({
		"processing": true,
		"serverSide": true,
		// "order": [],
		"ordering": false,
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('Verifikasi_kariskarsu/table_data_verifikasi_kariskarsu') ?>",
			"type": "POST"
		},
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
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "left"
		}],
		// "columnDefs": [{
		// 	"targets": [-1],
		// 	"orderable": false,
		// }],
		fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[12] == "21" || aData[11] == "22") {
				/*mapping*/
				$("td:eq(0)", nRow).css('font-weight', 'bold');
				$("td:eq(2)", nRow).css('font-weight', 'bold');
				$("td:eq(3)", nRow).css('font-weight', 'bold');
				$("td:eq(4)", nRow).css('font-weight', 'bold');
				$("td:eq(11)", nRow).css('font-weight', 'bold');
				$(nRow).css('background-color', '#f7f7cd');
			}
		},

	});

	function form_verifikasi_kariskarsu_kep(Id) {
		$.ajax({
			url: "<?php echo site_url('Verifikasi_kariskarsu/form_verifikasi_kariskarsu_kep'); ?>",
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
		$('.modal-title').text('Form Verifikasi Surat KARIS/KARSU'); // Set Title to Bootstrap modal title
	}
</script>