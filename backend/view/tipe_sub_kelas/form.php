<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Tipe Subkelas</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tipe Subkelas</label>
                    <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Tipe Subkelas">
                </div>
                <div class="form-group col-md-6">
                    <label>Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = ['tipe', 'keterangan'];
    //load option
    <?= isset($_GET['id']) ? "getDataById('tipe_sub_kelas', '{$_GET['id']}');" : ''; ?>

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('tipe_sub_kelas/data')
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
            table: 'tipe_sub_kelas',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>