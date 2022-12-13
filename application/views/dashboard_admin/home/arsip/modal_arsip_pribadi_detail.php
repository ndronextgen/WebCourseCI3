<div class="card card-navy">
  <div class="card-body">
    <form id="frmPribadiLainnya" name="frmPribadiLainnya" method="post" enctype="multipart/form-data">
      <input type="hidden" class="form-control" name="id_pribadi" id="id_pribadi" value='<?php echo $Id; ?>'/>
      <div class="form-group form-group-last row" id="frmPribadiLainnya">
          <div class="form-group row align-items-center">
          <div class="col-md-12">
            <div class="kt-form__group--inline">
              <div class="kt-form__label">
                  <label class="kt-label m-label--single">Nama File : <b><?php echo $data->title; ?></b></label>
              </div>
              
          </div>
            <div class="d-md-none kt-margin-b-10"></div>
            <hr>
        </div>
          <div class="col-md-12">
          <div class="kt-form__group--inline">
            <?php
              if($data->file_name!=''){
            ?>
              <iframe id="frame_pribadi" src="<?php echo base_url();?>asset/upload/pribadi/pribadi_<?php echo $data->id_data_keluarga.'_'.$data->id_arsip_pribadi.'/'.$data->file_name; ?>" frameborder="no" ></iframe>
            <?php } ?>
          </div>
          <!-- <div class="d-md-none kt-margin-b-10"></div> -->
      </div>
          <div class="col-md-12">
            <br /><hr />
          </div>
      </div>
    </div>
  </div>
</form>
</div>
<script>
  function removeFrmPribadiLainnya(obj) {
    $(obj).parents().eq(2).remove();
    $("#counterFrmPribadiLainnya").val(counterFrmPribadiLainnya);
  }

</script>