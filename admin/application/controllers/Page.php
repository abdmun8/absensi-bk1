<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	// web.com/page/index
	public function index()
	{
		//load view yang ada di folder page/index
		$this->load->view('page/index');
	}

	public function halaman2()
	{
		$this->load->view('page/hal2');
	}
}
