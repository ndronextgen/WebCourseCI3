<?php headAdminHtml();?>
<body style="background-image: url(<?php echo base_url().'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
	<?php
	headerAdmin(); 
	?>
	
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				<?php menuAdmin($menu_open); ?>

				<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
					<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						<!-- begin Subheader -->
						<?php headerTitle(); ?>
						<!-- end Subheader -->

						<!-- begin content -->
						<div class="kt-container  kt-grid__item kt-grid__item--fluid">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-interface-11"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="dropdown dropdown-inline">
												<!--<button type="button" class="btn btn-brand btn-icon-sm">-->
												<a href="<?php echo base_url();?>admin/master_bezeting/edit" class="btn btn-brand btn-icon-sm">
													<i class="la la-edit"></i> Ubah Data
												</a>
												<!--</button>-->
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
                  <div class="col-lg-12">
                    <div class="kt-infobox__section">
                      <div class="kt-infobox__content">
                        <div class="table-responsive">
                          <table class="table table-light">
                            <thead>
                              <tr>
                                <th class="table-center">JENIS JABATAN</th>
                                <th class="table-center">EXISTING</th>
                                <th class="table-center">ABK</th>
                                <th class="table-center">SELISIH +/-</th>
                                <th class="table-center">KETERANGAN</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if ($list != null) {
                                foreach ($list as $k=>$dt) {
                                  echo '
                                  <tr>
                                    <td class="kt-font-bold table-row-title">JABATAN '.$dt['status_jabatan'].'</td>
                                    <td class="table-center">&nbsp;</td>
                                    <td class="table-center">&nbsp;</td>
                                    <td class="table-center">&nbsp;</td>
                                    <td class="table-center">&nbsp;</td>
                                  </tr>
                                  ';

                                  if ($dt['data_jabatan'] != null) {
                                    foreach ($dt['data_jabatan'] as $kj=>$j) {
                                      echo '
                                      <tr>
                                        <td>'.$j['nama_jabatan'].'</td>
                                        <td class="table-center">'.$j['existing'].'</td>
                                        <td class="table-center">'.$j['abk'].'</td>
                                        <td class="table-center">'.$j['selisih'].'</td>
                                        <td class="table-center">'.$j['ket'].'</td>
                                      </tr>
                                      ';
                                    }
                                  }
                                }
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
								</div>
							</div>
						</div>
						<!-- end content -->
					</div>
				</div>
				<?php footerAdmin(); ?>
			</div>
		</div>
	</div>

	<?php scrollTop(); ?>

	<!-- begin script global -->
	<script src="<?php echo base_url()?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<!-- end script global -->

</body>