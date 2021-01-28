<?php

use Service\Service;

function login()
{
    $service = new Service();
    $input = file_get_contents("php://input");
    $data = json_decode($input);

    // var_dump($service->db);
    // echo 'login';
    // var_dump($data);
    $service->json($data);
}
