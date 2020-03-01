<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller { 
	    	
	public function __construct(){
		parent::__construct();
		$this->load->model('Default_model');
		$this->load->model('CustomerModel');
		$this->load->model('TagihanModel');
		$this->load->model('TransaksiModel');
		$this->load->model('PerumahanModel');
		$this->load->model('ClusterModel');
		$this->load->model('BlokModel');
		$this->load->model('StaffModel');
		$this->load->model('NotaModel');
		$this->load->model('NotaDetailModel');
		$this->load->helper('url_helper');
		$this->load->library('pdf');
        $this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
	}

	//LOAD VIEW

	//front
	public function index()
	{
		$this->load->view('login');

	}	

	//Dashboard admin
	public function dashboardadmin(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/dashboard');
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Dashboard staff
	public function dashboardstaff(){
		if ($this->checkcookiestaff()) {
			$this->load->view('header1');
			$this->load->view('staff/blok_page');
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	///profile
	public function profileadmin(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/profile_page');
			$this->load->view('footer');
		}else if ($this->checkcookiestaff()) {
			$this->load->view('header1');
			$this->load->view('admin/profile_page');
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//change password
	public function changepassword(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/change_password');
			$this->load->view('footer');
		}else if ($this->checkcookiestaff()) {
			$this->load->view('header1');
			$this->load->view('staff/change_password');
			$this->load->view('footer');
		}else {
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Cluster
	public function cluster(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/cluster_page');
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Blok
	public function blok(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/blok_page');
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Blok detail
	public function blokdetail(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/blok_detail_page');
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Customer
	public function customer(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/customer_page');	
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Staff
	public function staff(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/staff_page');	
			$this->load->view('footer');	
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Arsip
	public function arsip(){
		$idBlok = $this->input->post('id');
		if ($this->checkcookieuser()) {
			$data['idBlok'] = $idBlok;
			$this->load->view('header');
			$this->load->view('admin/arsip_admin_page', $data);
			$this->load->view('footer');
		}else if ($this->checkcookiestaff()) {
			$data['idBlok'] = $idBlok;
			$this->load->view('header1');
			$this->load->view('staff/arsip_staff_page', $data);
			$this->load->view('footer');
		}else {
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Transaksi
	public function arsipdata(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/arsip_page');
			$this->load->view('footer');
		}else {
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Detail iuran tagihan
	public function iurandetail(){
		$idBlok = $this->input->post('id');
		if ($this->checkcookieuser()) {
			$data['idBlok'] = $idBlok;
			$this->load->view('header');
			$this->load->view('admin/tagihan_page',$data);
			$this->load->view('footer');
		} else if ($this->checkcookiestaff()) {
			$data['idBlok'] = $idBlok;
			$this->load->view('header1');
			$this->load->view('staff/detail_iuran_page',$data);
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//Review iuran tagihan admin
	public function iuranreview(){
		$idTagihan = $this->input->post('data');
		$manual = $this ->input->post('manual');
		$id = $this ->input->post('idBlok');
		if ($this->checkcookiestaff()) {
			$data['idTagihan'] = $idTagihan;
			$data['manual'] = $manual;
			$data['id'] = $id;
			$data['harga'] = $this->BlokModel->get_harga($id);
			$this->load->view('header1');
			$this->load->view('staff/review_iuran',$data);
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}

	//add tagihan
	public function addtagihan(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/add_tagihan');
			$this->load->view('footer');
		}else{
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}


	public function cekuser(){
		if ($this->checkcookieuser()) {
			$this->load->view('header');
			$this->load->view('admin/dashboard');
			$this->load->view('footer');
		}else if ($this->checkcookiestaff()) {
			$this->load->view('header1');
			$this->load->view('staff/blok_page');
			$this->load->view('footer');
		}else {
			header("Location: ".base_url()."index.php/login");
			die();
		}
	}


	//GET DATA

	//ambil data user
	//note: password tidak diambil
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_all_user($return_var = NULL){
		$data = $this->Default_model->get_data_user_nopassword();
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	//ambil data user berdasarkan username
	//note: ambil data user dari database berdasarkan username
	//parameter 1: username
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_user_by_id($id, $return_var = NULL){
		$data = $this->Default_model->get_data_user_nopassword($id);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	//ambil data perumahan
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_all_perumahan($return_var = NULL){
		$data = $this->PerumahanModel->get_all();
			if (empty($data)){
				$data = [];
			}
			if ($return_var == true) {
				$jml = $data.length;
				return $data;
			}else{
				echo json_encode($data);
			}
	}

	//ambil data user berdasarkan username
	//note: ambil data user dari database berdasarkan username
	public function get_perumahan_by_id($return_var = NULL){
		$id = $this->input->post('id');
		$data = $this->PerumahanModel->get_all($id);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	//ambil list nama perumahan
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_list_perumahan($return_var = NULL){
		$data = $this->BlokModel->get_list_perumahan();
			if (empty($data)){
				$data = [];
			}
			if ($return_var == true) {
				return $data;
			}else{
				echo json_encode($data);
			}
	}

	//ambil list nama cluster
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_list_cluster($return_var = NULL){
		$data = $this->BlokModel->get_list_cluster();
			if (empty($data)){
				$data = [];
			}
			if ($return_var == true) {
				return $data;
			}else{
				echo json_encode($data);
			}
	}

	//ambil data cluster
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_all_cluster($return_var = NULL){
		$perumahan = $this->input->post('perumahan');
		$username = $this->get_cookie_decrypt("staffCookie");

		if($username != NULL){
			$data = $this->ClusterModel->get_all(null, $perumahan, $username);
		}else{
			$data = $this->ClusterModel->get_all(null, $perumahan);
		}
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	//ambil data user berdasarkan username
	//note: ambil data user dari database berdasarkan username
	public function get_cluster_by_id($return_var = NULL){
		$id = $this->input->post('id');
		$data = $this->ClusterModel->get_all($id);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	public function get_cluster_by_perumahan($return_var = NULL){
		$id = $this->input->post('id');
		$data = $this->ClusterModel->get_by_perumahan($id);
		
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	
	public function get_blok_by_cluster($return_var = NULL){
		$id = $this->input->post('id');
		$data = $this->BlokModel->get_blok_by_cluster($id);
		
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	//ambil data blok
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_all_blok($isAdmin, $return_var = NULL){
		$perumahan = $this->input->post('perumahan');
		$cluster = $this->input->post('cluster');
		$username = $this->get_cookie_decrypt("staffCookie");

		if(!$isAdmin){
			$data = $this->BlokModel->get_all(null, $perumahan, $cluster,null,$username);
		}else{
			$data = $this->BlokModel->get_all(null, $perumahan, $cluster);
		}
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	//ambil data blok yang ada penghuni
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_blok_data($return_var = NULL){
		$data = $this->BlokModel->data_get();
			if (empty($data)){
				$data = [];
			}
			if ($return_var == true) {
				// $jml = $data.length;
				return $data;
			}else{
				echo json_encode($data);
			}
	}

	//ambil data user berdasarkan username
	//note: ambil data user dari database berdasarkan username
	public function get_blok_by_id($return_var = NULL){
		$id = $this->input->post('id');
		$data = $this->BlokModel->get_all($id);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}


	//detailblok customer
	public function get_blok_customer($id, $return_var = NULL){
		$data = $this->Default_model->get_all($id);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}


	//ambil data staff
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_all_staff($return_var = NULL){
		$data = $this->StaffModel->get_all();
			if (empty($data)){
				$data = [];
			}
			if ($return_var == true) {
				return $data;
			}else{
				echo json_encode($data);
			}
	}

	//ambil data user berdasarkan username
	//note: ambil data user dari database berdasarkan username
	public function get_staff_by_id($return_var = NULL){
		$id = $this->input->post('id');
		$data = $this->StaffModel->get_all($id);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}


	//ambil data customer
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_all_customer($return_var = NULL){
		$data = $this->CustomerModel->get_all();
			if (empty($data)){
				$data = [];
			}
			if ($return_var == true) {
				return $data;
			}else{
				echo json_encode($data);
			}
	}

	//ambil data user berdasarkan username
	//note: ambil data user dari database berdasarkan username
	public function get_customer_by_id($return_var = NULL){
		$id = $this->input->post('id');
		$data = $this->CustomerModel->get_all($id);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	//ambil data arsip
	//parameter 1: true bila priviledge akses adalah dari admin
	//parameter 2: true bila ingin return array, kosongi bila ingin Json
	public function get_all_arsip($return_var = NULL){
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$id = $this->input->post('id');

		$data = $this->TagihanModel->get_all($id,1,$startDate,$endDate);
		
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	public function get_transaksi(){
		$perumahan = $this->input->post('perumahan');
		$cluster = $this->input->post('cluster');
		$data = $this->TransaksiModel->get_all($perumahan, $cluster);
		
		if (empty($data)){
			$data = [];
		}
		echo json_encode($data);
	}

	public function get_tagihan($return_var = NULL){
		$id = $this->input->post('id');
		if(is_array($id)){
			$data = $this->TagihanModel->get_by_id($id);
		}else{
			$data = $this->TagihanModel->get_all($id,0);
		}
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	//ambil data customer berdasarkan username
	//note: password tidak diambil
	//parameter 1: username
	//parameter 1: true bila ingin return array, kosongi bila ingin Json
	public function get_customer($id = null){
		$data = $this->CustomerModel->get_all($id);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
	}

	public function get_my_profile(){
		$username = $this->get_cookie_decrypt("adminCookie");
		if($username == NULL){
			$username = $this->get_cookie_decrypt("staffCookie");
		}
		$data = $this->Default_model->get_data_user_nopassword($username);
		if (empty($data)){
			$data = [];
		}
		echo json_encode($data);
	}

	public function get_my_blok($return_var = NULL){
		$username = $this->get_cookie_decrypt("editblok");
		$data = $this->CustomerModel->get_detail($username);
		if (empty($data)){
			$data = [];
		}
		if ($return_var == true) {
			return $data;
		}else{
			echo json_encode($data);
		}
		// echo $username;
	}

	//INSERT

	//Tambah data user
	//note: API hanya bisa diakses saat ada cookie user
	//input: form POST seperti di bawah
	//output: success/failed/access denied
	public function insert_user(){
		if ($this->checkcookieuser()) {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			);
			$insertStatus = $this->Default_model->insert_user($data);
			echo $insertStatus;
		}else{
			echo "access denied";
		}
	}
	
	public function insert_perumahan() {
		if ($this->checkcookieuser()) {
			$spasi = str_replace(" ", "_", $this->input->post('nama'));
			$data = array(
				'nama_perumahan' => $this->input->post('nama'),
				'kota' => $this->input->post('kota'),
				'status' => '0'
			);
			$insertStatus = $this->PerumahanModel->insert($data);
			echo $insertStatus;
		}else{
			echo "access denied";
		}
	}

	public function insert_cluster() {
		if ($this->checkcookieuser()) {
			$idperum = $this->input->post('perum');
			$cluster = $this->input->post('nama');

			$test = '';
			$test = $test.$idperum.'_'.$cluster;

			$data = array(
				'IDPerumahan' => $idperum,
				'nama_cluster' => $test
			);
			$insertStatus = $this->ClusterModel->insert($data);
			echo $insertStatus;
		}else{
			echo "access denied";
		}
	}

	public function insert_blok() {
		if ($this->checkcookieuser()) {
			$nama = $this->input->post('nama');
			$cluster =  $this->input->post('cluster');
			$harga =  $this->input->post('harga');
			$type =  $this->input->post('type');
			
			$data = array(
				'nama_blok' => $nama,
				'IDCluster' => $cluster,
				'Harga' => $harga,
				'IDCustomer' => null,
				'type' => $type
			);
			$insertStatus = $this->BlokModel->insert($data);
			echo $insertStatus;
		}else{
			echo "access denied";
		}
	}

	public function insert_blok_detail() {
		if ($this->checkcookieuser()) {
			$id = $this->get_cookie_decrypt("editblok");
			$perumahan =  $this->input->post('perumahan');
			$cluster =  $this->input->post('cluster');
			$blok =  $this->input->post('blok');
			
			$data = array(
				'IDCustomer' => $id
			);

			$where= array('IDBlok' => $blok );
        	$insertStatus = $this->BlokModel->update($where, $data);			
		}else{
			echo "access denied";
		}
	}

	public function insert_customer() {
		if ($this->checkcookieuser()) {
			$data = array(
				'nama' => $this->input->post('nama'),
				'nomor' => $this->input->post('nomor'),
				'email' => $this->input->post('email')
			);
			$insertStatus = $this->CustomerModel->insert($data);
			echo $insertStatus;
		}else{
			echo "access denied";
		}
	}

	public function insert_staff() {
		if ($this->checkcookieuser()) {
			$username =  $this->input->post('user');
			$nomor =  $this->input->post('nomor');
			$perumahan = $this->input->post('perum');
			$email = $this->input->post('email');
			$staff = "staff";
			$nama = str_replace(" ", "_", $this->input->post('nama'));

			$data = array(
				'username' => $username,
				'password' => '827ccb0eea8a706c4c34a16891f84e7b',
				'nama_user' => $nama,
				'pangkat' => $staff,
				'nomor' => $nomor,
				'email' => $email
			);

			$data1 = array(
				'username' => $username,
				'status' => '1'
			);

			$where= array('IDPerumahan' => $perumahan );
			$insertStatus = $this->StaffModel->insert($data);
			$updateperumahan = $this->PerumahanModel->update($where, $data1);
			echo $nama;
		}else{
			echo "access denied";
		}
	}

	public function add_tagihan_manual(){
		if ($this->checkcookieuser()) {
			$all = $this->TagihanModel->get_all_tagihan();

			$coba = $this->input->post('id');
			$kondisi = '';

			foreach($all as $satuan){
				if($coba == $satuan['IDTagihan']){					
					echo "Data Tagihan Sudah Ada!";
					$kondisi = 'ada';
					break;
				} 					
			}

			if($kondisi == 'ada') {
			} else {
				$data = array(
					'IDTagihan' => $this->input->post('id'),
					'IDBlok' => $this->input->post('blok'),
					'bulan' => $this->input->post('bulan'),
					'tahun' => $this->input->post('tahun'),
					'Harga' => $this->input->post('harga'),
					'status' => '0'					
				);
				$insertStatus = $this->TagihanModel->insert_tagihan($data);	
				echo 'Data Berhasil Ditambahkan!';
			}
					
			$kondisi = '';
			
		}else{
			echo "access denied";
		}
	}

	public function tagihanmanual(){
		if($this->checkcookiestaff()){
			$username = $this->get_cookie_decrypt("staffCookie");
			$data = $this->input->post('data');
			$blok = $this->input->post('id');
			$harga = $this->input->post('harga');
			$idsementara = '';
			$all = $this->TagihanModel->get_all_tagihan();
			$kondisi = '';

			foreach($data as $monthYear){
				$idsementara = $idsementara.$blok.$monthYear['month'].$monthYear['year'];

				foreach($all as $satuan){
					if($idsementara == $satuan['IDTagihan']){					
						$kondisi = 'ada';
						break;
					} 					
				}

				if($kondisi == 'ada'){

				} else {
					$tagihan = array(
							'IDTagihan' => $blok.$monthYear['month'].$monthYear['year'],
							'IDBlok' => $blok,
							'bulan' => $monthYear['month'],
							'tahun' => $monthYear['year'],
							'harga' => $harga
						);
					$this->TagihanModel->insert_tagihan($tagihan);
				}

				$idsementara = '';
				$kondisi='';

			}
		}
	}


	//UPDATE

	//Ubah password user
	//note: API hanya bisa diakses saat ada cookie user
	//parameter 1: username
	//input: form POST seperti di bawah
	//output: success/failed/id not found/wrong old password/access denied
	public function update_password_user(){
		if ($this->checkcookieuser()) {
			$password = md5($this->input->post('passw'));			
			$username = $this->get_cookie_decrypt("adminCookie");

			$data = array(
				'password' => $password
			);
			
			$where= array('username' => $username );
			$this->StaffModel->update($where, $data);

		}else if($this->checkcookiestaff()){
			$password = md5($this->input->post('passw'));			
			$username = $this->get_cookie_decrypt("staffCookie");

			$data = array(
				'password' => $password
			);
			
			$where= array('username' => $username );
			$this->StaffModel->update($where, $data);			
		} else {
			echo "access denied";
		}
	}

	//Edit data perumahan
	public function update_perumahan(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$kota = $this->input->post('kota');

		$data = array(
            'nama_perumahan' => $nama,
            'kota' => $kota,
		);
		
		$where= array('IDPerumahan' => $id );
		$this->PerumahanModel->update($where, $data);
		
	}

	//Edit data cluster
	public function update_cluster(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$idperum = $this->input->post('perumahan');

		$test = '';
		$test = $test.$idperum.'_'.$nama;

		$data = array(
			'nama_cluster' => $test,
			'IDPerumahan' => $idperum
		);
		
		$where= array('IDCluster' => $id );
        $this->ClusterModel->update($where, $data);
	}

	//Edit data blok
	public function update_blok(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$perumahan = $this->input->post('perumahan');
		$cluster = $this->input->post('cluster');
		$harga = $this->input->post('harga');		

		$data = array(
			'nama_blok' => $nama,
			'IDCluster' => $cluster,
			'Harga' => $harga
		);
		
		
		$where= array('IDBlok' => $id );
        $this->BlokModel->update($where, $data);

		echo $cluster;
	}

	//Edit data blok
	public function update_blok_detail(){
		$id = $this->input->post('id');		

		$data = array(
			'IDCustomer' => null
		);	
		
		$where= array('IDBlok' => $id );
        $this->BlokModel->update($where, $data);
	}

	//Edit data customer
	public function update_customer(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$nomor = $this->input->post('nomor');

		$data = array(
            'IDCustomer' => $id,
			'nama' => $nama,
			'nomor' => $nomor,
			'email' => $email
		);
		
		$where= array('IDCustomer' => $id );
		$this->CustomerModel->update($where, $data);
		
	}


	//Edit data staff
	public function update_staff(){
		$username = $this->input->post('id');
		$nama = $this->input->post('nama');
		$nomor = $this->input->post('nomor');
		$email = $this->input->post('email');
		$idperum = $this->input->post('perum');
		$idlama = $this->input->post('idlama');

		$data = array(
			'username' => $username,
			'nama_user' => $nama,
			'nomor' => $nomor,
			'email' => $email
		);

		//update tabel perumahan utk username ada staff
		$data1 = array(
			'username' => $username,
			'status' => '1'
		);

		//update tabel perumahan hapus staff
		$data2 = array(
			'username' => null,
			'status' => '0'
		);

		if($idperum != null) {
			if($idperum != $idlama) {
				$where1= array('IDPerumahan' => $idperum );
				$this->PerumahanModel->update($where1, $data1);
				$where2= array('IDPerumahan' => $idlama );
				$this->PerumahanModel->update($where2, $data2);
			} 
		}
		$where= array('username' => $username );
		$this->StaffModel->update($where, $data);
				
	}
	
	public function do_bayar(){
		if($this->checkcookiestaff()){
			$username = $this->get_cookie_decrypt("staffCookie");
			$id = $this->input->post("id");
			$diskon = $this->input->post("diskon");
			$total_awal = $this->input->post("total_awal");
			$this->TagihanModel->update_status($id);
			$notaID = $this->NotaModel->insert_one($username,$total_awal,$diskon);
			$this->NotaDetailModel->insert_one($notaID, $id);		
			$c = $this->create_cookie_encrypt("idcetak",$notaID);	
	
			echo $notaID;
		}

	}

	public function view_pdf(){
		$id = $this->input->post("data");
		$c = $this->create_cookie_encrypt("idcetak",$id);	
		echo $c;
	}

	public function update_profile(){
		$nomor = $this->input->post('nomor');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$nama = str_replace(" ", "_", $this->input->post('nama'));


		$id = $this->get_cookie_decrypt("adminCookie");
		if($id == NULL){
			$id = $this->get_cookie_decrypt("staffCookie");
		}
		
		if($password == NULL){
			$data = array(
				'nama_user' => $nama,
				'nomor' => $nomor,
				'email' => $email
			);
		} else{
			$data = array(
				'nama_user' => $nama,
				'nomor' => $nomor,
				'email' => $email,
				'password'=> $password
			);
		}
		$deleteStatus = $this->Default_model->update_user($id, $data);

		echo "Data saved !";
	}

	//Reset password staff
	public function reset_pass_staff(){
		$id = $this->input->post('id');

		$data = array(
            'password' => '827ccb0eea8a706c4c34a16891f84e7b'
		);
		
		$where= array('username' => $id );
		$this->StaffModel->update($where, $data);
		
	}



	//DELETE

	//Delete user
	//note: API hanya bisa diakses saat ada cookie user
	//parameter 1: username
	//output: success/failed/access denied
	public function delete_user($id){
		if ($this->checkcookieuser()) {
			$deleteStatus = $this->Default_model->delete_user($id);
			echo $deleteStatus;
		}else{
			echo "access denied";
		}
	}

	public function delete_perumahan() {
		if ($this->checkcookieuser()) {
			$username = $this->input->post('id');
			$kd = array('IDPerumahan' => $username);

			$deleteStatus = $this->PerumahanModel->delete_perumahan1($username);
			echo $deleteStatus;
		}else{
			echo "access denied";
		}
	}

	public function delete_customer() {
		if ($this->checkcookieuser()) {
			$username = $this->input->post('id');

			$data = array(
				'IDCustomer' => null
			);
		
		
			$where= array('IDCustomer' => $username );
			$this->BlokModel->update($where, $data);

			$deleteStatus = $this->CustomerModel->delete($username);
			echo $username;
		}else{
			echo "access denied";
		}
	}

	public function delete_cluster(){
		if ($this->checkcookieuser()) {
			$username = $this->input->post('id');
			$deleteStatus = $this->ClusterModel->delete($username);
			echo $deleteStatus;
		}else{
			echo "access denied";
		}
	}

	public function delete_blok(){
		if ($this->checkcookieuser()) {
			$username = $this->input->post('id');
			$deleteStatus = $this->BlokModel->delete($username);
			echo $deleteStatus;
		}else{
			echo "access denied";
		}
	}

	public function delete_staff(){
		if ($this->checkcookieuser()) {
			$username = $this->input->post('id');

			$data = array(
				'username' => null,
				'status' => '0'
			);

			$where= array('username' => $username );
			$this->PerumahanModel->update($where, $data);
			$deleteStatus = $this->StaffModel->delete($username);


			echo $deleteStatus;
		}else{
			echo "access denied";
		}
	}

	//OTHER

	//Login user
	//note: -
	//input: form POST seperti di bawah
	//Output: berhasil login / gagal login
	public function cekloginuser(){

		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$data = $this->Default_model->get_data_user();
		$status = 'null';
		$is_login = false;
		foreach ($data as $row){
			if ($username == $row['username'] && $password == $row['password']) {
				if($row['pangkat'] == 'admin'){
					$this->create_cookie_encrypt("adminCookie",$username);
					$status = 'admin';
					$is_login = true;
					break;

				} else if($row['pangkat'] == 'staff'){
					$this->create_cookie_encrypt("staffCookie",$username);
					$status = 'staff';
					$is_login = true;
					break;
				}
				
			}
		}
		if ($status == 'admin') {
			echo "admin";
		} else if ($status == 'staff') {
			echo "staff";
		} else{
			echo "gagal login";
		}
	}


	//Check cookie admin
	//note: tidak untuk front end
	public function checkcookieuser(){
		$this->load->helper('cookie');
		if ($this->input->cookie('adminCookie',true)!=NULL) {
			return true;
		}else{
			return false;
		}
	}

	//Check cookie staff
	//note: tidak untuk front end
	public function checkcookiestaff(){
		$this->load->helper('cookie');
		if ($this->input->cookie('staffCookie',true)!=NULL) {
			return true;
		}else{
			return false;
		}
	}

	//Logout
	//note: menghapus cookie dan langsung redirect ke halaman login
	public function logoutuser(){
		$this->load->helper('cookie');
		if ($this->input->cookie('adminCookie',true)!=NULL) {
			delete_cookie("adminCookie");
		}else if ($this->input->cookie('staffCookie',true)!=NULL){
			delete_cookie("staffCookie");
		}
		
		header("Location: ".base_url()."index.php");
		die();
	}

	//untuk membuat cookie
	//parameter 1: nama cookie (opsional)
	//parameter 2: value cookie (opsional)
	//parameter 3: expire (opsional)
	//input: form POST seperti di bawah (opsional bila tidak bisa menggunakan parameter)
	//output: -
	public function create_cookie($name = NULL, $value = NULL, $expire = NULL){
		if ($name == NULL) {
			$name = $this->input->post('name');
		}
		if ($value == NULL) {
			$value = $this->input->post('value');
		}
		if ($expire == NULL) {
			$expire = 0;
		}
		$this->load->helper('cookie');
		$cookie= array(
			'name'   => $name,
			'value'  => $value,
			'expire' => $expire
		);
		$this->input->set_cookie($cookie);
		echo "cookie created";
	}

	//untuk mengambil cookie
	//note: JANGAN GUNAKAN INI UNTUK MENGAMBIL COOKIE USER (karena sudah di encrypt), gunakan get_cookie_decrypt() di bawah
	//parameter 1: nama cookie
	//output: no cookie / $cookie
	public function get_cookie($name){
		$this->load->helper('cookie');
		if ($this->input->cookie($name,true)!=NULL) {
			echo $this->input->cookie($name,true);
		}else{
			echo "no cookie";
		}
	}

	//untuk membuat cookie yang diencrypt
	//parameter 1: nama cookie (opsional)
	//parameter 2: value cookie (opsional)
	//parameter 3: expire (opsional)
	//input: form POST seperti di bawah (opsional bila tidak bisa menggunakan parameter)
	//output: -
	public function create_cookie_encrypt($name = NULL, $value = NULL, $expire = NULL){
		if ($name == NULL) {
			$name = $this->input->post('name');
		}
		if ($value == NULL) {
			$value = $this->input->post('value');
		}
		if ($expire == NULL) {
			$expire = 0;
		}
		$this->load->helper('cookie');
		$cookie= array(
			'name'   => $name,
			'value'  => str_rot13($value), //Not really encrypt anything, just jumble text :P
			'expire' => $expire
		);
		$this->input->set_cookie($cookie);
		// echo "cookie created";
	}

	//untuk mengambil cookie yang di decrypt dari fungsi create_cookie_encrypt
	//parameter 1: nama cookie
	//output: no cookie / $cookie
	public function get_cookie_decrypt($name){
		$this->load->helper('cookie');
		if ($this->input->cookie($name,true)!=NULL) {
			return str_rot13($this->input->cookie($name,true));
		}else{
			return null;
		}
	}

	//verifikasi empty login
	public function aksilogin(){
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
           echo json_encode(['success'=>'Record added successfully.']);
        }
	}

	//verifikasi change password empty
	public function aksipass(){
		$this->form_validation->set_rules('password', 'Password', 'required|matches[re_password]');
        $this->form_validation->set_rules('re_password', 'Retype Password', 'required');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
           echo json_encode(['success'=>'Record added successfully.']);
        }
	}

	//fungsi tambah tagihan bulanan
	public function input_transaksi(){
		$jml =  $this->input->post('jml');
		$cust = $this->input->post('arr');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$idsementara = '';
		$nilaiharga = '';
		$harga1 = '';
		$nilaiblok = '';
		$blok1 = '';
		$kondisi = '';

		$all = $this->TagihanModel->get_all_tagihan();

		foreach($cust as $hasil) {
			$nilaiharga = json_encode($hasil['Harga']);
			$nilaiblok = json_encode($hasil['IDBlok']);
			$number = str_replace('"', "", $nilaiharga);
			$harga1 = intval($number);
			$blok1 = str_replace('"', "", $nilaiblok);
			$idsementara = $idsementara.$blok1.$bulan.$tahun;


			foreach($all as $satuan){
				if($idsementara == $satuan['IDTagihan']){					
					$kondisi = 'ada';
					break;
				} 					
			}

			if($kondisi == 'ada') {
			} else {
				$data = array(
					'IDTagihan' => $idsementara,
					'IDBlok' => $blok1,
					'bulan' => $bulan,
					'tahun' => $tahun,
					'Harga' => $harga1,
					'status' => '0'			
				);
				$insertStatus = $this->TagihanModel->insert_tagihan($data);	
			}
			
			$idsementara = '';
			$nilaiharga = '';
			$harga1 = '';
			$nilaiblok = '';
			$blok1 = '';
			$kondisi = '';
		}

	}


	//utk penulisan fungsi terbilang pada kuintansi
	public function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." Puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " Seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " Seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

	public function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}

	//mencetak kuintansi pdf tagihan pembayaran
	public function cetak_pdf(){
		$no = 1;
		$username = $this->get_cookie_decrypt("idcetak");
		$data = $this->TagihanModel->kuintansi($username);
		$bulannya = $this->TagihanModel->jmlbln($username);
		$dt = new DateTime(null, new DateTimeZone('Asia/Jakarta')); 
		$c_pdf = $this->pdf->getInstance();
		$jml = 0;
		$caca = "";
		$nilai = "";

		foreach($bulannya as $item) {
			$caca = $caca.$bulannya[$jml]->bulan. ", ";
			$nilai = $nilai.$bulannya[$jml]->Harga. ", ";
			$jml = $jml + 1;
		}

		$yng = $this->terbilang($data[0]->total_awal);

        $c_pdf = new FPDF('P', 'mm', 'A4');
        $c_pdf->AddPage();
        $c_pdf->header('Arial');
        $c_pdf->setTopMargin(15);
        $c_pdf->setLeftMargin(12);
        $c_pdf->Cell(10);
        $c_pdf->SetFont('Arial','', 15);
        $c_pdf->Cell(75,10,'MANAGEMENT STATE', 0,1, 'C');
        $c_pdf->SetFont('Arial', 'B', 17);
        $c_pdf->Cell(10);
		$c_pdf->Cell(190,7, 'PURI SAFIRA RESIDENCE', 0,1,'L');
        $c_pdf->SetFont('Arial', 'B', 8);
        $c_pdf->Cell(10);
		$c_pdf->Cell(75,5, 'Jl. Raya Darmo No.75-77, Surabaya',0,0, 'C');
		$c_pdf->SetFont('Arial', 'U',25);
		$c_pdf->Cell(30);
		$c_pdf->Cell(120,5, 'Tanda Terima',0,1, 'L');
		$c_pdf->SetFont('Arial', 'B',7);
		$c_pdf->Cell(10);
		$c_pdf->Cell(75,4, 'Telp. (031) 5666615, 5666616',0,1, 'C');
	   		
		$c_pdf->Line(15, 40, 220-25, 40);
        $c_pdf->Line(15, 40, 220-25, 40);
        $c_pdf->Line(15, 40, 220-25, 40);

        $c_pdf->Cell(10,8, '', 0,1);
        $c_pdf->Cell(10);
        $c_pdf->SetFont('Arial', '', 12);
        $c_pdf->Cell(40,8,'Sudah Terima dari :' ,0,0, 'L');
		$c_pdf->Cell(55,8, $data[0]->nama ,0,0, 'L');

		$c_pdf->Cell(14,8,'Type: ',0,0,'L');
		$c_pdf->Cell(20,8, $data[0]->type ,0,0,'L');
		$c_pdf->Cell(14,8,'Blok:',0,0,'L');
		$c_pdf->Cell(20,8, $data[0]->IDBlok,0,1,'L'); 

		$c_pdf->Cell(10);
        $c_pdf->Cell(40,8, 'Terbilang                :',0,0, 'L');
        $c_pdf->Cell(40,8, $yng,0,1, 'L');
        
		$c_pdf->Cell(10);
        $c_pdf->Cell(40,8, 'Untuk Pembayaran:',0,0, 'L');
        $c_pdf->Cell(40,8, 'IURAN MANAGEMENT ESTATE',0,1, 'L');

		$c_pdf->Cell(50);
		$c_pdf->Cell(16,8, 'Bulan :',0,0, 'L');
		$c_pdf->Cell(40,8, $caca ,0,1, 'L');

		$c_pdf->Cell(50);
        $c_pdf->Cell(10,8, $jml ,0,0, 'L');
		$c_pdf->Cell(28,8, 'bulan   x  Rp.',0,0, 'L');
		$c_pdf->Cell(40,8, $bulannya[0]->Harga ,0,1, 'L');

		$c_pdf->Cell(10);
        $c_pdf->Cell(48,8, 'Jumlah Rupiah       : Rp.',0,0, 'L');
		$c_pdf->Cell(40,8, $data[0]->total_awal ,0,1, 'L');
		    
		$c_pdf->Cell(10,10, '', 0,1);
        $c_pdf->Cell(10);
        $c_pdf->SetFont('Arial', '', '12');
		$c_pdf->Cell(115,7, 'Yang Menyerahkan,',0,0, 'L');
		$c_pdf->Cell(80,7, 'Surabaya, '.$dt->format('Y-m-d'),0,1, 'L');
		
        $c_pdf->SetFont('Arial','','10');
		$c_pdf->Cell(10);       
        $c_pdf->Cell(140,5, 'Penerima,',0,0, 'R');
        $c_pdf->Cell(10,10,'',0,1);
        $c_pdf->Cell(10);
    
        $c_pdf->Cell(10,15,'',0,1);
        $c_pdf->Cell(10);
        $c_pdf->SetFont('Arial','','12');
		$c_pdf->Cell(115,5, '('.$data[0]->nama_user.')',0,0); 
		$c_pdf->Cell(100,5, '('.$data[0]->nama.')',0,0);
		   
		$caca = "";
		$nilai = "";
		
		$c_pdf->Output();
		
    }


	//mencetak kuintansi pdf tagihan pembayaran dengan diskon
	public function cetak_pdf_diskon(){
		$no = 1;
		$username = $this->get_cookie_decrypt("idcetak");
		$data = $this->TagihanModel->kuintansi($username);
		$bulannya = $this->TagihanModel->jmlbln($username);
		$dt = new DateTime(null, new DateTimeZone('Asia/Jakarta')); 
		$c_pdf = $this->pdf->getInstance();
		$jml = 0;
		$caca = "";
		$nilai = "";

		foreach($bulannya as $item) {
			$caca = $caca.$bulannya[$jml]->bulan. ", ";
			$nilai = $nilai.$bulannya[$jml]->Harga. ", ";
			$jml = $jml + 1;
		}

		$yng = $this->terbilang($data[0]->total_setelah_diskon);

        $c_pdf = new FPDF('P', 'mm', 'A4');
        $c_pdf->AddPage();
        $c_pdf->header('Arial');
        $c_pdf->setTopMargin(15);
        $c_pdf->setLeftMargin(12);
        $c_pdf->Cell(10);
        $c_pdf->SetFont('Arial','', 15);
        $c_pdf->Cell(75,10,'MANAGEMENT STATE', 0,1, 'C');
        $c_pdf->SetFont('Arial', 'B', 17);
        $c_pdf->Cell(10);
		$c_pdf->Cell(190,7, 'PURI SAFIRA RESIDENCE', 0,1,'L');
        $c_pdf->SetFont('Arial', 'B', 8);
        $c_pdf->Cell(10);
		$c_pdf->Cell(75,5, 'Jl. Raya Darmo No.75-77, Surabaya',0,0, 'C');
		$c_pdf->SetFont('Arial', 'U',25);
		$c_pdf->Cell(30);
		$c_pdf->Cell(120,5, 'Tanda Terima',0,1, 'L');
		$c_pdf->SetFont('Arial', 'B',7);
		$c_pdf->Cell(10);
		$c_pdf->Cell(75,4, 'Telp. (031) 5666615, 5666616',0,1, 'C');
	   		
		$c_pdf->Line(15, 40, 220-25, 40);
        $c_pdf->Line(15, 40, 220-25, 40);
        $c_pdf->Line(15, 40, 220-25, 40);

        $c_pdf->Cell(10,8, '', 0,1);
        $c_pdf->Cell(10);
        $c_pdf->SetFont('Arial', '', 12);
        $c_pdf->Cell(40,8,'Sudah Terima dari :' ,0,0, 'L');
		$c_pdf->Cell(55,8, $data[0]->nama ,0,0, 'L');

		$c_pdf->Cell(14,8,'Type: ',0,0,'L');
		$c_pdf->Cell(20,8, $data[0]->type ,0,0,'L');
		$c_pdf->Cell(14,8,'Blok:',0,0,'L');
		$c_pdf->Cell(20,8, $data[0]->IDBlok,0,1,'L'); 

		$c_pdf->Cell(10);
        $c_pdf->Cell(40,8, 'Terbilang                :',0,0, 'L');
        $c_pdf->Cell(40,8, $yng,0,1, 'L');
        
		$c_pdf->Cell(10);
        $c_pdf->Cell(40,8, 'Untuk Pembayaran:',0,0, 'L');
        $c_pdf->Cell(40,8, 'IURAN MANAGEMENT ESTATE',0,1, 'L');

		$c_pdf->Cell(50);
		$c_pdf->Cell(16,8, 'Bulan :',0,0, 'L');
		$c_pdf->Cell(40,8, $caca ,0,1, 'L');

		$c_pdf->Cell(50);
        $c_pdf->Cell(10,8, $jml ,0,0, 'L');
		$c_pdf->Cell(28,8, 'bulan   x  Rp.',0,0, 'L');
		$c_pdf->Cell(40,8, $bulannya[0]->Harga ,0,1, 'L');

		$c_pdf->Cell(10);
        $c_pdf->Cell(48,8, 'Total diskon            : Rp.',0,0, 'L');
		$c_pdf->Cell(40,8, $data[0]->diskon ,0,1, 'L');

		$c_pdf->Cell(10);
        $c_pdf->Cell(48,8, 'Jumlah Rupiah       : Rp.',0,0, 'L');
		$c_pdf->Cell(40,8, $data[0]->total_setelah_diskon ,0,1, 'L');	
        
		$c_pdf->Cell(10,10, '', 0,1);
        $c_pdf->Cell(10);
        $c_pdf->SetFont('Arial', '', '12');
		$c_pdf->Cell(115,7, 'Yang Menyerahkan,',0,0, 'L');
		$c_pdf->Cell(80,7, 'Surabaya, '.$dt->format('Y-m-d'),0,1, 'L');
		
        $c_pdf->SetFont('Arial','','10');
		$c_pdf->Cell(10);       
        $c_pdf->Cell(140,5, 'Penerima,',0,0, 'R');
        $c_pdf->Cell(10,10,'',0,1);
        $c_pdf->Cell(10);
    
        $c_pdf->Cell(10,15,'',0,1);
        $c_pdf->Cell(10);
        $c_pdf->SetFont('Arial','','12');
		$c_pdf->Cell(115,5, '('.$data[0]->nama_user.')',0,0); 
		$c_pdf->Cell(100,5, '('.$data[0]->nama.')',0,0);
		   
		$caca = "";
		$nilai = "";


		////////////////////////////////////
		// $c_pdf->Line(0, 150, 220-25, 150);
        // $c_pdf->Line(0, 150, 220-25, 150);
        // $c_pdf->Line(0, 150, 220-25, 150);
		

        // $c_pdf->SetFont('Arial','', 15);
        // $c_pdf->Cell(75,20,'MANAGEMENT STATE', 0,1, 'C');
        // $c_pdf->SetFont('Arial', 'B', 17);
        // $c_pdf->Cell(10);
		// $c_pdf->Cell(190,7, 'PURI SAFIRA RESIDENCE', 0,1,'L');
        // $c_pdf->SetFont('Arial', 'B', 8);
        // $c_pdf->Cell(10);
		// $c_pdf->Cell(75,5, 'Jl. Raya Darmo No.75-77, Surabaya',0,0, 'C');
		// $c_pdf->SetFont('Arial', 'U',25);
		// $c_pdf->Cell(30);
		// $c_pdf->Cell(120,5, 'Tanda Terima',0,1, 'L');
		// $c_pdf->SetFont('Arial', 'B',7);
		// $c_pdf->Cell(10);
		// $c_pdf->Cell(75,4, 'Telp. (031) 5666615, 5666616',0,1, 'C');

		// $c_pdf->Line(15, 173, 220-25, 173);
        // $c_pdf->Line(15, 173, 220-25, 173);
        // $c_pdf->Line(15, 173, 220-25, 173);

        // $c_pdf->Cell(10,8, '', 0,1);
        // $c_pdf->Cell(10);
        // $c_pdf->SetFont('Arial', '', 12);
        // $c_pdf->Cell(40,8,'Sudah Terima dari :' ,0,0, 'L');
		// // foreach ($data as $item){
		// 	$c_pdf->Cell(55,8, $data[0]->nama ,0,0, 'L');
		// // }
		

		// $c_pdf->Cell(14,8,'Type: ',0,0,'L');
		// $c_pdf->Cell(20,8, $data[0]->type ,0,0,'L');
		// $c_pdf->Cell(14,8,'Blok:',0,0,'L');
		// $c_pdf->Cell(20,8, $data[0]->IDBlok,0,1,'L'); 

		// $c_pdf->Cell(10);
        // $c_pdf->Cell(40,8, 'Terbilang                :',0,0, 'L');
        // $c_pdf->Cell(40,8, 'lalala',0,1, 'L');
        
		// $c_pdf->Cell(10);
        // $c_pdf->Cell(40,8, 'Untuk Pembayaran:',0,0, 'L');
        // $c_pdf->Cell(40,8, 'IURAN MANAGEMENT ESTATE',0,1, 'L');

		// $c_pdf->Cell(50);
        // $c_pdf->Cell(16,8, 'Bulan :',0,0, 'L');
        // $c_pdf->Cell(40,8, 'lalala',0,1, 'L');

		// $c_pdf->Cell(50);
        // $c_pdf->Cell(16,8, $jml ,0,0, 'L');
        // $c_pdf->Cell(28,8, 'bulan   x  Rp.',0,0, 'L');
		// $c_pdf->Cell(40,8, $data[0]->total_setelah_diskon ,0,1, 'L');

		// $c_pdf->Cell(10);
        // $c_pdf->Cell(48,8, 'Jumlah Rupiah       : Rp.',0,0, 'L');
		// $c_pdf->Cell(40,8, '899999',0,1, 'L');
		
        
		// $c_pdf->Cell(10,10, '', 0,1);
        // $c_pdf->Cell(10);
        // $c_pdf->SetFont('Arial', '', '12');
		// $c_pdf->Cell(115,7, 'Yang Menyerahkan,',0,0, 'L');
		// $c_pdf->Cell(80,7, 'Surabaya, '.$dt->format('Y-m-d'),0,1, 'L');
		
        // $c_pdf->SetFont('Arial','','10');
		// $c_pdf->Cell(10);       
        // $c_pdf->Cell(140,5, 'Penerima,',0,0, 'R');
        // $c_pdf->Cell(10,10,'',0,1);
        // $c_pdf->Cell(10);
    
        // $c_pdf->Cell(10,15,'',0,1);
        // $c_pdf->Cell(10);
        // $c_pdf->SetFont('Arial','','12');
		// $c_pdf->Cell(115,5, '('.$data[0]->nama_user.')',0,0); 
		// $c_pdf->Cell(100,5, '('.$data[0]->nama.')',0,0);
          
		$c_pdf->Output();
		
    }
	
}
