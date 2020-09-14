<div class="data-page-header">
    <p>Data Nilai Siswa</p>
    <div class="btn-group btn-group-sm" role="group">
        <button class="btn btn-sm btn-success" onclick="selectAll()">Pilih Semua</button>
        <button class="btn btn-sm btn-warning" onclick="deselectAll()">Batalkan Pilihan</button>
        <button class="btn btn-sm btn-primary" onclick="processClustering()">Proses</button>
    </div>

</div>
<div class="card">
    <div class="card-body">
        <div>
            <table class="table table-sm table-striped" id="table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Mengeja</th>
                        <th>Penjumlahan</th>
                        <th>Menulis</th>
                        <th>Keaktifan</th>
                        <th>Pengurangan</th>
                        <th>Mewarnai</th>
                        <th>Menggambar</th>
                        <th>Mencocokan Bentuk</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Clustering</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-content-wrapper">
                    <span>Hasil clustering dengan metode Algoritma K-Means</span>
                    <div class="mb-2">
                        <div class="button-group btn-group-sm">
                            <button onclick="printResult()" type="button" class="btn btn-primary">Print</button>
                        </div>
                    </div>
                </div>
                <div id="print-area">
                    Loading...
                </div>
            </div>
            <div class="modal-footer">
                <p><i>*Data yang ditampilkan adalah hasil perhitungan</i></p>
            </div>
        </div>
    </div>
</div>

<script>
    var table;
    var standar_nilai;
    $(document).ready(function() {
        initTable();
        req(base_url, 'GET', {
            action: 'data',
            table: 'nilai_kelas'
        }).then(res => {
            if (res.success) {
                standar_nilai = res.data;
            }
        })
    });

    function processClustering() {
        let data_nilai = [];
        if (standar_nilai.length < 2) return alert('Silahkan isi minimal 2 Standar Nilai!')
        let data = table.rows('.selected').data();
        if (!data.length) return alert('Pilih data siswa');
        for (let index = 0; index < data.length; index++) {
            const item = data[index];
            data_nilai.push(item)
        }
        $('#staticBackdrop').modal('show')
        req(base_url, 'POST', {
            standar_nilai: JSON.stringify(standar_nilai),
            data_nilai: JSON.stringify(data_nilai),
            action: 'clustering'
        }).then(res => {
            if (res.success) {
                $('#print-area').html(geneRateTableReport(res.data));
            }
        });
    }

    function printResult() {
        window.print()
    }

    function geneRateTableReport(data) {
        let html = `<table class="table table-sm table-striped table-bordered" width="100%" id="table-report" style="width: 100%;">`;
        html += `<thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>skA</th>
                        <th>skB</th>
                        <th>Kelas</th>
                    </tr>
                </thead>`;
        html += `<tbody>`;
        for (let index = 0; index < data.length; index++) {
            const item = data[index];
            html += `<tr>
                        <td>${index+1}</td>
                        <td>${item.nama}</td>
                        <td>${item.nisn}</td>
                        <td class="text-right">${item['A']}</td>
                        <td class="text-right">${item['B']}</td>
                        <td>${item.result}</td>
                    </tr>`;
        }
        html += "</tbody></table>";
        return html;
    }

    function deselectAll() {
        table.rows().deselect()
    }

    function selectAll() {
        table.rows().select()
    }

    function initTable() {
        // param
        var params = {
            action: 'data',
            table: 'nilai_siswa'
        };
        // qs object
        var qs = objectToQueryString(params);
        table = $('#table').DataTable({
            ajax: base_url + qs,
            scrollX: true,
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'os multi',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ],
            language: {
                url: base_url + "assets/Indonesian.json",
            },
            scrollX: true,
            columns: [{
                    data: 'id',
                    render: () => ''
                },
                {
                    data: 'nama'
                },
                {
                    data: 'mengeja'
                },
                {
                    data: 'penjumlahan'
                },
                {
                    data: 'menulis'
                },
                {
                    data: 'keaktifan'
                },
                {
                    data: 'pengurangan'
                },
                {
                    data: 'mewarnai'
                },
                {
                    data: 'menggambar'
                },
                {
                    data: 'mencocokan_bentuk'
                },

            ],
            initComplete: function(settings, json) {
                this.api().columns.adjust().draw()
            }
        });
    }

    function hapus(id) {
        if (confirm("Apakah anda yakin akan mengahpus data ini?")) deleteData('nilai_siswa', id, table);
    }

    function tambah() {
        loadPage('nilai_siswa/form');
    }

    function edit(id) {
        loadPage('nilai_siswa/form', {
            id: id,
            table: 'nilai_siswa',
        });
    }
</script>