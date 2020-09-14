<?php
    $data = null;
    if ($param != null) {
        $data = $this->model->getRecord(array(
            'table' => 'pic_eksternal', 'where' => array('id' => $param)
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
            <h1>Data PIC Eksternal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Database</a></li>
              <li class="breadcrumb-item active">Data PIC Eksternal</li>
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
                    <table width="100%"" id="data-table" class="table table-sm table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama PIC</th>
                        <th>Keterangan</th>
                        <th>Nama Perusahaan</th>
                        <th>Opsi</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama PIC</th>
                        <th>Keterangan</th>
                        <th>Nama Perusahaan</th>
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
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Nama PIC</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama PIC">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" placeholder="Keterangan" id="keterangan" name="keterangan"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" id="perusahaan" name="perusahaan" class="form-control" placeholder="Nama Perusahaan">
                          </div>
                        </div>
                      
                      <input type="hidden" id="value-input" name="value-input" >
                      <input type="hidden" id="key-input" name="key-input" value="id">
                      <input type="hidden" id="action-input" name="action-input" value="1">
                      <input type="hidden" id="model-input" name="model-input" value="pic_eksternal">

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
        getAll();
        <?php
        if($data != null) {
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

    function getAll() {
        if ($.fn.dataTable.isDataTable('#data-table')) {
            tableUser = $('#data-table').DataTable({responsive: true});
        } else {
            tableUser = $('#data-table').DataTable({
                "ajax": base_url + 'objects/pic_eksternal',
                "columns": [
                   {"data": "no"},
                   {"data": "nama"},
                   {"data": "perusahaan"},
                   {"data": "keterangan"},
                   {"data": "aksi"}
                ],
                 // "scrollX": true,
                responsive: true,
                "ordering": true,
                "deferRender": true,
                "order": [[0, "asc"],[1, "asc"]],
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
            loadContent(base_url + 'view/_data_pic_eksternal/' + $(this).attr('href').substring(1));
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
                        var page ='_data_pic_eksternal/';
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
            data: 'model-input=pic_eksternal&key-input=id&value-input=' + idx,
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json) {
                if (json.data.code === 0) {
                    loginAlert('Akses tidak sah');
                } else {
                    $("#nama").val(json.data.object.nama);
                    $("#keterangan").val(json.data.object.keterangan);
                    $("#perusahaan").val(json.data.object.perusahaan);
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
                    data: 'model-input=pic_eksternal&action-input=3&key-input=id&value-input='+n,
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
        tableUser.ajax.url(base_url + '/objects/pic_eksternal').load();
    }
</script>