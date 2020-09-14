  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <!-- /.col -->
          <div class="col-md-6">
            <!-- Card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <div class="card-body">
                <!-- Form Group -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Input your old password">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                
                <!-- Form Group -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Input your new password">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Form Group -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="Repeat your new password">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Button -->
                <div class="form-group">
                  <div class="input-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>                  
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(function () {
      
      $('#example1 tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      });

      var table = $('#example1').DataTable({
        "responsive": true
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
    
  </script>