<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_pelajaranmodel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'jadwal_pelajaran';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'id_kelas' => $inputs['id_kelas'],
            'id_guru' => $inputs['id_guru'],
            'hari' => $inputs['hari'],
            'jam' => $inputs['jam'],
            'jumlah_jam' => $inputs['jumlah_jam'],
            'id_matpel' => $inputs['id_matpel']
        );

        if( $inputs['action-input'] == 1 ){
            $fields['tahun_ajaran'] = $this->session->userdata('_TA');
            $fields['semester'] = $this->session->userdata('_SMT');
        }

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        // $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.level_name]' : '';
        $id_kelas = array(
            'field' => 'id_kelas',
            'label' => 'Kelas',
            'rules' => 'trim|required|max_length[50]'
        );
        
        return array($id_kelas);
    }
}