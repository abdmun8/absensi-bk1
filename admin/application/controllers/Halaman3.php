<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	// web.com/page/halaman3
	public function index()
	{
		//load view yang ada di folder page/index
		$this->load->view('page/index');
	}

	public function halaman3()
	{
		$this->load->view('page/hal2');
	}
}

