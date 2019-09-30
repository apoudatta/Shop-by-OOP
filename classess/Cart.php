<?php
	$filepath = realpath(dirname(__FILE__));
  	include_once($filepath.'/../lib/Database.php');
  	include_once($filepath.'/../helpers/Format.php');
?>

<?php

class Cart{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function addToCart($quantity,$id){
		$quantity  = $this->fm->validation($quantity);
		$quantity  = mysqli_real_escape_string($this->db->link, $quantity);
		$productId = mysqli_real_escape_string($this->db->link, $id);
		$ssnId	   = session_id();

		$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		$result = $this->db->select($query)->fetch_assoc();

		$productName = $result['productName'];
		$price = $result['price'];
		$image = $result['image'];

		$checkSmePdt = "SELECT * FROM `tbl_cart` WHERE `ssnId`='$ssnId' AND `productId`='$productId'";
		$getSmePdt = $this->db->select($checkSmePdt);
		if ($getSmePdt) {
			$mgs = "Product already Added !";
			return $mgs;
		} else {
			$query = "INSERT INTO tbl_cart(`ssnId`,`productId`,`productName`,`price`,`quantity`,`image`) 
					VALUES('$ssnId','$productId','$productName','$price','$quantity','$image')";

			$Insert_row = $this->db->insert($query);
			if ($Insert_row) {
				header("Location:cart.php");
			}else{ 
				header("Location:404.php");
			}
		}
	}

	public function getCartProduct(){
		$ssnId = session_id();
		$query = "SELECT * FROM `tbl_cart` WHERE `ssnId` = '$ssnId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function updateCartQuantity($cartId,$quantity) {
		$cartId = $this->fm->validation($cartId);
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);
		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);

		$query = "UPDATE tbl_cart SET `quantity`='$quantity' WHERE `cartId`='$cartId'";
		$updated_row = $this->db->update($query);
		if ($updated_row) {
			header("Location:cart.php");
		}else{
			$mgs = "<span class='error'>Quantity Not Update.</span>";
			return $mgs;
		}
	}

	public function delCrtPdt($delCrtId) {
		$delCrtId  = mysqli_real_escape_string($this->db->link, $delCrtId);
		$query = "DELETE FROM tbl_cart WHERE `cartId`='$delCrtId'";
		$delData = $this->db->delete($query);
		if ($delData) {
			header("Location:cart.php");	
		}else{
			$mgs = "<span class='error'>Product Not Deleted.</span>";
			return $mgs;
		}
	}

	public function checkCartTable() {
		$ssnId = session_id();
		$query = "SELECT * FROM `tbl_cart` WHERE `ssnId` = '$ssnId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function delCustomerCart() {
		$ssnId = session_id();
		$query = "DELETE FROM `tbl_cart` WHERE `ssnId` = '$ssnId'";
		$result = $this->db->delete($query);
	}

	public function orderProduct($cmrId) {
		$ssnId = session_id();
		$query = "SELECT * FROM `tbl_cart` WHERE `ssnId` = '$ssnId'";
		$getPro = $this->db->select($query);
		if ($getPro) {
			while ($result = $getPro->fetch_assoc()) {
				$productId = $result['productId'];
				$productName = $result['productName'];
				$quantity = $result['quantity'];
				$price = $result['price'];
				$image = $result['image'];
			$query = "INSERT INTO tbl_order(`cmrid`,`productId`,`productName`,`quantity`,`price`,`image`) 
					VALUES('$cmrId','$productId','$productName','$quantity','$price','$image')";
			$Insert_row = $this->db->insert($query);
			}
		}
	}

	public function payableAmount($cmrId){
		$query = "SELECT price FROM `tbl_order` WHERE `cmrId` = '$cmrId' AND date = now()";
		$result = $this->db->select($query);
		return $result;
	}
}

?>