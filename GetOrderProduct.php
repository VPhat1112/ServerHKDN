<?php
	include "connect.php";
    $order_ids=$_GET['order_ids'];
	$query = "SELECT quantity,p.product_name as product_name,p.product_image as product_image,p.product_price as product_price,otd.Product_TotalPay as TotalPay
	From order_detail as otd, product as p 
	where otd.id_product=p.id and otd.id_order='$order_ids'
	GROUP BY otd.id_order,quantity,p.product_name,p.product_image,p.product_price,otd.Product_TotalPay";
	$data = mysqli_query($conn,$query);
	$OrderPRoduct = array();
	
	while ($row = mysqli_fetch_assoc($data)) {
		array_push($OrderPRoduct,new OrderProduct(
			$row['quantity'],
			$row['product_name'],
			$row['product_image'],
            $row['product_price'],
            $row['TotalPay'],
        ));
	}
	echo json_encode($OrderPRoduct);
	class OrderProduct{
        
        public $quantity;
        public $product_name;
	    public $product_image;
        public $product_price;
        public $TotalPay;

		function __construct($quantity,$product_name,$product_image,$product_price,$TotalPay){
			$this->quantity =  $quantity;
			$this->product_name =  $product_name;
			$this->product_image =  $product_image;
            $this->product_price = $product_price;
            $this->TotalPay = $TotalPay;
		}

	}
?>