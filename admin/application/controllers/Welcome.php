<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function myprofile($param1 = null, $param2 = null)
	{
		$data_to_view = array(
			'nama' => $param1,
			'jurusan' => $param2
		);

		$data_template = array(
			'_TITLE' => "My Profile",
			'_MENU' => $this->load->view('template/menu', '', TRUE),
			'_CONTENT' => $this->load->view('profil', $data_to_view, TRUE)
		);

		//load template
		$this->load->view('template/index', $data_template);
	}

	public function template()
	{
		$this->load->view('template/index');
	}
}
