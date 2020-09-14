<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'user';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'name' => $inputs['name-input'],
            'username' => $inputs['username-input'],
            'level_id' => $inputs['level-input'],
            'email' => $inputs['email-input'],
        );

        /* jika pass tidak kosong*/
        if ($inputs['password-input'] != '') {
            $fields['password'] = md5($inputs['password-input']);
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
            'label' => 'Full Name',
            'rules' => 'trim|required|max_length[50]'
        );

        $email = array(
            'field' => 'email-input',
            'label' => 'Email',
            'rules' => 'trim|max_length[150]'
        );
        
        return array($username, $full_name, $email);
    }
}