<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Subkelas</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tingkat">Kelas</label>
                    <select id="tingkat" name="tingkat" class="form-control">
                        <option selected disabled value="">Pilih Kelas..</option>
                        <option value="10">Kelas 10</option>
                        <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Nama Kelas">
                </div>
                <div class="form-group col-md-6">
                    <label>Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="deskripsi"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="wali_kelas">Guru</label>
                    <select id="wali_kelas" name="wali_kelas" class="form-control">
                        <option selected disabled value="">Pilih Wali Kelas..</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="pic">PIC External</label>
                    <select id="pic" name="pic" class="form-control">
                        <option selected disabled value="">Pilih Guru PIC..</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="tipe_id">Tipe Sub Kelas</label>
                    <select id="tipe_id" name="tipe_id" class="form-control">
                        <option selected disabled value="">Pilih Tipe Sub Kelas..</option>
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = ['tingkat', 'nama_kelas', 'deskripsi', 'tipe_id'];

    // ambil data kelas
    req(base_url, 'GET', {
        table: 'guru',
        action: 'data'
    }).then(res => {
        $('#wali_kelas').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#wali_kelas').append(`<option value="${item.id}">${item.nik} - ${item.nama}</option>`);
        });
    }).catch(err => console.log(err));

    // ambil data guru
    req(base_url, 'GET', {
        table: 'guru',
        action: 'data'
    }).then(res => {
        $('#wali_kelas').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#wali_kelas').append(`<option value="${item.id}">${item.nik} - ${item.nama}</option>`);
        });
    }).catch(err => console.log(err));

    // ambil data pic
    req(base_url, 'GET', {
        table: 'pic_eksternal',
        action: 'data'
    }).then(res => {
        $('#pic').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#pic').append(`<option value="${item.id}">${item.nama} - ${item.keterangan}</option>`);
        });
    }).catch(err => console.log(err));

    // ambil tipe sub kelas
    req(base_url, 'GET', {
        table: 'tipe_sub_kelas',
        action: 'data'
    }).then(res => {
        $('#tipe_id').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#tipe_id').append(`<option value="${item.id}">${item.tipe} - ${item.keterangan}</option>`);
        });
    }).catch(err => console.log(err));


    // load data if parameter id exist
    <?= isset($_GET['id']) ? "getDataById('v_sub_kelas', '{$_GET['id']}');" : ''; ?>

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('sub_kelas/data')
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
            table: 'sub_kelas',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>