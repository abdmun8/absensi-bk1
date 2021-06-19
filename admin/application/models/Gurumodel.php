<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gurumodel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'guru';  //tabel db yg dipakai
        $this->isNew = false;
    }

    //mapping filed yang akan disimpan
    public function getField($inputs = array())
    {
        $fields = array(
            'nama' => $inputs['nama'],
            'nik' => $inputs['nik'],
            'tgl_lahir' => $inputs['tgl_lahir'],
            'pendidikan' => $inputs['pendidikan'],
            'tgl_join' => $inputs['tgl_join'],
            'jenis_kelamin' => $inputs['jenis_kelamin'],
            'alamat' => $inputs['alamat'],
            'username' => $inputs['username'],
            'created_by' => $this->session->userdata('_ID'),
            'created_at' => date('Y-m-d H:i:s')
        );

        if ($inputs['password'] != "") {
            $fields['password'] = md5($inputs['password']);
        }

        return $fields;
    }

    //aturan validasi
    public function getRules()
    {
        $newRule = ($this->isNew) ? '|is_unique[' . $this->table . '.id]' : '';
        $nama_guru = array(
            'field' => 'nama',
            'label' => 'Nama guru',
            'rules' => 'trim|required|max_length[50]'
        );



        $username = array(
            'field' => 'username',
            'label' => 'NIK',
            'rules' => 'trim|required|max_length[20]' . $newRule
        );



        $jenis_kelamin = array(
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'trim|required|max_length[1]'
        );

        return array($nama_guru, $jenis_kelamin);
    }
}
