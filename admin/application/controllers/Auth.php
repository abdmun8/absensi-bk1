<?php

defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: OPTIONS, POST");
header("Access-Control-Allow-Headers: *");

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;

class Auth extends RestController
{

    function __construct()
    {
        parent::__construct();
        $this->secret_key = base64_encode("abdmun8");
        $this->secret_key_user = base64_encode("smk1binakarya");
    }

    function index_options()
    {
        $this->response(NULL, RestController::HTTP_OK);
    }

    function login_post()
    {
        $username = '';
        $password = '';
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data)) {
            $this->response(NULL, RestController::HTTP_BAD_REQUEST);
            die;
        }
        $username = $data->username;
        $password = $data->password;


        $table_name = 'guru';
        $query = $this->db->get_where($table_name, ["username" => $username]);
        $num = $query->num_rows();


        if ($num > 0) {
            $row = $query->row_array();
            $id = $row['id'];
            $name = $row['nama'];
            $nik = $row['nik'];
            $jk = $row['jenis_kelamin'];
            $password2 = $row['password'];

            if (md5($password) == $password2) {
                $secretKey = $this->secret_key;
                $tokenId = 'smkbk1';
                $serverName = "abdmun8.xyz";
                $issuedAt = time(); // issued at
                $notBefore = time() + 10; //not before 
                $expire = time() + (30 * 24 * 60 * 60); //expired

                $token = [
                    'iat'  => $issuedAt,         // Issued at: time when the token was generated
                    'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
                    'iss'  => $serverName,       // Issuer
                    'nbf'  => $notBefore,        // Not before
                    'exp'  => $expire,           // Expire
                    'data' => [                  // Data related to the signer user
                        "id" => $id,
                        "nama" => $name,
                        "nik" => $nik,
                        "username" => $username
                    ]
                ];

                $user_data = base64_encode(json_encode([
                    "name" => ucwords($name),
                    "jk" => $jk,
                    "nik" => $nik,
                    "id" => $id
                ]).$this->secret_key_user);

                $jwt = JWT::encode($token, $secretKey, 'HS256');
                $response = array(
                    "user" => $user_data,
                    "message" => "OK",
                    "token" => $jwt,
                );
                $this->response($response, RestController::HTTP_OK);
            } else {
                http_response_code(401);
                echo json_encode(array("message" => "Login failed.", "success" => false));
            }
        }
    }
}
