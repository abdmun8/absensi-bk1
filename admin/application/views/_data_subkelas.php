<?php
//default value
$id = null;
$pic_eksternal = null;
$guru = null;
if ($param != null) {
    $id = $this->model->getRecord(array(
        'table' => 'sub_kelas', 'where' => array('id' => $param)
    ));
}

$kelas = $this->db->select("id, concat(tingkat,' ',nama_kelas) as kelas", false)->where('active', 1)->get('kelas')->result();
$subkelas = $this->model->getList(['table' => "sub_kelas"]);
$pic = $this->model->getList(['table' => "pic_eksternal"]);
$guru = $this->model->getList(['table' => "guru"]);
$tipe = $this->db->get('tipe_sub_kelas')->result();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Sub Kelas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Database</a></li>
                        <li class="breadcrumb-item active">Data subkelas</li>
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
                                                    <th>Kelas</th>
                                                    <th>Nama Kelas</th>
                                                    <th>Deskripsi</th>
                                                    <th>Wali Kelas</th>
                                                    <th>PIC</th>
                                                    <th>Tipe Kelas</th>
                                                    <th>Status</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kelas</th>
                                                    <th>Nama Kelas</th>
                                                    <th>Deskripsi</th>
                                                    <th>Wali Kelas</th>
                                                    <th>PIC</th>
                                                    <th>Tipe Kelas</th>
                                                    <th>Status</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </tfoot>
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
                                                    <label>Tingkat</label>
                                                    <select class="form-control" id="tingkat" name="tingkat">
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
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

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Wali Kelas</label>
                                                    <select class="form-control" id="wali_kelas" name="wali_kelas">
                                                        <option value="" selected disabled>Pilih Wali Kelas</option>
                                                        <?php
                                                        foreach ($guru as $key => $v) {
                                                            ?>
                                                        <option value="<?= $v->id ?>"><?= $v->nama ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama PIC Eksternal</label>
                                                    <select class="form-control" id="pic" name="pic">
                                                        <option value="" selected disabled>Pilih PIC</option>
                                                        <?php
                                                        foreach ($pic as $key => $v) {
                                                            ?>
                                                        <option value="<?= $v->id ?>"><?= $v->nama . ' - ' . $v->perusahaan ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tipe Sub Kelas</label>
                                                    <select name="tipe_subkelas" id="tipe_subkelas" class="form-control">
                                                    <option value="" selected disabled>Pilih Tipe Kelas</option>
                                                        <?php
                                                        foreach ($tipe as $key => $v) {
                                                            ?>
                                                        <option value="<?= $v->id ?>"><?= $v->tipe ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Status</label>
                                                    <select name="status-input" id="status-input" class="form-control">
                                                        <option value="1">Active</option>
                                                        <option value="0">Non Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            

                                            
                                            <input type="hidden" id="value-input" name="value-input">
                                            <input type="hidden" id="key-input" name="key-input" value="id">
                                            <input type="hidden" id="action-input" name="action-input" value="1">
                                            <input type="hidden" id="model-input" name="model-input" value="sub_kelas">
                                        </div>

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
    var tableSubkelas;
    $(document).ready(function() {
        getSubkelas();
        <?php
        if ($id != null) {
            echo 'getData("' . $param . '");';
            echo 'setActiveTab("form-tab");';
        }
        ?>

        //Initialize Select2 Elements
        $('.select2').select2()

        /* Create Input on footer */
        // $('#data-table tfoot th').each(function() {
        //     var title = $(this).text();
        //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        // });

    });

    function newForm() {
        loadContent(base_url + "view/_subkelas_form", function() {
            setActiveTab("form-tab");
        });
    }

    function getSubkelas() {
        if ($.fn.dataTable.isDataTable('#data-table')) {
            tableSubkelas = $('#data-table').DataTable({
                responsive: true
            });
        } else {
            tableSubkelas = $('#data-table').DataTable({
                "ajax": base_url + 'objects/sub_kelas',
                "columns": [
                    {
                        "data": "no"
                    },
                    {
                        "data": "tingkat"
                    },
                    {
                        "data": "nama_kelas"
                    },
                    {
                        "data": "deskripsi"
                    },
                    {
                        "data": "wali_kelas"
                    },
                    {
                        "data": "pic"
                    },
                    {
                        "data": "tipe"
                    },
                    {
                        "data": "active",
                        render: function(data) {
                            return data == 1 ? "aktif" : "tidak aktif" //ternari operator

                        }

                    },
                    {
                        "data": "aksi"
                    }
                ],
                // "scrollX": true,
                "ordering": true,
                "deferRender": true,
                "order": [
                    [1, "asc"],
                    [3, "asc"]
                ],
                "fnDrawCallback": function(oSettings) {
                    utilSubkelas();
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



    function utilSubkelas() {
        $("#data-table .editBtn").on("click", function() {
            loadContent(base_url + 'view/_data_subkelas/' + $(this).attr('href').substring(1));
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
                        var page = '_data_subkelas/';
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
            data: 'model-input=sub_kelas&key-input=id&value-input=' + idx,
            dataType: 'json',
            type: 'POST',
            cache: false,
            success: function(json) {
                if (json.data.code === 0) {
                    loginAlert('Akses tidak sah');
                } else {
                    $("#tingkat").val(json.data.object.tingkat);
                    $("#nama_kelas").val(json.data.object.nama_kelas);
                    $("#deskripsi").val(json.data.object.deskripsi);
                    $("#pic").val(json.data.object.pic);
                    $("#tipe_subkelas").val(json.data.object.tipe_id);
                    $("#wali_kelas").val(json.data.object.wali_kelas);
                    $("#active").val(json.data.object.active);
                    $("#action-input").val('2');
                    $("#value-input").val(json.data.object.id);
                    $("#password").attr("placeholder", "Kosongkan jika tidak ingin dirubah");
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
                        data: 'model-input=sub_kelas&action-input=3&key-input=id&value-input=' + n,
                        dataType: 'json',
                        type: 'POST',
                        cache: false,
                        success: function(json) {
                            loading('loading', false);
                            if (json.data.code === 1) {
                                genericAlert('Hapus data berhasil', 'success', 'Sukses');
                                refreshTable();
                            } else if (json.data.code === 2) {
                                genericAlert('Pastikan subkelasini tidak mempunyai jadwal!', 'warning', 'Perhatian');
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
        tableSubkelas.ajax.url(base_url + '/objects/sub_kelas').load();
    }
</script>