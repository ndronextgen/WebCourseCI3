<form id="form_manage_admin" enctype="multipart/form-data">
	<?php if($type == "edit") : ?>
		<input type="hidden" name="id" value="<?= $data_admin->Id ?>" required>
	<?php endif; ?>

	<div class="row">
		<div class="col-md-12">
			<div class="box-body table-responsive">
	            <div class="card">
	                <div class="card-body">
	                    <div class="row">
	                        <div class="form-group col-12">
	                            <label class="text-white">Username</label>
	                            <input
	                            	type="text"
	                            	name="Username" class="form-control form-control-sm" id="Username"
	                            	placeholder="Username"
	                            	onkeyup="this.value=this.value.replace(/[' ']/g,'')"
	                            	minlength="3"
	                            	maxlength="255"
	                            	required
	                            	<?php if($type == "edit") : ?>
	                            		style="color: black;"
	                            		disabled
	                            		value="<?= $data_admin->Username ?>"
	                            	<?php endif; ?>
	                            >
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="form-group col-12">
	                            <label class="text-white">Password</label>
	                            <input
	                            	type="Password"
	                            	name="Password" class="form-control form-control-sm" id="Password"
	                            	minlength="3"
	                            	maxlength="255"
	                            	<?php if($type == "tambah") : ?>
	                            		required
	                            		placeholder="Password"
	                            	<?php elseif($type == "edit") : ?>
	                            		placeholder="Ketik Password Apabila ingin merubahnya"
	                            	<?php endif; ?>
	                            >
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="form-group col-12">
	                            <label class="text-white">Nama Admin</label>
	                            <input
		                            type="text"
		                            class="form-control form-control-sm" name="Nama_lengkap" id="Nama_lengkap"
		                            placeholder="Nama_lengkap"
	                            	required
	                            	minlength="3"
	                            	maxlength="255"
		                            <?php if($type == "edit") : ?>
	                            		value="<?= $data_admin->Nama_lengkap ?>"
	                            	<?php endif; ?>
		                        >
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="form-group col-4">
	                            <label class="text-white">Group Admin</label>
	                            <select name="Gid" id="Gid" class="form-control form-control-sm" style='font-size:12px;' required>
	                            	<?php foreach($Group_user as $KdGroups) : ?>
	                            		<option
	                            			value="<?= $KdGroups->Gid ?>"
	                            			<?php if($type == "edit") : ?>
	                            				<?= $KdGroups->Gid == $data_admin->Gid ? 'selected' : '' ?>
	                            			<?php endif; ?>
	                            		>
	                            			<?= $KdGroups->Namagroup ?>
	                            		</option>
	                            	<?php endforeach; ?>
	                            </select>
	                        </div>
	                    </div>

	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</form>

<div class="row" style="margin-top: 1%;">
	<div class="col-md-12">
		<div class="form-group col-6">
	    	<button type="submit" class="btn btn-success btn-block btn-sm" id="btn-proses" form="form_manage_admin">
	    		<?php if($type == "tambah") : ?>
	    			Simpan
	    		<?php elseif($type == "edit") : ?>
	    			Perbaharui
	    		<?php endif ?>
	    	</button>
	    </div>
	</div>
</div>



<?php if($type == "tambah") : ?>
	<script type="text/javascript">
		$('#form_manage_admin').on('submit', function(e) {

			e.preventDefault()

			$.ajax({
				url: "<?= site_url('modul_admin/manage_admin/manage_admin_save') ?>",
				method: "post",
				data: new FormData(this),
				processData: false,
				contentType: false,

				beforeSend: () => {
					$('#btn-proses').attr('disabled', true)
				},

				success: (data) => {
					if(data.status == true) {
						alert(data.keterangan)
						$('#modal_all').modal('hide');
						loadTable();
					} else {
						alert(data.keterangan)
						$('#btn-proses').attr('disabled', false)
					}
				},

				error: () => {
					alert('gagal')
					$('#btn-proses').attr('disabled', false)
				}
			})
			return false;

		})
	</script>
<?php elseif($type == "edit") : ?>
	<script type="text/javascript">
		$('#form_manage_admin').on('submit', function(e) {

			e.preventDefault()

			$.ajax({
				url: "<?= site_url('modul_admin/manage_admin/manage_admin_update') ?>",
				method: "post",
				data: new FormData(this),
				processData: false,
				contentType: false,

				beforeSend: () => {
					$('#btn-proses').attr('disabled', true)
				},

				success: (data) => {
					alert('Berhasil')
					$('#modal_all').modal('hide');
					loadTable();
				},

				error: () => {
					alert('gagal')
					$('#btn-proses').attr('disabled', false)
				}
			})
			return false;

		})
	</script>

	<script type="text/javascript">
		getUnitKerja()
	</script>
<?php endif; ?>