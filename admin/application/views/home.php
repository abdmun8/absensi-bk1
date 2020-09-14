<?php
	//type akun?
	$type = $this->session->userdata('_LEVEL');
	$data = array(
		'_TITLE'=> 'Absensi Siswa',
		'_CONTENT'=>'',
		'_MENU'=> $this->load->view('template/menu', '', TRUE),
		'_EXTRA_JS'=>'loadContent(base_url + "view/_dashboard");'

	);

	$this->load->view('template/index', $data);	//file template
	
?>