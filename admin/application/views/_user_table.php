<div class="card">
	<div class="card-header" data-background-color="purple">
        <h4>Data User</h4>
	</div>
	<div class="card-content">
        <div id="loading"></div>
		<a href="#" class="btn btn-success pull-right" onclick="loadContent(base_url + 'view/_user_form')"> Add User</a>
		<div class="clearfix"></div>
		<table class="table table-bordered" id="table-user">
			<thead class="text-primary">
				<tr>
					<th>Full Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Level</th>
					<th>Status</th>
					<th>Opsi</th>	
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		loadDataTable();
	});

	function loadDataTable() {
		//ajax here
		if ($.fn.dataTable.isDataTable('#table-user')) {
		    table = $('#table-user').DataTable();
		} else {
			table = $('#table-user').DataTable({
				"ajax": base_url + 'objects/user',
				"columns": [
		            {"data": "name"},
		            {"data": "username"},
		            {"data": "email"},
		            {"data": "level_id"},
		            {"data": "status"},
		            {"data": "aksi"}
		        ],
		        "ordering": true,
		        "deferRender": true,
		        "order": [[0, "asc"]],
		        "fnDrawCallback": function (oSettings) {
		        	utilsUsers();
		        }
			});
		}
	}

	function utilsUsers(){
		//tombol edit/delete
		$("#table-user .editBtn").on("click", function () {
			loadContent(base_url + 'view/_user_form/' + $(this).attr("href").substr(1));
		});

		$("#table-user .removeBtn").on("click", function () {
			deleteData($(this).attr("href").substr(1));
		});
	}

	function deleteData(x) {
		if (confirm("Yakin hapus data??!!")) {
			loading('loading', true);
			setTimeout(function () {
				$.ajax({
	                url: base_url + 'manage',
	                data: 'model-input=user&key-input=user_id&action-input=3&value-input=' + x,
	                dataType: "json",
	                type: "POST",
	                cache: false,
	                success: function(json){
	                    //stop loading
	                    loading('loading', false);
	                    if(json.data != null){
	                        if (json.data.code == 1) {
	                            alert("Hapus data berhasil");  
	                            loadContent(base_url + 'view/_user_table');  
	                        } else {
	                            alert("Hapus data gagal " + json.data.message);
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
	}
</script>