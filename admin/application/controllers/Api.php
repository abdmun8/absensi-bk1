<?php
defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class Api extends REST_Controller
{
    function index()
    {
        echo "Welcome!";
    }

    function index_post(){
        echo "Welcome!";
    }

    function login()
    {
        $username = '';
        $password = '';
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data)) die();
        $username = $data->u;
        $password = $data->p;


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
                $secretKey = 'abdmun8';
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

                http_response_code(200);

                $jwt = JWT::encode($token, $secretKey, 'HS256');
                $response = array(
                    "message" => "Successful login.",
                    "jwt" => $jwt,
                    "name" => ucwords($name),
                    "jk" => $jk,
                    "nik" => $nik,
                    "id" => $id
                );

                $this->response($response, REST_Controller::HTTP_OK);
            } else {

                http_response_code(401);
                echo json_encode(array("message" => "Login failed.", "success" => false));
            }
        }
    }

    function protected()
    {
        $secret_key = base64_decode("abdmun8");
        $jwt = NULL;
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            http_response_code(401);
            die;
        }
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $arr = explode(" ", $authHeader);
        $jwt = $arr[1];
        if ($jwt) {
            try {
                JWT::decode($jwt, $secret_key, array('HS256'));
                return TRUE;
            } catch (Exception $e) {
                return FALSE;
            }
        }
    }

    function register()
    {
        $firstName = '';
        $lastName = '';
        $email = '';
        $password = '';
        $conn = null;

        $databaseService = new DatabaseService();
        $conn = $databaseService->getConnection();

        $data = json_decode(file_get_contents("php://input"));

        $firstName = $data->first_name;
        $lastName = $data->last_name;
        $email = $data->email;
        $password = $data->password;

        $table_name = 'Users';

        $query = "INSERT INTO " . $table_name . "
                SET first_name = :firstname,
                    last_name = :lastname,
                    email = :email,
                    password = :password";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':firstname', $firstName);
        $stmt->bindParam(':lastname', $lastName);
        $stmt->bindParam(':email', $email);

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(':password', $password_hash);


        if ($stmt->execute()) {

            http_response_code(200);
            echo json_encode(array("message" => "User was successfully registered."));
        } else {
            http_response_code(400);

            echo json_encode(array("message" => "Unable to register the user."));
        }
    }

    // Absen guru
    function absenGuru()
    {
        http_response_code(200);
        $message = '';
        $success = FALSE;
        $data = json_decode(file_get_contents("php://input"));
        $column = $data->type == 'Masuk' ? 'jam_masuk' : 'jam_pulang';
        $date = date('Y-m-d');
        $current = date('Y-m-d H:i:s');
        $sql = " SELECT * FROM absensi_guru WHERE id_guru = '{$data->id}' AND tanggal = '$date' ";
        $query = $this->db->query($sql);
        $total = $query->num_rows();
        $result = $query->result();
        if ($data->type == 'Masuk') {
            if ($total > 0) {
                $message = 'Anda Sudah Masuk Hari ini';
            } else {
                $sql = " INSERT INTO absensi_guru (id_guru,tanggal,jam_masuk,jam_pulang) 
                VALUES ('{$data->id}','{$date}','{$current}','0000-00-00 00:00:00')";
                if ($this->db->query($sql)) {
                    $success = TRUE;
                    $message = "Absen Masuk berhasil";
                }
            }
        } else {
            $sql = "UPDATE absensi_guru set jam_pulang = '{$current}' WHERE id_guru = '{$data->id}' AND tanggal = '$date' ";
            if ($this->db->query($sql)) {
                $success = TRUE;
                $message = "Absen pulang berhasil";
            }
        }

        echo json_encode(array("success" => $success, "message" => $message));
    }
}
