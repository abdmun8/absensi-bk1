<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe_liburmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'tipe_libur';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'nama_libur' => $inputs['nama_libur'],
            'keterangan' => $inputs['keterangan'],
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.nama_libur]' : '';
        $nama_libur = array(
            'field' => 'nama_libur',
            'label' => 'Nama Libur',
            'rules' => 'trim|required|max_length[50]' . $newRule 
        );


        $keterangan = array(
            'field' => 'keterangan',
            'label' => 'Keterangan',
            'rules' => 'required'
        );

        return array($nama_libur, $keterangan);
    }
}