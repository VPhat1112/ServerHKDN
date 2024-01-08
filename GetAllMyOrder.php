<?php
	include "connect.php";
    $id_user=$_GET['id_user'];
	$query = "SELECT users.id as user_id,shops.id as shop_id,shop_name, tbl_order.id as order_id,contact_buy.id as contact_id,users.Name,tbl_order.Phone,tbl_order.Address_ship,product.id as product_id,FinalTotal,Order_status,Number_pay,product_name,product_image,tbl_order.CreatedAt
    FROM tbl_order , order_detail , contact_buy , product ,users,shops
    where tbl_order.id=order_detail.id 
    and order_detail.contact_id=contact_buy.id 
    and order_detail.product_id=product.id
    and contact_buy.buyer_id=users.id
    and contact_buy.shop_id=shops.id and users.id='$id_user';";
	$data = mysqli_query($conn,$query);
	$Order = array();
	while ($row = mysqli_fetch_assoc($data)) {
		array_push($Order,new Order(
			$row['user_id'],
			$row['shop_id'],
			$row['shop_name'],
			$row['order_id'],
            $row['contact_id'],
			$row['Name'],
			$row['Phone'],
			$row['Address_ship'],
            $row['product_id'],
            $row['FinalTotal'],
			$row['Order_status'],
			$row['Number_pay'],
			$row['product_name'],
            $row['product_image'],
			$row['CreatedAt'],
        ));
	}
	echo json_encode($Order);
	class Order{
        
        public $user_id;
        public $shop_id;
		public $Shop_name;
	    public $order_id;
	    public $contact_id;
		public $Name;
		public $Phone;
		public $Address_ship;
        public $product_id;
        public $FinalTotal;
        public $Order_status;
		public $Number_pay;
		public $product_name;
        public $product_image;
		public $CreatedAt;
		

		function __construct($user_id,$shop_id,$Shop_name,$order_id,$contact_id,$Name,$Phone,$Address_ship,$product_id,$FinalTotal,$Order_status,$Number_pay,$product_name,$product_image,$CreatedAt){
			$this->user_id =  $user_id;
			$this->shop_id =  $shop_id;
			$this->Shop_name = $Shop_name;
			$this->order_id =  $order_id;
            $this->contact_id = $contact_id;
			$this->Name=$Name;
			$this->Phone=$Phone;
			$this->Address_ship=$Address_ship;
            $this->product_id = $product_id;
            $this->FinalTotal = $FinalTotal;
			$this->Order_status = $Order_status;
			$this->Number_pay = $Number_pay;
			$this->product_name = $product_name;
			$this->product_image = $product_image;
			$this->CreatedAt=$CreatedAt;
		}

	}
?>