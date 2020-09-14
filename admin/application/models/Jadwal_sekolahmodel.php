<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_sekolahmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'jadwal_sekolah';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'tahun_ajaran' => $inputs['tahun_ajaran'],
            'semester' => $inputs['semester'],
            'nama_libur' => $inputs['nama_libur'],
            'keterangan' => $inputs['keterangan'],
            'tipe_libur' => $inputs['tipe_libur']
        );
        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.id]' : '';
        $tahun_ajaran = array(
            'field' => 'tahun_ajaran',
            'label' => 'Tahun Ajaran',
            'rules' => 'trim|required|max_length[50]'
        );

        $semester = array(
            'field' => 'semester',
            'label' => 'Semester',
            'rules' => 'required'  
        );
        $keterangan = array(
            'field' => 'keterangan',
            'label' => 'Keterangan',
            'rules' => 'required'
        );

       
        return array($tahun_ajaran, $semester, $keterangan);
    }
}
      