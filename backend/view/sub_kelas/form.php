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
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
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
                    <label for="guru">Wali Kelas</label>
                    <select id="guru" name="guru" class="form-control">
                        <option selected disabled value="">Pilih Wali Kelas..</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="pic">Guru PIC</label>
                    <select id="pic" name="pic" class="form-control">
                        <option selected disabled value="">Pilih Guru PIC..</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="tipe_subkelas">Tipe Sub Kelas</label>
                    <select id="tipe_subkelas" name="tipe_subkelas" class="form-control">
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
    var required = ['tingkat', 'nama_kelas', 'deskripsi', 'wali_kelas', 'pic', 'tipe_id'];
    req(base_url, 'GET', {
        table: 'guru',
        action: 'data'
    }).then(res => {
        $('#wali_kelas').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#wali_kelas').append(`<option value="${item.id}">${item.guru} - ${item.pic}</option>`);
        });
        // load data if parameter id exist
        <?= isset($_GET['id']) ? "getDataById('v_subkelas', '{$_GET['id']}');" : ''; ?>
    }).catch(err => console.log(err));

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