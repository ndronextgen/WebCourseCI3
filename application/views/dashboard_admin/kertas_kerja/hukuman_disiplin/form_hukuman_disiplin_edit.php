<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
<script>
	$('.selectpicker').selectpicker();
</script>
<?php
if ($user_type=='administrator' AND ($id_lokasi_kerja == '0' || $id_lokasi_kerja == '52' || $id_lokasi_kerja == '' || $id_lokasi_kerja == null)){ //admin utama
	$kond = "";
} elseif ($user_type=='administrator') { //admin lokasi
	$kond = " disabled";
} else {
	$kond = " disabled";
}
?> 
<form id="form_hukdis" name="form_hukdis" method="post">
<div class="kt-portlet__body kt-portlet__body--fit">
<div class="row" style='padding:0px;'>
	<div class="col-12">
		<div class="form-group">
			<label>Jenis Surat</label>
		<select id="Type_surat" name="Type_surat" class="selectpicker form-control input-sm" data-style="btn btn-primary btn-sm" data-show-subtext='false' data-live-search='false' style="padding: 0px 0px !important;"> 
			<?php
				foreach ($tipe_surat as $d) {
					echo "<option value='$d->id_tipe_surat_hukdis'";
					if ($d->id_tipe_surat_hukdis == $Data->Type_surat) {
						echo ' selected';
					}
					echo ">$d->name</option>";
				}
			?>
		</select>
		</div>
	</div>
	<div class="col-7">
		<div class="form-group">
			<label>Lokasi Kerja</label>
		<select id="filter_lokasi_kerja" name="filter_lokasi_kerja" class="selectpicker form-control input-sm" data-style="btn btn-primary btn-sm" data-show-subtext='true' data-live-search='true' style="padding: 0px 0px !important;" <?php echo $kond; ?>> 
			<option value=''>- Pilih Lokasi Kerja -</option>
			<?php
				foreach ($lokasi_kerja as $d) {
					echo "<option value='$d->id_lokasi_kerja'";
					if ($d->id_lokasi_kerja == $Data->lokasi_kerja_pegawai) {
						echo ' selected';
					}
					echo ">$d->lokasi_kerja</option>";
				}
			?>
		</select>
		</div>
	</div>
	<div class="col-5">
		<div class="form-group">
			<label>Pegawai</label>
			<select id="filter_pegawai" name="filter_pegawai" class="selectpicker form-control input-sm" data-style="btn btn-primary btn-sm" data-show-subtext='true' data-live-search='true' style="padding: 0px 0px !important;"> 
			<option value=''>- Pilih Pegawai -</option>
		</select>
		</div>
	</div>

</div>
<div class="col-12">
		<div id='table_info'></div>
	</div>
<div id='alasan_pindah' class="row" style='padding:0px;display:none;'>
	<div class="col-12">
		<div class="form-group">
			<label>Pindah Tugas Ke ?</label>
			<textarea name='Keterangan' id='Keterangan' class='form-control input-sm'><?php echo $Data->Keterangan; ?></textarea>
		</div>
	</div>
</div>

<hr>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<input type='hidden' name='lokasi_admin' value='<?php echo $id_lokasi_kerja; ?>'>
			<input type='hidden' name='Hukdis_id' value='<?php echo $Hukdis_id; ?>'>
			<button type="button" id='btn_tmb' style='float:right;' class="btn btn-success  btn-sm" onclick="simpan_pengajuan()"><i class="fa fa-save"></i> Simpan</button>
			<button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form()">Batal</button>
		</div>
	</div>
</div>
</div>
</form>
<script>
	//onload
	var filter_lokasi_kerja = $('#filter_lokasi_kerja').val();
	$.ajax({
			type : "POST",
			url : "<?php echo site_url('admin/Data_hukuman_disiplin/get_pegawai') ?>",
			data : {lokasi_kerja:filter_lokasi_kerja, id_pegawai: <?php echo $Data->id_pegawai; ?>},
			success: function(data) {
				$('#filter_pegawai').val(data);
				$("#filter_pegawai").selectpicker('refresh').empty().append(data).selectpicker('refresh').trigger('change');
			}
	})
	$('#filter_lokasi_kerja').change(function() {
		var filter_lokasi_kerja = $('#filter_lokasi_kerja').val();
		$.ajax({
				type : "POST",
				url : "<?php echo site_url('admin/Data_hukuman_disiplin/get_pegawai') ?>",
				data : {lokasi_kerja:filter_lokasi_kerja, id_pegawai: <?php echo $Data->id_pegawai; ?>},
				success: function(data) {
					$('#filter_pegawai').val(data);
					$("#filter_pegawai").selectpicker('refresh').empty().append(data).selectpicker('refresh').trigger('change');
				}
		})
	});
	// filter pegawai
	$('#filter_pegawai').change(function() {
		var filter_pegawai = $('#filter_pegawai').val();
		$.ajax({
				type : "POST",
				url : "<?php echo site_url('admin/Data_hukuman_disiplin/get_elm_pegawai') ?>",
				data : {filter_pegawai:filter_pegawai},
				success: function(data) {
					$('#table_info').html(data);
				}
		})
	});
</script>
<script>
    $('#Type_surat').change(function() {
        var Type_surat = $('#Type_surat').val();
        const targetDiv = document.getElementById("alasan_pindah");
        if (Type_surat == 4) {
            targetDiv.style.display = "block";
        } else {
            targetDiv.style.display = "none";
        }
    });
	// onload
	var Type_surat = $('#Type_surat').val();
	const targetDiv = document.getElementById("alasan_pindah");
	if (Type_surat == 4) {
		targetDiv.style.display = "block";
	} else {
		targetDiv.style.display = "none";
	}
</script>