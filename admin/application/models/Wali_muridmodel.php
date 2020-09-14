<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali_muridmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'wali_murid';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'nama' => $inputs['nama'],
            'username' => $inputs['username'],
            'id_siswa' => $inputs['id_siswa'],
            'no_hp' => $inputs['no_hp'],
            'jenis_kelamin' => $inputs['jenis_kelamin'],
            'alamat' => $inputs['alamat'],
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        if($inputs['password'] != ""){
            $fields['password'] = md5($inputs['password']);
        }

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.id_siswa]' : '';
        $nama = array(
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'trim|required|max_length[50]'
        );

        $id_siswa = array(
            'field' => 'id_siswa',
            'label' => 'id_siswa',
            'rules' => 'trim|required|max_length[20]' . $newRule 
        );

        $no_hp = array(
            'field' => 'no_hp',
            'label' => 'No HP',
            'rules' => 'trim|required|max_length[20]' . $newRule 
        );

        $username = array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|max_length[20]' . $newRule 
        );

        $jenis_kelamin = array(
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'trim|required|max_length[1]'
        );

        
        return array($nama, $id_siswa, $jenis_kelamin, $no_hp);
    }
}