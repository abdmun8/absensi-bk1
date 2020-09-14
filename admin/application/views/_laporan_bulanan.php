  <?php
    if( $this->session->userdata("_LEVEL") != 'wali' ){
      $kelas = $this->db->select("id, concat(tingkat,' ',nama_kelas) as kelas",false)->where('active',1)->get('kelas')->result();
    }else{
      $id_kelas = $this->db->get_where('siswa',
        ['id'=>$this->session->userdata('_ID_SISWA')]
      )->row()->id_kelas;
      $kelas = $this->db->select("id, concat(tingkat,' ',nama_kelas) as kelas",false)->where(['active'=>1,'id'=>$id_kelas])->get('kelas')->result();
    }

    $years = $this->db->select('YEAR(trx_date) as year',false)->group_by('YEAR(trx_date)')->get('absensi')->result();
    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Bulanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Laporan</a></li>
              <li class="breadcrumb-item active">laporan Bulanan</li>
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
              <?php //if($this->session->userdata("_LEVEL") != 'wali'): ?>
                <!-- Select kelas -->
                <div class="card-header p-2">
                  <form class="form-inline">
                      <div class="form-group mx-2">
                        <label for="id_kelas" class=" mr-2">Pilh Kelas:</label>
                        <select onchange="get_mapel(this.value);" class="form-control" id="id_kelas" name="id_kelas">
                          <?php
                            foreach ($kelas as $key => $v) {
                              ?>
                                <option value="<?=$v->id?>"><?=$v->kelas?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>

                      <div class="form-group mx-2">
                        <label for="id_matpel" class=" mr-2">Pilh Tahun:</label>
                        <select onchange="refreshTable();" class="form-control" id="year" name="year">     
                        <?php
                            foreach ($years as $key => $v) {
                              ?>
                                <option value="<?=$v->year?>"><?=$v->year?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                    </form>
                </div>
                <!-- /Select Kelas -->
              <?php //endif; ?>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="data-table-tab">
                    <!-- table -->
                    <div class="table-responsive-sm">
                      <table id="data-table" class="table table-sm table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Bulan</th>
                        <th>Awal</th>
                        <th>Akhir</th>
                        <th>Opsi</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                      <!-- /table -->
                    </div>
                    <div class="btn-wrap"></div>
                  </div>
                  <!-- /.tab-pane -->
                    
                  </div>
                  <!-- /.row -->
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
    var data_absen;
    var tableUser;
    $(document).ready(function () {
        getAll();     
        // get_mapel();          
    });

    function getAll() {        
        var year = $("#year").val();
        if ($.fn.dataTable.isDataTable('#data-table')) {
            tableUser = $('#data-table').DataTable({responsive: true});
        } else {
            tableUser = $('#data-table').DataTable({
                "ajax": base_url + 'get_all_month?year='+year,
                "columns": [
                   {"data": "month"},
                   {"data": "start"},
                   {"data": "end"},
                   {"data": "aksi"}
                ],
                "ordering": true,
                "deferRender": true,
                "order": [[0, "asc"]],
                "fnDrawCallback": function (oSettings) {
                    // utilUser();
                }
            });
        }
      }

    function refreshTable(){
        tableUser.ajax.url(base_url + 'get_all_month?year='+year).load();
    }

    function printWeeklyReport(start, end){
      var kelas = $("#id_kelas").val();
      setTimeout(function () {
      $.ajax({
            url: base_url + 'print_monthly',
            dataType: "html",
            data: 'start='+ start+'&end='+end+'&kelas='+ kelas,
            type: "POST",
            cache: false,
            success: function(html){
              loading('loading', false);
                var w = window.open('', 'Laporan Absensi', 'width=700, height=900, scrollbars=yes');
                var $w = $(w.document.body);
            $w.html(html);
            },
            error: function() {
                loading('loading-modal', false);
                notify("Respon server error",'danger');
            }
          });
      }, 500); 
    }

    

</script>