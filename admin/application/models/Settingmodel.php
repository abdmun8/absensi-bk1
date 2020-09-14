<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settingmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'setting';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'tahun_ajaran' => $inputs['tahun_ajaran'],
            'semester' => $inputs['semester'],
            'nama_sekolah' => $inputs['nama_sekolah'],
            'kepala_sekolah' => $inputs['kepala_sekolah']
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $id = array(
            'field' => 'id',
            'label' => 'Tahun Ajaran',
            'rules' => 'trim|required|max_length[50]',
            'errors' => array(
                        'required' => 'Data pengaturan hanya bisa diedit!',
                ),
        );
        
        return array($id);
    }
}