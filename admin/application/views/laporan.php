<!DOCTYPE html>
<html>
<head>
	<title><?=$title ?></title>
	<style>

		body {
			margin: 20px;
			font-family: Times New Roman;
		}

		table {
			border: 1px solid black;
			width: 100%;
		}

		table tr th{
			border: 1px solid black;
			text-align: center;
			padding: 0 10px 0 10px;
		}

		table tr td{
			border: 1px solid black;
			padding: 3px;
		}

		table tr td:not(:nth-child(2)){
			text-align: center;
		}

		h3 {
			text-align: center;
		}

		p {
			text-align: left;
			font-weight: bold;
		}

		.no-mgb{
			margin-bottom: 0;
		}

		.no-mgt{
			margin-top: 0;
		}

		/*table tr td:nth-child(3){
			background-color: green;
		}

		table tr td:nth-child(4){
			background-color: blue;
		}

		table tr td:nth-child(5){
			background-color: yellow;
		}

		table tr td:nth-child(6){
			background-color: red;
		}*/

	</style>
</head>
<body>
	<h3><?=$title?></h3>
	<p class="no-mgb">Kelas: <?=$kelas?></p>
	<p class="no-mgt">Periode: <?=$date?></p>
	<table cellpadding="2" cellspacing="0">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Hadir</th>
			<th>Sakit</th>
			<th>Izin</th>
			<th>Alpa</th>
		</tr>
		<?php
		$j = 1;
		foreach ($absen as $key => $v) {
			?>
			<tr>
				<td><?=$j?></td>
				<td><?=$v['nama']?></td>
				<td><?=$v['h']?></td>
				<td><?=$v['s']?></td>
				<td><?=$v['i']?></td>
				<td><?=$v['a']?></td>
			</tr>
		<?php 
			$j++;
		}?>
	</table>

</body>
</html>
		