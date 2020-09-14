<?php
if ($code == 1) {
	$msg = 'Apply loker berhasil';
} elseif ($code == 2) {
	$msg = 'Tidak bisa aplly loker, Anda sudah pernah apply loker ini sebelumnya!';
} else {
	$msg = 'Tidak bisa aplly loker, terjadi kesalahan!';
}
?>
<h3><?php echo $msg;?></h3>