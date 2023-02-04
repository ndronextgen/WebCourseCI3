<?php
$user_type    = $this->session->userdata('ses_user_type');
$Gid          = $this->session->userdata('ses_Gid');
$E2Nama       = $this->session->userdata('ses_unite2');
$E3Nama    	  = $this->session->userdata('ses_unite3');          
$E4Nama    	  = $this->session->userdata('ses_unite4');
$Finger       = $this->session->userdata('ses_FingerBadgeNumber');
    //if ($user_type=='admin' AND $Gid == '1'){
    //    $kond = "";
    //} else {
    //    $kond = " disabled";
    //}
#gid admin
if($Gid=='1'){
	$de_2=''; $de_3=''; $de_4 ='';
} else {
	$de_2='avoid-clicks';
	if ($E3Nama!= ''){ $de_3='avoid-clicks'; } else { $de_3=''; }
	if ($E4Nama!= ''){ $de_4='avoid-clicks'; } else { $de_4=''; }
}
?> 
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <h5>Manage Akses Kelola Absensi <small><i class="ace-icon fa fa-angle-double-right"></i> Komisi Nasional Hak Asasi Manusia</small></h5>
        </li>
    </ul>
    <ul class="breadcrumb" style="float: right;padding-top:7px;">
        <li>
            <i class="ace-icon fa fa-dashboard"></i> <a href="<?php echo site_url('i/dashboard'); ?>">Dashboard</a>
        </li>
        <li class="active">Manage Akses Kelola Absensi</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                    <table class='table borderless'>
                        <tr>
							<td>
								<select id="filter_tahun" class="form-control input-sm">
									<option value="">[Pilih Tahun]</option>
									<?php $tahun = date('Y');
										foreach ($this->db->query("SELECT * from master_tahun order by Tahun;")->result() as $d) {
										echo '<option value="'.$d->Tahun.'"';
											if ($tahun == $d->Tahun) {
													echo " selected";
											}
										echo '>'.$d->Tahun.'</option>';
										}
									?>
								</select>
							</td>
	
							<td>
								<select id="filter_bulan" class="form-control input-sm">
									<option value="">[Pilih Bulan]</option>
									<?php $bulan = '';//date('m');
										foreach ($this->db->query("SELECT * from master_bulan order by Kode ASC;")->result() as $d) {
										echo '<option value="'.$d->Kode.'"';
											if ($bulan == $d->Kode) {
													echo " selected";
											}
										echo '>'.$d->Bulan.'</option>';
										}
									?>
								</select>
							</td>

                            <td>
                                <button class="btn btn-xs btn-primary" id="fillet_btn" onclick="filter()"><i class="fa fa-filter"></i> Filter</button>
                                <button class="btn btn-xs btn-default" id="refresh" onclick="reload_table()"><i class="fa fa-refresh"></i> </button>
                            </td>
                        </tr>
                    </table>

                    <div id="ajax_table"></div>

                </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<script type="text/javascript">
$(document).ready(function(){
	filter();
});
function filter() {
	var tahun   	= $("#filter_tahun").val();
	var bulan   	= $("#filter_bulan").val();

	$.ajax({
		type: "POST",
		data: { 
			tahun: tahun,
			bulan: bulan
		},
		url : "<?php echo site_url('i/system/Manage_akses/filter') ?>",
		beforeSend: function(f) {
			var percentVal = '<img src="<?php echo base_url("assets/images/loading.gif");?>" style="width:3em;position:fixed;">';
			$('#ajax_table').html(percentVal);
		},
		success: function(data){
			$('#ajax_table').html(data);
		}
	});
}

function reload_table() {
	table.ajax.reload(null,false); //reload datatable ajax 
}

function ubah_aktif(Id) {
var x = confirm("Apakah anda yakin ingin Mengubah Status Ini ?"); var aktif = document.getElementById("aktif_"+Id).value;
	if (x) {
		$.ajax({
			type : "POST",
			url : "<?php echo site_url('i/system/Manage_akses/pindah_aktif'); ?>",
			data: { Id: Id, aktif: aktif },
			dataType: 'html',
			success: function(response) {
			  reload_table();
			}
		});
	}  else { return false; reload_table(); }
}
</script>


                    