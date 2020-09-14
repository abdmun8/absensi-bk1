<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswamodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'siswa';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'nama' => $inputs['nama'],
            'nis' => $inputs['nis'],
            'nisn' => $inputs['nisn'],
            'tgl_lahir' => $inputs['tgl_lahir'],
            'jenis_kelamin' => $inputs['jenis_kelamin'],
            'id_kelas' => $inputs['id_kelas'],
            'alamat' => $inputs['alamat'],
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.nama]' : '';
        $nama = array(
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'trim|required|max_length[50]'
        );


        $id_kelas = array(
            'field' => 'id_kelas',
            'label' => 'Kelas',
            'rules' => 'trim|required|max_length[10]'
        );

        

        $jenis_kelamin = array(
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'trim|required|max_length[1]'
        );
        
        return array($nama, $jenis_kelamin, $id_kelas);
    }
}