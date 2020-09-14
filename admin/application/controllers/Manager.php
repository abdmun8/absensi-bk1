<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
	private $activeSession; // store session

	public function __construct() {
	    parent::__construct();
	    $this->activeSession = $this->session->userdata('_ID');
	    $this->load->library('form_validation');
	}

	public function index() {
		redirect(site_url('view/home'));
	}

	/*
	*	login or logout
	*/
	public function identify($action) {
		if ($action == 'acknowledge') { // for login
			/*
			* code info:
			*	- 0 = akses tidak sah
			*	- 1 = user granted
			*	- 2 = username tidak dikenal
			*	- 3 = user password salah
			*/
			$code = 0;
			$message = '';

			if ($this->activeSession == null) {
				$this->load->model('loginmodel');
				$this->form_validation->set_rules($this->loginmodel->getRules());

				if ($this->form_validation->run() == FALSE) {
					$delimiter = '<i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>';
					$this->form_validation->set_error_delimiters($delimiter, '');
					$message = $this->form_validation->error_array();//validation_errors();
				} else {
					$query['table'] = 'v_user';
					$query['where'] = array(
									'username' => $this->input->post('username-input')
									);
					$actor = $this->loginmodel->getRecord($query);
					// echo $this->db->last_query();die;

					if ($actor == null) {
	    				$code = 2;	//username tidak ada atau tidak aktif
	    			} else {
	    				if($actor->password == md5($this->input->post('password-input'))) {
	    					$st = $this->db->get('setting')->row();
	    					$this->session->set_userdata(array(
	    					    '_ID' => $actor->user_id,
	    					    '_NAMA' => $actor->name,
	    					    '_LEVEL' => $actor->level,
	    					    '_TA' => $st->tahun_ajaran,
	    					    '_SMT' => $st->semester,
	    					    '_ID_SISWA' => $actor->id_siswa,
	    					    //'_IMG' => $actor->img
	    					));
	    					$code = 1;	//login ok
	    				} else {
	    					$code = 2;	//password salah
	    					$message = 'Password salah!';
	    				}
	    			}
					}
	    	}

	    	echo json_encode(array('data' => array(
	    		'code' => $code,
	    		'message' => $message
    		)));
    		
		} else if ($action == 'revoke') { // for logout
			if ($this->activeSession != null) {
	    		$this->session->sess_destroy();
	    	}
	    	redirect(site_url());
		}
	}

	/*
	*	create, update, or delete
	*/
	
	public function process() {
		/*
		* code info:
		*	- 0 = akses tidak sah
		*	- 1 = proses berhasil
		*	- 2 = proses gagal
		*/
		$code = 0;
		$last_id = 0;
		$message = '';
		/* collect request */
		$action = $this->input->post('action-input'); // create, update, delete
		$model = $this->input->post('model-input') . 'model';


		if ($this->activeSession != null || $model = 'registermodel') {
			$this->load->model($model);
			$this->$model->isNew(($action == $this->$model->CREATE)); // if action is for creating new data, ignore unique field

			//if delete
			if($action == $this->$model->DELETE) {
				//for file
				if ($this->input->post('model-input') == 'gallery_detail') {
					$dt = $this->model->getRecord(array('table' => $this->$model->getTable(), 'where' => array($this->input->post('key-input') => $this->input->post('value-input'))));
					if ($dt) {
						$pathfile = 'asset/image/gallery/' . $dt->img;
						$pathfile2 = 'asset/image/gallery/thumb/' . $dt->img;
					}
				}elseif ($this->input->post('model-input') == 'apply_cv') {
					$dt = $this->model->getRecord(array('table' => $this->$model->getTable(), 'where' => array($this->input->post('key-input') => $this->input->post('value-input'))));
					if ($dt) {
						$pathfile = 'assets/files/' . $dt->file_name;
					}
				} else {
					$pathfile = null;
				}

				$result = $this->_do_delete($this->$model, $this->input->post(null));
				if ($result) {
					$code = 1;
					//delete file
					if ($pathfile != null) {
						@unlink($pathfile);
						@unlink($pathfile2);
					}
				} else {
					$code = 2;
				}
				
			} else {
				$this->form_validation->set_rules($this->$model->getRules());

				if ($this->form_validation->run() == FALSE) {
					$delimiter = '- ';
					$this->form_validation->set_error_delimiters($delimiter, '');
					$message = validation_errors();
				} else {
					$isExist = '';
					$result = $this->_do($this->$model, $action, $this->input->post(null));

					$last_id = ($action == $this->$model->CREATE) ? $this->$model->getLastID() : $this->input->post('value-input') ;
					$code = ($result) ? 1 : 2;
					
				}
			}
		}

    	echo json_encode(array('data' => array(
    		'code' => $code,
    		'message' => $message,
    		'last_id' => $last_id
		)));
	}

	/*
	* inner process
	*/
	private function _do($model, $action, $inputs) {
		$query = array(
		'table' => $model->getTable(), 'type' => $action,
		'data' => $model->getField($inputs),
			'at' => array(
				$inputs['key-input'] => $inputs['value-input']
			) // clause for model
		);
		return $model->action($query); // do...
	}

	private function _do_delete($model, $inputs) {
		// print_r($model);die;
		// if($model->getTable() != 'jadwal_pelajaran'){
		// 	if( $this->checkRelasi( $model->getTable() , $inputs ) ){
		// 		return false;
		// 	}	
		// }		

		$query = array(
			'table' => $model->getTable(), 'type' => 3,
			'data' => 'null',
			'at' => array(
				$inputs['key-input'] => $inputs['value-input']
			) // clause for model
		);
		return $model->action($query); // do...
	}

	/* Chek relasi table */
	function checkRelasi($table, $inputs){
		$exist = true;
		$key = "";
		$tblCheck = "";
		switch ($table) {
			case 'kelas':
				$key = "id_kelas";
				$tblCheck = "siswa";
				break;
			case 'guru':
				$key = "id_guru";
				$tblCheck = "jadwal_pelajaran";
				break;
			case 'mata_pelajaran':
				$key = "id_matpel";
				$tblCheck = "jadwal_pelajaran";
				break;
			case 'siswa':
				$key = "id_siswa";
				$tblCheck = "wali_murid";
				break;
		}

		$total = $this->db->get_where($tblCheck, ["active"=>1, $key => $inputs['value-input']])->num_rows();
		if($total == 0)
			$exist = false;

		return $exist;
	}


	function switch_day($i){
		$days = array('senin','selasa','rabu','kamis','jum\'at','sabtu','minggu');
		return $days[$i - 1];
	}

	function get_jadwal_today(){		
		$day = $this->switch_day(date('N'));
		$wh = array("hari"=>$day, "active"=>1 );
		if($this->session->userdata('_LEVEL') == 'guru'){
			$wh['id_guru'] = intval($this->session->userdata('_ID')) - 1000;
		}
		$res = $this->model->getList(['table'=>'v_jadwal_pelajaran', 'where'=>$wh]);
		// echo $this->db->last_query();
		echo json_encode($res);
	}

	function get_siswa_absensi(){
		$post = $this->input->post();
		$wh0 = array('id'=>$post['id']);
		$jadwal = $this->model->getRecord(['table'=>'v_jadwal_pelajaran', 'where'=>$wh0]);
		$wh1 = array('id_kelas'=>$jadwal->id_kelas, 'active'=>1);
		$siswa = $this->model->getList(['table'=>'v_siswa', 'where'=>$wh1, 'sort'=>'nama ASC']);
		
		$data = array();
		
		/* get data from table absensi*/
		$absen = $this->db->get_where('absensi',
			array('id_jadwal'=>$jadwal->id, 'DATE(created_at)'=>date('Y-m-d'))
		)->result();
		if(empty($absen)){
			$i = 0;
			$date = date('Y-m-d H:i:s');
			foreach ($siswa as $key => $sw) {
				$data[$i]['tahun_ajaran'] = $this->session->userdata("_TA");
				$data[$i]['semester'] = $this->session->userdata("_SMT");
				$data[$i]['trx_date'] = $date;
				$data[$i]['id_siswa'] = $sw->id;
				$data[$i]['id_jadwal'] = $jadwal->id;
				$data[$i]['value'] = 0;
				$data[$i]['keterangan'] = 'I';
				$data[$i]['created_by'] = $this->session->userdata('_ID');
				$data[$i]['created_at'] = $date;

				/* insert into table absensi*/
				$this->db->insert('absensi',$data[$i]);
				$i++;
			}
			// $this->db->order_by('nama ASC');
			$absen = $this->db->get_where('absensi',
				array('id_jadwal'=>$jadwal->id, 'DATE(created_at)'=>date('Y-m-d'))
			)->result();
		}		

		$i = 0;
		$res = array();
		foreach ($absen as $key => $abs) {
			$res[$i]['id'] = $abs->id;
			foreach ($siswa as $key => $sw) {
				if($abs->id_siswa == $sw->id){
					$res[$i]['id_siswa'] = $sw->id;
					$res[$i]['value'] = $abs->value;
					$res[$i]['keterangan'] = $abs->keterangan;
					$res[$i]['nama'] = $sw->nama;
				}
			}
			$i++;
		}

		echo json_encode(array(
			'kelas'=>$jadwal->kelas,
			'mata_pelajaran'=>$jadwal->mata_pelajaran,
			'nama_guru'=>$jadwal->nama_guru,
			'data'=>$res
		));
	}

	function save_absen(){
		// print_r($this->input->post('data'));
		foreach ($this->input->post('data') as $key => $v) {			
			$this->db->update(
				'absensi',
				array(
					'value'=>($v['value'] == 'true') ? 1 : 0,
					'keterangan'=>$v['keterangan']
				),
				array(
					'id'=>$v['id']
				)
			);
		}
		echo json_encode(['success'=>true]);
	}

	function get_absen_realtime(){
		// print_r($this->session->userdata());
		$day = $this->switch_day(date('N'));
		$level = $this->session->userdata("_LEVEL");
		$idKelas = $this->input->get("id_kelas");
		$idMatpel = $this->input->get("id_mapel");
		$where = " DATE(a.trx_date) = '".date('Y-m-d')."' AND k.id='".$idKelas."' AND j.id_matpel='".$idMatpel."' ";
		if( $level == 'wali' ){
			$where .= " AND id_siswa = '" . $this->session->userdata("_ID_SISWA") . "' ";
		}else if( $level == 'guru' ){
			$where .= " AND j.id_guru = '" . (intval($this->session->userdata("_ID")) - 1000) . "' ";
		}

		$absen = $this->getAbsenQuery($where);

		// $kelas = array();
		$this->db->select('id,nama');
		$this->db->order_by('nama','ASC');
		$siswaInKelas = $this->db->get_where('siswa',['id_kelas'=>$idKelas,'active'=>1])->result();
		$this->db->order_by('jam','ASC');

		
		echo json_encode($absen);
	}

	function getAbsenQuery($where=''){
		$absen = $this->db->query("SELECT 
		    j.id_kelas,
		    j.id,
		    j.jumlah_jam,
		    j.jam,
		    a.trx_date,
		    a.id_siswa,
		    a.value,    
		    a.keterangan,
		    CONCAT(k.tingkat, ' ', k.nama_kelas) AS kelas,
		    m.nama AS nama_matpel,
		    s.nama,
		    g.nama as nama_guru
		    
		FROM
		    `absensi` `a`
		        JOIN
		    `jadwal_pelajaran` `j` ON `a`.`id_jadwal` = `j`.`id`
		        JOIN
		    `siswa` `s` ON `a`.`id_siswa` = `s`.`id`
		    JOIN
		    `mata_pelajaran` `m` ON `j`.`id_matpel` = `m`.`id`
		        JOIN
		    `kelas` `k` ON `j`.`id_kelas` = `k`.`id`
		    	JOIN
		    `guru` `g` ON `j`.`id_guru` = `g`.`id`
		        
		    
		WHERE
		     ".$where."
		ORDER BY `j`.`jam` ASC, `s`.`nama`")->result();

		return $absen;
	}

	function getMapel(){
		$idKelas = $this->input->get("id_kelas");
		$day = $this->switch_day(date('N'));
		$this->db->select('jadwal_pelajaran.id,jadwal_pelajaran.id_matpel,mata_pelajaran.nama as nama_matpel,jadwal_pelajaran.jam,guru.nama as nama_guru',false);
		$this->db->join('mata_pelajaran','jadwal_pelajaran.id_matpel=mata_pelajaran.id');
		$this->db->join('guru','jadwal_pelajaran.id_guru=guru.id');
		$jadwalToday = $this->db->get_where('jadwal_pelajaran',['id_kelas'=>$idKelas,'hari'=>$day,'jadwal_pelajaran.active'=>1])->result();
		echo json_encode($jadwalToday);		
	}

	function getSiswa(){
		$id_kelas = $this->input->get("id_kelas");
		$id_siswa = $this->input->get("id_siswa");
		if($id_siswa != ""){
			$id_kelas = $this->db->get_where("siswa",["id"=>$id_siswa])->row()->id_kelas;
		}
		$this->db->order_by("nama","ASC");
		$data = $this->db->get_where("siswa",
			["id_kelas"=>$id_kelas,"active"=>1]
		)->result();
		echo json_encode($data);
	}

	/* Start end of week*/
	function getStartAndEndDate($week, $year) 
	{
		$dto = new DateTime();
		$dto->setISODate($year, $week);
		$ret['week_start'] = $dto->format('Y-m-d');
		$dto->modify('+6 days');
		$ret['week_end'] = $dto->format('Y-m-d');
		return $ret;
	}

	function getAllWeek()
	{
		$dataWeek = [];
		$y = date('Y');
		$j = 0;
		for ($i=0; $i < date('W'); $i++) {
			$j++;
			$week = $this->getStartAndEndDate($j,$y);
			$start = date( 'Y-m-d', strtotime($week['week_start']));
			$end = date( 'Y-m-d', strtotime($week['week_end']));
			$startFormat = date( 'd F Y', strtotime($week['week_start']));
			$endFormat = date( 'd F Y', strtotime($week['week_end']));
			$linkBtn = ' <a href="#' . $j . '" class="btn btn-sm btn-primary" onclick="printWeeklyReport(\''.$start.'\',\''.$end.'\')" title="Print"><i class="fa fa-print"></i></a>';
			$dataWeek[] = array(
				'week' => $j,
				'start' => $startFormat,
				'end' => $endFormat,
				'aksi' => $linkBtn
			);

		}
		echo json_encode(['data'=>$dataWeek]);
	}

	function getAllMonth()
	{
		$dataMonth = [];
		$year = $this->input->get('year');
		$y = date('Y');
		$j = 0;
		for ($i=1; $i <= 12; $i++) {
			$j++;
			$mt = $i < 10 ? '0'.$i : $i;
			$dt = $year.'-'.$mt.'-'.'12';
			$start = date( 'Y-m-01', strtotime($dt));
			$end = date( 'Y-m-t', strtotime($dt));
			$startFormat = date( 'd F Y', strtotime($start));
			$endFormat = date( 'd F Y', strtotime($end));
			$linkBtn = ' <a href="#' . $j . '" class="btn btn-sm btn-primary" onclick="printWeeklyReport(\''.$start.'\',\''.$end.'\')" title="Print"><i class="fa fa-print"></i></a>';
			$dataMonth[] = array(
				'month' => $j,
				'start' => $startFormat,
				'end' => $endFormat,
				'aksi' => $linkBtn
			);

		}
		echo json_encode(['data'=>$dataMonth]);
	}

	function getAllSemester(){
		$dataSemester = [];
		$kelas = $this->input->get('kelas');
		$this->db->select('a.semester,a.tahun_ajaran,j.id_kelas');
		$this->db->group_by(['tahun_ajaran','semester']);
		$this->db->join('jadwal_pelajaran j','a.id_jadwal = j.id');
		$data = $this->db->get_where('absensi a',['j.id_kelas'=>$kelas])->result();
		$j = 0;
		foreach ($data as $key => $v) {
			$linkBtn = ' <a href="#' . $j . '" class="btn btn-sm btn-primary" onclick="printSemesterReport(\''.$v->tahun_ajaran.'\',\''.$v->semester.'\')" title="Print"><i class="fa fa-print"></i></a>';
			$dataSemester[] = array(
				'no' => $j,
				'tahun_ajaran' => $v->tahun_ajaran,
				'semester' => $v->semester,
				'aksi' => $linkBtn
			);
			$j++;
		}
		echo json_encode(['data'=>$dataSemester]);	
	}

	function printReportWeekly()
	{
		$post = $this->input->post();
		$where = " a.tahun_ajaran='".$this->session->userdata('_TA')."' AND a.semester='".$this->session->userdata('_SMT')."' AND k.id='".$post['kelas']."' AND a.trx_date >= '".$post['start']."' AND a.trx_date <= '".$post['end']."' ";
		$view = 'laporan_mingguan';
		$title = 'Laporan Mingguan';
		$this->printReport($post, $where, $title);
	}

	function printReportMonthly()
	{
		$post = $this->input->post();
		$where = " a.tahun_ajaran='".$this->session->userdata('_TA')."' AND a.semester='".$this->session->userdata('_SMT')."' AND k.id='".$post['kelas']."' AND a.trx_date >= '".$post['start']."' AND a.trx_date <= '".$post['end']."' ";
		$title = 'Laporan Bulanan';
		$this->printReport($post, $where, $title);
	}

	function printReportSemester()
	{
		$post = $this->input->post();
		$where = " a.tahun_ajaran='".$post['tahun_ajaran']."' AND a.semester='".$post['semester']."' AND k.id='".$post['kelas']."' ";
		$title = 'Laporan Semester';
		$this->printReport($post, $where, $title, false);
	}

	function printReport($post, $where, $title, $periode = true){		

		$wh1 = array('id_kelas'=>$post['kelas'], 'active'=>1);
		if( $this->session->userdata('_LEVEL') == 'wali'){
			$where .= " AND s.id='".$this->session->userdata('_ID_SISWA')."' " ;
			$wh1['id'] = $this->session->userdata('_ID_SISWA');
		}

		if( $this->session->userdata('_LEVEL') == 'guru'){
			$where .= " AND j.id_guru='".($this->session->userdata('_ID') - 1000)."' " ;	
		}
			
		$siswa = $this->model->getList(['table'=>'v_siswa', 'where'=>$wh1, 'sort'=>'nama ASC']);
		$absen = $this->getAbsenQuery($where);
		
		if(empty($absen)){
			echo "Data Kosong";
			return;
		}
		$data = [];
		$i = 0;
		$dataSiswa = [];
		foreach ($siswa as $key => $s) {

			$x = 0;
			foreach ($absen as $key => $a) {
				if($x == 0){
					$dataSiswa[$i]['h'] = 0;
					$dataSiswa[$i]['s'] = 0;
					$dataSiswa[$i]['i'] = 0;
					$dataSiswa[$i]['a'] = 0;
				}
				if($s->id == $a->id_siswa){
					$dataSiswa[$i]['id'] = $s->id;
					$dataSiswa[$i]['nama'] = $s->nama;
					
					if($a->value == 1){
						$dataSiswa[$i]['h'] += 1;
					}else{
						if($a->keterangan == 'S'){
							$dataSiswa[$i]['s'] += 1;	
						}

						if($a->keterangan == 'I'){
							$dataSiswa[$i]['i'] += 1;	
						}

						if($a->keterangan == 'A'){
							$dataSiswa[$i]['a'] += 1;	
						}
					}
					
				}
				$x++;
			}
			$i++;
		}	

		$data['absen'] = $dataSiswa;
		$data['title'] = $title;
		$data['kelas'] = $this->db->select("CONCAT(tingkat, ' ', nama_kelas) kelas", false)->get_where('kelas', ['id'=>$post['kelas']])->row()->kelas;
		if($periode){
			$data['date'] = date( 'd F Y', strtotime($post['start'])).' - '.date( 'd F Y', strtotime($post['end']));			
		}else{
			$data['date'] = 'Tahun Ajaran '. $post['tahun_ajaran'] .' Semester '.$post['semester'];
		}

		$html = $this->load->view('laporan', $data, true);
		echo $html;
		
	}
}
