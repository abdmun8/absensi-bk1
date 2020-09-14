  <?php
    if( $this->session->userdata("_LEVEL") != 'wali' ){
      $kelas = $this->db->select("id, concat(tingkat,' ',nama_kelas) as kelas",false)->where('active',1)->get('kelas')->result();
    }else{
      $id_kelas = $this->db->get_where('siswa',
        ['id'=>$this->session->userdata('_ID_SISWA')]
      )->row()->id_kelas;
      $kelas = $this->db->select("id, concat(tingkat,' ',nama_kelas) as kelas",false)->where(['active'=>1,'id'=>$id_kelas])->get('kelas')->result();
    } ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Semester</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Laporan</a></li>
              <li class="breadcrumb-item active">laporan Semester</li>
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

                      <!-- <div class="form-group mx-2">
                        <label for="id_matpel" class=" mr-2">Pilh MaPel:</label>
                        <select onchange="get_realtime(this.value);" class="form-control" id="id_matpel" name="id_matpel">       

                        </select>
                      </div> -->
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
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
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

      var kelas = $('#id_kelas').val();

      if ($.fn.dataTable.isDataTable('#data-table')) {
          tableUser = $('#data-table').DataTable({responsive: true});
      } else {
          tableUser = $('#data-table').DataTable({
              "ajax": base_url + 'get_all_semester?kelas='+ kelas,
              "columns": [
                 {"data": "tahun_ajaran"},
                 {"data": "semester"},
                 {"data": "aksi"}
              ],
              responsive: true,
              "ordering": true,
              "deferRender": true,
              "order": [[0, "asc"]],
              "fnDrawCallback": function (oSettings) {
                  // utilUser();
              }
          });
        }
      }

    function get_mapel(kelas = ''){
      if(kelas == ''){
        kelas = $("#id_kelas").val();        
      }
      $(".data-wrap").children().remove();
      $(".data-wrap").append('<tr><td class="text-center" colspan="10">Data Kosong</td></tr>');

      setTimeout( function() {
        $.ajax({
          url: base_url + 'get_mapel',
          dataType: 'json',
          data: {id_kelas: kelas},
          type: 'GET',
          cache: false,
          success: function(json) {
            var data = json;
            $("#id_matpel").children().remove();
            $("#id_matpel").append('<option value="" selected disabled>Mata Pelajaran</option>');
            if(!json.length){              
              return;
            }
            var j = 0;
            for (var i = 0; i < data.length; i++) {
              $("#id_matpel").append(
                '<option value="'+data[i].id_matpel+'">'+data[i].nama_matpel+'</option>'
                );
            }
          },
          error: function(e){
            alert(e);
          }
        });
      }, 100);
    }

    function printSemesterReport(ta, smt){
      var kelas = $("#id_kelas").val();
      setTimeout(function () {
      $.ajax({
            url: base_url + 'print_semester',
            dataType: "html",
            data: 'tahun_ajaran='+ ta+'&semester='+smt+'&kelas='+ kelas,
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