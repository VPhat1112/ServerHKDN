<?php
	include "connect.php";
    $id_shop=$_GET['id_shop'];
    
	$query = "SELECT id,id_shop,Voucher_name,PR,DateStart,DateEnd FROM tbl_voucher WHERE id_shop='$id_shop'";
	$data = mysqli_query($conn,$query);
	$Voucher = array();
	while ($row = mysqli_fetch_assoc($data)) {
		array_push($Voucher,new Voucher(
			$row['id'],
			$row['id_shop'],
			$row['Voucher_name'],
            $row['PR'],
            $row['DateStart'],
            $row['DateEnd'],
        ));
	}
	echo json_encode($Voucher);
	class Voucher{
        public $id;
	    public $id_shop;
	    public $Voucher_name;
        public $PR;
        public $DateStart;
        public $DateEnd;
		function __construct($id,$id_shop,$Voucher_name,$PR,$DateStart,$DateEnd){
			$this->id =  $id;
			$this->id_shop =  $id_shop;
			$this->Voucher_name =  $Voucher_name;
            $this->PR = $PR;
            $this->DateStart = $DateStart;
            $this->DateEnd = $DateEnd;
		}
	}
?>