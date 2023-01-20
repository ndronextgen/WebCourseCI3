<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: "d M yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
		clearBtn: true,
	});

	function add_keluarga(room='addkeluarga', param_1='', param_2='') {
		save_method = room;
		param_1 = param_1;
		param_2 = param_2;
		$('#form_keluarga')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_keluarga').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Keluarga - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title

		$('.url').remove();
		$('#arsipContentPribadi').remove();
		$('#arsipContentPribadiTitle').remove();
		$('#file_preview').html('');

		// === reset value ===
		$("#hub_keluarga").change();
		$("input[name='opt_jenis_kelamin']").each(function(i) {
			$(this).attr('disabled', false);
		});
		$("#txt_alamat").css("background-color", "");
		$('[name="param_1"]').val(param_1);
		$('[name="param_2"]').val(param_2);
	}

	function edit_keluarga(id_data_keluarga, room='update', param_1='', param_2='') {
		$('#arsipContentPribadi').remove();
		$('#arsipContentPribadiTitle').remove();
		save_method = room;
		param_1 = param_1;
		param_2 = param_2;

		$('#form_keluarga')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('.url').remove();
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('keluarga/keluarga_edit/') ?>/" + id_data_keluarga,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_data_keluarga"]').val(data.id_data_keluarga);

				$('[name="hub_keluarga"]').val(data.hub_keluarga);
				$("#hub_keluarga").change();

				$('[name="uraian"]').val(data.uraian);
				$('[name="nama_anggota_keluarga"]').val(data.nama_anggota_keluarga);
				if (data.jenis_kelamin == 1) {
					$('#jenkel_1').prop('checked', true);
				} else if (data.jenis_kelamin == 2) {
					$('#jenkel_2').prop('checked', true);
				}
				$('#jenis_kelamin').val(data.jenis_kelamin);
				$('[name="tempat_lahir_anggota_keluarga"]').val(data.tempat_lahir);
				$('[name="tanggal_lahir_keluarga"]').datepicker('update', data.tanggal_lahir_keluarga);
				$('[name="agama"]').val(data.agama);
				$('[name="agama_lainnya"]').val(data.agama_lainnya);
				if (data.alamat_sdp == 1) {
					$('[name="chk_alamat"]').prop('checked', true);
					$("#txt_alamat").css("background-color", "#dedede");
				} else {
					$("#txt_alamat").css("background-color", "");
				}
				$('[name="txt_alamat"]').val(data.alamat);
				$('[name="tempat_nikah_anggota_keluarga"]').val(data.tempat_nikah);
				$('[name="tanggal_pernikahan_keluarga"]').datepicker('update', data.tanggal_nikah);

				if (data.pns_nonpns == 1) {
					$("#opt_pns_1").prop('checked', true);
					$("#opt_pns_1").change();
				} else {
					$("#opt_pns_2").prop('checked', true);
					$("#opt_pns_2").change();
				}

				$('[name="nik_anggota_keluarga"]').val(data.nik);
				$('[name="pekerjaan_anggota_keluarga"]').val(data.pekerjaan_sekolah);
				$('[name="pangkat_golongan"]').val(data.pangkat_golongan);
				// tunjangan
				$('[name="param_1"]').val(param_1);
				$('[name="param_2"]').val(param_2);
				// end

				// if (data.hub_keluarga == '1') {
				// 	document.getElementById("grp_tanggal_nikah").style.display = "block";
				// 	document.getElementById("ket-lampiran").innerHTML = "Lampirkan AKTE NIKAH.";
				// 	document.getElementById("ket-lampiran").style.color = "red";
				// } else {
				// 	document.getElementById("grp_tanggal_nikah").style.display = "none";
				// 	document.getElementById("ket-lampiran").innerHTML = "Lampirkan file KTP/KK/AKTE LAHIR atau lainnya.";
				// 	document.getElementById("ket-lampiran").style.color = "";
				// }

				$('#modal_keluarga').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data Keluarga - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title

				//arsip handle
				if (data.arsip !== null) {
					genArsip(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsip(data) {
		$('#arsipContentPribadi').remove();
		$('#arsipContentPribadiTitle').remove();
		$('#arsipPribadi_title').val(data.title);
		// let html = '<iframe id="arsipcontentpribadi" src="<?php echo base_url(); ?>asset/upload/pribadi/pribadi_' + data.id_data_keluarga + '_' + data.id_arsip_pribadi + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>';
		// html = '<span id="arsipContentPribadiTitle">' + data.title + ' - <a href="<?php echo site_url('keluarga/download/'); ?>' + data.id_arsip_pribadi + '">' + data.file_name + '</a><br /><br />';

		// === begin: file preview ===
		let file_ext = data.file_name.split('.').pop();
		let path_file = '<?= site_url("asset/upload/pribadi/pribadi_") ?>' + data.id_data_keluarga + '_' + data.id_arsip_pribadi + '/' + data.file_name;

		$.get(path_file)
			.done(function() {
				// console.log('exist');

				let html = '';
				html = '<table class="table table-bordered table-hover" style="font-size:10px; width: 10px;">';
				html += '<tbody>';
				html += '<tr>';
				html += '<td>';
				if (file_ext.toLowerCase() == 'pdf') {
					html += '<a data-fancybox data-type="iframe" data-src="' + path_file + '" href="javascript:void(0);">';
					html += '<button type="button" class="btn btn-sm btn-danger" title="' + data.file_name_ori + '"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button>';
				} else {
					html += '<a data-fancybox="images" href="' + path_file + '" target="_blank">';
					html += '<img height="30px" src="' + path_file + '" title="' + data.file_name_ori + '">';
				}
				html += '</a>';
				html += '</td>';
				html += '</tr>';
				html += '</tbody>';
				html += '</table>';

				$('#file_preview').html(html);

			}).fail(function() {
				// console.log('not exist');
			})
	}
	// === end: file preview ===

	function reload_table_keluarga() {
		tablekeluarga.ajax.reload(null, false); //reload datatable ajax 
	}

	function savekeluarga() {
		$('#btnKeluargaSave').text('saving...'); //change button text
		$('#btnKeluargaSave').attr('disabled', true); //set button disable 
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		var url;
		if (save_method == 'addkeluarga' || save_method == 'tunjangan') {
			url = "<?php echo site_url('keluarga/keluarga_add') ?>";
		} else {
			url = "<?php echo site_url('keluarga/keluarga_update') ?>";
		}
		console.log(url);

		// ajax adding data to database
		var form = $("#form_keluarga").closest("form");
		var data = new FormData(form[0]);

		// tunjangan
		//console.log(data);
		var param_1 =data.get('param_1');
		var param_2 =data.get('param_2');
		// end tunpkangan

		$.ajax({
			url: url,
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			dataType: "JSON",
			success: function(data) {
				if (data.status) //if success close modal and reload ajax table
				{
					$('#modal_keluarga').modal('hide');
				
					swal.fire({
						icon: 'success',
						title: 'Data berhasil disimpan!',
						showConfirmButton: false,
						timer: 1500
					});
					$('#btn_verifikasi').text('Simpan');
					$('#btn_verifikasi').attr('disabled', false);
					
					if(save_method=='tunjangan' || save_method=='ubah_tunjangan'){
						get_item(param_1, param_2);
						//$('#isi_keluarga').html('');
					} else {
						reload_table_keluarga();
					}
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string

						//for arsip
						$('#' + data.inputerror[i]).addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('#' + data.inputerror[i]).next().text(data.error_string[i]); //select span help-block class set text error string
						$('#' + data.inputerror[i]).next().addClass('has-error');
					}
				}

				set_notif_to_admin('1668732869');

				$('#btnKeluargaSave').text('save'); //change button text
				$('#btnKeluargaSave').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnKeluargaSave').text('save'); //change button text
				$('#btnKeluargaSave').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_keluarga(id_data_keluarga) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('keluarga/keluarga_delete') ?>/" + id_data_keluarga,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			reload_table_keluarga();
		// 			set_notif_to_admin('1668732869');
		// 		},
		// 		error: function(jqXHR, textStatus, errorThrown) {
		// 			alert('Proses delete data error');
		// 		}
		// 	});
		// }



		let q = 'Hapus data?';
		let i = 'Data berhasil dihapus.';
		let e = 'Proses hapus data bermasalah.';

		$.confirm({
			icon: 'fa fa-warning',
			title: 'Konfirmasi',
			content: q,
			type: 'red',
			buttons: {
				yes: {
					text: 'Ya',
					btnClass: 'btn-red',
					action: function() {
						$.ajax({
							url: '<?php echo site_url("keluarga/keluarga_delete") ?>/' + id_data_keluarga,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								reload_table_keluarga();
								set_notif_to_admin('1668732869');
							},
							error: function(jqXHR, textStatus, errorThrown) {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: e,
									type: 'red',
									backgroundDismiss: true
								});
							}
						});
					}
				},
				no: {
					text: 'Tidak'
				}
			}
		})
	}
</script>

<style type="text/css">
	.ast {
		content: "\002A";
	}
</style>

<!-- <div class="modal in" id="modal_keluarga" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-backdrop in"></div> -->

<div class="modal fade" id="modal_keluarga" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Keluarga - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
				<div style="font-size: 14px; font-style: italic;" align="left">Data Istri/Suami, Anak, Ayah, Ibu atau lainnya.</div>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_keluarga" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_data_keluarga" />
					<!-- tunjangan -->
					<input type="hidden" value="" name="param_1" />
					<input type="hidden" value="" name="param_2" />
					<!-- end -->
					<div class="form-body">

						<!--<div class="form-group">
							<label class="control-label col-md-3">Hubungan Keluarga</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="hub_keluarga" id="hub_keluarga" placeholder="Hubungan Keluarga">
								<span class="help-block"></span>
							</div>
						</div>-->

						<table style="align: center; width: 100%; font-size: smaller;">
							<tr>
								<td style="width: 400px; border-right: 1px solid #dedede">

									<div class="form-group">
										<label class="control-label col-md-3">Hubungan Keluarga</label>
										<div class="col-md-9">
											<select class="select2 form-control" name="hub_keluarga" id="hub_keluarga" placeholder="Hubungan Keluarga" style="font-size: 12px; cursor: pointer;">
												<option value="0X">-- Pilih Hubungan Keluarga --</option>
												<?php
												// === master hubungan keluarga ===
												$this->db->select('kode, keterangan');
												$this->db->from('tbl_master_hubungan_keluarga');
												$this->db->order_by('no_urut');
												$rsSQL = $this->db->get();

												if ($rsSQL->num_rows() > 0) {
													$hub_kel = $rsSQL->result();
												} else {
													goto skip_hubkel;
												}

												// === gender ===
												$nrk = $this->session->userdata('username');
												$this->db->select('jenis_kelamin');
												$rsSQL = $this->db->get_where('tbl_data_pegawai', array('nrk' => $nrk));

												if ($rsSQL->num_rows()) {
													$jen_kel = $rsSQL->row()->jenis_kelamin;
												} else {
													goto skip_hubkel;
												}

												foreach ($hub_kel as $data) {
													if (strpos(strtolower($data->keterangan), 'suami') === false) {
														echo '<option value="' . $data->kode . '">';
														echo $data->keterangan;
													} else {
														if (strtolower($jen_kel) == 'laki-laki') {
															echo '<option value="' . $data->kode . '">';
															echo 'Istri';
														} elseif (strtolower($jen_kel) == 'perempuan') {
															echo '<option value="' . $data->kode . '">';
															echo 'Suami';
														} else {
															echo '<option value="' . $data->kode . '" style="background-color: red; color: white;" title="lengkapi jenis kelamin pada data pegawai!">';
															echo 'Istri / Suami (lengkapi jenis kelamin pada data pegawai!)';
														}
													};
													?>
													</option>
												<?php
												}
												skip_hubkel:
												?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Keterangan</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="uraian" id="uraian" placeholder="Istri pertama, ayah, ibu, anak tiri atau lainnya." style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Nama</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="nama_anggota_keluarga" id="nama_anggota_keluarga" placeholder="Nama" style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

									<!-- <div class="form-group">
										<label class="control-label col-md-3">Jenis Kelamin</label>
										<div class="col-md-9">
											<select name="jenis_kelamin" id="jenis_kelamin" data-placeholder="Jenis Kelamin" class="form-control" style="font-size: 12px; cursor: pointer;">
												<option value="0X">-- Pilih Jenis Kelamin --</option>
												<option value="1">Laki-Laki</option>
												<option value="2">Perempuan</option>
											</select>
											<span class="help-block"></span>
										</div>
									</div> -->

									<div class="form-group" id="grp_jenis_kelamin">
										<label class="control-label col-md-3">Jenis Kelamin</label>
										<div class="col-md-9">
											<div class="form-check form-check-inline" style="float: left;">
												<input class="form-check-input" type="radio" name="opt_jenis_kelamin" id="jenkel_1" value=1 checked style="font-size: 12px; cursor: pointer;">
												<label class="form-check-label" for="jenkel_1" style="font-size: 12px; cursor: pointer;">Laki-Laki &nbsp; &nbsp; &nbsp;</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="opt_jenis_kelamin" id="jenkel_2" value=2 style="font-size: 12px; cursor: pointer;">
												<label class="form-check-label" for="jenkel_2" style="font-size: 12px; cursor: pointer;">Perempuan</label>
											</div>
											<input type="hidden" name="jenis_kelamin" id="jenis_kelamin">
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Tempat Lahir</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="tempat_lahir_anggota_keluarga" id="tempat_lahir_anggota_keluarga" placeholder="Tempat lahir" style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Tanggal Lahir</label>
										<div class="col-md-9">
											<input type="text" class="form-control datepicker" name="tanggal_lahir_keluarga" id="tanggal_lahir_keluarga" placeholder="dd mmm yyyy" style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Agama</label>
										<div class="col-md-9">
											<select name="agama" id="agama" data-placeholder="Agama" class="form-control" style="font-size: 12px; cursor: pointer;">
												<option value="0X">-- Pilih Agama --</option>
												<?php
												// === master agama (mt_agama) ===
												$this->db->select('kode, agama');
												$this->db->from('mt_agama');
												$this->db->order_by('no_urut');
												$rsSQL = $this->db->get();

												if ($rsSQL->num_rows() > 0) {
													$rsSQL = $rsSQL->result();
													foreach ($rsSQL as $agama) {
														?>

														<!-- <option value="1">Laki-Laki</option> -->
														<!-- <option value="2">Perempuan</option> -->
														<option value=<?= $agama->kode ?>><?= $agama->agama ?></option>

												<?php
													}
												}
												?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group" id="grp_agama_lainnya" hidden>
										<label class="control-label col-md-3">Agama Lainnya</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="agama_lainnya" id="agama_lainnya" placeholder="Agama Lainnya" style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

								</td>
								<td style="width: 450px;">

									<div class="form-group" id="grp_alamat">
										<label class="control-label col-md-3">Alamat</label>
										<?php
										// === get alamat pegawai ===
										$nrk = $this->session->userdata('username');
										$this->db->select('alamat');
										$rsSQL = $this->db->get_where('tbl_data_pegawai', array('nrk' => $nrk));

										if ($rsSQL->num_rows() > 0) {
											$alamat_pegawai = $rsSQL->row()->alamat;
										} else {
											$alamat_pegawai = "";
										}
										?>

										<div class="col-md-9">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value=1 name="chk_alamat" id="chk_alamat" style="font-size: 12px; cursor: pointer;">
												<label class="form-check-label" for="chk_alamat" style="font-size: 12px; cursor: pointer; color: #a5a5a5;">
													Sama dengan pegawai
												</label>
											</div>
											<div class="form-floating">
												<textarea class="form-control" placeholder="Alamat" name="txt_alamat" id="txt_alamat" style="font-size: 12px;"></textarea>
												<span class="help-block"></span>
											</div>
										</div>
									</div>

									<div class="form-group" id="grp_tempat_nikah">
										<label class="control-label col-md-3">Tempat Nikah</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="tempat_nikah_anggota_keluarga" id="tempat_nikah_anggota_keluarga" placeholder="Tempat Nikah" style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group" id="grp_tanggal_nikah">
										<label class="control-label col-md-3">Tanggal Nikah</label>
										<div class="col-md-9">
											<input type="text" class="form-control datepicker" name="tanggal_pernikahan_keluarga" id="tanggal_pernikahan_keluarga" placeholder="dd mmm yyyy" style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group" id="grp_opt_pns">
										<label class="control-label col-md-3">PNS / Non-PNS</label>
										<div class="col-md-9">
											<div class="form-check form-check-inline" style="float: left;">
												<input class="form-check-input" type="radio" name="opt_pns" id="opt_pns_1" value=1 style="font-size: 12px; cursor: pointer;">
												<label class="form-check-label" for="opt_pns_1" style="font-size: 12px; cursor: pointer;">PNS &nbsp; &nbsp; &nbsp;</label>
											</div>
											<div class="form-check form-check-inline" style="float: left;">
												<input class="form-check-input" type="radio" name="opt_pns" id="opt_pns_2" value=2 style="font-size: 12px; cursor: pointer;">
												<label class="form-check-label" for="opt_pns_2" style="font-size: 12px; cursor: pointer;">Non-PNS</label>
											</div>
										</div>
									</div>

									<div class="form-group" id="grp_nik">
										<label class="control-label col-md-3" id="lbl_nik">NIK</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="nik_anggota_keluarga" id="nik_anggota_keluarga" placeholder="NIK" style="font-size: 12px;" maxlength="20">
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group" id="grp_pekerjaan">
										<label class="control-label col-md-3" id="lbl_pekerjaan">Pekerjaan / Sekolah</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="pekerjaan_anggota_keluarga" id="pekerjaan_anggota_keluarga" placeholder="Pekerjaan / Sekolah (Isi jika ada)" style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group" id="grp_pangkat_golongan">
										<label class="control-label col-md-3">Pangkat / Golongan Ruang</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="pangkat_golongan" id="pangkat_golongan" placeholder="Pangkat / Golongan Ruang" style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

								</td>
							</tr>

							<tr>
								<td colspan="2">

									<div class="col-md-12">
										<fieldset>
											<legend>Lampiran
												<div id="ket-lampiran" style=" font-size: 14px; font-style: italic;">Lampirkan file KTP/KK/AKTE LAHIR atau lainnya.</div>
											</legend>
										</fieldset>
									</div>

								</td>
							</tr>

							<tr>
								<td>

									<div class="form-group">
										<label class="control-label col-md-3" id='lbl_nama_file'>Nama File</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="arsipPribadi_title" id="arsipPribadi_title" placeholder="Input nama file yang di-upload." style="font-size: 12px;">
											<span class="help-block"></span>
										</div>
									</div>

								</td>
								<td>

									<div class="form-group">
										<label class="control-label col-md-3" id='lbl_upload_file'>Upload File</label>
										<div class="col-md-9">
											<div id="file_preview" style="float: left; padding-right: 10px;"></div>
											<input type="file" name="arsipPribadi_file" id="arsipPribadi_file" class="form-control" style="font-size: 12px; width: 210px;">
											<span class="help-block"></span>
											<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
										</div>
									</div>

								</td>
							</tr>

						</table>

					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="submit" id="btnKeluargaSave" onclick="savekeluarga()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	// === select option "hubungan keluarga" onchange ===
	$("#hub_keluarga").change(function() {
		const jenKel0 = '<?= $jen_kel ?>';
		const jenKel = jenKel0.toLowerCase();

		const hubKel = $('#hub_keluarga').find(":selected").val();

		if (hubKel == '1') {
			if (jenKel == 'laki-laki') {
				$("#jenkel_2").prop("checked", true);
				$('#jenis_kelamin').val(2);
				$("input[name='opt_jenis_kelamin']").each(function(i) {
					$(this).attr('disabled', true);
				});
			} else if (jenKel == 'perempuan') {
				$("#jenkel_1").prop("checked", true);
				$('#jenis_kelamin').val(1);
				$("input[name='opt_jenis_kelamin']").each(function(i) {
					$(this).attr('disabled', true);
				});
			} else {
				$("#jenkel_1").prop("checked", false);
				$("#jenkel_2").prop("checked", false);
			}

			$("#grp_alamat").show();
			$("#grp_tempat_nikah").show();
			$("#grp_tanggal_nikah").show();
			$("#grp_opt_pns").show();
			$("#grp_nik").show();
			$("#grp_pekerjaan").show();
			$("#lbl_pekerjaan").text("Pekerjaan");
			$("#pekerjaan_anggota_keluarga").prop("placeholder", "Pekerjaan");
			$("#grp_pangkat_golongan").show();

			if ($('input[name="opt_pns"]:checked').val() !== 1) {
				$("#lbl_nik").text("NIK");
				$("#nik_anggota_keluarga").prop("placeholder", "NIK");
				$("#grp_pangkat_golongan").hide();
			}

			$("#ket-lampiran").text("Lampirkan AKTA NIKAH.");
			$("#ket-lampiran").css("color", "red");
			$("#arsipPribadi_title").val("AKTA NIKAH");
			$("#lbl_upload_file").css('color', 'red');

		} else if (hubKel == '2') {
			$("#jenkel_1").prop("checked", true);
			$('#jenis_kelamin').val(1);

			$("#grp_alamat").show();
			$("#grp_tempat_nikah").hide();
			$("#grp_tanggal_nikah").hide();
			$("#grp_opt_pns").hide();
			$("#grp_nik").show();
			$("#grp_pekerjaan").show();
			$("#lbl_pekerjaan").text("Pekerjaan / Sekolah");
			$("#pekerjaan_anggota_keluarga").prop("placeholder", "Pekerjaan / Sekolah (Isi jika ada)");
			$("#grp_pangkat_golongan").hide();

			$("#opt_pns_2").prop("checked", true);
			// if (typeof $('input[name="opt_pns"]:checked').val() == 'undefined') {
				$("#lbl_nik").text("NIK");
				$("#nik_anggota_keluarga").prop("placeholder", "NIK");
			// }

			$("#ket-lampiran").text("Lampirkan file KTP/KK/AKTE LAHIR atau lainnya.");
			$("#ket-lampiran").css("color", "");
			$("#arsipPribadi_title").val("");
			$("#lbl_upload_file").css('color', '');

		} else {
			$("#jenkel_1").prop("checked", true);
			$('#jenis_kelamin').val(1);

			$("#grp_alamat").show();
			$("#grp_tempat_nikah").hide();
			$("#grp_tanggal_nikah").hide();
			$("#grp_opt_pns").hide();
			$("#grp_nik").hide();
			$("#grp_pekerjaan").hide();
			$("#grp_pangkat_golongan").hide();

			$("#opt_pns_2").prop("checked", true);
			// if (typeof $('input[name="opt_pns"]:checked').val() == 'undefined') {
				$("#lbl_nik").text("NIK");
				$("#nik_anggota_keluarga").prop("placeholder", "NIK");
			// }

			$("#ket-lampiran").text("Lampirkan file KTP/KK/AKTE LAHIR atau lainnya.");
			$("#ket-lampiran").css("color", "");
			$("#arsipPribadi_title").val("");
			$("#lbl_upload_file").css('color', '');
		}
	});

	$('input[type=radio][name=opt_jenis_kelamin]').change(function() {
		if (this.value == 1) { // === Laki-Laki ===
			$("#jenis_kelamin").val(1);
		} else if (this.value == 2) { // === Perempuan ===
			$("#jenis_kelamin").val(2);
		}
	});

	$("#agama").change(function() {
		const agama = $('#agama').find(":selected").val();

		if (agama == '0') {
			$('#grp_agama_lainnya').show();
		} else {
			$('#grp_agama_lainnya').hide();
		}
	});

	$("#chk_alamat").change(function() {
		if ($('#chk_alamat').is(":checked")) {
			$("#txt_alamat").prop("value", "<?= $alamat_pegawai ?>");
			$("#txt_alamat").css("background-color", "#dedede");
		} else {
			$("#txt_alamat").prop("value", "");
			$("#txt_alamat").css("background-color", "");
		}
	});

	$('input[type=radio][name=opt_pns]').change(function() {
		if (this.value == 1) { // === PNS ===
			$("#lbl_nik").text("NIP");
			$("#nik_anggota_keluarga").prop("placeholder", "NIP");
			$("#lbl_pekerjaan").text("Jabatan / Pekerjaan");
			$("#pekerjaan_anggota_keluarga").prop("placeholder", "Jabatan / Pekerjaan");
			$("#grp_pangkat_golongan").show();
		} else if (this.value == 2) { // === Non-PNS ===
			$("#lbl_nik").text("NIK");
			$("#nik_anggota_keluarga").prop("placeholder", "NIK");
			$("#lbl_pekerjaan").text("Pekerjaan");
			$("#pekerjaan_anggota_keluarga").prop("placeholder", "Pekerjaan");
			$("#grp_pangkat_golongan").hide();
		}
	});

	// === prevent keypress on specified control ===
	$(function() {
		$('#tanggal_lahir_keluarga').keypress(function(event) {
			event.preventDefault();
			return false;
		});
		$('#tanggal_pernikahan_keluarga').keypress(function(event) {
			event.preventDefault();
			return false;
		});

		$('#txt_alamat').keypress(function(event) {
			if ($('#chk_alamat').is(":checked")) {
				event.preventDefault();
				return false;
			}
		});
	});

	document.addEventListener('readystatechange', event => {
		switch (document.readyState) {
			case "complete":
				// var sel = document.getElementById('hub_keluarga');
				// sel.options[1].selected = true;
				// setTimeout(function() {
				// 	fireEvent(sel, 'change');
				// }, 100);
				// break;
		}
	});

	function fireEvent(element, event) {
		if (document.createEventObject) {
			// dispatch for IE
			var evt = document.createEventObject();
			return element.fireEvent('on' + event, evt)
		} else {
			// dispatch for firefox + others
			var evt = document.createEvent("HTMLEvents");
			evt.initEvent(event, true, true); // event type,bubbling,cancelable
			return !element.dispatchEvent(evt);
		}
	}

	$(function() {
		// === begin: numeric input only ===
		$("#nik_anggota_keluarga").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
		// === end: numeric input only ===
	})
</script>