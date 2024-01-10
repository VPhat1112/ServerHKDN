<?php
	include "connect.php";
    $id_user=$_GET['id_user'];
	$query = "SELECT o.*, s.shop_name as shop_name, s.Image_shop as Image_shop,u.Name as user_name
	FROM tbl_order as o, shops as s,users as u
	WHERE s.id = o.id_shop
		and u.id = o.id_user
					and o.id_user = '$id_user'";

	$data = mysqli_query($conn,$query);
	$Order = array();

	while ($row = mysqli_fetch_assoc($data)) {
		array_push($Order,new Order(
			$row['id_user'],
			$row['id_shop'],
			$row['shop_name'],
			$row['id'],
            $row['Phone'],
			$row['Address_ship'],
			$row['FinalTotal'],
			$row['Order_status'],
            $row['Image_shop'],
            $row['CreatedAt'],
			$row['user_name']
        ));
	}
	echo json_encode($Order);
	class Order{
        
        public $user_id;
        public $shop_id;
		public $Shop_name;
	    public $order_id;
		public $Phone;
		public $Address_ship;
        public $FinalTotal;
        public $Order_status;
        public $shop_image;
		public $CreatedAt;
		public $user_name;
		function __construct($user_id,$shop_id,$Shop_name,$order_id,$Phone,$Address_ship,$FinalTotal,$Order_status,$shop_image,$CreatedAt,$user_name){
			$this->user_id =  $user_id;
			$this->shop_id =  $shop_id;
			$this->Shop_name = $Shop_name;
			$this->order_id =  $order_id;
			$this->Phone=$Phone;
			$this->Address_ship=$Address_ship;
            $this->FinalTotal = $FinalTotal;
			$this->Order_status = $Order_status;
			$this->shop_image = $shop_image;
			$this->CreatedAt=$CreatedAt;
			$this->user_name=$user_name;
		}

	}
?>