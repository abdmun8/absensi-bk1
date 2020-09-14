  <?php
    $jadwal = null;
    if ($param != null) {
        $jadwal = $this->model->getRecord(array(
          'table' => 'jadwal_pelajaran', 'where' => array('id' => $param)
        ));
    }

    $kelas = $this->db->select("id, concat(tingkat,' ',nama_kelas) as kelas",false)->where('active',1)->get('kelas')->result();

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jadwal Pelajaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Jadwal Pelajaran</li>
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
                  <li class="nav-item"><a onclick="refreshTable()" class="nav-link active" href="#data-tab" data-toggle="tab"> Data</a></li>
                  <li class="nav-item"><a onclick="resetForm()" class="nav-link" href="#form-tab" data-toggle="tab">Form</a></li>
                </ul>
              </div><!-- /.card-header -->                
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="data-tab">
                    <!-- table -->
                    <table id="data-table" class="table table-sm table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Jml jam</th>
                        <th>Mat Pel</th>
                        <th>Kelas</th>
                        <th>Guru</th>
                        <th>Opsi</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <!-- /table -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="form-tab">
                    <form id="data-form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" id="hari" name="hari">
                              <option value="senin"> SENIN</option>
                              <option value="selasa"> SELASA</option>
                              <option value="rabu"> RABU</option>
                              <option value="kamis"> KAMIS</option>
                              <option value="jum'at"> JUM'AT</option>
                              <option value="sabtu"> SABTU</option>
                              <option value="minggu"> MINGGU</option>
                            </select>
                            <!-- <input type="text" name="hari" class="form-control" placeholder="NIS"> -->
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Kelas</label>
                            <select class="form-control" name="id_kelas" id="id_kelas">
                              <?php
                                $kelas = $this->db->get('kelas')->result();
                                foreach ($kelas as $key => $kls) {
                                  echo "<option value='". $kls->id ."'> ". $kls->deskripsi ."</option>";
                                }
                              ?>                            
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Row -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control" name="id_matpel" id="id_matpel">
                              <?php
                                $kelas = $this->db->get('mata_pelajaran')->result();
                                foreach ($kelas as $key => $kls) {
                                  echo "<option value='". $kls->id ."'> ". $kls->nama ."</option>";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Guru</label>
                            <select class="form-control" name="id_guru" id="id_guru">
                              <?php
                                $kelas = $this->db->get('guru')->result();
                                foreach ($kelas as $key => $kls) {
                                  echo "<option value='". $kls->id ."'> ". $kls->nama ."</option>";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- End Row -->

                      <!-- Row -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Jumlah Jam Pelajaran (45 Min)</label>
                            <select class="form-control" id="jumlah_jam" name="jumlah_jam">
                              <option value="1">1 Jam</option>
                              <option value="2">2 Jam</option>
                              <option value="3">3 Jam</option>
                              <option value="4">4 Jam</option>
                              <option value="5">5 Jam</option>
                              <option value="6">6 Jam</option>
                              <option value="7">7 Jam</option>
                              <option value="8">8 Jam</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Jam Mulai</label>
                            <select class="form-control" name="jam" id="jam">
                              <option value="7:00">7:00</option>
                              <option value="7:45">7:45</option>
                              <option value="8:30">8:30</option>
                              <option value="9:15">9:15</option>
                              <option value="10:00">10:00</option>
                              <option value="10:45">10:45</option>
                              <option value="11:30">11:30</option>
                              <option value="13:00">13:00</option>
                              <option value="13:45">13:45</option>
                              <option value="14:30">14:30</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- End Row -->

                      <input type="hidden" id="value-input" name="value-input">
                      <input type="hidden" id="key-input" name="key-input" value="id">
                      <input type="hidden" id="action-input" name="action-input" value="1">
                      <input type="hidden" id="model-input" name="model-input" value="jadwal_pelajaran">

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
        getJadwal();
        <?php
        if($jadwal != null) {
            echo 'getData("'. $param .'");';
            echo 'setActiveTab("form-tab");';
        }
        ?>

        $('#datepicker').daterangepicker({
          singleDatePicker: true,
          showDropdowns: true,
          minYear: 1901,
          maxYear: parseInt(moment().format('YYYY'),10)
        });

        //Initialize Select2 Elements
        $('.select2').select2()
        
    });

    function newForm() {
        loadContent(base_url + "view/_user_form", function () {
            setActiveTab("data-form-tab");
        });
    }

    function getJadwal() {
        if ($.fn.dataTable.isDataTable('#data-table')) {
            tableUser = $('#data-table').DataTable({responsive: true});

        } else {
            tableUser = $('#data-table').DataTable({
                "ajax": base_url + 'objects/jadwal_pelajaran',
                "columns": [
                   {"data": "no"},
                   {"data": "hari"},
                   {"data": "jam"},
                   {"data": "jumlah_jam"},
                   {"data": "mata_pelajaran"},
                   {"data": "kelas"},
                   {"data": "nama_guru"},
                   {"data": "aksi"}
                ],
                "responsive": true,
                "ordering": true,
                "deferRender": true,
                "order": [[0, "asc"],[3, "asc"]],
                "columnDefs": [
                  {targets: -1,className: 'text-center', orderable: false}
                ],
                "fnDrawCallback": function (oSettings) {
                    utilUser();
                }
            });
        }
    }

    

    function utilUser() {
        <?php 
        if ($this->session->userdata('_LEVEL') == 'driver') {
            echo '$("#data-table .editBtn, #data-table .removeBtn, #btn-add, #btn-save").hide();';
        }
        ?>
        $("#data-table .editBtn").on("click",function() {
            loadContent(base_url + 'view/_jadwal_pelajaran/' + $(this).attr('href').substring(1));
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
                        var page ='_jadwal_pelajaran/';
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
            data: 'model-input=jadwal_pelajaran&key-input=id&value-input=' + idx,
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json) {
                if (json.data.code === 0) {
                    loginAlert('Akses tidak sah');
                } else {
                    $("#id_kelas").val(json.data.object.id_kelas);
                    $("#id_matpel").val(json.data.object.id_matpel);
                    $("#id_guru").val(json.data.object.id_guru);
                    $("#jumlah_jam").val(json.data.object.jumlah_jam);
                    $("#jam").val(json.data.object.jam);
                    $("#hari").val(json.data.object.hari);
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
                    data: 'model-input=jadwal_pelajaran&action-input=3&key-input=id&value-input='+n,
                    dataType: 'json',
                    type: 'POST',
                    cache: false,
                    success: function(json){
                        loading('loading',false);
                        if (json.data.code === 1) {
                            genericAlert('Hapus data berhasil','success','Sukses');
                            refreshTable();
                        } else if(json.data.code === 2){
                            genericAlert('Hapus data gagal!','error','Error');
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
        tableUser.ajax.url(base_url + '/objects/jadwal_pelajaran').load();
    }

</script>