<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Siswa</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                </div>
                <div class="form-group col-md-6">
                    <label>NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN">
                </div>
                <div class="form-group col-md-6">
                    <label>NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS">
                </div>
                <div class="form-group col-md-6">
                    <label for="jenis_kelamin">Jenis kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                        <option selected disabled value="">Pilih Jenis Kelamin..</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="id_kelas">Kelas</label>
                    <select id="id_kelas" name="id_kelas" class="form-control">
                        <option selected disabled value="">Pilih Kelas..</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir">
                </div>

                <div class="form-group col-md-6">
                    <label>Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
                </div>

            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = ['nama', 'nisn', 'jenis_kelamin', 'tgl_lahir', 'alamat'];
    // load option
    req(base_url, 'GET', {
        table: 'kelas',
        action: 'data'
    }).then(res => {
        $('#id_kelas').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#id_kelas').append(`<option value="${item.id}">${item.nama_kelas} - ${item.deskripsi}</option>`);
        });
        // load data if parameter id exist
        <?= isset($_GET['id']) ? "getDataById('v_siswa', '{$_GET['id']}');" : ''; ?>
    }).catch(err => console.log(err));

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('siswa/data')
    }

    /**
     * validate form
     */
    function validate() {
        return validateForm(required);
    }

    function resetForm() {
        clearForm(required);
    }

    /**
     * save data
     */
    function simpan() {
        if (!validate()) {
            return;
        }
        var extra = {
            table: 'siswa',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>