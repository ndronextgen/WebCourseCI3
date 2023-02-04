<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <select class="select2" id="select2-tipe-admin" style="width: 100% !important;">
                    <option value="">[Semua Tipe Admin]</option>
                    <?php foreach($group as $groups) : ?>
                        <option
                            value="<?= $groups->Gid ?>"
                        >
                            <?= $groups->Namagroup ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="loadTable()">
                    <i class="fa fa-filter"></i>
                    Filter
                </button>

                <button class="btn btn-warning" onclick="resetTable()">
                    <i class="fa fa-refresh"></i>
                    Reset
                </button>
            </div>
        </div>

        <div class="row" style="margin-top: 1%;">
            
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 1%;">
        <div class="box-body table-responsive">
            <table id="table_admin" class="table table-striped table-bordered" cellspacing="0" width="100%" style='font-size:13px !important;' >
                <thead>
                    <tr style='background-color:#ef7d20;color:#fff;'>
                        <td width="80px;"><b>Action</b></td>
                        <td width="120px;"><b>Nama Group</b></td>
                        <td><b>Nama Admin</b></td>
                        <td><b>Username</b></td>
                    </tr>
                </thead>
            <tbody>
            </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2()
</script>

<script type="text/javascript">
    function resetTable() {
        $('#select2-tipe-admin').val('').trigger('change')

        loadTable()
    }

    function loadTable() {
        let TipeAdmin   = $('#select2-tipe-admin').val()

        Table = $('#table_admin').DataTable({
            "destroy": true,
            "processing": true, 
            "serverSide": true, 
            "ajax": {
                "url": "<?php echo site_url('modul_admin/manage_admin/table_manage_admin')?>",
                "type": "POST",
                "data": { TipeAdmin }
            },
            "aoColumns": [ {"sClass":"center"},{"sClass":"center"},{"sClass":"left"},{"sClass":"center"}],
            language: {
                 processing: '<img src="<?php echo base_url('assets/img/loading.gif');?>" width="40px"> Memuat...',
             },
            "bSort": false,
            "bInfo": true
        })
    }

    loadTable()

</script>

<script type="text/javascript">

function edit_admin(Id)
    {
      save_method = 'add';
      $.ajax({
        url: "<?php echo site_url('modul_admin/manage_admin/manage_admin_edit'); ?>",
        data: {Id:Id},
        type: "POST",
        success: function(data) {
          $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
        }
      });
      $('#modal_all').modal('show'); // show bootstrap modal
      $('.modal-title').text('Ubah Admin'); // Set Title to Bootstrap modal title
    }
</script>