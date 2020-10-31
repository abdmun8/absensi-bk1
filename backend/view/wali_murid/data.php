<div class="data-page-header">
    <p>Data Wali Murid</p>
    <button class="btn btn-sm btn-primary" onclick="tambah()">Tambah</button>
</div>
<div class="card">
    <div class="card-body">
        <div>
            <table class="table table-sm table-striped" id="table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Wali Murid</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
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
            table: 'v_wali_murid'
        };
        // qs object
        var qs = objectToQueryString(params);
        table = $('#table').DataTable({
            ajax: base_url + qs,
            scrollX: true,
            language: {
                url: base_url + "assets/Indonesian.json",
            },
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
                    data: 'nama'
                },
                {
                    data: 'jenis_kelamin'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'nama_kelas'
                },
                {
                    data: 'no_hp'
                },
                {
                    data: 'alamat',
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
                    }
                },

            ],
            initComplete: function(settings, json) {
                this.api().columns.adjust().draw()
            }
        });

        addIndexColumn(table);
    }



    function hapus(id) {
        if (confirm("Apakah anda yakin akan mengahpus data ini?")) deleteData('wali_murid', id, table);
    }

    function tambah() {
        loadPage('wali_murid/form');
    }

    function edit(id) {
        loadPage('wali_murid/form', {
            id: id,
            table: 'wali_murid',
        });
    }
</script>