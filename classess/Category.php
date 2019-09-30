<?php
	$filepath = realpath(dirname(__FILE__));
  	include_once($filepath.'/../lib/Database.php');
  	include_once($filepath.'/../helpers/Format.php');
?>

<?php

class Category
{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function catInsert($catName){
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		if (empty($catName)){
			$mgs = "<span class='error'>Cetagory fild must not be empty! </span>";
			return $mgs;
		}else{
			$query = "INSERT INTO tbl_category(`catName`) VALUES('$catName')";
			$catInsert = $this->db->insert($query);
			if ($catInsert) {
				$mgs = "<span class='success'>Category Inserted Successfully.</span>";
				return $mgs;
			}else{
				$mgs = "<span class='error'>Category Not Inserted.</span>";
				return $mgs;
			}
		}
	}

	public function getAllCat(){
		$query = "SELECT * FROM `tbl_category` ORDER BY catId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getCatById($id){
		$query = "SELECT * FROM `tbl_category` WHERE `catId` = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function catUpdate($catName,$id){
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$catId   = mysqli_real_escape_string($this->db->link, $id);
		if (empty($catName)){
			$mgs = "<span class='error'>Cetagory fild must not be empty! </span>";
			return $mgs;
		}else{
			$query = "UPDATE tbl_category SET `catName`='$catName' WHERE `catId`='$id'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$mgs = "<span class='success'>Category Update Successfully.</span>";
				return $mgs;
			}else{
				$mgs = "<span class='error'>Category Not Update.</span>";
				return $mgs;
			}
		}
	}

	public function delCatById($id){
		$query = "DELETE FROM tbl_category WHERE `catId`='$id'";
		$delData = $this->db->delete($query);
		if ($delData) {
				$mgs = "<span class='success'>Category Delete Successfully.</span>";
				return $mgs;
			}else{
				$mgs = "<span class='error'>Category Not Delete.</span>";
				return $mgs;
			}
	}
}
?>