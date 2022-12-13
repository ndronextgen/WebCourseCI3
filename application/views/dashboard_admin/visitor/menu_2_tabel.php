<!-- <<< Menu 2 >>> -->

<!-- DATATABLES -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <table class="table display" id='table_visitor'>
            <thead>
                <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Login Terakhir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data_visitor as $key) {
                    $no++; ?>
                    <tr>
                        <!-- <th scope="row"><?php echo $no; ?></th> -->
                        <td><?php echo $key->tanggal; ?></td>
                        <td><?php echo $key->nama; ?></td>
                        <td><?php echo $key->waktu_login; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_visitor').DataTable();
    });
</script>