<?php
    include "connect.php";

    $id_product = $_GET["id_product"];

    $query = "SELECT tbl_product_evaluate.id,id_product,Name,Comment,Rating FROM tbl_product_evaluate,users where tbl_product_evaluate.id_user=users.id and id_product='$id_product'";
	$data = mysqli_query($conn,$query);
	$Rating_ar = array();
	while ($row = mysqli_fetch_assoc($data)) {
		array_push($Rating_ar,new Rating(
			$row['id'],
			$row['id_product'],
			$row['Name'],
            $row['Comment'],
            $row['Rating'],
		));
	}
    echo json_encode($Rating_ar);
 
    class Rating{
        public $id;
	    public $id_product;
	    public $Name;
        public $Comment;
        public $Rating;
		function __construct($id,$id_product,$Name,$Comment,$Rating){
			$this->id =  $id;
			$this->id_product =  $id_product;
			$this->Name =  $Name;
            $this->Comment=$Comment;
            $this->Rating=$Rating;
		}
	}

?>