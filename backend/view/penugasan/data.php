<div class="data-page-header">
    <p>Data Penugasan</p>
    <button class="btn btn-sm btn-primary" onclick="tambah()">Tambah</button>
</div>
<div class="card">
    <div class="card-body">
        <div>
            <table class="table table-sm table-striped" id="table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Tipe Penugasan</th>
                        <th>Tipe Kelas</th>
                        <th>Nama Guru PIC</th>
                        <th>Kelas</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
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
            table: 'v_penugasan'
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
                [1, "asc"],
                [3, "asc"]
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'tahun_ajaran'
                },
                {
                    data: 'semester'
                },
                {
                    data: 'tipe_penugasan'
                },
                {
                    data: 'tipe_kelas'
                },
                {
                    data: 'nama_pic'
                },
                {
                    data: 'nama_kelas'
                },
                {
                    data: 'start_date'
                },
                {
                    data: 'end_date'
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
        if (confirm("Apakah anda yakin akan mengahpus data ini?")) deleteData('penugasan', id, table);
    }

    function tambah() {
        loadPage('penugasan/form');
    }

    function edit(id) {
        loadPage('penugasan/form', {
            id: id,
            table: 'penugasan',
        });
    }
</script>