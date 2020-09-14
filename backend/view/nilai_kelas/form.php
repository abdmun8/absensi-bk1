<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Nilai kelas</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas">
                </div>
                <div class="form-group col-md-3">
                    <label>Mengeja</label>
                    <input type="number" min="0" class="form-control" id="mengeja" name="mengeja" placeholder="Mengeja">
                </div>
                <div class="form-group col-md-3">
                    <label>Penjumlahan</label>
                    <input type="number" min="0" class="form-control" id="penjumlahan" name="penjumlahan" placeholder="Penjumlahan">
                </div>
                <div class="form-group col-md-3">
                    <label>Menulis</label>
                    <input type="number" min="0" class="form-control" id="menulis" name="menulis" placeholder="Menulis">
                </div>
                <div class="form-group col-md-3">
                    <label>Keaktifan</label>
                    <input type="number" min="0" class="form-control" id="keaktifan" name="keaktifan" placeholder="Keaktifan">
                </div>
                <div class="form-group col-md-3">
                    <label>Pengurangan</label>
                    <input type="number" min="0" class="form-control" id="pengurangan" name="pengurangan" placeholder="Pengurangan">
                </div>
                <div class="form-group col-md-3">
                    <label>Mewarnai</label>
                    <input type="number" min="0" class="form-control" id="mewarnai" name="mewarnai" placeholder="Mewarnai">
                </div>
                <div class="form-group col-md-3">
                    <label>Menggambar</label>
                    <input type="number" min="0" class="form-control" id="menggambar" name="menggambar" placeholder="Menggambar">
                </div>
                <div class="form-group col-md-3">
                    <label>Mencocokan Bentuk</label>
                    <input type="number" min="0" class="form-control" id="mencocokan_bentuk" name="mencocokan_bentuk" placeholder="Mencocokan Bentuk">
                </div>
            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = [
        'kelas',
        'mengeja',
        'penjumlahan',
        'menulis',
        'keaktifan',
        'pengurangan',
        'mewarnai',
        'menggambar',
        'mencocokan_bentuk',
    ];
    <?= isset($_GET['id']) ? "getDataById('nilai_kelas', '{$_GET['id']}');" : ''; ?>

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('nilai_kelas/data')
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
            table: 'nilai_kelas',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>