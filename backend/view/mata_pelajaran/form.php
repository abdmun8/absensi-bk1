<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Data Mata Pelajaran</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Mata Pelajaran</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Mata Pelajaran">
                </div>
                <div class="form-group col-md-6">
                    <label>Kelas</label>
                    <input type="text" class="form-control" id="tingkat" name="tingkat" placeholder="Kelas">
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
    var required = ['nama', 'tingkat', 'deskripsi'];
    // load option
    <?= isset($_GET['id']) ? "getDataById('mata_pelajaran', '{$_GET['id']}');" : ''; ?>

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('mata_pelajaran/data')
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
            table: 'mata_pelajaran',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>