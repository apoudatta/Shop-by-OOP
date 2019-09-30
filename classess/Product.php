<?php
	$filepath = realpath(dirname(__FILE__));
  	include_once($filepath.'/../lib/Database.php');
  	include_once($filepath.'/../helpers/Format.php');
?>

<?php

class Product
{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function productInsert($data, $file){
		$productName = $this->fm->validation($data['productName']);
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId 		 = $this->fm->validation($data['catId']);
		$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId 	 = $this->fm->validation($data['brandId']);
		$brandId 	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body 	 	 = $this->fm->validation($data['body']);
		$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
		$price 		 = $this->fm->validation($data['price']);
		$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		 = $this->fm->validation($data['type']);
		$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);

		$permited  = array('jpg','jpeg','png','gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "upload/".$unique_image;

		if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" ) {
			$mgs = "<span class='error'>Product fild must not be empty! </span>";
			return $mgs;
		}
		elseif ($file_size > 1048567) {
			echo "<span class='error'>Image Size should be less then 1MB! </span>";
		}
		elseif (in_array($file_ext, $permited) === false) {
			echo "<span class='error'>You can uplode only:-".implode(',', $permited)."</span>";
		}
		else{
			move_uploaded_file($file_temp,$uploaded_image);
			$query = "INSERT INTO tbl_product(`productName`,`catId`,`brandId`,`body`,`price`,`image`,`type`) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
			$Insert_row = $this->db->insert($query);
			if ($Insert_row) {
				$mgs = "<span class='success'>Product Inserted Successfully.</span>";
				return $mgs;
			}else{
				$mgs = "<span class='error'>Product Not Inserted.</span>";
				return $mgs;
			}
		}
	}

	public function getAllProduct(){
		$query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
				FROM tbl_product
				INNER JOIN tbl_category
				ON tbl_product.catId = tbl_category.catId
				INNER JOIN tbl_brand
				ON tbl_product.brandId = tbl_brand.brandId
				ORDER BY tbl_product.productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getPdtById($id){
		$query = "SELECT * FROM `tbl_product` WHERE `productId` = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function productUpdate($data, $file, $id){
		$productName = $this->fm->validation($data['productName']);
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId 		 = $this->fm->validation($data['catId']);
		$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId 	 = $this->fm->validation($data['brandId']);
		$brandId 	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body 	 	 = $this->fm->validation($data['body']);
		$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
		$price 		 = $this->fm->validation($data['price']);
		$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		 = $this->fm->validation($data['type']);
		$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);

		$permited  = array('jpg','jpeg','png','gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "upload/".$unique_image;

		if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" ) {
			$mgs = "<span class='error'>Product fild must not be empty! </span>";
			return $mgs;
		} else {
			if (!empty($file_name)) {
			
				if ($file_size > 1048567) {
					echo "<span class='error'>Image Size should be less then 1MB! </span>";
				}
				elseif (in_array($file_ext, $permited) === false) {
					echo "<span class='error'>You can uplode only:-".implode(',', $permited)."</span>";
				}
				else{
					move_uploaded_file($file_temp,$uploaded_image);
					
					$query = "UPDATE tbl_product
								SET
								productName = '$productName',
								catId = '$catId',
								brandId = '$brandId',
								body = '$body',
								price = '$price',
								image = '$uploaded_image',
								type = '$type'
								WHERE productId = '$id'
							";

					$update_row = $this->db->update($query);
					if ($update_row) {
						$mgs = "<span class='success'>Product Update Successfully.</span>";
						return $mgs;
					}else{
						$mgs = "<span class='error'>Product Not Updated.</span>";
						return $mgs;
					}
				}
			} else {
				
				$query = "UPDATE tbl_product
							SET
							productName = '$productName',
							catId = '$catId',
							brandId = '$brandId',
							body = '$body',
							price = '$price',
							type = '$type'
							WHERE productId = '$id'
						";

				$update_row = $this->db->update($query);
				if ($update_row) {
					$mgs = "<span class='success'>Product Update Successfully.</span>";
					return $mgs;
				}else{
					$mgs = "<span class='error'>Product Not Updated.</span>";
					return $mgs;
				}
			}
		}
	}

	public function delPdtById($id){
		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$getData = $this->db->select($query);

		if ($getData) {
			while ($delImg = $getData->fetch_assoc()) {
				$dellink = $delImg['image'];
				unlink($dellink);
			}
		}

		$delquery = "DELETE FROM tbl_product WHERE productId = '$id'";
		$delData = $this->db->delete($delquery);

		if ($delData) {
			$mgs = "<span class='success'>Brand Delete Successfully.</span>";
			return $mgs;
		}else{
			$mgs = "<span class='error'>Brand Not Delete.</span>"; 
			return $mgs;
		}
	}

	public function getFeaturePdt(){
		$query = "SELECT * FROM `tbl_product` WHERE type = '1' ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	public function getNewPdt(){
		$query = "SELECT * FROM `tbl_product` ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	public function getSingleProduct($id){
		$query = "SELECT p.*, c.catName, b.brandName
					FROM tbl_product as p, tbl_category as c, tbl_brand as b
					WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function latestFromIphone() {
		$query = "SELECT * FROM `tbl_product` WHERE `brandId`='2' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	public function latestFromSamsung() {
		$query = "SELECT * FROM `tbl_product` WHERE `brandId`='3' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	public function latestFromAcer() {
		$query = "SELECT * FROM `tbl_product` WHERE `brandId`='1' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	public function latestFromCanon() {
		$query = "SELECT * FROM `tbl_product` WHERE `brandId`='4' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	public function productByCat($id) {
		$id 	= mysqli_real_escape_string($this->db->link, $id);
		$query = "SELECT * FROM `tbl_product` WHERE `catId` = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
}

?>