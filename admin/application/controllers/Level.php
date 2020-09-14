<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('m_level');
        $this->load->helper('utilities');
    }

    public function index()
	{
		/*mengambil data level menggunakan model*/
		$data['level'] = $this->m_level->read_data();
		$this->load->view('header');
		/*panggil view dan masukan data level ke */
		$this->load->view('level/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{
		$this->load->view('header');
		$this->load->view('level/form');
		$this->load->view('footer');
	}

	public function simpan()
	{
		$data_to_save = array(
			'level_name' => $this->input->post('level-name'),
			'description' => $this->input->post('description'),
			'is_active' => $this->input->post('status')
			);
		$simpan = $this->m_level->simpan_data($data_to_save);
		if ($simpan) {
			echo 'Simpan data berhasil';
		} else {
			echo 'Simpan data gagal';
		}
		echo '<br><a href="' . base_url('level/') . '">Kembali</a>';
	}

	public function edit($id = null)
	{
		$data['level'] = $this->m_level->get_data($id);
		$this->load->view('header');
		$this->load->view('level/form_edit', $data);
		$this->load->view('footer');
	}

	public function update()
	{
		$data_to_save = array(
			'level_name' => $this->input->post('level-name'),
			'description' => $this->input->post('description'),
			'is_active' => $this->input->post('status')
			);
		$update_data = $this->m_level->update_data($this->input->post('id'), $data_to_save);
		if ($update_data) {
			echo 'Update data berhasil';
		} else {
			echo 'Update data gagal';
		}
		echo '<br><a href="' . base_url('level/') . '">Kembali</a>';
	}

	public function delete($id)
	{
		$delete_data = $this->m_level->delete_data($id);
		if ($delete_data) {
			echo 'Hapus data berhasil';
		} else {
			echo 'Hapus data gagal';
		}
		echo '<br><a href="' . base_url('level/') .'">Kembali</a>';
	}
}

