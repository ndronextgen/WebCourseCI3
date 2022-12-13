<form id="form_pengajuan" name="form_agenda" method="post" enctype="multipart/form-data">
<div class="form-group">
<div class="kt-radio-inline">
	<label class="kt-radio kt-radio--bold kt-radio--brand">
	<input type="radio" name="dec" value="2" onclick="changeStatus(2);"> Diterima
	<span></span>
	</label>
	<label class="kt-radio kt-radio--bold kt-radio--brand">
	<input type="radio" name="dec" value="1" onclick="changeStatus(1);"> Ditolak
	<span></span>
	</label>
</div>
</div>
<div class="form-group" id="divttd" style="display:none;">
	<div class="col-md-12">
		<select class="form-control" name="select_ttd" id="select_ttd">
			<option value="basah">Tanda Tangan Basah</option>
			<option value="digital">Tanda Tangan Digital</option>
		</select>
	</div>
</div>
<div class="form-group" id="divKet" style="display:none;">
	<div class="col-md-12">
		<textarea class="form-control" rows="3" id="ket" name="ket" placeholder="Alasan ditolak"></textarea>
	</div>
</div>
<br>
<hr>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<input type='hidden' name='id_surat' value='<?php echo $Id; ?>'>
			<button type="button" style='float:right;' class="btn btn-success  btn-sm" onclick="simpan_pengajuan()"><i class="fa fa-save"></i> Simpan Pengajuan</button>
			<button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form()">Batal</button>
		</div>
	</div>
</div>
</form>
