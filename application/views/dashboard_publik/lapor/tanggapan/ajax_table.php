<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="table_laporan_harian" class="table table-bordered" cellspacing="0" width="100%" style='font-size:12px !important;'>
                    <thead style="background: #90dfe0;color:#404040;">
                        <tr>
                            <td align="center" rowspan="2"><b>Act</b></td>
                            <td align="center" colspan="4"><b>Jadwal Kerja</b></td>
                            <td align="center" rowspan="2" width="80px"><b>Jam Masuk</b></td>
                            <td align="center" rowspan="2" width="80px"><b>Jam Keluar</b></td>
                            <td align="center" rowspan="2" width='600px;'><b>Laporan Harian</b></td>

                        </tr>
                        <tr>
                            <td align="center"><b>Tanggal</b></td>
                            <td align="center" width="80px;"><b>Hari-Jadwal</b></td>
                            <td align="center"><b>Masuk</b></td>
                            <td align="center"><b>Pulang</b></td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    table = $('#table_laporan_harian').DataTable({

        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo site_url('i/laporan_harian/Laporan_harian/table_laporan_harian') ?>",
            "type": "POST",
            "data": {
                unite2: "<?php echo $unite2; ?>",
                pegawai: "<?php echo $pegawai; ?>",
                tahun: "<?php echo $tahun; ?>",
                bulan: "<?php echo $bulan; ?>",
            }
        },
        "aoColumns": [{
            "sClass": "center"
        }, {
            "sClass": "center"
        }, {
            "sClass": "center"
        }, {
            "sClass": "center"
        }, {
            "sClass": "center"
        }, {
            "sClass": "center"
        }, {
            "sClass": "center"
        }, {
            "sClass": "left"
        }],
        columnDefs: [

            {
                "targets": 5,
                "createdCell": function(td, cellData, rowData, row, col) {
                    $(td).css('background-color', '#80e178')
                }
            },
            {
                "targets": 6,
                "createdCell": function(td, cellData, rowData, row, col) {
                    $(td).css('background-color', '#80e178')
                }
            },
        ],

        language: {
            processing: '<img src="<?php echo base_url('ws_assets/img/loading.gif'); ?>" width="40px"> Memuat...',
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            switch (aData[5]) {
                case "Kosong":
                    $('td:eq(5)', nRow).html('');
                    $('td:eq(5)', nRow).css('background-color', '#fefb95');
                    break;
            }
            switch (aData[6]) {
                case "Kosong":
                    $('td:eq(6)', nRow).html('');
                    $('td:eq(6)', nRow).css('background-color', '#fefb95');
                    break;
            }
        },
        "ordering": false,
        "info": false,
        "aLengthMenu": [
            [50, 75, -1],
            [50, 75, "All"]
        ],
        "iDisplayLength": 50,
        "searching": false
    });
</script>