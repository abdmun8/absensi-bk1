<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe_sub_kelasmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'tipe_sub_kelas';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'tipe' => $inputs['tipe'],
            'keterangan' => $inputs['keterangan'],
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.id]' : '';
        $tipe = array(
            'field' => 'tipe',
            'label' => 'Tipe sub kelas',
            'rules' => 'trim|required|max_length[50]' 
        );


        $keterangan = array(
            'field' => 'keterangan',
            'label' => 'Keterangan',
            'rules' => 'required'
        );

        return array($tipe, $keterangan);
    }
}