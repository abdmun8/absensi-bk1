<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'user';
        $this->isNew = false;
    }

    //aturan validasi
    public function getRules() {
        $username = array(
            'field' => 'username-input',
            'label' => 'Username',
            'rules' => 'trim|required|max_length[50]',
            'errors' => ['required'=>'Please input your %s']
        );

        $password = array(
            'field' => 'password-input',
            'label' => 'Password',
            'rules' => 'trim|required|max_length[32]',
            'errors' => ['required'=>'Please input your %s']
        );
        
        return array($username, $password);
    }
}