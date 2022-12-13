<div class="card card-navy">
  <div class="card-body">
    <form id="frmPribadiLainnya" name="frmPribadiLainnya" method="post" enctype="multipart/form-data">
      <input type="hidden" class="form-control" name="Id" id="Id" value='<?php echo $Id; ?>'/>
      <div class="form-group form-group-last row" id="frmPribadiLainnya">
          <div class="form-group row align-items-center">
          <div class="col-md-12">
            <div class="kt-form__group--inline">
            <div class="kt-form__label">
                <label class="kt-label m-label--single">Nama File :</label>
            </div>
            <div class="kt-form__control">
              <input type="text" class="form-control" name="title_pribadi" id="title_pribadi" />
            </div>
        </div>
            <div class="d-md-none kt-margin-b-10"></div>
        </div>
          <div class="col-md-6">
          <div class="kt-form__group--inline">
              <div class="kt-form__label">
                <label class="kt-label m-label--single">Upload File :</label>
            </div>
              <div class="kt-form__control">
              <input type="file" name="file_pribadi" id="file_pribadi" class="form-control" />
            </div>
          </div>
          <div class="d-md-none kt-margin-b-10"></div>
      </div>
          <div class="col-md-12">
            <br />
           <button type="button" onclick="simpan_pribadilainnya();" class="btn btn-brand"><i class="fa fa-save"></i> Simpan Data</button>
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