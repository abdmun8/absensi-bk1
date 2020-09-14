  <?php
    $data = null;
    if ($param != null) {
        $data = $this->model->getRecord(array(
            'table' => 'kelas', 'where' => array('id' => $param)
            ));
    }


  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Database</a></li>
              <li class="breadcrumb-item active">Data Kelas</li>
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
                  <li class="nav-item"><a class="nav-link active" href="#data-tab" data-toggle="tab"> Data</a></li>
                  <li class="nav-item"><a class="nav-link" href="#form-tab" data-toggle="tab">Form</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="data-tab">
                    <!-- table -->
                    <table id="data-table" class="table table-sm table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Deskripsi</th>
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
                            <label>Kelas</label>
                            <select class="form-control" id="tingkat" name="tingkat">
                            <option value="" selected disabled>Pilih Kelas</option>
                              <option value="X">X</option>
                              <option value="XI">XI</option>
                              <option value="XII">XIII</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nama Kelas</label>
                            <input type="text" class="form-control" placeholder="Nama Kelas" id="nama_kelas" name="nama_kelas">
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsi" name="deskripsi"></textarea>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" id="value-input" name="value-input">
                      <input type="hidden" id="key-input" name="key-input" value="id">
                      <input type="hidden" id="action-input" name="action-input" value="1">
                      <input type="hidden" id="model-input" name="model-input" value="kelas">

                    <form>

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
        getAll();
        <?php
        if($data != null) {
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
        loadContent(base_url + "view/_data_kelas", function () {
            setActiveTab("data-form-tab");
        });
    }

    function getAll() {
        if ($.fn.dataTable.isDataTable('#data-table')) {
            tableUser = $('#data-table').DataTable({responsive: true});
        } else {
            tableUser = $('#data-table').DataTable({
                "ajax": base_url + 'objects/kelas',
                "columns": [
                   {"data": "tingkat"},
                   {"data": "nama_kelas"},
                   {"data": "deskripsi"},
                   {"data": "aksi"}
                ],
                responsive: true,
                "ordering": true,
                "deferRender": true,
                "order": [[0, "asc"],[1, "asc"]],
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
            loadContent(base_url + 'view/_data_kelas/' + $(this).attr('href').substring(1));
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
                        var page ='_data_kelas/';
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
            data: 'model-input=kelas&key-input=id&value-input=' + idx,
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json) {
                if (json.data.code === 0) {
                    loginAlert('Akses tidak sah');
                } else {
                    $("#tingkat").val(json.data.object.tingkat);
                    $("#deskripsi").val(json.data.object.deskripsi);
                    $("#nama_kelas").val(json.data.object.nama_kelas);
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
                    data: 'model-input=kelas&action-input=3&key-input=id&value-input='+n,
                    dataType: 'json',
                    type: 'POST',
                    cache: false,
                    success: function(json){
                        loading('loading',false);
                        if (json.data.code === 1) {
                            genericAlert('Hapus data berhasil','success','Sukses');
                            refreshTable();
                        } else if(json.data.code === 2){
                            genericAlert('Pastikan tidak ada siswa dikelas ini!','warning','Perhatian');
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
        tableUser.ajax.url(base_url + '/objects/kelas').load();
    }
</script>