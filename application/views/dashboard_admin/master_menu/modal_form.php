<?= form_open(base_url("admin/master_menu/form/" . $model_info->menu_id), array("id" => "menu-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="form-group">
        <div class="row">
            <div class="col-12 col-md-12">
                <label class="col-form-label font-weight-bold">Nama Menu</label>
                <input value="<?= $model_info->menu_name; ?>" type="text" id="menu_name" name="menu_name" class="form-control" placeholder="Masukan Nama Menu" data-rule-required="true" data-msg-required="Nama Menu wajib diisi, tidak boleh kosong" />
            </div>
            <div class="col-12 col-md-6">
                <label class="col-form-label font-weight-bold">Kode Menu</label>
                <input value="<?= $model_info->menu_code; ?>" type="text" id="menu_code" name="menu_code" class="form-control" placeholder="Unik Kode Menu" />
            </div>
            <div class="col-12 col-md-6">
                <label class="col-form-label font-weight-bold">Url Menu</label>
                <input value="<?= $model_info->menu_url ? $model_info->menu_url : "#"; ?>" type="text" id="menu_url" name="menu_url" class="form-control" placeholder="Masukan Url Menu (Optional)" />
            </div>
            <div class="col-12 col-md-8">
                <label class="col-form-label font-weight-bold">Icon Menu</label>
                <input value="<?= $model_info->menu_icon; ?>" type="text" id="menu_icon" name="menu_icon" class="form-control" placeholder="Masukan Icon Menu (Optional)">
                <a href="https://fontawesome.com/v4/icons/#web-application" target="_blank" class="btn btn-ouline text-primary px-0">List Icon</a>
            </div>
            <div class="col-12 col-md-4">
                <label class="col-form-label font-weight-bold">Urutan Menu</label>
                <input value="<?= $model_info->menu_position ? $model_info->menu_position : 1; ?>" type="number" id="menu_position" name="menu_position" class="form-control" placeholder="Urutan Menu" data-rule-required="true" data-msg-required="Urutan Menu wajib diisi, tidak boleh kosong">
            </div>
            <div class="col-12 col-md-6">
                <label class="col-form-label font-weight-bold">Status</label>
                <select class="form-control" id="menu_status" name="menu_status" data-rule-required="true" data-msg-required="Status Menu wajib dipilih, tidak boleh kosong">
                    <?php
                    $selected_1 = $model_info->menu_status ? ($model_info->menu_status == '1' ? "selected" : "") : "selected";
                    $selected_0 = $model_info->menu_status == '0' ? "selected" : "";
                    ?>
                    <option value="1" <?= $selected_1 ?>>Aktif</option>
                    <option value="0" <?= $selected_0 ?>>Tidak Aktif</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="col-form-label font-weight-bold">Tipe Menu</label>
                <select class="form-control" id="menu_type" name="menu_type" data-rule-required="true" data-msg-required="Tipe Menu wajib dipilih, tidak boleh kosong">
                    <?php
                    $selected_publik = $model_info->menu_type ? ($model_info->menu_type == 'publik' ? "selected" : "") : "selected";
                    $selected_admin = $model_info->menu_type == 'admin' ? "selected" : "";
                    ?>
                    <option value="publik" <?= $selected_publik; ?>>Publik</option>
                    <option value="admin" <?= $selected_admin; ?>>Admin</option>
                </select>
            </div>
            <div class="col-12 col-md-12">
                <label class="col-form-label font-weight-bold">Induk Menu</label>
                <select class="form-control" id="menu_parent" name="menu_parent" data-rule-required="true" data-msg-required="Induk Menu wajib dipilih, tidak boleh kosong">
                    <?php
                    if (!empty($parents)) :
                        foreach ($parents->result() as $key => $value) :
                            $selected = $model_info->menu_parent == $value->menu_id ? "selected" : "";
                            if (empty($selected) && $key == '0') :
                                $selected = "selected";
                            endif;
                            echo '<option value="' . $value->menu_id . '" ' . $selected . '>' . strtoupper($value->menu_name) . '</option>';
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        console.log(AppHelper.table.reload());
        $("#menu_name").focus();
        validateForm($("#menu-form"), function(form) {
            $(form).ajaxSubmit({
                dataType: "json",
                beforeSubmit: function(data, self, options) {
                    $(form).find('[type="submit"]').attr('disabled', 'disabled');
                    $("#ajaxModalOriginalContent").removeClass('d-none').css({
                        "position": "absolute",
                        "width": "100%",
                        "background": "#ffffff29",
                        "padding-top": "50%",
                        "height": "100%"
                    });
                },
                success: function(result) {
                    if (result.success) {
                        if (result.message) {
                            appAlert.success(result.message, {
                                duration: '2000'
                            });
                        }
                        $("#ajaxModal").modal('toggle');
                        AppHelper.table.reload();
                    } else {
                        if (result.message) {
                            appAlert.error(result.message, {
                                container: '.modal-body',
                                animate: false
                            });
                        }
                    }
                    $(form).find('[type="submit"]').attr('disabled', 'disabled');
                    $("#ajaxModalOriginalContent").addClass('d-none').css({});
                }
            });
        });
    });
</script>