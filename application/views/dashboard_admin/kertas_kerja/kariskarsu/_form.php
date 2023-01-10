<?php
headHtml();
headerAdmin();

?>
<div class="container">
	<?php
	judulPage();
	?>
	<!-- content page -->
	<?php if ($this->session->flashdata('msg')) { ?>
		<div class="alert alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>ERROR !!!</h4>
			<?php echo $this->session->flashdata('msg'); ?>
		</div>
	<?php } ?>

	<div class="well">
		<?php echo form_open_multipart(base_url() . 'admin/surat_hukdis/simpan', 'class="form-horizontal"'); ?>
		<section>
			<form class="form-horizontal">
				<input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo (isset($pegawai->id_pegawai) ? $pegawai->id_pegawai : 0); ?>" />
				<legend>Surat Keterangan Hukuman Disiplin untuk <?php echo $pegawai->nama_pegawai; ?></legend>

				<div class="form-group">
					<label class="form-label" for="keterangan">Keterangan</label>
				</div>

				<div class="form-group" id="divKeterangan0">
					<div class="input-group">
						<textarea name="keterangan[]" id="keterangan0" class="form-control" style="width:90%"></textarea>&nbsp;
					</div>
					<br />
				</div>
				<div class="form-group">
					<a href="javascript:void(0);" class="btn btn-primary btn-sm" id="tambah" onclick="tambah();"><i class="icon-plus icon-white"></i> Tambah</a>
				</div>
				<br /><br />
				<div class="form-group">
					<label class="form-label" for="keterangan">Surat keterangan ini dibuat untuk </label>
				</div>
				<div class="form-group">
					<div class="input-group">
						<textarea name="penutup" id="penutup" class="form-control" style="width:90%"></textarea>
					</div>
				</div>

				<br /><br />
				<div class="control-group">
					<div style="text-align:center">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<a href="<?php echo base_url(); ?>admin/surat_hukdis" class="btn">Batal<a>
					</div>
				</div>
			</form>
		</section>
	</div>
	<!-- end content page -->
	<?php
	footerPage();
	?>
</div>
<script>
	var counter = 0;

	function remove(counter) {
		$('#divKeterangan' + counter).remove();
	}

	function tambah() {
		let counterold;

		if (counter == 0) counterold = counter;
		else counterold = 0;

		counter++;

		let html = '<div class="form-group" id="divKeterangan' + counter + '">';
		html += '<div class="input-group">';
		html += '<textarea name="keterangan[]" id="keterangan' + counter + '" class="form-control" style="width:90%"></textarea>&nbsp;&nbsp;';
		html += '<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="remove(' + counter + ');" ><i class="icon-remove icon-white"></i></a>';
		html += '</div><br />';
		html += '</div>';

		$('#divKeterangan' + counterold).after(html);
	}
</script>
<?php

footerHtml();
?>