  <?php
    $kelas = $this->db->select("id, concat(tingkat,' ',nama_kelas) as kelas",false)->where('active',1)->get('kelas')->result(); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Realtime</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Laporan</a></li>
              <li class="breadcrumb-item active">laporan Realtime</li>
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
                        <label for="id_matpel" class=" mr-2">Pilh MaPel:</label>
                        <select onchange="get_realtime(this.value);" class="form-control" id="id_matpel" name="id_matpel">       

                        </select>
                      </div>
                    </form>
                </div>
                <!-- /Select Kelas -->
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="data-table-tab">
                    <!-- table -->
                    <p class="text-bold text-center" id="date-wrap"><?php echo date('d F Y');?></p>
                    <div class="table-responsive-sm">
                      <table id="data-table" class="table table-bordered table-sm">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th class="text-center">Mata Pelajaran</th>
                          <th class="text-center">Nama guru</th>
                          <th class="text-center">Jumlah Jam</th>
                          <th class="text-center">Keterangan</th>
                        </tr>
                        </thead>
                        <tbody class="data-wrap">
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
    $(document).ready(function () {
        get_mapel();
        $('.select2').select2()
               
    });

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

    function get_realtime(mapel){
      var kelas = $("#id_kelas").val();

      setTimeout( function() {
          $.ajax({
              url: base_url + 'get_realtime',
              dataType: 'json',
              data: {id_kelas: kelas,id_mapel: mapel},
              type: 'GET',
              cache: false,
              success: function(json) {
                var data = json;
                $(".data-wrap").children().remove();
                if(!json.length){
                  $(".data-wrap").append('<tr><td class="text-center" colspan="10">Data Kosong</td></tr>');
                  return;
                }
                var j = 0;
                for (var i = 0; i < data.length; i++) {
                  var ket = "Hadir";
                  j = i + 1;
                  var bg = "bg-success";
                  if(!parseInt(data[i].value)){
                    ket = data[i].keterangan;
                    
                    switch (data[i].keterangan) {
                      case 'S':
                        ket = "Sakit";
                        bg = "bg-primary";
                        break;
                      case 'I':
                        ket = "Izin";
                        bg = "bg-warning";
                        break;
                      case 'A':
                        ket = "Alpa";
                        bg = "bg-danger";
                        break;
                    }
                  }
                  
                  $(".data-wrap").
                    append(
                      '<tr>'+
                      '<td class="text-center">'+j+'</td>'+
                      '<td>'+data[i].nama+'</td>'+
                      '<td>'+data[i].nama_matpel+'</td>'+
                      '<td>'+data[i].nama_guru+'</td>'+
                      '<td class="text-center">'+data[i].jumlah_jam+'</td>'+
                      '<td class="'+bg+' text-center small">'+ket+'</td>'+                      
                      '</tr>'
                      );
                }
              },
              error: function(e){
                alert(e);
              }
          });
        }, 100);
    }

</script>