<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
            "success" => true,
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

        $this->db->select('jadwal_pelajaran.*, guru.nama, guru.nik, mata_pelajaran.nama as nama_matpel, mata_pelajaran.tingkat');
        $this->db->join('guru', 'jadwal_pelajaran.id_guru = guru.id');
        $this->db->join('mata_pelajaran', 'mata_pelajaran.id = jadwal_pelajaran.id_matpel');
        $this->db->where($where);
        $query = $this->db->get('jadwal_pelajaran');
        $result = $query->result();

        $setting = $this->db->get_where('setting', ['id' => 1])->row();

        $data = [];

        foreach ($result as $key => $value) {
            $value->durasi = $setting->durasi_jam_pelajaran * $value->jumlah_jam;
            array_push($data, $value);
        }
        $response = [
            'data' => $data,
            "success" => true,
            'message' => 'OK',
            '$day_name' => date('Ymd H:i:s')
        ];
        $this->response($response, RestController::HTTP_OK);
    }
}
