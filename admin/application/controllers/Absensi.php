<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/REST_Controller.php';

class Jadwal extends RestController
{

    function __construct()
    {
        parent::__construct();
        $this->auth = jwtVerify();
        if (!$this->auth) {
            $this->response(NULL, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    function index_get()
    {
        $data = $this->db->get('jadwal_pelajaran')->result();
        $response = [
            'data' => $data,
            'message' => 'OK'
        ];
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function today_get($id_guru = NULL)
    {
        $day_name = getDayNameIndo(date('l'));
        $ta = $this->db->get('setting', ['id' => 1])->row()->tahun_ajaran;
        $where = ['hari' => $day_name, 'tahun_ajaran' => $ta];
        if ($id_guru != NULL && is_int(intval($id_guru))) {
            $where['id_guru'] = $id_guru;
        }
        $data = $this->db->get_where('jadwal_pelajaran', $where)->result();
        $response = [
            'data' => $data,
            'message' => 'OK'
        ];
        $this->response($response, REST_Controller::HTTP_OK);
    }
}
