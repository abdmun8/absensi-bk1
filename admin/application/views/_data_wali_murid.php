  <?php
    $siswa = null;
    if ($param != null) {
        $siswa = $this->model->getRecord(array(
            'table' => 'wali_murid', 'where' => array('id' => $param)
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
            <h1>Data Wali Murid</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Database</a></li>
              <li class="breadcrumb-item active">Data Wali Murid</li>
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
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Nama Siswa</th>
                        <th>kelas</th>
                        <th>Opsi</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <!-- <tfoot>
                      <tr>
                        <th></th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                      </tr>
                      </tfoot> -->
                    </table>
                    <!-- /table -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="form-tab">

                    <form id="data-form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nama Wali</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>No Hp</label>
                            <input type="text" class="form-control" placeholder="No Hp" id="no_hp" name="no_hp">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Kelas</label>
                            <select class="form-control" onchange="getSiswa(this.value);" id="id_kelas">
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
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nama Siswa</label>
                            <select disabled="true" class="form-control" id="id_siswa" name="id_siswa">
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" style="width: 100%;" id="jenis_kelamin" name="jenis_kelamin">
                              <option value="L">Laki-Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <hr>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="username" id="username" name="username">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>ulangi Password</label>
                            <input type="password" class="form-control" placeholder="Ulangi Password" id="repeat-password" name="repeat-password">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" placeholder="Alamat" id="alamat" name="alamat"></textarea>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" id="value-input" name="value-input" >
                      <input type="hidden" id="key-input" name="key-input" value="id">
                      <input type="hidden" id="action-input" name="action-input" value="1">
                      <input type="hidden" id="model-input" name="model-input" value="wali_murid">

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
<!--   <script type="text/javascript">
    $(function () {

      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass   : 'iradio_square-blue',
        // increaseArea : '10%' // optional
      })
      
      $('#example1 tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      });

      var table = $('#example1').DataTable({
        autoWidth: true,
        responsive: true
      });

      // Apply the search
      table.columns().every( function () {
          var that = this;   
          $( 'input', this.footer() ).on( 'keyup change', function () {
              if ( that.search() !== this.value ) {
                that
                .search( this.value )
                .draw();
              }
          });
      });
    });

  </script>  -->

  <script>
    var tableUser;
    $(document).ready(function () {
        getWali();
        <?php
        if($siswa != null) {
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

    function getWali() {
        if ($.fn.dataTable.isDataTable('#data-table')) {
            tableUser = $('#data-table').DataTable({responsive: true});
        } else {
            tableUser = $('#data-table').DataTable({
                "ajax": base_url + 'objects/wali_murid',
                "columns": [
                   {"data": "nama"},
                   {"data": "jenis_kelamin"},
                   {"data": "nama_siswa"},
                   {"data": "nama_kelas"},
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
        }
    }

    

    function utilUser() {
        <?php 
        if ($this->session->userdata('_LEVEL') == 'driver') {
            echo '$("#table-user .editBtn, #table-user .removeBtn, #btn-add, #btn-save").hide();';
        }
        ?>
        $("#data-table .editBtn").on("click",function() {
            loadContent(base_url + 'view/_data_wali_murid/' + $(this).attr('href').substring(1));
        });

        $("#data-table .removeBtn").on("click",function() {
            konfirmDelete($(this).attr('href').substring(1));
        });
    }

    function saving() {
        if($("#password").val() != $("#repeat-password").val()){
          genericAlert('Password Tidak Sama!', 'error','Error');
          return;
        }
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
                        var page ='_data_wali_murid/';
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
            data: 'model-input=wali_murid&key-input=id&value-input=' + idx,
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json) {
                if (json.data.code === 0) {
                    loginAlert('Akses tidak sah');
                } else {
                  // console.log(json);

                    $("#nama").val(json.data.object.nama);                    
                    $("#alamat").val(json.data.object.alamat);
                    $("#no_hp").val(json.data.object.no_hp);
                    $("#jenis_kelamin").val(json.data.object.jenis_kelamin);
                    $("#username").val(json.data.object.username);
                    $("#password").attr("placeholder","Kosongkan jika tidak ingin dirubah");
                    $("#action-input").val('2');
                    $("#value-input").val(json.data.object.id);
                    getSiswa("",json.data.object.id_siswa);
                    $("#id_siswa").val(json.data.object.id_siswa);
                }
            }
        });
    }

    function getSiswa(id_kelas = "", id_siswa = ""){
      if(id_kelas == "" && id_siswa == "")
        return;
      $.ajax({
        url: base_url + 'get_siswa',
        data: 'id_kelas=' + id_kelas + '&id_siswa=' + id_siswa,
        dataType: 'json',
        type: 'GET',
        cache: false,
        success: function(json) {
          if(json.length){
            $("#id_siswa").attr("disabled",false).
            children().remove();
            if(id_siswa != ""){
              $("#id_kelas").val(json[0].id_kelas);
            }
            for (var i = 0; i < json.length; i++) {
              if(id_siswa != "" && json[i].id == id_siswa){
                $("#id_siswa").append(
                  "<option selected value='"+ json[i].id +"'>"+ json[i].nama +"</option>"
                );
              }else{
                $("#id_siswa").append(
                  "<option value='"+ json[i].id +"'>"+ json[i].nama +"</option>"
                );  
              }

              
            }
          }
        },
        error: function(e){
          genericAlert(e)
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
                    data: 'model-input=user&action-input=3&key-input=user_id&value-input='+n,
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
      $("#id_siswa").attr("disabled",true).
            children().remove();
    }

    function refreshTable(){
        tableUser.ajax.url(base_url + '/objects/wali_murid').load();
    }
</script>