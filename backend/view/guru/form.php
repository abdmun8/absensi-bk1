<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Data Guru</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Kode Guru</label>
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Kode Guru">
                </div>
                <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                </div>
                <div class="form-group col-md-6">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="username">
                </div>
                <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
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
                    <label>Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir">
                </div>
            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = ['nik', 'nama', 'username', 'password', 'jenis_kelamin', 'alamat', 'tgl_lahir'];
    // load option
    <?= isset($_GET['id']) ? "getDataById('guru', '{$_GET['id']}');" : ''; ?>

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('guru/data')
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
            table: 'guru',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>