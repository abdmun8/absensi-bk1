<?php
$server = "localhost";
$dbname = "absensi_siswa";
$user = "root";
$pass = "";
$db = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
