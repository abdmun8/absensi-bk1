<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mata_pelajaranmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'mata_pelajaran';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'nama' => $inputs['nama'],
            'deskripsi' => $inputs['deskripsi'],
            'tingkat' => $inputs['tingkat'],
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
            'rules' => 'trim|required|max_length[100]' . $newRule
        );    
        
        return array($nama);
    }
}