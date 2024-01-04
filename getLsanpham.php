<?php
	include "connect.php";
	$query = "SELECT * FROM category";
	$data = mysqli_query($conn,$query);
	$loaisanpham = array();
	while ($row = mysqli_fetch_assoc($data)) {
		array_push($loaisanpham,new LoaiSP(
			$row['id'],
			$row['category_name'],
			$row['category_image'],
			$row['CreatedAt'],
			$row['UpdateAt'],
		));
	}
	echo json_encode($loaisanpham);
	class LoaiSP{
        public $id;
	    public $category_name;
	    public $category_image;
		public $CreatedAt;
		public $UpdateAt;
		function __construct($id,$category_name,$category_image,$CreatedAt,$UpdateAt){
			$this->id =  $id;
			$this->category_name =  $category_name;
			$this->category_image =  $category_image;
			$this->CreatedAt=$CreatedAt;
			$this->UpdateAt=$UpdateAt;
		}
	}
?>