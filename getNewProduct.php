<?php
	include "connect.php";
	$query = "SELECT * FROM product where status='1' Order BY ID";
	$data = mysqli_query($conn,$query);
	$product = array();
	while ($row = mysqli_fetch_assoc($data)) {
		array_push($product,new Product(
			$row['id'],
			$row['product_name'],
			$row['product_price'],
            $row['product_image'],
            $row['product_decs'],
            $row['category_id'],
			$row['id_shop'],
			$row['product_review'],
			$row['product_numbersell'],
			$row['product_selled'],
			$row['status'],
        ));
	}
	echo json_encode($product);
	class Product{
        public $id;
	    public $product_name;
	    public $product_price;
        public $product_image;
        public $product_decs;
        public $IDcategory;
		public $id_shop;
		public $product_review;
		public $product_numbersell;
		public $product_selled;
		public $status;

		function __construct($id,$product_name,$product_price,$product_image,$product_decs,$IDcategory,$id_shop,$product_review,$product_numbersell,$product_selled,$status){
			$this->id =  $id;
			$this->product_name =  $product_name;
			$this->product_price =  $product_price;
            $this->product_image = $product_image;
            $this->product_decs = $product_decs;
            $this->IDcategory = $IDcategory;
			$this->id_shop = $id_shop;
			$this->product_review = $product_review;
			$this->product_numbersell = $product_numbersell;
			$this->product_selled = $product_selled;
			$this->status=$status;
		}
	}
?>