<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends Ci_Controller
{
	private $activeSession; // store session

	public function __construct()
	{
		$this->faker = Faker\Factory::create();
		parent::__construct();
		$this->activeSession = $this->session->userdata('_ID');
	}


	public function index()
	{
		echo "hello world";
	}

	function seed_employee($total = 10)
	{

		for ($i = 0; $i < $total; $i++) {
			$data = [
				"employee_id" => NULL,
				"nik" => rand(1000, 9999),
				"department_id" => 1,
				"position_id" => 1,
				"sex" => 'Laki-laki',
				"email" => $this->faker->email,
				"is_active" => 1,
				"address" => $this->faker->address,
				"username" => $this->faker->userName,
				"is_new" => 1,
				"is_valid" => 1,
				"activation_code" => rand(100000, 99999)
			];
			$this->db->insert("employee", $data);
		}
		echo "ok";
	}

	function seed_siswa($total = 10)
	{
		$sex = ['L', 'P'];
		for ($i = 0; $i < $total; $i++) {
			$data = [
				"id" => NULL,
				"nis" => rand(1000, 9999),
				"nisn" => '',
				"nama" => $this->faker->name,
				"jenis_kelamin" => $sex[array_rand($sex)],
				"active" => 1,
				"id_kelas" => rand(1, 6),
				"alamat" => $this->faker->address,
				"created_by" => 1,
				"created_at" => date('Y-m-d H:i:s'),
				"updated_by" => 1,
				"updated_at" => date('Y-m-d H:i:s')
			];
			$this->db->insert("siswa", $data);
		}
		echo "ok";
	}

	function seed_guru($total = 50)
	{
		$sex = ['L', 'P'];
		$pend = ['S1 Bahasa Inggris', 'S1 Bahasa indonesia', 'S1 Teknik', 'S1 Bahasa jepang', 'S1 PAI', 'S1 Informatika'];
		for ($i = 0; $i < $total; $i++) {
			$data = [
				"id" => NULL,
				"nik" => rand(1000, 9999),
				"nama" => $this->faker->name,
				"jenis_kelamin" => $sex[array_rand($sex)],
				"tgl_join" => $this->faker->date($format = 'Y-m-d', $max = 'now'),
				"tgl_lahir" => $this->faker->date($format = 'Y-m-d', $max = 'now'),
				"pendidikan" => $pend[array_rand($pend)],
				"alamat" => $this->faker->address,
				"active" => 1,
				"created_by" => 1,
				"created_at" => date('Y-m-d H:i:s'),
				"updated_by" => 1,
				"updated_at" => date('Y-m-d H:i:s')
			];
			$this->db->insert("guru", $data);
		}
		echo "ok";
	}



	function seed_wali_murid($total = 50)
	{
		$sex = ['L', 'P'];
		for ($i = 0; $i < $total; $i++) {
			$j = $i + 1;
			$data = [
				"id" => NULL,
				"nama" => $this->faker->name,
				"id_siswa" => $j,
				"no_hp" => $this->faker->e164PhoneNumber,
				"jenis_kelamin" => $sex[array_rand($sex)],
				"alamat" => $this->faker->address,
				"active" => 1,
				"created_by" => 1,
				"created_at" => date('Y-m-d H:i:s'),
				"updated_by" => 1,
				"updated_at" => date('Y-m-d H:i:s')
			];
			$this->db->insert("wali_murid", $data);
		}
		echo "ok";
	}
}
