<?php
  $ses_Gid  = $this->session->userdata('ses_Gid');
  #hak_akses
  if ($ses_Gid == '1'){
    
?>
<!-- SELECT2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<ul class="breadcrumb">
    <li><a href='<?php echo base_url(); ?>'>Dashboard</a></li>
    <li class='active'>Manage Admin</li>
</ul>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Manage Admin</h2>
  </div>
  <!-- START WIDGETS -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <button type="button" class="btn btn-info btn-lg" id="tambah" onclick="tambah_admin()">
                    <i class="fa fa-plus"></i> Tambah Admin
                    </button>
                    <hr>
                    <div id='ajax_table'></div>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php } else { ?>
maaf anda tidak memiliki hak akses di halaman ini
  <?php } ?>


<!-- JS Library -->

<!-- SELECT2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $('.select2').select2()
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url : "<?php echo site_url('modul_admin/manage_admin/filter') ?>",
            
            beforeSend: function(f) {
                var percentVal = '<img src="<?php echo base_url("assets/lte/loading.gif");?>" style="width:3em;position:fixed;">';
                $('#ajax_table').html(percentVal);
            },
            success: function(data){
                $('#ajax_table').html(data);
            }
        });
    })

  function reload_table(){
    Table.ajax.reload(null,false); //reload datatable ajax 
  }

  function tambah_admin()
    {
      save_method = 'add';
      $.ajax({
        url: "<?php echo site_url('modul_admin/manage_admin/manage_admin_tambah'); ?>",
        data: "act=" + 'Tambah',
        type: "POST",
        success: function(data) {
          $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
        }
      });
      $('#modal_all').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Admin'); // Set Title to Bootstrap modal title
    }

    

function delete_admin(Id) {
  var i = "Hapus ?";
  var b = "Admin Dihapus";
  if (!confirm(i)) return false;
  $.ajax({
      type: "post",
      data: "Id="+ Id,
      url: "<?php echo site_url('modul_admin/manage_admin/manage_admin_delete') ?>",
      success: function(s) {
          alert(b);
          reload_table();
      }
  });
}

</script>