<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publik extends CI_Controller
{

	public function index()
	{
		//data loker
		$data_loker = $this->model->getList(array(
			'table' => 'loker',
			'where' => array(
				'is_publish' => 1
			)
		));
		$this->load->view('publik/template/index', array('data_loker' => $data_loker));
	}

	public function info_loker($id = '')
	{
		$data_loker = $this->model->getRecord(array(
			'table' => 'loker',
			'where' => array(
				'is_publish' => 1,
				'loker_id' => $id
			)
		));
		$this->load->view('publik/info_loker', array('data_loker' => $data_loker));
	}

	/* untuk proses Apply*/
	//ketika user apply loker
	public function form_apply($loker_id = null)
	{
		$code = 0; //apply gagal
		//cek login belum
		if ($this->session->userdata('_ID') != NULL && $this->session->userdata('_LEVEL') == 'employee') {
			//proses apply
			//cek jika sudah pernah apply
			$exist = $this->model->getRecord(array(
				'table' => 'apply',
				'where' => array(
					'loker_id' => $loker_id,
					'employee_id' => $this->session->userdata('_ID')
				)
			));

			if ($exist == NULL) {
				//cek loker apakah valid
				$loker = $this->model->getRecord(array(
					'table' => 'loker',
					'where' => array(
						'loker_id' => $loker_id,
						'is_publish' => 1
					)
				));

				if ($loker) {
					$data_to_save = array(
						'loker_id' => $loker_id,
						'employee_id' => $this->session->userdata('_ID'),
						'apply_date' => date('Y-m-d H:i:s')
					);

					//proses simpan
					$simpan = $this->db->insert('apply', $data_to_save);
					if ($simpan) {
						$code = 1; // apply sukses
					}
				}
			} else {
				$code = 2; //sudah pernah apply
			}

			$this->load->view('publik/after_apply', array('code' => $code));
		} else {
			//buat session untuk menandai redirect
			$session_to_create = array(
				'link' => base_url('Publik/info_loker/' . $loker_id)
			);

			$this->session->set_userdata($session_to_create);

			redirect('form_login');
		}
		//$this->load->view('publik/form_apply');
	}

	// view
	function absensiGuruHariIni()
	{

		$this->load->view('publik/header');
		$this->load->view('publik/absensi_guru_hari_ini');
		$this->load->view('publik/footer');
	}

	function getDataAbsensiGuruHariIni()
	{
		$data = [];
		$date = date('Y-m-d');
		$jam_masuk = $date . ' 07:00:00';
		$sql = " SELECT *, TIMESTAMPDIFF(minute,'{$jam_masuk}',a.jam_masuk) as telat FROM `absensi_guru` `a` 
			JOIN `guru` `g` ON `a`.`id_guru` = `g`.`id` 
			WHERE `a`.`tanggal` = '{$date}' 
			ORDER BY `a`.`jam_masuk` DESC";
		$result = $this->db->query($sql)
			->result_array();
		// echo $this->db->last_query();
		$no = 0;
		foreach ($result as $key => $value) {
			$no++;
			if ($value['telat'] >= 5) {
				$value['keterangan'] = "<span class='tr-danger'>Telat {$value['telat']} Menit</span>";
			} else if ($value['telat'] >= -5) {
				$value['keterangan'] = "<span class='tr-warning'>";
			} else {
				$value['keterangan'] = "";
			}
			$value['no'] = $no;
			$data[] = $value;
		}
		echo json_encode(['data' => $data]);
	}
}
