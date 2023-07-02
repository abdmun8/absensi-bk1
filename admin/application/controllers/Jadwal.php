<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Jadwal extends RestController
{

    private $auth = NULL;
    function __construct()
    {
        parent::__construct();
        $this->auth = jwtVerify();
        if (!$this->auth) {
            $this->response(NULL, RestController::HTTP_UNAUTHORIZED);
        }
    }

    function index_get()
    {
        $data = $this->db->get('jadwal_pelajaran')->result();
        $response = [
            'data' => $data,
            'message' => 'OK'
        ];
        $this->response($response, RestController::HTTP_OK);
    }

    function today_get()
    {
        $id_guru = $this->get('id');
        $day_name = getDayNameIndo(date('l'));
        $ta = $this->db->get('setting', ['id' => 1])->row()->tahun_ajaran;
        $where = ['hari' => $day_name, 'tahun_ajaran' => $ta];
        if ($id_guru != NULL && is_int(intval($id_guru))) {
            $where['id_guru'] = $id_guru;
        }

        $this->db->select('jadwal_pelajaran.*, guru.nama, guru.nik');
        $this->db->join('guru', 'jadwal_pelajaran.id_guru = guru.id');
        $this->db->where($where);
        $query = $this->db->get('jadwal_pelajaran');
        $data = $query->result();
        $response = [
            'data' => $data,
            'message' => 'OK'
        ];
        $this->response($response, RestController::HTTP_OK);
    }
}
