<?php

use function PHPSTORM_META\type;

headAdminHtml(); ?>

<body style="background-image: url(<?php echo base_url() . 'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
    <?php
    headerAdmin();
    ?>

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                <?php menuAdmin($menu_open); ?>

                <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                    <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                        <!-- begin Subheader -->
                        <?php headerTitle(); ?>
                        <!-- end Subheader -->

                        <?= form_open(base_url("admin/master_informasi/form/" . $model_info->id), array('id' => "form-data")); ?>
                        <!-- begin content -->
                        <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon-web"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            <?php echo $page_name; ?>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <a href="<?php echo base_url(); ?>admin/master_informasi" class="btn btn-clean btn-icon-sm">
                                                <i class="la la-long-arrow-left"></i>
                                                Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <!--begin: Search Form -->
                                    <div class="kt-form kt-form--label-right kt-margin-b-10">
                                        <?php
                                        if (validation_errors()) {
                                            echo '<div class="alert alert-warning fade show" role="alert">
												<div class="alert-icon"><i class="flaticon-warning"></i></div>
												<div class="alert-text">' . validation_errors() . '</div>
												<div class="alert-close">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true"><i class="la la-close"></i></span>
													</button>
												</div>
											</div>';
                                        }
                                        ?>
                                        <div class="row d-flex align-items-center justify-content-md-center align-items-center flex-sm-nowrap flex-wrap list-config">
                                            <div class="col-md-8">
                                                <div class="form-informasi mb-1">
                                                    <div class="form-group">
                                                        <label class="col-form-label kt-font-bolder">Judul Informasi</label>
                                                        <input class="form-control" name="title" id="title" type="text" value="<?= $model_info->title; ?>" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group mb-2 col-md-6">
                                                            <label class="col-form-label kt-font-bolder">Tanggal Awal</label>
                                                            <input class="form-control" name="tgl_mulai" id="tgl_mulai" type="date" value="<?= $model_info->tgl_mulai; ?>" />
                                                        </div>
                                                        <div class="form-group mb-2 col-md-6">
                                                            <label class="col-form-label kt-font-bolder">Tanggal Akhir</label>
                                                            <input class="form-control" name="tgl_akhir" id="tgl_akhir" type="date" value="<?= $model_info->tgl_akhir; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label kt-font-bolder">Hak Akses: </label>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th width="20%"><b>TIPE</b></th>
                                                                <th width="80%"><b>VALUE</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>PEGAWAI</td>
                                                                <td>
                                                                    <select id="list_pegawai" class="form-control" name="permission[pegawai][]" multiple="multiple" style="width: 100%">
                                                                        <?php
                                                                        if (!empty($pegawai)) :
                                                                            foreach ($pegawai as $key => $value) :
                                                                                echo "<option value='" . $value->id_pegawai . "' selected>" . $value->id_pegawai . " - " . $value->nama_pegawai . "</option>";
                                                                            endforeach;
                                                                        endif;
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>LOKASI KERJA</td>
                                                                <td>
                                                                    <select id="list_lokasi_kerja" class="form-control" name="permission[lokasi_kerja][]" multiple="multiple" style="width: 100%">
                                                                        <?php
                                                                        if (!empty($lokasi_kerja)) :
                                                                            foreach ($lokasi_kerja as $key => $value) :
                                                                                echo "<option value='" . $value->id_lokasi_kerja . "' selected>" . $value->id_lokasi_kerja . " - " . $value->lokasi_kerja . "</option>";
                                                                            endforeach;
                                                                        endif;
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>SUB LOKASI KERJA</td>
                                                                <td>
                                                                    <select id="list_sub_lokasi_kerja" class="form-control" name="permission[sub_lokasi_kerja][]" multiple="multiple" style="width: 100%">
                                                                        <?php
                                                                        if (!empty($sub_lokasi_kerja)) :
                                                                            foreach ($sub_lokasi_kerja as $key => $value) :
                                                                                echo "<option value='" . $value->id_sub_lokasi_kerja . "' selected>" . $value->id_sub_lokasi_kerja . " - " . $value->sub_lokasi_kerja . "</option>";
                                                                            endforeach;
                                                                        endif;
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end: Search Form -->
                                </div>
                                <div class="kt-portlet__foot" align="center">
                                    <div class="kt-form__actions kt-space-between"></div>
                                    <div class="row" align="center">
                                        <div class="col-lg-12" align="center">
                                            <button type="submit" class="btn btn-brand btn-saved"><i class="fa fa-save"></i> Simpan Data</button>
                                            &nbsp;
                                            <a href="<?php echo base_url(); ?>admin/master_informasi" class="btn btn-clean btn-icon-sm">
                                                <i class="flaticon2-cross"></i>
                                                Batal
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= form_close(); ?>
                        <!-- end content -->
                    </div>
                </div>
                <?php footerAdmin(); ?>
            </div>
        </div>
    </div>

    <?php scrollTop(); ?>

    <!-- begin script global -->
    <script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
    <!-- end script global -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            ("use strict");

            $("#list_pegawai").select2({
                id: "-1", // the value of the option
                placeholder: "Pilih",
                minimumInputLength: 2,
                allowClear: true,
                multiple: true,
                ajax: {
                    url: `<?= base_url("admin/master_informasi/select2_value/pegawai"); ?>`,
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }
            }).on('select2:select');

            $("#list_lokasi_kerja").select2({
                id: "-1", // the value of the option
                placeholder: "Pilih",
                minimumInputLength: 2,
                allowClear: true,
                multiple: true,
                ajax: {
                    url: `<?= base_url("admin/master_informasi/select2_value/lokasi_kerja"); ?>`,
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }
            });

            $("#list_sub_lokasi_kerja").select2({
                id: "-1", // the value of the option
                placeholder: "Pilih",
                minimumInputLength: 2,
                allowClear: true,
                multiple: true,
                ajax: {
                    url: `<?= base_url("admin/master_informasi/select2_value/sub_lokasi_kerja"); ?>`,
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }
            });

        });
    </script>
</body>