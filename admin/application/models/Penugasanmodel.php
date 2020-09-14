<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenugasanModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'penugasan';  //tabel db yg dipakai
        $this->isNew = false;
    }

    // mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'tahun_ajaran' => $this->session->userdata('_TA'),
            'semester' => $this->session->userdata('_SMT'),
            'tipe_penugasan' => $inputs['tipe_penugasan'],
            'tipe_kelas' => $inputs['tipe_kelas'],
            'id_guru_pic' => $inputs['id_guru_pic'],
            'id_kelas' => $inputs['id_kelas'],
            'start_date' => date('Y-m-d', strtotime($inputs['start_date'])),
            'end_date' => date('Y-m-d', strtotime($inputs['end_date'])),
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.id]' : '';

        $tipe_penugasan = array(
            'field' => 'tipe_penugasan',
            'label' => 'Tipe Penugasan',
            'rules' => 'required' 
        );

        $tipe_kelas = array(
            'field' => 'tipe_kelas',
            'label' => 'Kelas',
            'rules' => 'required'
        );

      
        return array($tipe_penugasan, $tipe_kelas);
    }
}