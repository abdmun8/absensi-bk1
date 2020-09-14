<?php
$jadwal = null;
$tipe_libur = null;
if ($param != null) {
  $jadwal = $this->model->getRecord(array(
    'table' => 'jadwal_sekolah', 'where' => array('id' => $param)
  ));
}

$tipe_libur = $this->db->get('tipe_libur')->result();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jadwal Sekolah</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active">Jadwal Sekolah</li>
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
                  <div class="table-responsive">
                    <table width="100%" id="data-table" class="table table-sm table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tahun Ajaran</th>
                          <th>Nama Libur</th>
                          <th>Keterangan</th>
                          <th>Tipe Libur</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- /table -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="form-tab">
                  <form id="data-form">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Tahun Ajaran</label>
                          <input type="text" class="form-control" placeholder="Tahun Ajaran" id="tahun_ajaran" name="tahun_ajaran">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Semester</label>
                          <select class="form-control" id="semester" name="semester">
                          <option value="" selected disabled>Pilih Semester</option>
                            <option value="Ganjil"> Ganjil</option>
                            <option value="Genap">Genap</option>
                          </select>
                        </div>
                      </div>
                      <!-- Row -->
                
                       <div class=" col-md-6">
                        <div class="form-group">
                          <label>Nama Libur</label>
                          <input type="text" class="form-control" placeholder="Nama Libur" id="nama_libur" name="nama_libur">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Keterangan</label>
                          <textarea class="form-control" rows="3" placeholder="Keterangan" id="keterangan" name="keterangan"></textarea>
                        </div>
                      </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Tipe Libur</label>
                        <select class="form-control" id="tipe_libur" name="tipe_libur">
                          <option value="" selected disabled>Pilih Tipe Libur</option>
                          <?php
                          foreach ($tipe_libur as $key => $v) {
                            ?>
                            <option value="<?= $v->id ?>"><?= $v->nama_libur ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                 </div>

                    <!-- End Row -->

                    <input type="hidden" id="value-input" name="value-input">
                    <input type="hidden" id="key-input" name="key-input" value="id">
                    <input type="hidden" id="action-input" name="action-input" value="1">
                    <input type="hidden" id="model-input" name="model-input" value="jadwal_sekolah">

                  </form>

                  <div class="row">
                    <div class="col-md-12 mx-auto">
                      <button type="button" id="btn-save" class="btn btn-success" onclick="saving(); return false;"><i class="fa fa-save"></i> Simpan</button>
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
  $(document).ready(function() {
    getJadwal();
    <?php
    if ($jadwal != null) {
      echo 'getData("' . $param . '");';
      echo 'setActiveTab("form-tab");';
    }
    ?>

    $('#datepicker').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1901,
      maxYear: parseInt(moment().format('YYYY'), 10)
    });

    //Initialize Select2 Elements
    $('.select2').select2()

  });

  function newForm() {
    loadContent(base_url + "view/_user_form", function() {
      setActiveTab("data-form-tab");
    });
  }

  function getJadwal() {
    if ($.fn.dataTable.isDataTable('#data-table')) {
      tableUser = $('#data-table').DataTable({
        responsive: true
      });

    } else {
      tableUser = $('#data-table').DataTable({
        "ajax": base_url + 'objects/jadwal_sekolah',
        "columns": [{
            "data": "no"
          },
          {
            "data": "tahun_ajaran"
          },
          
          {
            "data": "nama_libur"
          },
          {
            "data": "keterangan"
          },
          {
            "data": "tipe_libur"
          },
          {
            "data": "aksi"
          }
        ],
        "responsive": true,
        "ordering": true,
        "deferRender": true,
        "order": [
          [0, "asc"],
          [3, "asc"]
        ],
        "columnDefs": [{
          targets: -1,
          className: 'text-center',
          orderable: false
        }],
        "fnDrawCallback": function(oSettings) {
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
    $("#data-table .editBtn").on("click", function() {
      loadContent(base_url + 'view/_jadwal_sekolah/' + $(this).attr('href').substring(1));
    });

    $("#data-table .removeBtn").on("click", function() {
      konfirmDelete($(this).attr('href').substring(1));
    });
  }

  function saving() {
    loading('loading', true);
    setTimeout(function() {
      $.ajax({
        url: base_url + 'manage',
        data: $("#data-form").serialize(),
        dataType: 'json',
        type: 'POST',
        cache: false,
        success: function(json) {
          loading('loading', false);
          if (json.data.code === 0) {
            if (json.data.message == '') {
              genericAlert('Penyimpanan data gagal!', 'error', 'Error');
            } else {
              genericAlert(json.data.message, 'warning', 'Peringatan');
            }
          } else {
            var page = '_jadwal_sekolah/';
            page += json.data.last_id;
            genericAlert('Penyimpanan data berhasil', 'success', 'Sukses');
            loadContent(base_url + 'view/' + page);
          }
        }
      });
    }, 100);
  }

  function getData(idx) {
    $.ajax({
      url: base_url + 'object',
      data: 'model-input=jadwal_sekolah&key-input=id&value-input=' + idx,
      dataType: 'json',
      type: 'POST',
      cache: false,
      success: function(json) {
        if (json.data.code === 0) {
          loginAlert('Akses tidak sah');
        } else {
          $("#tahun_ajaran").val(json.data.object.tahun_ajaran);
          $("#semester").val(json.data.object.semester);
          $("#keterangan").val(json.data.object.keterangan);
          $("#tipe_libur").val(json.data.object.tipe_libur);
          $("#action-input").val('2');
          $("#value-input").val(json.data.object.id);
        }
      }
    });
  }

  function konfirmDelete(n) {
    swal({
        title: "Konfirmasi Hapus",
        text: "Apakah anda yakin akan menghapus data ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: " Ya",
        closeOnConfirm: false
      },
      function() {
        loading('loading', true);
        setTimeout(function() {
          $.ajax({
            url: base_url + 'manage',
            data: 'model-input=jadwal_pelajaran&action-input=3&key-input=id&value-input=' + n,
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json) {
              loading('loading', false);
              if (json.data.code === 1) {
                genericAlert('Hapus data berhasil', 'success', 'Sukses');
                refreshTable();
              } else if (json.data.code === 2) {
                genericAlert('Hapus data gagal!', 'error', 'Error');
              } else {
                genericAlert(json.data.message, 'warning', 'Perhatian');
              }
            },
            error: function() {
              loading('loading', false);
              genericAlert('Tidak dapat hapus data!', 'error', 'Error');
            }
          });
        }, 100);
      });
  }

  function resetForm() {
    $("#data-form")[0].reset();
    $("#action-input").val(1);
    $("#value-input").val("");
  }

  function refreshTable() {
    tableUser.ajax.url(base_url + '/objects/jadwal_sekolah').load();
  }
</script>