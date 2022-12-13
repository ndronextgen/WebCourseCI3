<div class="card card-navy">
  <div class="card-body">
    <form id="frmSkLainnya" name="frmSkLainnya" method="post" enctype="multipart/form-data">
      <input type="hidden" class="form-control" name="id_sk" id="id_sk" value='<?php echo $Id; ?>'/>
      <div class="form-group form-group-last row" id="frmSkLainnya">
          <div class="form-group row align-items-center">
          <div class="col-md-12">
            <div class="kt-form__group--inline">
              <div class="kt-form__label">
                  <label class="kt-label m-label--single">Nama File :</label>
              </div>
              <div class="kt-form__control">
                <input type="text" class="form-control" name="title_sk" id="title_sk" value='<?php echo $data->title; ?>' />
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
              <iframe id="frame_sk" src="<?php echo base_url();?>asset/upload/SK/SK_<?php echo $data->id_jenis_sk.'_'.$data->id_ref.'_'.$data->id_arsip_sk.'/'.$data->file_name; ?>" frameborder="no" ></iframe>
            <?php } ?>
          </div>
          <!-- <div class="d-md-none kt-margin-b-10"></div> -->
      </div>
      <div class="col-md-6">
          <div class="kt-form__group--inline">
              <div class="kt-form__label">
                <label class="kt-label m-label--single">Upload File :</label>
            </div>
              <div class="kt-form__control">
              <input type="file" name="file_sk" id="file_sk" class="form-control" />
            </div>
          </div>
          <div class="d-md-none kt-margin-b-10"></div>
      </div>
          <div class="col-md-12">
            <br />
            <button type="button" onclick="simpan_sklainnya();" class="btn btn-brand"><i class="fa fa-save"></i> Simpan Data</button>
           
          </div>
          <div class="col-md-12">
            <br /><hr />
          </div>
      </div>
    </div>
  </div>
</form>
</div>