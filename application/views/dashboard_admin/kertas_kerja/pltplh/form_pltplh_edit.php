<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
<script>
	$('.selectpicker').selectpicker();
</script>

<style>
.avoid-clicks {
pointer-events: none;
background-color: #dbdbdb;
cursor: no-drop;
}
</style>
<form id="form_pltplh" name="form_pltplh" method="post">
<input type="hidden" name="id_surat_tugas_pltplh" id="id_surat_tugas_pltplh" value="<?php echo $Data->id_surat_tugas_pltplh; ?>" />
<input type="hidden" name="counterFrmSuratTugasPltPlh" id="counterFrmSuratTugasPltPlh" value="1" />
<!-- <input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo (isset($pegawai->id_pegawai) ? $pegawai->id_pegawai : 0);?>" /> -->
<!-- <input type="hidden" name="id_surat_tugas_pltplh" id="id_surat_tugas_pltplh" value="<?php echo (isset($surat->id_surat_tugas_pltplh) ? $surat->id_surat_tugas_pltplh : 0);?>" /> -->
	<div class="kt-portlet__body kt-portlet__body--fit">
	<div class="row" style='padding:0px;'>
			<div class="col-2">
				<?php 
					if($Data->type_surat=='PLH'){
						$select_plh = ' selected';
						$select_plt = '';
					} else {
						$select_plh = '';
						$select_plt = ' selected';

					}
				?>
				<div class="form-group">
					<label>Jenis Surat</label>
					<select id="type_surat" name="type_surat" class="selectpicker form-control input-sm" data-style="btn btn-primary btn-sm" data-show-subtext='false' data-live-search='false' style="padding: 0px 0px !important;"> 
					<option value='PLH' <?php echo $select_plh ?>>PLH</option>	
					<option value='PLT' <?php echo $select_plt ?>>PLT</option>
				</select>
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					<label>Pegawai (Petugas PLT/PLH)</label>
				<select id="filter_pegawai" name="filter_pegawai" class="selectpicker form-control input-sm" data-style="btn btn-primary btn-sm" data-show-subtext='true' data-live-search='true' style="padding: 0px 0px !important;"> 
					<option value=''>- Pilih Pegawai -</option>
					<?php
						foreach ($data_pegawai as $d) {
							echo "<option value='$d->id_pegawai'";
							if ($d->id_pegawai == $Data->id_pegawai) {
								echo ' selected';
							}
							echo ">$d->nama_pegawai</option>";
						}
					?>
				</select>
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Lokasi Kerja Pegawai PLT/PLH</label>
					<input type='text' id="lokasi_kerja_pltplh" name="lokasi_kerja_pltplh" value='<?php echo $Data->lokasi_kerja_pltplh ?>' class="form-control avoid-clicks">
				</div>
			</div>

		</div>
		<div class="row" style='padding:0px;'>
			<div class="col-4">
				<div class="form-group">
					<label>Pegawai Yang Berhalangan Tugas</label>
				<select id="filter_pegawai_berhalangan" name="filter_pegawai_berhalangan" class="selectpicker form-control input-sm" data-style="btn btn-primary btn-sm" data-show-subtext='true' data-live-search='true' style="padding: 0px 0px !important;"> 
					<option value=''>- Pilih Pegawai -</option>
					<?php
						foreach ($data_pegawai as $d) {
							echo "<option value='$d->id_pegawai'";
							if ($d->id_pegawai == $Data->id_pegawai_berhalangan) {
								echo ' selected';
							}
							echo ">$d->nama_pegawai</option>";
						}
					?>
				</select>
				</div>
			</div>

			<div class="col-8">
				<div class="form-group">
					<label>Lokasi Kerja Pegawai Yang Berhalangan Tugas</label>
					<input type='text' id="lokasi_kerja_berhalangan" name="lokasi_kerja_berhalangan" value='<?php echo $Data->lokasi_kerja_berhalangan; ?>' class="form-control avoid-clicks">
				</div>
			</div>

		</div>
		<div class="row" style='padding:0px;'>
			<div class="col-6">
				<div class="form-group">
					<label>Alasan Pegawai Berhalangan Tugas :</label>
					<textarea rows="2" id="alasan_pltplh" name="alasan_pltplh" class="form-control"><?php echo $Data->alasan_pltplh; ?></textarea>
				</div>
			</div>
			
			<div class="col-2">
				<div class="form-group">
					<label>Tgl. Mulai :</label>
					<input type='text' class="form-control tgl_mulai" id="tgl_mulai" name='tgl_mulai' value='<?php echo $Data->tgl_mulai; ?>'>
				</div>
			</div>

			<div class="col-2">
				<div class="form-group">
					<label>Tgl. Selesai :</label>
					<input type='text' class="form-control tgl_selesai" id="tgl_selesai" name='tgl_selesai' value='<?php echo $Data->tgl_selesai ?>'>
				</div>
			</div>
			<div class="col-2" id='lama_durasi'>
				<div class="form-group">
					<label>Lama (Hari) :</label>
					<input type='number' class="form-control avoid-clicks" id="durasi" name='durasi' value='<?php echo $Data->durasi ?>'>
				</div>
			</div>
		</div>
			<?php  
			if ($Data->tembusan!=''){
			$str = $Data->tembusan;
			$headers = explode('#|#', $str);
			foreach ($headers as $key) {
			?>
			<div class="form-group" id="frmSuratTugasPltPlh">
				<label>Tembusan:</label>
				<textarea rows="2" id="tembusan" name="tembusan[]" class="form-control"><?php echo $key; ?></textarea>
				<br>
				<a href="javascript:;" onclick="removeFrmSuratTugasPlh(this);" class="btn-sm btn btn-label-danger btn-bold">
					<i class="la la-trash-o"></i>
					Hapus
				</a>
			</div>
			<?php } 
			} ?>
			<div class="form-group" id="frmSuratTugasPltPlh">
				<label>Tembusan:</label>
				<textarea rows="2" id="tembusan" name="tembusan[]" class="form-control"></textarea>
			</div>

			<div class="form-group form-group-last row">
				<label class="col-lg-2 col-form-label"></label>
				<div class="col-lg-12">
					<a href="javascript:;" onclick="addFrmSuratTugasPltPlh(this);" class="btn btn-bold btn-sm btn-label-brand" id="btnAddSuratTugasPlh">
						<i class="la la-plus"></i> Tambah
					</a>
				</div>
			</div>
			<div class="form-group">
				<hr />
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<button type="button" id='btn_tmb' style='float:right;' class="btn btn-success  btn-sm" onclick="simpan_pengajuan()"><i class="fa fa-save"></i> Simpan</button>
					<button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form()">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script src="<?php echo base_url()?>assets_admin/plugins/duallistbox/jquery.bootstrap-duallistbox.js" type="text/javascript"></script>

	<!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url("assets_admin/sweetalert2/sweetalert2.min.css"); ?>">
    <script src="<?= base_url("assets_admin/sweetalert2/sweetalert2.min.js"); ?>"></script>

	<!-- begin script page -->
	<script src="<?php echo base_url()?>assets_admin/js/pages/custom/form/surat_tugas_pltplh.js" type="text/javascript"></script>
	<!-- end script page -->

	<script>
	$('.tgl_mulai').datepicker({
		format: 'yyyy-mm-dd'
	});
	$('.tgl_selesai').datepicker({
		format: 'yyyy-mm-dd'
	});
	//onchange
	$('#filter_pegawai').change(function() {
		var filter_pegawai = $('#filter_pegawai').val();
		$.ajax({
				type : "POST",
				url : "<?php echo site_url('admin/Data_pltplh/get_lokasi') ?>",
				data : {param:filter_pegawai},
				success: function(data) {
					$('#lokasi_kerja_pltplh').val(data);
				}
			})
	});
	$('#filter_pegawai_berhalangan').change(function() {
		var filter_pegawai_berhalangan = $('#filter_pegawai_berhalangan').val();
		$.ajax({
				type : "POST",
				url : "<?php echo site_url('admin/Data_pltplh/get_lokasi') ?>",
				data : {param:filter_pegawai_berhalangan},
				success: function(data) {
					$('#lokasi_kerja_berhalangan').val(data);
				}
			})
	});

	$('#tgl_mulai, #tgl_selesai').change(function() {
		var tgl_mulai = $('#tgl_mulai').val();
		var tgl_selesai = $('#tgl_selesai').val();
		$.ajax({
				type : "POST",
				url : "<?php echo site_url('admin/Data_pltplh/get_selisih') ?>",
				data : {tgl_mulai:tgl_mulai,tgl_selesai:tgl_selesai},
				success: function(data) {
					$('#durasi').val(data);
				}
			})
	});
	//onload
	function set_tipe(){
		var x = $("#type_surat").val();
		const targetDiv = document.getElementById("lama_durasi");
		if (x === "PLT") {
			targetDiv.style.display = "none";
		} else {
			targetDiv.style.display = "block";
		}
	}
	set_tipe();
	//onchange
	$("#type_surat").change(function () {
		set_tipe();
	});


</script>

<script type="text/javascript">
$('#prosestambahsurattugaspltplh').on('submit', function(e) {
    e.preventDefault();

    let id_pegawaipltplh = $('#id_pegawai').val();

    $.ajax({
        url: "<?= site_url('admin/Surat_tugas_pltplh/simpan') ?>",
        method: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        async: true,

        beforeSend: function(){
            Swal.fire({
                title: "Menyimpan",
                text: "Silahkan Tunggu, Proses Memakan Waktu",
                onOpen: () => {
                    Swal.showLoading()
                }
            });
        },

        complete: function(){
            Swal.fire({
                type: "success",
                title: "Berhasil",
                text: "Tambah Sukses!",
                timer: 1500,
            });

            window.location.href = `<?= site_url('admin/Surat_tugas_pltplh/detail/') ?>` + id_pegawaipltplh;

        },

    });
    return false;
});
</script>