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
                    <label>Tahun Ajaran</label>
                    <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Tahun Ajaran">
                </div>
                <div class="form-group col-md-6">
                    <label for="tipe_libur">Semester</label>
                    <select id="tipe_libur" name="tipe_libur" class="form-control">
                        <option selected disabled value="">Pilih Semester..</option>
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Tanggal Libur</label>
                <input type="date" class="form-control" id="tgl_libur" name="tgl_libur" placeholder="Tanggal Libur">
            </div>
            <div class="form-group col-md-6">
                <label>Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
            </div>
            <div class="form-group col-md-6">
                <label>Tipe Libur</label>
                <input type="text" class="form-control" id="tipe_libur" name="tipe_libur" placeholder="Tipe_libur">
            </div>
    </div>
    <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
    <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
    </form>
</div>
</div>
<script>
    // set required form
    var required = ['tahun_ajaran', 'semester', 'tgl_libur', 'keterangan', 'tipe_libur'];
    // load option
    <?= isset($_GET['id']) ? "getDataById('jadwal_sekolah', '{$_GET['id']}');" : ''; ?>

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('jadwal_sekolah/data')
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
            table: 'jadwal_sekolah',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>