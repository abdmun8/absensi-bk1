<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelasmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'kelas';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'nama_kelas' => $inputs['nama_kelas'],
            'tingkat' => $inputs['tingkat'],
            'deskripsi' => $inputs['deskripsi'],
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.nama_kelas]' : '';
        $nama_kelas = array(
            'field' => 'nama_kelas',
            'label' => 'Nama Kelas',
            'rules' => 'trim|required|max_length[50]' . $newRule 
        );

        $tingkat = array(
            'field' => 'tingkat',
            'label' => 'Tingkat',
            'rules' => 'trim|required|max_length[20]'
        );

        $deskripsi = array(
            'field' => 'deskripsi',
            'label' => 'Deskripsi',
            'rules' => 'trim|required|max_length[255]'
        );

        return array($nama_kelas, $tingkat, $deskripsi);
    }
}