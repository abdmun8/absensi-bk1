<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Data Kelas</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tingkat Kelas</label>
                    <input type="text" class="form-control" id="tingkat" name="tingkat" placeholder="Tingkat Kelas">
                </div>
                <div class="form-group col-md-6">
                    <label>Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Nama Kelas">
                </div>
                <div class="form-group col-md-6">
                    <label>Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi"></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = ['tingkat', 'nama_kelas', 'deskripsi'];
    // load option
    <?= isset($_GET['id']) ? "getDataById('kelas', '{$_GET['id']}');" : ''; ?>

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('kelas/data')
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
            table: 'kelas',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>