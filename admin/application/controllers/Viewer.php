<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewer extends CI_Controller {
	private $activeSession; 

	public function __construct() {
	    parent::__construct();
	    $this->activeSession = $this->session->userdata('_ID');
	}

	public function index() {
		if ($this->activeSession == null) {
			$this->load->view('login');
		} else {
			redirect(site_url('view/home'));
		}
	}

	public function pathGuide($page = 'home', $param = null) {
		if ($this->activeSession == null) {
			//$this->load->view('login');
			$this->load->view('redirect');
		} else {
			$this->load->view($page, array('param' => $param));
		}
	}

	public function registrasi()
	{
		if ($this->activeSession == null) {
			$this->load->view('register');
		} else {
			redirect(site_url('view/home'));
		}
	}

	public function form_login()
	{
		if ($this->activeSession == null) {
			$this->load->view('login');
		} else {
			redirect(site_url('view/home'));
		}
	}
}