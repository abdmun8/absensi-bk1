<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'employee';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'nik' => NULL,
            'name' => $inputs['name-input'],
            'username' => $inputs['username-input'],
            'sex' => $inputs['gender-input'],
            'email' => $inputs['email-input'],
            'address' => $inputs['alamat-input'],
            'is_new' => 1,
            'is_active' => 0    //not active
        );

        /* jika pass tidak kosong*/
        if ($inputs['password-input'] != '') {
            $fields['password'] = md5($inputs['password-input']);
        }

        if ($this->isNew) {
            $fields['activation_code'] = genActivationCode();
        }

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.username]' : '';
        $username = array(
            'field' => 'username-input',
            'label' => 'Username',
            'rules' => 'trim|required|max_length[50]' . $newRule
        );

        $full_name = array(
            'field' => 'name-input',
            'label' => 'Nama Lengkap',
            'rules' => 'trim|required|max_length[50]'
        );

        $email = array(
            'field' => 'email-input',
            'label' => 'Email',
            'rules' => 'trim|max_length[150]'
        );

        $password = array(
            'field' => 'password-input',
            'label' => 'Password',
            'rules' => 'trim|required|max_length[20]'
        );
        
        return array($username, $full_name, $email, $password);
    }
}