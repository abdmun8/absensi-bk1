  <?php
    $siswa = null;
    if ($param != null) {
        $siswa = $this->model->getRecord(array(
            'table' => 'siswa', 'where' => array('id' => $param)
            ));
    }
    $this->db->order_by("nama_kelas","ASC");
    $kelas = $this->db->select("id, concat(tingkat,' ',nama_kelas) as kelas",false)->where('active',1)->get('kelas')->result();

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Database</a></li>
              <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#data-table-tab" data-toggle="tab"> Data</a></li>
                  <li class="nav-item"><a class="nav-link" href="#data-form-tab" data-toggle="tab">Form</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="data-table-tab">
                    <!-- table -->
                    <div class="table-responsive">
                    <table width="100%" id="data-table" class="table table-sm table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Kelas</th>
                        <th>Opsi</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Kelas</th>
                        <th>Opsi</th>
                      </tr>
                      </tfoot>
                    </table>
                 </div>
                    <!-- /table -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="data-form-tab">
                    <form id="data-form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>NIS</label>
                            <input type="text" id="nis" name="nis" class="form-control" placeholder="NIS">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>NISN</label>
                            <input type="text" id="nisn" name="nisn" class="form-control" placeholder="NISN">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Tgl Lahir</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="fa fa-calendar"></i>
                                </span>
                              </div>
                              <input type="text" name="tgl_lahir" class="form-control float-right" id="datepicker">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" style="width: 100%;">
                              <option value="L">Laki-Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Kelas</label>
                            <select class="form-control" id="id_kelas" name="id_kelas">
                              <?php
                                foreach ($kelas as $key => $v) {
                                  ?>
                                    <option value="<?=$v->id?>"><?=$v->kelas?></option>
                                  <?php
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
                          </div>
                        </div>
                      </div>
                      
                      <input type="hidden" id="value-input" name="value-input" >
                      <input type="hidden" id="key-input" name="key-input" value="id">
                      <input type="hidden" id="action-input" name="action-input" value="1">
                      <input type="hidden" id="model-input" name="model-input" value="siswa">

                    </form>

                    <div class="row">
                      <div class="col-md-12 mx-auto">
                        <button type="button" id="btn-save" class="btn btn-success"  onclick="saving(); return false;"><i class="fa fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-default" onclick="resetForm();"><i class="fa fa-undo"></i> Batal</button>
                      </div>                    
                    </div>
                  </div>                  
                  <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    var tableUser;
    $(document).ready(function () {
        getSiswa();
        <?php
        if($siswa != null) {
            echo 'getData("'. $param .'");';
            echo 'setActiveTab("data-form-tab");';
        }
        ?>

        $('#datepicker').daterangepicker({
          singleDatePicker: true,
          showDropdowns: true,
          minYear: 1950,
          maxYear: parseInt(moment().format('YYYY'),10),
          format: 'YYYY-MM-DD'
        });

        //Initialize Select2 Elements
        $('.select2').select2()

         /* Create Input on footer */
        // $('#data-table tfoot th').each(function() {
        //     var title = $(this).text();
        //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        // });

        
    });

    function newForm() {
        loadContent(base_url + "view/_user_form", function () {
            setActiveTab("data-form-tab");
        });
    }

    function getSiswa() {
        if ($.fn.dataTable.isDataTable('#data-table')) {
            tableUser = $('#data-table').DataTable({responsive: true});
        } else {
            tableUser = $('#data-table').DataTable({
                "ajax": base_url + 'objects/siswa',
                "columns": [
                   {"data": "no"},
                   {"data": "nis"},
                   {"data": "nama"},
                   {"data": "jenis_kelamin"},
                   {"data": "kelas"},
                   {"data": "aksi"}
                ],
                responsive: true,
                "ordering": true,
                "deferRender": true,
                "order": [[0, "asc"],[3, "asc"]],
                "fnDrawCallback": function (oSettings) {
                    utilUser();
                }
            });
             // tableSubkelas.columns().every(function() {
            //     var that = this;

            //     $('input', this.footer()).on('keyup change clear', function() {
            //         if (that.search() !== this.value) {
            //             that
            //                 .search(this.value)
            //                 .draw();
            //         }
            //     });
            // });
        }
    }

    

    function utilUser() {
        <?php 
        if ($this->session->userdata('_LEVEL') == 'driver') {
            echo '$("#table-user .editBtn, #table-user .removeBtn, #btn-add, #btn-save").hide();';
        }
        ?>
        $("#data-table .editBtn").on("click",function() {
            loadContent(base_url + 'view/_data_siswa/' + $(this).attr('href').substring(1));
        });

        $("#data-table .removeBtn").on("click",function() {
            konfirmDelete($(this).attr('href').substring(1));
        });
    }

    function saving() {
        loading('loading',true);
        setTimeout(function() {
            $.ajax({
                url: base_url + 'manage',
                data: $("#data-form").serialize(),
                dataType: 'json',
                type: 'POST',
                cache: false,
                success: function(json) {
                    loading('loading',false);
                    if (json.data.code === 0) {
                        if (json.data.message == '') {
                            genericAlert('Penyimpanan data gagal!', 'error','Error');
                        } else {
                            genericAlert(json.data.message, 'warning','Peringatan');
                        }
                    } else {
                        var page ='_data_siswa/';
                        page += json.data.last_id;
                        genericAlert('Penyimpanan data berhasil', 'success','Sukses');
                        loadContent(base_url + 'view/' + page);
                    }
                }
            });
        }, 100);
    }

    function getData(idx) {
        $.ajax({
            url: base_url + 'object',
            data: 'model-input=siswa&key-input=id&value-input=' + idx,
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json) {
                if (json.data.code === 0) {
                    loginAlert('Akses tidak sah');
                } else {
                    $("#nama").val(json.data.object.nama);
                    $("#jenis_kelamin").val(json.data.object.jenis_kelamin);
                    $("#alamat").val(json.data.object.alamat);
                    $("#datepicker").val(json.data.object.tgl_lahir);
                    $("#nis").val(json.data.object.nis);
                    $("#nisn").val(json.data.object.nisn);
                    $("#id_kelas").val(json.data.object.id_kelas);
                    $("#action-input").val('2');
                    $("#value-input").val(json.data.object.id);
                }
            }
        });
    }

    function konfirmDelete(n){
        swal({
            title: "Konfirmasi Hapus",
            text: "Apakah anda yakin akan menghapus data ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: " Ya",
            closeOnConfirm: false
        },
        function(){
            loading('loading',true);
            setTimeout(function() {
                $.ajax({
                    url: base_url + 'manage',
                    data: 'model-input=siswa&action-input=3&key-input=id&value-input='+n,
                    dataType: 'json',
                    type: 'POST',
                    cache: false,
                    success: function(json){
                        loading('loading',false);
                        if (json.data.code === 1) {
                            genericAlert('Hapus data berhasil','success','Sukses');
                            refreshTable();
                        } else if(json.data.code === 2){
                            genericAlert('Pastikan siswa ini tidak mempunyai wali!','warning','Perhatian');
                        } else{
                            genericAlert(json.data.message,'warning','Perhatian');
                        }
                    },
                    error: function () {
                        loading('loading',false);
                        genericAlert('Tidak dapat hapus data!','error', 'Error');
                    }
                });
            }, 100);
        });
    }

    function resetForm(){
      $("#data-form")[0].reset();
      $("#action-input").val(1);
      $("#value-input").val("");
    }

    function refreshTable(){
        tableUser.ajax.url(base_url + '/objects/siswa').load();
    }
</script>