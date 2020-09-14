<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan_kerja extends CI_Controller {

	public function index()
	{
		$this->load->view('public/list_loker');
	}

}

