<?php
	$filepath = realpath(dirname(__FILE__));
  	include_once($filepath.'/../lib/Database.php');
  	include_once($filepath.'/../helpers/Format.php');
?>

<?php

class Customer{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function customerRegistration($data) {
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$zipCode = mysqli_real_escape_string($this->db->link, $data['zipCode']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

		if ($name == "" || $address == "" || $city == "" || $country == "" || $zipCode == "" || $phone == "" || $email == "" || $password == "" ) {
			$mgs = "<span class='error'>Product fild must not be empty! </span>";
			return $mgs;
		}
		$mailQuery = "SELECT * FROM `tbl_customer` WHERE `email`='$email' limit 1";
		$mailChk   = $this->db->select($mailQuery);
		if ($mailChk) {
			$mgs = "<span class='error'>Email already Exist ! </span>";
			return $mgs;
		} else {
			$query = "INSERT INTO tbl_customer(`name`,`address`,`city`,`country`,`zip`,`phone`,`email`,`password`)
					VALUES('$name','$address','$city','$country','$zipCode','$phone','$email','$password')";
			$Insert_row = $this->db->insert($query);
			if ($Insert_row) {
				$mgs = "<span class='success'>Customer data Inserted Successfully.</span>";
				return $mgs;
			}else{
				$mgs = "<span class='error'>Customer data Not Inserted.</span>";
				return $mgs;
			}
		}
	}

	public function customerLogin($data) {
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
		//$email = $this->fm->validation($data['email']);
		//$password = $this->fm->validation(md5($data['password']));

		if (empty($email) || empty($password)) {
			$mgs = "<span class='error'>Field must not be empty !</span>";
			return $mgs;
		} else {
			$query = "SELECT * FROM `tbl_customer` WHERE `email` = '$email' AND `password` = '$password'";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("cmrLogin", true);
				Session::set("cmrId", $value['id']);
				Session::set("cmrName", $value['name']);
				header("Location:order.php");
			}else{
				$mgs = "<span class='error'>Email or Password Not matched !</span>";
				return $mgs;
			}
		}
	}

	public function getCustomerData($id) {
		$query = "SELECT * FROM `tbl_customer` WHERE `id` = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function customerupdate($data, $cmrId) {

		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$zip = mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);

		if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" ) {
			$mgs = "<span class='error'>Product fild must not be empty! </span>";
			return $mgs;

		}else {

			$query = "UPDATE tbl_customer
						SET 
						`name`='$name',
						`address`='$address',
						`city`='$city',
						`country`='$country',
						`zip`='$zip',
						`phone`='$phone',
						`email`='$email' 
						WHERE `id`='$cmrId'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$mgs = "<span class='success'>Customer Data Update Successfully.</span>";
				return $mgs;
			}else{
				$mgs = "<span class='error'>Customer Data Not Update.</span>";
				return $mgs;
			}
		}
	}


}

?>