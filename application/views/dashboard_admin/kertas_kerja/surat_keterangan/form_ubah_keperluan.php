<form id="form_ubah_keperluan" name="form_ubah_keperluan" method="post">

<div class="form-group">
	<div class="col-md-12">
	<select class="select form-control" name="jenis_pengajuan_surat" id="jenis_pengajuan_surat" onchange="onChangeJenisPengajuanSurat()" placeholder="Jenis Pengajuan Surat">
		<option value="">[Jenis Keperluan]</option>
		<?php
		foreach ($mst_jenis_pengajuan_surat as $d) {
			
			echo "<option value='$d->kode'";
			if ($d->kode == $Data->jenis_pengajuan_surat) {
				echo ' selected';
			}
			echo ">$d->keterangan</option>";
		}
		?>
	</select>
	<input type="text" class="form-control" name="jenis_pengajuan_surat_lainnya" id="jenis_pengajuan_surat_lainnya" value='<?php echo $Data->jenis_pengajuan_surat_lainnya ?>' placeholder="Jenis keperluan lainnya" />
	</div>
</div>


<br>
<hr>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<input type='hidden' name='id_surat' value='<?php echo $Id; ?>'>
			<button type="button" style='float:right;' class="btn btn-success  btn-sm" onclick="simpan_perubahan_keperluan()"><i class="fa fa-save"></i> Simpan</button>
			<button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form_md()">Batal</button>
		</div>
	</div>
</div>
</form>

<script>
	function onChangeJenisPengajuanSurat() {
		var kodeJenis = document.getElementById("jenis_pengajuan_surat").value; //alert(kodeJenis);

		if (kodeJenis.toLowerCase() == 'x') {
			document.getElementById('jenis_pengajuan_surat_lainnya').type = 'text';
		} else {
			document.getElementById('jenis_pengajuan_surat_lainnya').type = 'hidden';
		}
	}

	var kodeJenis = document.getElementById("jenis_pengajuan_surat").value;

		if (kodeJenis.toLowerCase() == 'x') {
			document.getElementById('jenis_pengajuan_surat_lainnya').type = 'text';
		} else {
			document.getElementById('jenis_pengajuan_surat_lainnya').type = 'hidden';
		}
</script>
