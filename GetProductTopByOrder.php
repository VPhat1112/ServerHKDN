<?php
	include "connect.php";
    $order_id=$_GET['order_id'];
	$query = "select otd.quantity,otd.product_price, otd.Product_TotalPay, p.product_name, p.product_image
    from tbl_order as o, order_detail as otd, product as p
    where o.id = otd.id_order
        and p.id = otd.id_product
		and o.id='$order_id'
    order by otd.id
    Limit 1";

	$data = mysqli_query($conn,$query);
	$Order = array();

	while ($row = mysqli_fetch_assoc($data)) {
		array_push($Order,new Order(
			$row['quantity'],
			$row['Product_TotalPay'],
			$row['product_name'],
			$row['product_image'],
			$row['product_price'],
        ));
	}
	echo json_encode($Order);
	class Order{
        
        public $quantity;
        public $Product_TotalPay;
		public $product_name;
	    public $product_image;
		public $product_price;
		

		function __construct($quantity,$Product_TotalPay,$product_name,$product_image,$product_price){
			$this->quantity =  $quantity;
			$this->Product_TotalPay =  $Product_TotalPay;
			$this->product_name = $product_name;
			$this->product_image =  $product_image;
			$this->product_price =  $product_price;
		}

	}