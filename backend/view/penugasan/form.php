<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Penugasan</p>
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
                    <label for="semester">Semester</label>
                    <select id="semester" name="semester" class="form-control">
                        <option selected disabled value="">Pilih Semester..</option>
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="tipe_penugasan">Tipe Penugasan</label>
                    <select id="tipe_penugasan" name="tipe_penugasan" class="form-control">
                        <option selected disabled value="">Pilih Tipe Penugasan..</option>
                        <option value="internal">Internal</option>
                        <option value="eksternal">Eksternal</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="tipe_kelas">Tipe Kelas</label>
                    <select id="tipe_kelas" name="tipe_kelas" class="form-control">
                        <option selected disabled value="">Pilih Tipe Kelas..</option>
                        <option value="kelas">Kelas</option>
                        <option value="sub_kelas">Sub Kelas</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="id_guru_pic">Guru PIC</label>
                    <select id="id_guru_pic" name="id_guru_pic" class="form-control">
                        <option selected disabled value="">Pilih Guru PIC..</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="id_kelas">Kelas</label>
                    <select id="id_kelas" name="id_kelas" class="form-control">
                        <option selected disabled value="">Pilih Kelas..</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Tanggal Mulai</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Tanggal Mulai">
                </div>
                <div class="form-group col-md-6">
                    <label>Tanggal Selesai</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Tanggal Selesai">
                </div>
            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = ['tahun_ajaran', 'semester', 'tipe_penugasan', 'tipe_kelas', 'id_guru_pic', 'id_kelas', 'start_date', 'end_date'];

    // ambil data Guru PIC
    req(base_url, 'GET', {
        table: 'pic_eksternal',
        action: 'data'
    }).then(res => {
        $('#id_guru_pic').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#id_guru_pic').append(`<option value="${item.id}">${item.nama} - ${item.keterangan}</option>`);
        });
    }).catch(err => console.log(err));


    // ambil data  kelas
    req(base_url, 'GET', {
        table: 'kelas',
        action: 'data'
    }).then(res => {
        $('#id_kelas').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#id_kelas').append(`<option value="${item.id}">${item.tingkat} - ${item.nama_kelas}</option>`);
        });
    }).catch(err => console.log(err));

    // load data if parameter id exist
    <?= isset($_GET['id']) ? "getDataById('v_penugasan', '{$_GET['id']}');" : ''; ?>

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('penugasan/data')
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
            table: 'penugasan',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>