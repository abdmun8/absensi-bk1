<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retriever extends CI_Controller
{
	private $activeSession; // store session

	public function __construct()
	{
		parent::__construct();
		$this->activeSession = $this->session->userdata('_ID');
	}

	public function index()
	{
		redirect(site_url('view/home'));
	}

	/*
	* read object
	*/
	public function record($specific = null)
	{
		/*
		* code info:
		*	- 0 = akses tidak sah & data tidak perlu di tampilkan
		*	- 1 = akses sah & data di tampilkan
		*/
		$code = 0;
		$object = null;

		if ($this->activeSession != null) {
			switch ($this->input->post('model-input')) {
				case 'siswa':
					$query['table'] = 'v_siswa';
					break;
				case 'kelas':
					$query['table'] = 'kelas';
					break;
				case 'subkelas':
					$query['table'] = 'sub_kelas';
					break;
				case 'ekskul':
					$query['table'] = 'ekskul';
					break;
				case 'tipe_libur':
					$query['table'] = 'tipe_libur';
					break;
				case 'pic_eksternal':
					$query['table'] = 'pic_eksternal';
					break;
				case 'tipe_sub_kelas':
					$query['table'] = 'tipe_sub_kelas';
					break;
				case 'guru':
					$query['table'] = 'guru';
					break;
				case 'wali_murid':
					$query['table'] = 'v_wali_murid';
					break;
				case 'mata_pelajaran':
					$query['table'] = 'mata_pelajaran';
					break;
				case 'jadwal_pelajaran':
					$query['table'] = 'v_jadwal_pelajaran';
					break;
				case 'absensi':
					$query['table'] = 'v_siswa';
					break;
				case 'setting':
					$query['table'] = 'setting';
					break;
				case 'sub_kelas':
					$query['table'] = 'v_sub_kelas';
					break;
				case 'jadwal_sekolah':
					$query['table'] = 'jadwal_sekolah';
					break;
				case 'penugasan':
					$query['table'] = 'penugasan';
					break;

				default:
					$query['table'] = $this->input->post('model-input');
					break;
			}

			$query['where'] = array($this->input->post('key-input') => $this->input->post('value-input'));

			$object = $this->model->getRecord($query);

			$code = 1;
		}

		echo json_encode(array('data' => array(
			'code' => $code,
			'object' => $object
		)));
	}

	/* |||||||||||||||||||||||||||||||||||| DATATABLES |||||||||||||||||||||||||||||||||||| */
	/*
	* read objects - DataTables
	*/
	public function records($table, $key = 'null', $value = 'null', $picker = 'no')
	{
		$data = array();

		if ($this->activeSession != null) {
			if (isset($table)) {
				if ($key != 'null' && $value != 'null') {
					$query['where'] = array($key => $value);
				}

				switch ($table) {
					case 'siswa':
						$query['table'] = 'v_siswa';
						break;
					case 'kelas':
						$query['table'] = 'kelas';
						$query['where'] = ['active' => 1];
						break;
					case 'subkelas':
						$query['table'] = 'sub_kelas';
						break;
					case 'tipe_sub_kelas':
						$query['table'] = 'tipe_sub_kelas';
						break;
					case 'ekskul':
						$query['table'] = 'ekskul';
						break;
					case 'tipe_libur':
						$query['table'] = 'tipe_libur';
						break;
					case 'jadwal_sekolah':
						$query['table'] = 'v_jadwal_sekolah';
						break;
					case 'penugasan':
						$query['table'] = 'penugasan';
						break;
					case 'pic_eksternal':
						$query['table'] = 'pic_eksternal';
						break;
					case 'guru':
						$query['table'] = 'guru';
						$query['where'] = ['active' => 1];
						break;
					case 'wali_murid':
						$query['table'] = 'v_wali_murid';
						$query['where'] = ['active' => 1];
						break;
					case 'mata_pelajaran':
						$query['table'] = 'mata_pelajaran';
						$query['where'] = ['active' => 1];
						break;
					case 'jadwal_pelajaran':
						$query['table'] = 'v_jadwal_pelajaran';
						$query['where'] = ['active' => 1];
						break;
					case 'absensi':
						$query['table'] = 'v_siswa';
						break;
					case 'setting':
						$query['table'] = 'setting';
						break;
					case 'sub_kelas':
						$query['table'] = 'v_sub_kelas';
						break;
					default:
						$query['table'] = $table;
						break;
				}

				$records = $this->model->getList($query);

				$inner = '_' . $table;
				$data = $this->$inner($records, $picker);
			}
		}

		echo json_encode(array('data' => $data));
	}

	/*
	* inner data generator
	* ===================================== write your custom function here =====================================
	*/

	function _level($records, $picker = 'no')
	{
		$data = array();

		foreach ($records as $record) {
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->level_id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->level_id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i> Edit</a>';
				$linkBtn .= ' <a href="#' . $record->level_id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</a>';
			}

			$status = ($record->is_active == 1) ? 'Aktif' : 'Non Aktif';
			$data[] = array(
				'level_name' => $record->level_name,
				'description' => $record->description,
				'status' => $status, //$record->is_active,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _user($records, $picker = 'no')
	{
		$data = array();

		foreach ($records as $record) {
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->user_id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->user_id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i> Edit</a>';
				$linkBtn .= ' <a href="#' . $record->user_id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</a>';
			}
			$data[] = array(
				'name' => $record->name,
				'username' => $record->username,
				'email' => $record->email,
				'level_id' => $record->level_id,
				'status' => $record->is_active,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _siswa($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'nama' => $record->nama,
				'nis' => $record->nis,
				'nisn' => $record->nisn,
				'kelas' => $record->kelas,
				'alamat' => $record->alamat,
				'jenis_kelamin' => $record->jenis_kelamin,
				'active' => $record->active,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'updated_at' => $record->updated_at,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _penugasan($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'tahun_ajaran' => $record->tahun_ajaran,
				'semester' => $record->semester,
				'tipe_penugasan' => $record->tipe_penugasan,
				'tipe_kelas' => $record->tipe_kelas,
				'id_guru_pic' => $record->id_guru_pic,
				'id_kelas' => $record->id_kelas,
				'start_date' => $record->start_date,
				'end_date' => $record->end_date,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'updated_at' => $record->updated_at,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _kelas($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'tingkat' => $record->tingkat,
				'nama_kelas' => $record->nama_kelas,
				'deskripsi' => $record->deskripsi,
				'active' => $record->active,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'updated_at' => $record->updated_at,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}
	function _sub_kelas($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'tingkat' => $record->tingkat,
				'nama_kelas' => $record->nama_kelas,
				'deskripsi' => $record->deskripsi,
				'wali_kelas' => $record->nama_guru,
				'pic' => $record->nama_pic_eksternal,
				'active' => $record->active,
				'tipe' => $record->tipe,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,

				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _ekskul($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'nama_ekskul' => $record->nama_ekskul,
				'keterangan' => $record->keterangan,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _tipe_libur($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'nama_libur' => $record->nama_libur,
				'keterangan' => $record->keterangan,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}
	function _tipe_sub_kelas($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'tipe' => $record->tipe,
				'keterangan' => $record->keterangan,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _pic_eksternal($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'nama' => $record->nama,
				'keterangan' => $record->keterangan,
				'perusahaan' => $record->perusahaan,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _guru($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'pendidikan' => $record->pendidikan,
				'nik' => $record->nik,
				'nama' => $record->nama,
				'tgl_lahir' => $record->tgl_lahir,
				'tgl_join' => $record->tgl_join,
				'jenis_kelamin' => $record->jenis_kelamin,
				'alamat' => $record->alamat,
				'active' => $record->active,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'updated_at' => $record->updated_at,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _wali_murid($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'id_siswa' => $record->id_siswa,
				'nama_siswa' => $record->nama_siswa,
				'nama' => $record->nama,
				'no_hp' => $record->no_hp,
				'nama_kelas' => $record->nama_kelas,
				'jenis_kelamin' => $record->jenis_kelamin,
				'alamat' => $record->alamat,
				'active' => $record->active,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'updated_at' => $record->updated_at,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _mata_pelajaran($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'nama' => $record->nama,
				'tingkat' => $record->tingkat,
				'deskripsi' => $record->deskripsi,
				'active' => $record->active,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'updated_at' => $record->updated_at,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _setting($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
			}

			$data[] = array(
				'id' => $record->id,
				'tahun_ajaran' => $record->tahun_ajaran,
				'semester' => $record->semester,
				'nama_sekolah' => $record->nama_sekolah,
				'kepala_sekolah' => $record->kepala_sekolah,
				'durasi_jam_pelajaran' => $record->durasi_jam_pelajaran,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _jadwal_pelajaran($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'hari' => $record->hari,
				'jam' => $record->jam,
				'id_kelas' => $record->id_kelas,
				'kelas' => $record->kelas,
				'id_matpel' => $record->id_matpel,
				'mata_pelajaran' => $record->mata_pelajaran,
				'jumlah_jam' => $record->jumlah_jam,
				'id_guru' => $record->id_guru,
				'nama_guru' => $record->nama_guru,
				'active' => $record->active,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'updated_at' => $record->updated_at,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _jadwal_sekolah($records, $picker = 'no')
	{
		$data = array();
		$j = 0;

		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <a href="#' . $record->id . '" class="btn btn-sm btn-primary editBtn" title="Edit"><i class="fa fa-edit"></i></a>';
				$linkBtn .= ' <a href="#' . $record->id . '" class="btn btn-sm btn-danger removeBtn" title="Hapus"><i class="fa fa-trash"></i></a>';
			}

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'tahun_ajaran' => $record->tahun_ajaran,
				'semester' => $record->semester,
				'nama_libur' => $record->nama_libur,
				'keterangan' => $record->keterangan,
				'tipe_libur' => $record->tipe_libur,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'aksi' => $linkBtn
			);
		}

		return $data;
	}

	function _absensi($records, $picker = 'no')
	{
		$data = array();
		$j = 0;
		foreach ($records as $record) {
			$j++;
			if ($picker == 'yes') {
				$linkBtn = '<a href="#' . $record->id . '" class="btn btn-sm btn-info pickBtn" title="Pilih"><i class="fa fa-thumb-tack"></i> Pilih</a>';
			} else if ($picker == 'no') {
				$linkBtn = ' <span class="switch">
                      <input type="checkbox" class="switch" id="sw_' . $record->id . '">
                      <label for="sw_' . $record->id . '"></label>
                    </span>';
			}
			$ket = '<div class="switch-field">
                  <input type="radio" id="switch_3_left" name="ket_' . $record->id . '" value="sakit" checked/>
                  <label for="switch_3_left">Sakit</label>
                  <input type="radio" id="switch_3_center" name="ket_' . $record->id . '" value="izin" />
                  <label for="switch_3_center">Izin</label>
                  <input type="radio" id="switch_3_right" name="ket_' . $record->id . '" value="alpa" />
                  <label for="switch_3_right">Alpa</label>
                    </div>';

			$data[] = array(
				'no' => $j,
				'id' => $record->id,
				'nis' => $record->nis,
				'nama' => $record->nama,
				'nisn' => $record->nisn,
				'kelas' => $record->kelas,
				'alamat' => $record->alamat,
				'active' => $record->active,
				'jenis_kelamin' => $record->jenis_kelamin,
				'created_by' => $record->created_by,
				'created_at' => $record->created_at,
				'updated_by' => $record->updated_by,
				'updated_at' => $record->updated_at,
				'aksi' => $linkBtn,
				'keterangan' => $ket
			);
		}

		return $data;
	}
}
