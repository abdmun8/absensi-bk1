<?php

use \Firebase\JWT\JWT;

/*fungsi untuk merubah angka menjadi nama status */
/*misal:
* angka 1 menjadi "Aktif"
*/

function status_data($angka = 0)
{
	if ($angka == 1) {
		$str = 'Aktif';
	} else {
		$str = 'Tidak Aktif';
	}

	return $str;
}

function status_yn($angka = 0)
{
	if ($angka == 1) {
		$str = 'Yes';
	} else {
		$str = 'No';
	}

	return $str;
}

/*u/ merubah angka biasa menjadi format rupiah*/
/*misal:
* angka 5000 menjadi Rp 5.000
*/
function format_rupiah($angka = 0)
{
	return  'Rp ' . number_format($angka);
}

/*
* for Generate Random Code (int) for code activation
*/
function genActivationCode($len = 5)
{
	$angka = range(0, 9);
	shuffle($angka);
	return implode('', array_rand($angka, $len));
}

function getDayNameIndo($day_name_eng)
{
	$day_name = [
		'Sunday' => 'minggu',
		'Monday' => 'senin',
		'Tuesday' => 'selasa',
		'Wednesday' => 'rabu',
		'Thursday' => 'kamis',
		'Friday' => 'jum\'at',
		'Saturday' => 'sabtu'
	];

	return $day_name[$day_name_eng];
}

function jwtVerify()
{
	$secret_key = base64_encode("abdmun8");
	$jwt = NULL;
	if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
		http_response_code(401);
		die;
	}
	$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
	$arr = explode("Bearer ", $authHeader);
	if (count($arr) < 2) {
		return FALSE;
	}
	$jwt = $arr[1];
	try {
		JWT::decode($jwt, $secret_key, array('HS256'));
		return TRUE;
	} catch (Exception $e) {
		return FALSE;
	}
}
