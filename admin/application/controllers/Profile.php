<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	// web.com/page/index
	public function index()
	{
		//load view yang ada di folder page/index
		$this->load->view('Sejarah');
	}

	
}
