<?php
	include "connect.php";
    $id_shop=$_GET['id_shop'];
	$query = "SELECT users.id as user_id,shops.id as shop_id, tbl_order.id as order_id,contact_buy.id as contact_id,product.id as product_id,FinalTotal,Order_status,Number_pay,product_name,product_image 
    FROM tbl_order , order_detail , contact_buy , product ,users,shops
    where tbl_order.id=order_detail.id 
    and order_detail.contact_id=contact_buy.id 
    and order_detail.product_id=product.id
    and contact_buy.buyer_id=users.id
    and contact_buy.shop_id=shops.id and tbl_order.Order_status='0' and shops.id='$id_shop';";
	$data = mysqli_query($conn,$query);
	$Order = array();
	while ($row = mysqli_fetch_assoc($data)) {
		array_push($Order,new Order(
			$row['user_id'],
			$row['shop_id'],
			$row['order_id'],
            $row['contact_id'],
            $row['product_id'],
            $row['FinalTotal'],
			$row['Order_status'],
			$row['Number_pay'],
			$row['product_name'],
            $row['product_image'],
        ));
	}
	echo json_encode($Order);
	class Order{
        
        public $user_id;
        public $shop_id;
	    public $order_id;
	    public $contact_id;
        public $product_id;
        public $FinalTotal;
        public $Order_status;
		public $Number_pay;
		public $product_name;
        public $product_image;

		function __construct($user_id,$shop_id,$order_id,$contact_id,$product_id,$FinalTotal,$Order_status,$Number_pay,$product_name,$product_image){
			$this->user_id =  $user_id;
			$this->shop_id =  $shop_id;
			$this->order_id =  $order_id;
            $this->contact_id = $contact_id;
            $this->product_id = $product_id;
            $this->FinalTotal = $FinalTotal;
			$this->Order_status = $Order_status;
			$this->Number_pay = $Number_pay;
			$this->product_name = $product_name;
			$this->product_image = $product_image;
		}

	}
?>