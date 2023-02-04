<style>
	select.xyz {
  
  -webkit-user-select: none;
  background-position: center right;
  background:transparent;
  font-size: inherit;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>
<div class="row">
<div class="col-md-12">
		<div class="box-body table-responsive">
			<table id="table_manage_akses" class="table table-striped table-bordered" cellspacing="0" width="100%" style='font-size:12px !important;' >

				<thead>
                    <tr>
                        <th><b>Tahun</b></th>
                        <th><b>Bulan</b></th>
                        <th><b>Buka/Tutup</b></th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

		</div>
	</div>
</div>

<script type="text/javascript">
table = $('#table_manage_akses').DataTable({ 
    destroy : true,
	"processing": true, 
	"serverSide": true, 
	"ajax": {
		"url": "<?php echo site_url('i/system/Manage_akses/table_manage_akses')?>",
		"type": "POST",
        "data" : {
            tahun: "<?php echo $tahun; ?>",
            bulan: "<?php echo $bulan; ?>",
        }
	},
    "aoColumns": [ {"sClass":"center"},{"sClass":"center"},{"sClass":"center"}],
	language: {
         processing: '<img src="<?php echo base_url('assets/images/loading.gif');?>" width="40px"> Memuat...',
     },
    "bSort":false,
    "bInfo": true,
    "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>'
});
</script>