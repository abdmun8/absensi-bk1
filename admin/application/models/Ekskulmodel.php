<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekskulmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'ekskul';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'nama_ekskul' => $inputs['nama_ekskul'],
            'keterangan' => $inputs['keterangan'],
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.id]' : '';
        $nama_ekskul = array(
            'field' => 'nama_ekskul',
            'label' => 'Nama Ekskul',
            'rules' => 'required|max_length[255]'
        );

        $keterangan = array(
            'field' => 'keterangan',
            'label' => 'Keterangan',
            'rules' => 'required|max_length[255]' 
        );
        
        return array($nama_ekskul, $keterangan);
    }
}