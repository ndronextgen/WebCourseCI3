<div class="row">

	<div class="col-md-6">

		<div class="form-group row">
			<label for="dasar_tugas" class="col-sm-6 col-form-label">Dasar Penugasan</label>
			<form name="form_dasar_tugas" method="post" id="form_dasar_tugas" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_dasar_tugas_lama' name='file_dasar_tugas_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_dasar_tugas">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_dasar_tugas" id="file_dasar_tugas">
				</span>
				<button type="button" title="Upload" id='btn_dasar_tugas' class="btn btn-primary btn-sm" onclick="upload_dasar_tugas()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_dasar_tugas" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_dasar_tugas" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('dasar_tugas')"><i class="fa fa-trash"></i></a>
			</form>
		</div>

		<div class="form-group row">
			<label for="tor" class="col-sm-6 col-form-label">TOR ditandatangani Ka Satker</label>
			<form name="form_tor" method="post" id="form_tor" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_tor_lama' name='file_tor_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_tor">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_tor" id="file_tor">
				</span>
				<button type="button" title="Upload" id='btn_tor' class="btn btn-primary btn-sm" onclick="upload_tor()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_tor" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_tor" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('tor')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="rab" class="col-sm-6 col-form-label">RAB ditandatangani Ka Satker</label>
			<form name="form_rab" method="post" id="form_rab" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_rab_lama' name='file_rab_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_rab">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_rab" id="file_rab">
				</span>
				<button type="button" title="Upload" id='btn_rab' class="btn btn-primary btn-sm" onclick="upload_rab()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_rab" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_rab" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('rab')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="ded" class="col-sm-6 col-form-label">DED</label>
			<form name="form_ded" method="post" id="form_ded" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_ded_lama' name='file_ded_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_ded">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_ded" id="file_ded">
				</span>
				<button type="button" title="Upload" id='btn_ded' class="btn btn-primary btn-sm" onclick="upload_ded()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_ded" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_ded" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('ded')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="lahan" class="col-sm-6 col-form-label">Kesiapan Lahan(Sertifikat atau Lainnya)</label>
			<form name="form_lahan" method="post" id="form_lahan" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_lahan_lama' name='file_lahan_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_lahan">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_lahan" id="file_lahan">
				</span>
				<button type="button" title="Upload" id='btn_lahan' class="btn btn-primary btn-sm" onclick="upload_lahan()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_lahan" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_lahan" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('lahan')"><i class="fa fa-trash"></i></a>
			</form>
		</div>

		<div class="form-group row">
			<label for="s_myc" class="col-sm-6 col-form-label">Surat Persetujuan/Rekomposisi MYC </label>
			<form name="form_s_myc" method="post" id="form_s_myc" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_s_myc_lama' name='file_s_myc_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_s_myc">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_s_myc" id="file_s_myc">
				</span>
				<button type="button" title="Upload" id='btn_s_myc' class="btn btn-primary btn-sm" onclick="upload_s_myc()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_s_myc" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_s_myc" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('s_myc')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="skma" class="col-sm-6 col-form-label">Surat Kesediaan Menerima Aset </label>
			<form name="form_skma" method="post" id="form_skma" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_skma_lama' name='file_skma_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_skma">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_skma" id="file_skma">
				</span>
				<button type="button" title="Upload" id='btn_skma' class="btn btn-primary btn-sm" onclick="upload_skma()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_skma" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_skma" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('skma')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="andalalin" class="col-sm-6 col-form-label">Andalalin</label>
			<form name="form_andalalin" method="post" id="form_andalalin" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_andalalin_lama' name='file_andalalin_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_andalalin">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_andalalin" id="file_andalalin">
				</span>
				<button type="button" title="Upload" id='btn_andalalin' class="btn btn-primary btn-sm" onclick="upload_andalalin()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_andalalin" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_andalalin" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('andalalin')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="amdal" class="col-sm-6 col-form-label">Amdal</label>
			<form name="form_amdal" method="post" id="form_amdal" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_amdal_lama' name='file_amdal_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_amdal">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_amdal" id="file_amdal">
				</span>
				<button type="button" title="Upload" id='btn_amdal' class="btn btn-primary btn-sm" onclick="upload_amdal()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_amdal" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_amdal" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('amdal')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
	</div>
	<!-- end 7 -->
	<div class="col-md-6">

		<div class="form-group row">
			<label for="imb" class="col-sm-6 col-form-label">IMB</label>
			<form name="form_imb" method="post" id="form_imb" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_imb_lama' name='file_imb_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_imb">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_imb" id="file_imb">
				</span>
				<button type="button" title="Upload" id='btn_imb' class="btn btn-primary btn-sm" onclick="upload_imb()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_imb" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_imb" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('imb')"><i class="fa fa-trash"></i></a>
			</form>
		</div>

		<div class="form-group row">
			<label for="slf" class="col-sm-6 col-form-label">SLF</label>
			<form name="form_slf" method="post" id="form_slf" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_slf_lama' name='file_slf_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_slf">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_slf" id="file_slf">
				</span>
				<button type="button" title="Upload" id='btn_slf' class="btn btn-primary btn-sm" onclick="upload_slf()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_slf" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_slf" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('slf')"><i class="fa fa-trash"></i></a>
			</form>
		</div>

		<div class="form-group row">
			<label for="ukl_upl" class="col-sm-6 col-form-label">UKL-UPL</label>
			<form name="form_ukl_upl" method="post" id="form_ukl_upl" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_ukl_upl_lama' name='file_ukl_upl_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_ukl_upl">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_ukl_upl" id="file_ukl_upl">
				</span>
				<button type="button" title="Upload" id='btn_ukl_upl' class="btn btn-primary btn-sm" onclick="upload_ukl_upl()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_ukl_upl" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_ukl_upl" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('ukl_upl')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="rkbmn" class="col-sm-6 col-form-label">RK BMN</label>
			<form name="form_rkbmn" method="post" id="form_rkbmn" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_rkbmn_lama' name='file_rkbmn_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_rkbmn">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_rkbmn" id="file_rkbmn">
				</span>
				<button type="button" title="Upload" id='btn_rkbmn' class="btn btn-primary btn-sm" onclick="upload_rkbmn()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_rkbmn" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_rkbmn" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('rkbmn')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="sipa" class="col-sm-6 col-form-label">Surat Izin Pemanfataan Air Baku</label>
			<form name="form_sipa" method="post" id="form_sipa" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_sipa_lama' name='file_sipa_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_sipa">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_sipa" id="file_sipa">
				</span>
				<button type="button" title="Upload" id='btn_sipa' class="btn btn-primary btn-sm" onclick="upload_sipa()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_sipa" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_sipa" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('sipa')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="rispam" class="col-sm-6 col-form-label">Dokumen RISPAM</label>
			<form name="form_rispam" method="post" id="form_rispam" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_rispam_lama' name='file_rispam_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_rispam">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_rispam" id="file_rispam">
				</span>
				<button type="button" title="Upload" id='btn_rispam' class="btn btn-primary btn-sm" onclick="upload_rispam()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_rispam" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_rispam" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('rispam')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="pengelola" class="col-sm-6 col-form-label">Kesiapan Lembaga Pengelola</label>
			<form name="form_pengelola" method="post" id="form_pengelola" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_pengelola_lama' name='file_pengelola_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_pengelola">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_pengelola" id="file_pengelola">
				</span>
				<button type="button" title="Upload" id='btn_pengelola' class="btn btn-primary btn-sm" onclick="upload_pengelola()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_pengelola" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_pengelola" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('LPengelola')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
		<div class="form-group row">
			<label for="lainnya" class="col-sm-6 col-form-label">Lainnya</label>
			<form name="form_lainnya" method="post" id="form_lainnya" enctype="multipart/form-data">
				<input type="hidden" id='Id' name='Id' value="<?php echo $Id; ?>">
				<input type="hidden" id='file_lainnya_lama' name='file_lainnya_lama' value="">
				<span class="btn btn-default btn-sm btn-file" id="browse_lainnya">
					<i class="fa fa-folder-close"></i> Browse <input type="file" accept=".pdf" name="file_lainnya" id="file_lainnya">
				</span>
				<button type="button" title="Upload" id='btn_lainnya' class="btn btn-primary btn-sm" onclick="upload_lainnya()"><i class="fa fa-upload"></i></button>
				<a href="" target="_blank" id="file_link_lainnya" class="btn btn-info btn-sm hidden"><i class="fa fa-save"></i></a>
				<a href="#" id="hapus_file_lainnya" title="Hapus File" class="btn btn-danger btn-sm hidden" onclick="hapus_files('lainnya')"><i class="fa fa-trash"></i></a>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		function refresh_dd_form() {
			$.ajax({
				type: "post",
				data: {
					Id: "<?php echo $Id; ?>",
				},
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/form_datadukung_show'); ?>",
				success: function(data) {
					var obj = JSON.parse(data);

					if (obj.data.lahan == '' || obj.data.lahan == null) {
						$('#file_link_lahan').addClass("hidden");
						$('#hapus_file_lahan').addClass("hidden");
						$('#btn_lahan').removeClass("hidden");
					} else {
						$('#btn_lahan').addClass("hidden");
						$('#file_link_lahan').removeClass("hidden");
						$('#file_link_lahan').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.lahan);
						$('#file_lahan_lama').val(obj.data.lahan);
						$('#hapus_file_lahan').removeClass("hidden");
					}

					if (obj.data.dasar_tugas == '' || obj.data.dasar_tugas == null) {
						$('#file_link_dasar_tugas').addClass("hidden");
						$('#hapus_file_dasar_tugas').addClass("hidden");
						$('#btn_dasar_tugas').removeClass("hidden");
					} else {
						$('#btn_dasar_tugas').addClass("hidden");
						$('#file_link_dasar_tugas').removeClass("hidden");
						$('#file_link_dasar_tugas').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.dasar_tugas);
						$('#file_dasar_tugas_lama').val(obj.data.dasar_tugas);
						$('#hapus_file_dasar_tugas').removeClass("hidden");
					}

					if (obj.data.tor == '' || obj.data.tor == null) {
						$('#file_link_tor').addClass("hidden");
						$('#hapus_file_tor').addClass("hidden");
						$('#btn_tor').removeClass("hidden");
					} else {
						$('#btn_tor').addClass("hidden");
						$('#file_link_tor').removeClass("hidden");
						$('#file_link_tor').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.tor);
						$('#file_tor_lama').val(obj.data.tor);
						$('#hapus_file_tor').removeClass("hidden");
					}
					if (obj.data.rab == '' || obj.data.rab == null) {
						$('#file_link_rab').addClass("hidden");
						$('#hapus_file_rab').addClass("hidden");
						$('#btn_rab').removeClass("hidden");
					} else {
						$('#btn_rab').addClass("hidden");
						$('#file_link_rab').removeClass("hidden");
						$('#file_link_rab').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.rab);
						$('#file_rab_lama').val(obj.data.rab);
						$('#hapus_file_rab').removeClass("hidden");
					}
					if (obj.data.ded == '' || obj.data.ded == null) {
						$('#file_link_ded').addClass("hidden");
						$('#hapus_file_ded').addClass("hidden");
						$('#btn_ded').removeClass("hidden");
					} else {
						$('#btn_ded').addClass("hidden");
						$('#file_link_ded').removeClass("hidden");
						$('#file_link_ded').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.ded);
						$('#file_ded_lama').val(obj.data.ded);
						$('#hapus_file_ded').removeClass("hidden");
					}

					if (obj.data.s_myc == '' || obj.data.s_myc == null) {
						$('#file_link_s_myc').addClass("hidden");
						$('#hapus_file_s_myc').addClass("hidden");
						$('#btn_s_myc').removeClass("hidden");
					} else {
						$('#btn_s_myc').addClass("hidden");
						$('#file_link_s_myc').removeClass("hidden");
						$('#file_link_s_myc').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.s_myc);
						$('#file_s_myc_lama').val(obj.data.s_myc);
						$('#hapus_file_s_myc').removeClass("hidden");
					}
					if (obj.data.skma == '' || obj.data.skma == null) {
						$('#file_link_skma').addClass("hidden");
						$('#hapus_file_skma').addClass("hidden");
						$('#btn_skma').removeClass("hidden");
					} else {
						$('#btn_skma').addClass("hidden");
						$('#file_link_skma').removeClass("hidden");
						$('#file_link_skma').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.skma);
						$('#file_skma_lama').val(obj.data.skma);
						$('#hapus_file_skma').removeClass("hidden");
					}

					if (obj.data.amdal == '' || obj.data.amdal == null) {
						$('#file_link_amdal').addClass("hidden");
						$('#hapus_file_amdal').addClass("hidden");
						$('#btn_amdal').removeClass("hidden");
					} else {
						$('#btn_amdal').addClass("hidden");
						$('#file_link_amdal').removeClass("hidden");
						$('#file_link_amdal').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.amdal);
						$('#file_amdal_lama').val(obj.data.amdal);
						$('#hapus_file_amdal').removeClass("hidden");
					}

					if (obj.data.andalalin == '' || obj.data.andalalin == null) {
						$('#file_link_andalalin').addClass("hidden");
						$('#hapus_file_andalalin').addClass("hidden");
						$('#btn_andalalin').removeClass("hidden");
					} else {
						$('#btn_andalalin').addClass("hidden");
						$('#file_link_andalalin').removeClass("hidden");
						$('#file_link_andalalin').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.andalalin);
						$('#file_andalalin_lama').val(obj.data.andalalin);
						$('#hapus_file_andalalin').removeClass("hidden");
					}

					if (obj.data.imb == '' || obj.data.imb == null) {
						$('#file_link_imb').addClass("hidden");
						$('#hapus_file_imb').addClass("hidden");
						$('#btn_imb').removeClass("hidden");
					} else {
						$('#btn_imb').addClass("hidden");
						$('#file_link_imb').removeClass("hidden");
						$('#file_link_imb').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.imb);
						$('#file_imb_lama').val(obj.data.imb);
						$('#hapus_file_imb').removeClass("hidden");
					}
					if (obj.data.slf == '' || obj.data.slf == null) {
						$('#file_link_slf').addClass("hidden");
						$('#hapus_file_slf').addClass("hidden");
						$('#btn_slf').removeClass("hidden");
					} else {
						$('#btn_slf').addClass("hidden");
						$('#file_link_slf').removeClass("hidden");
						$('#file_link_slf').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.slf);
						$('#file_slf_lama').val(obj.data.slf);
						$('#hapus_file_slf').removeClass("hidden");
					}

					if (obj.data.ukl_upl == '' || obj.data.ukl_upl == null) {
						$('#file_link_ukl_upl').addClass("hidden");
						$('#hapus_file_ukl_upl').addClass("hidden");
						$('#btn_ukl_upl').removeClass("hidden");
					} else {
						$('#btn_ukl_upl').addClass("hidden");
						$('#file_link_ukl_upl').removeClass("hidden");
						$('#file_link_ukl_upl').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.ukl_upl);
						$('#file_ukl_upl_lama').val(obj.data.ukl_upl);
						$('#hapus_file_ukl_upl').removeClass("hidden");
					}

					if (obj.data.rkbmn == '' || obj.data.rkbmn == null) {
						$('#file_link_rkbmn').addClass("hidden");
						$('#hapus_file_rkbmn').addClass("hidden");
						$('#btn_rkbmn').removeClass("hidden");
					} else {
						$('#btn_rkbmn').addClass("hidden");
						$('#file_link_rkbmn').removeClass("hidden");
						$('#file_link_rkbmn').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.rkbmn);
						$('#file_rkbmn_lama').val(obj.data.rkbmn);
						$('#hapus_file_rkbmn').removeClass("hidden");
					}

					if (obj.data.sipa == '' || obj.data.sipa == null) {
						$('#file_link_sipa').addClass("hidden");
						$('#hapus_file_sipa').addClass("hidden");
						$('#btn_sipa').removeClass("hidden");
					} else {
						$('#btn_sipa').addClass("hidden");
						$('#file_link_sipa').removeClass("hidden");
						$('#file_link_sipa').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.sipa);
						$('#file_sipa_lama').val(obj.data.sipa);
						$('#hapus_file_sipa').removeClass("hidden");
					}

					if (obj.data.rispam == '' || obj.data.rispam == null) {
						$('#file_link_rispam').addClass("hidden");
						$('#hapus_file_rispam').addClass("hidden");
						$('#btn_rispam').removeClass("hidden");
					} else {
						$('#btn_rispam').addClass("hidden");
						$('#file_link_rispam').removeClass("hidden");
						$('#file_link_rispam').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.rispam);
						$('#file_rispam_lama').val(obj.data.rispam);
						$('#hapus_file_rispam').removeClass("hidden");
					}

					if (obj.data.LPengelola == '' || obj.data.LPengelola == null) {
						$('#file_link_pengelola').addClass("hidden");
						$('#hapus_file_pengelola').addClass("hidden");
						$('#btn_pengelola').removeClass("hidden");
					} else {
						$('#btn_pengelola').addClass("hidden");
						$('#file_link_pengelola').removeClass("hidden");
						$('#file_link_pengelola').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.LPengelola);
						$('#file_pengelola_lama').val(obj.data.LPengelola);
						$('#hapus_file_pengelola').removeClass("hidden");
					}

					if (obj.data.lainnya == '' || obj.data.lainnya == null) {
						$('#file_link_lainnya').addClass("hidden");
						$('#hapus_file_lainnya').addClass("hidden");
						$('#btn_lainnya').removeClass("hidden");
					} else {
						$('#btn_lainnya').addClass("hidden");
						$('#file_link_lainnya').removeClass("hidden");
						$('#file_link_lainnya').attr("href", "<?php echo base_url('file_penelitian/datadukung') ?>/" + obj.data.lainnya);
						$('#file_lainnya_lama').val(obj.data.lainnya);
						$('#hapus_file_lainnya').removeClass("hidden");
					}


					// --

				}
			});
		}
		refresh_dd_form()

		function upload_dasar_tugas() {
			var formData = new FormData($('#form_dasar_tugas')[0]);
			formData.append('dasar_tugas', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_dasar_tugas'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_tor() {
			// dasar tugas
			var formData = new FormData($('#form_tor')[0]);
			formData.append('tor', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_tor'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_rab() {
			// dasar tugas
			var formData = new FormData($('#form_rab')[0]);
			formData.append('tor', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_rab'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_ded() {
			// dasar tugas
			var formData = new FormData($('#form_ded')[0]);
			formData.append('ded', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_ded'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_lahan() {
			// lahan
			var formData = new FormData($('#form_lahan')[0]);
			formData.append('file_lahan', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_lahan'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_s_myc() {
			// dasar tugas
			var formData = new FormData($('#form_s_myc')[0]);
			formData.append('s_myc', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_s_myc'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_skma() {
			// dasar tugas
			var formData = new FormData($('#form_skma')[0]);
			formData.append('skma', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_skma'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_amdal() {
			// dasar tugas
			var formData = new FormData($('#form_amdal')[0]);
			formData.append('amdal', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_amdal'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_andalalin() {
			// dasar tugas
			var formData = new FormData($('#form_andalalin')[0]);
			formData.append('andalalin', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_andalalin'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_imb() {
			// dasar tugas
			var formData = new FormData($('#form_imb')[0]);
			formData.append('imb', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_imb'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_slf() {
			// dasar tugas
			var formData = new FormData($('#form_slf')[0]);
			formData.append('slf', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_slf'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_ukl_upl() {
			// dasar tugas
			var formData = new FormData($('#form_ukl_upl')[0]);
			formData.append('ukl_upl', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_ukl_upl'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_rkbmn() {
			// dasar tugas
			var formData = new FormData($('#form_rkbmn')[0]);
			formData.append('rkbmn', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_rkbmn'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_sipa() {
			// dasar tugas
			var formData = new FormData($('#form_sipa')[0]);
			formData.append('sipa', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_sipa'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_rispam() {
			// dasar tugas
			var formData = new FormData($('#form_rispam')[0]);
			formData.append('rispam', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_rispam'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_pengelola() {
			// dasar tugas
			var formData = new FormData($('#form_pengelola')[0]);
			formData.append('pengelola', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_pengelola'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}

		function upload_lainnya() {
			// dasar tugas
			var formData = new FormData($('#form_lainnya')[0]);
			formData.append('lainnya', $('input[type=file]')[0].files[0]);
			$.ajax({
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/upload_lainnya'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response);
					refresh_dd_form();
				}
			});
		}
		// hapus
		function hapus_files(par) {
			var Id = $('#Id').val();
			var lahan = $('#lahan').val();
			var i = "Hapus File ?";
			var b = "File Dihapus";
			if (!confirm(i)) return false;
			$.ajax({
				type: "post",
				data: {
					Id: Id,
					par: par
				},
				url: "<?php echo site_url('rkakl/modul_rkakl/Worksheet/hapus_files'); ?>",
				success: function(s) {
					alert(b);
					refresh_dd_form();
				}
			});
		}
	</script>