<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Wali Murid</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nama Wali</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                </div>
                <div class="form-group col-md-6">
                    <label>No telepon</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Telepon">
                </div>
                <div class="form-group col-md-6">
                    <label>Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="id_siswa">Nama Siswa</label>
                    <select id="id_siswa" name="id_siswa" class="form-control">
                        <option selected disabled value="">Pilih Nama Siswa..</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>

                <div class="form-group col-md-6">
                    <label for="id_kelas">Kelas</label>
                    <select id="id_kelas" name="id_kelas" class="form-control">
                        <option selected disabled value="">Pilih Kelas..</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = ['nama', 'username', 'password', 'telepon', 'alamat', 'id_siswa', 'id_kelas'];
    // load option
    //ambil data siswa
    req(base_url, 'GET', {
            table: 'siswa',
            action: 'data'
        }).then(res => {
                $('#id_siswa').children().not(':first').remove();
                res.data.forEach(function(item) {
                    $('#id_siswa').append(`<option value="${item.id}">${item.nama_siswa}</option>`);
                });
                // ambil data kelas
                req(base_url, 'GET', {
                    table: 'kelas',
                    action: 'data'
                }).then(res => {
                    $('#id_kelas').children().not(':first').remove();
                    res.data.forEach(function(item) {
                        $('#id_kelas').append(`<option value="${item.id}">${item.nama_kelas}</option>`);
                    });
                    // load data if parameter id exist
                    <?= isset($_GET['id']) ? "getDataById('v_wali_murid', '{$_GET['id']}');" : ''; ?>
                }).catch(err => console.log(err));

                /**
                 * back to previous page
                 */
                function kembali() {
                    loadPage('wali_murid/data')
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
                        table: 'wali_murid',
                        action: 'simpan',
                    }
                    <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
                    saveData(extra);
                }
</script>