<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LevelModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'level';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array()) {
        $fields = array(
            'level_name' => $inputs['name-input'],
            'description' => $inputs['description-input'],
            'is_active' => $inputs['status-input']
        );

        return $fields;
    }

    //aturan validasi
    public function getRules() {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.level_name]' : '';
        $name = array(
            'field' => 'name-input',
            'label' => 'Level Name',
            'rules' => 'trim|required|max_length[50]' . $newRule
        );

        $status = array(
            'field' => 'status-input',
            'label' => 'Status',
            'rules' => 'trim|required|max_length[50]'
        );
        
        return array($name, $status);
    }
}