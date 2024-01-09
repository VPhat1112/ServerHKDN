<?php
    include "connect.php";
	$key = $_GET['search'];

	$queryCategory = "select p.* from product as p inner join category as c on p.category_id = c.id and c.category_name = '$key' Order BY ID DESC";
	$dataCategory = mysqli_query($conn, $queryCategory);

    $queryProduct = "SELECT * FROM hkdng5.product where product_name like '%$key%' Order BY ID DESC";
    $dataProduct = mysqli_query($conn,$queryProduct);
    $product = array();
	
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
			$this->status = $status;
		}
	}

	if(mysqli_num_rows($dataCategory) > 0){
		while ($row = mysqli_fetch_assoc($dataCategory)) {
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
				$row['status']
			));
		}
		echo json_encode($product);
	} else if(mysqli_num_rows($dataProduct) > 0){
		while ($row = mysqli_fetch_assoc($dataProduct)) {
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
				$row['status']
			));
		}
		echo json_encode($product);
	} else {
		echo "Error";
	}

	mysqli_close($conn);
?>