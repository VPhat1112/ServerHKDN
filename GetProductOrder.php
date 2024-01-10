<?php
	include "connect.php";
    $id_order=$_GET['id_order'];
    
	$query = "SELECT p.id as product_id,quantity,p.product_name as product_name,p.product_image as product_image,p.product_price as product_price,otd.Product_TotalPay as product_totalpay
    From order_detail as otd, product as p where otd.id_product=p.id and otd.id_order='$id_order'
    GROUP BY p.id,otd.id_order,quantity,p.product_name,p.product_image,p.product_price,otd.Product_TotalPay";
	$data = mysqli_query($conn,$query);
	$product = array();
	while ($row = mysqli_fetch_assoc($data)) {
		array_push($product,new Product(
			$row['product_id'],
			$row['quantity'],
			$row['product_name'],
            $row['product_image'],
            $row['product_price'],
            $row['product_totalpay'],
        ));
	}
	echo json_encode($product);
	class Product{
        public $product_id;
	    public $quantity;
	    public $product_name;
        public $product_image;
        public $product_price;
        public $product_totalpay;
		
		function __construct($product_id,$quantity,$product_name,$product_image,$product_price,$product_totalpay){
			$this->product_id =  $product_id;
			$this->quantity =  $quantity;
			$this->product_name =  $product_name;
            $this->product_image = $product_image;
            $this->product_price = $product_price;
            $this->product_totalpay = $product_totalpay;
		}
	}
?>