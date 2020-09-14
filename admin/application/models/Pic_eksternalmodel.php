<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pic_eksternalmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'pic_eksternal';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'nama' => $inputs['nama'],
            'keterangan' => $inputs['keterangan'],
            'perusahaan' => $inputs['perusahaan'],
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
            'label' => 'Nama PIC',
            'rules' => 'trim|required|max_length[50]'
        );

        $keterangan = array(
            'field' => 'keterangan',
            'label' => 'Keterangan',
            'rules' => 'trim|required|max_length[255]' 
        );

        $perusahaan = array(
            'field' => 'perusahaan',
            'label' => 'Perusahaan',
            'rules' => 'trim|required|max_length[50]'
        );

        
        return array($nama, $keterangan, $perusahaan);
    }
}