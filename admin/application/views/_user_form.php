<div class="card">
    <div class="card-header" data-background-color="purple">
        <h4 class="title">Data User</h4>
        <p class="category">Description here...</p>
    </div>
    <div class="card-content">
        <div id="loading"></div>
        <form id="form-user">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Full Name</label>
                        <input type="text" name="name-input" id="name-input" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Username</label>
                        <input type="text" name="username-input" id="username-input" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Password</label>
                        <input type="text" name="password-input" id="password-input" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Email</label>
                        <input type="email" name="email-input" id="email-input" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Level</label>
                        <select name="level-input" id="level-input" class="form-control">
                            <?php
                            //data level
                            $levels = $this->model->getList(array('table' => 'level', 'where' => array(
                                'is_active' => 1
                            ), 'sort' => 'level_name ASC'));
                            if ($levels) {
                                foreach ($levels as $row) {
                                    echo '<option value="'.$row->level_id.'">'.$row->level_name.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Status</label>
                        <select name="status-input" id="status-input" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <!-- parameter crud -->
            <input type="hidden" name="model-input" id="model-input" value="user">
            <input type="hidden" name="key-input" id="key-input" value="user_id">
            <input type="hidden" name="action-input" id="action-input" value="1">
            <input type="hidden" name="value-input" id="value-input" value="0">

            <button type="submit" onclick="prosesSimpan(); return false;" class="btn btn-primary pull-right">Save</button>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        <?php
        //jika param terdefinisi maka proses edit
        if ($param != null) {
            echo 'editData("'.$param.'");';
        }
        ?>
    });

    function prosesSimpan() {
        //save via ajax
        loading('loading', true);
        setTimeout(function () {
            $.ajax({
                url: base_url + 'manage',   //CRUD ke manage
                data: $("#form-user").serialize(),
                dataType: "json",
                type: "POST",
                cache: false,
                success: function(json){
                    //stop loading
                    loading('loading', false);
                    if(json.data != null){
                        if (json.data.code == 1) {
                            alert("Simpan data berhasil");
                            loadContent(base_url + 'view/_user_table');
                        } else {
                            alert("Simpan data gagal" + json.data.message);
                        }
                    }
                },
                error: function() {
                    loading('loading', false);
                    alert("Respon server error");
                }
            });
        }, 1000);
    }

    function editData(x) {
        $.ajax({
            url: base_url + 'object',
            data: 'model-input=user&key-input=user_id&action-input=0&value-input='+x,
            dataType: "json",
            type: "POST",
            cache: false,
            success: function(json){
                if(json.data != null){
                    //fill form
                    $("#name-input").val(json.data.object.name).change();
                    $("#username-input").val(json.data.object.username).change().attr('readonly','');
                    $("#level-input").val(json.data.object.level_id).change();
                    $("#status-input").val(json.data.object.is_active).change();
                    //update action
                    $("#action-input").val('2');
                    $("#value-input").val('<?php echo $param;?>');
                }
            },
            error: function() {
                alert("Respon server error");
            }
        });
    }
</script>