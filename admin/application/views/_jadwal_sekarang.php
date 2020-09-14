  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Absensi Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaction</a></li>
              <li class="breadcrumb-item active">Absensi Siswa</li>
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
                  <li class="nav-item"><a id="form-tab" class="nav-link active" href="#data-form-tab" onclick="return false;">Jadwal hari ini</a></li>
                  <li class="nav-item"><a id="data-tab" class="nav-link" href="#data-table-tab" onclick="return false;"> Absensi Siswa</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="data-table-tab">
                    <!-- table -->
                    <h6><b>Kelas: </b><span id="txt-kelas"></span> &nbsp;|&nbsp;
                      <b>Matpel: </b><span id="txt-matpel"></span> &nbsp;|&nbsp;
                      <b>Guru: </b><span id="txt-guru"></span></h6>
                    <div class="table-responsive-sm">
                      <table id="data-table" class="table table-sm table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Absen/Hadir</th>
                          <th>Keterangan</th>
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
                  <div class="active tab-pane" id="data-form-tab">
                    <!-- Small boxes (Stat box) -->
                  <div class="row jadwal-wrap">

                    
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
        get_jadwal();
               
    });

    function do_absensi(id){
      blockPage('Mohon tunggu...');
      setTimeout( function() {
          $.ajax({
              url: base_url + 'get_siswa_absensi',
              dataType: 'json',
              data:{id:id},
              type: 'POST',
              cache: false,
              success: function(json) {
                $.unblockUI();
                $(".data-wrap").children().remove();
                $(".btn-wrap").children().remove();
                $("#txt-kelas").text("");
                $("#txt-matpel").text("");
                $("#txt-guru").text("");
                // console.log(json);return;
                if(!json){
                  $(".data-wrap").append('<p class="text-center">Data Kosong</p>');
                  return;
                }
                var data = json.data;
                data_absen = json.data;
                // console.log(data_absen)
                var j = 0;
                $("#txt-kelas").text(json.kelas);
                $("#txt-matpel").text(json.mata_pelajaran);
                $("#txt-guru").text(json.nama_guru);
                for (var i = 0; i < data.length; i++) {
                  j = i + 1; 
                  var val = (data[i].value == 1) ? "checked" : "";

                  var check = [];
                  switch (data[i].keterangan) {
                    case '':
                      check = ['','',''];
                      break;
                    case 'S':
                      check = ['checked','',''];
                      break;
                    case 'I':
                      check = ['','checked',''];
                      break;
                    case 'A':
                      check = ['','checked',''];
                      break;
                  }

                  $(".data-wrap").
                    append(
                      '<tr>'+
                      '<td>'+j+'</td>'+
                      '<td>'+data[i].nama+'</td>'+
                      '<td>'+
                        '<span class="switch">'+
                        '<input onchange="hide_ket(this.checked,'+data[i].id+')" type="checkbox" class="switch" '+ val +' id="sw_'+ data[i].id +'">'+
                        '<label for="sw_'+ data[i].id +'"></label>'+
                        '</span>'+
                      '</td>'+
                      '<td>'+
                        '<div class="switch-field btn-group" id="sw-ket-'+data[i].id+'">'+
                          '<input type="radio" id="switch_left_'+data[i].id+'" name="ket_'+data[i].id+'" value="S" onchange="save_absen()" '+check[0]+' />'+
                          '<label for="switch_left_'+data[i].id+'">S</label>'+
                          '<input type="radio" id="switch_center_'+data[i].id+'" name="ket_'+data[i].id+'" value="I" onchange="save_absen()" '+check[1]+' />'+
                          '<label for="switch_center_'+data[i].id+'">I</label>'+
                          '<input type="radio" id="switch_right_'+data[i].id+'" name="ket_'+data[i].id+'" value="A" onchange="save_absen()" '+check[2]+' />'+
                          '<label for="switch_right_'+data[i].id+'">A</label>'+
                        '</div>'+
                      '</td>'+
                      '</tr>'
                    );
                    
                    /* add button at the end of looping*/
                    if(j == data.length){
                      $(".btn-wrap").append('<div class="col-12 text-center"><button class="btn btn-primary" onclick="end_absen()">Simpan</button></div>');
                    }

                    /* change opacity keterangan*/
                    if(parseInt(data[i].value)){
                      $("#sw-ket-"+data[i].id+"").css( "opacity", 0.3 );
                    }else{
                      $("#sw-ket-"+data[i].id+"").css( "opacity", 1 );
                    }
                }
                // $("data-table-tab").tab('show');
                $('#form-tab').removeClass("active");
                $('#data-tab').addClass("active");
                $('#data-form-tab').hide();
                $('#data-table-tab').show();
              },
              error: function(e){
                $.unblockUI();
                alert(e);
              }
          });
        }, 100);
    }

    function hide_ket(v,id){
      if(v){
        $("#sw-ket-"+id+"").css( "opacity", 0.3 );
      }else{
        $("#sw-ket-"+id+"").css( "opacity", 1 );
      }

      save_absen();
    }

    function save_absen(){
      for (var i = 0; i < data_absen.length; i++) {
        data_absen[i].value = $("#sw_"+data_absen[i].id+"").prop("checked");
        data_absen[i].keterangan = $("input[name=ket_"+data_absen[i].id+"]:checked")[0].value;
      }

      setTimeout( function() {
          $.ajax({
              url: base_url + 'save_absen',
              dataType: 'json',
              data: {data: data_absen},
              type: 'POST',
              cache: false,
              success: function(json) {

              },
              error: function(e){
                alert(e);
              }
          });
        }, 100);
    }

    function end_absen(){
      save_absen();     

      /* wait before load jadwal*/
      setTimeout(function(){
        get_jadwal();
        $('#data-tab').removeClass("active");
        $('#form-tab').addClass("active");
        $('#data-form-tab').show();
        $('#data-table-tab').hide();
      }, 2000);


    }

    function get_jadwal(){
      blockPage('Mohon tunggu...');
      setTimeout( function() {
          $.ajax({
              url: base_url + 'get_jadwal_today',
              dataType: 'json',
              type: 'GET',
              cache: false,
              success: function(json) {
                $.unblockUI();
                if(!json.length){
                  $(".jadwal-wrap").append('<p class="text-center">Jadwal Kosong</p>');
                  return;
                }
                $(".jadwal-wrap").children().remove();
                for (var i = 0; i < json.length; i++) {
                  $(".jadwal-wrap").
                    append(
                      '<div class="col-lg-4 col-12">'+
                      '<div class="small-box bg-success">'+
                        '<div class="inner">'+
                          '<h3>'+json[i].kelas+'</h3>'+
                          '<p style="margin-bottom: 0px;padding-bottom: 0px;">'+json[i].mata_pelajaran+'</p>'+
                          '<p style="margin-bottom: 0px;padding-bottom: 0px;">'+json[i].jam+' | '+json[i].jumlah_jam+' x 45"</p>'+
                        '</div>'+
                        '<div class="icon">'+
                          '<i class="ion ion-android-contacts"></i>'+
                        '</div>'+
                        '<a href="#" class="small-box-footer do-absensi" onclick="do_absensi('+json[i].id+')">Absensi <i class="fa fa-arrow-circle-right"></i></a>'+
                      '</div>'+
                    '</div>'
                    );
                }
              },
              error: function(e){
                $.unblockUI();
                alert(e);
              }
          });
        }, 100);
    }

</script>