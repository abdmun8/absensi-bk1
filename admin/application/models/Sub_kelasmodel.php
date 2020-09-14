<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_kelasmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'sub_kelas';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'tingkat' => $inputs['tingkat'],
            'nama_kelas' => $inputs['nama_kelas'],
            'deskripsi' => $inputs['deskripsi'],
            'wali_kelas' => $inputs['wali_kelas'],
            'pic' => $inputs['pic'],
            'active' => $inputs['status-input'],
            'tipe_id' => $inputs['tipe_subkelas'],
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.id]' : '';
        $nama_kelas = array(
            'field' => 'nama_kelas',
            'label' => 'Kelas',
            'rules' => 'trim|required|max_length[50]'
        );

        $tipe_id = array(
            'field' => 'tipe_subkelas',
            'label' => 'Tipe Sub Kelas ',
            'rules' => 'required'  
        );

        $tingkat = array(
            'field' => 'tingkat',
            'label' => 'Tingkat',
            'rules' => 'required'  
        );
        
      
       
       
        return array($nama_kelas, $tipe_id, $tingkat);
    }
}