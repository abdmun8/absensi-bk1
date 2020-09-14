<div class="container" style="margin-top:20px;width:100%;">
    <div class="row">
        <div class="card" style="width:100%;">
            <div class="card-header">
                
                    <img height="40px" width="auto" style="margin-right:20px;" src="<?= base_url() ?>asset/image/icons-192.png" ?>
                    <span style="font-weight:bold;font-size:20px;">SMK BINAKARYA 1 KARAWANG </span>  
                    <span class="pull-right" style="font-size:20px;">Absensi hari Ini <?=date('d M Y') ?> <span style="font-weight:bold;background-color:white;"><?= date('H:i')?></span></span>
            </div>
            <div class="card-body">
                <table class="table table-stripped table-bordered table-sm" id="absensi-guru-hari-ini" style="width:100%;">
                    <thead class="grey lighten-2">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Keterangan</th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var table;
    $(document).ready(function() {
        // $("#absensi-guru-hari-ini tfoot th").each(function() {
        //     var title = $(this).text();
        //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        // });

        // generate data table
        getDataTable();

        setTimeout(function(){
            location.reload();
        },60000)
    });

    // Generate Datatable Header
    function getDataTable() {
        if ($.fn.dataTable.isDataTable("#absensi-guru-hari-ini")) {
            table = $("#absensi-guru-hari-ini").DataTable();
        } else {
            table = $("#absensi-guru-hari-ini").DataTable({
                ajax: base_url + "publik/getDataAbsensiGuruHariIni",
                columns: [{
                        data: "no",
                        width: '5%'
                    },
                    {
                        data: "nik"
                    },
                    {
                        data: "nama"
                    },
                    {
                        data: "jam_masuk",
                        className: "text-center"
                    },
                    {
                        data: "jam_pulang",
                        className: "text-center"
                    },
                    {
                        data: "keterangan"
                    },
                ],
                ordering: true,
                deferRender: true,
                scrollX: true,
                pageLength: 50,
                fnDrawCallback: function(oSettings) {
                    if (table) {
                        $(".tr-danger").parents('tr').addClass('bg-danger');
                        $(".tr-warning").parents('tr').addClass('bg-warning');
                    }
                }
            });
            // table.columns().every(function() {
            //     var that = this;
            //     $('input', this.footer()).on('keyup change', function() {
            //         if (that.search() !== this.value) {
            //             that
            //                 .search(this.value)
            //                 .draw();
            //         }
            //     });
            // });
        }
    }
</script>