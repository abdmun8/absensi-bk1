<div class="data-page-header">
    <p>Data Nilai Kelas</p>
    <button class="btn btn-sm btn-primary" onclick="tambah()">Tambah</button>
</div>
<div class="card">
    <div class="card-body">
        <div>
            <table class="table table-sm table-striped" id="table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mengeja</th>
                        <th>Penjumlahan</th>
                        <th>Menulis</th>
                        <th>Keaktifan</th>
                        <th>Pengurangan</th>
                        <th>Mewarnai</th>
                        <th>Menggambar</th>
                        <th>Mencocokan Bentuk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var table;
    $(document).ready(function() {
        initTable();
    });

    function initTable() {
        // param
        var params = {
            action: 'data',
            table: 'nilai_kelas'
        };
        // qs object
        var qs = objectToQueryString(params);
        table = $('#table').DataTable({
            ajax: base_url + qs,
            language: {
                url: base_url + "assets/Indonesian.json",
            },
            scrollX: true,
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc']
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'kelas'
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

                {
                    data: 'id',
                    className: 'text-center',
                    render: function(data, o, row) {
                        var button = `
                        <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-sm btn-info" onclick="edit(${data})">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="hapus(${data})">Delete</button>
                        </div>
                        `;
                        return button;
                    },
                },

            ],
            initComplete: function(settings, json) {
                this.api().columns.adjust().draw()
            }
        });

        addIndexColumn(table);
    }

    function hapus(id) {
        if (confirm("Apakah anda yakin akan mengahpus data ini?")) deleteData('nilai_kelas', id, table);
    }

    function tambah() {
        loadPage('nilai_kelas/form');
    }

    function edit(id) {
        loadPage('nilai_kelas/form', {
            id: id,
            table: 'nilai_kelas',
        });
    }
</script>