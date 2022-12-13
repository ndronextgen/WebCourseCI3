<script type="text/javascript">

	function add_keluarga()
	{
		save_method = 'addkeluarga';
		$('#form_keluarga')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_keluarga').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Keluarga - <?php echo $this->session->userdata("nama_pegawai"); ?>'); // Set Title to Bootstrap modal title
	}

	function edit_keluarga(id_data_keluarga)
	{
		save_method = 'update';
		$('#form_keluarga')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('keluarga/keluarga_edit/')?>/"+id_data_keluarga,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="id_data_keluarga"]').val(data.id_data_keluarga);
				$('[name="nama_anggota_keluarga"]').val(data.nama_anggota_keluarga);
				$('[name="hub_keluarga"]').val(data.hub_keluarga);
				$('[name="jenis_kelamin"]').val(data.jenis_kelamin);
				$('[name="tanggal_lahir_keluarga"]').datepicker('update',data.tanggal_lahir_keluarga);
				$('[name="uraian"]').val(data.uraian);
				$('#modal_keluarga').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data Keluarga'); // Set title to Bootstrap modal title
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}
		
	function reload_table_keluarga()
	{
		tablekeluarga.ajax.reload(null,false); //reload datatable ajax 
	}

	function savekeluarga()
	{
		$('#btnKeluargaSave').text('saving...'); //change button text
		$('#btnKeluargaSave').attr('disabled',true); //set button disable 
		var url;

		if(save_method == 'addkeluarga') {
			url = "<?php echo site_url('keluarga/keluarga_add')?>";
		} else {
			url = "<?php echo site_url('keluarga/keluarga_update')?>";
		}

		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form_keluarga').serialize(),
			dataType: "JSON",
			success: function(data)
			{

				if(data.status) //if success close modal and reload ajax table
				{
					$('#modal_keluarga').modal('hide');
					reload_table_keluarga();
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}
				$('#btnKeluargaSave').text('save'); //change button text
				$('#btnKeluargaSave').attr('disabled',false); //set button enable 


			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data');
				$('#btnKeluargaSave').text('save'); //change button text
				$('#btnKeluargaSave').attr('disabled',false); //set button enable 

			}
		});
	}
	
	function delete_keluarga(id_data_keluarga)
	{
		if(confirm('Apakah kamu yakin mau menghapus data ini?'))
		{
			// ajax delete data to database
			$.ajax({
				url : "<?php echo site_url('keluarga/keluarga_delete')?>/"+id_data_keluarga,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					//if success reload ajax table
					$('#modal_keluarga').modal('hide');
					reload_table_keluarga();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Proses delete data error');
				}
			});

		}
	}
</script>