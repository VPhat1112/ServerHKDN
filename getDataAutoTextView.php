<?php
    include "connect.php";
    $queryCategory = "SELECT category_name FROM hkdng5.category";
    $dataCategory = mysqli_query($conn,$queryCategory);

    $queryShop = "SELECT shop_name FROM hkdng5.shops";
    $dataqueryShop = mysqli_query($conn,$queryShop);

    $queryProduct = "SELECT product_name FROM hkdng5.product";
    $dataProduct = mysqli_query($conn,$queryProduct);

    $response = array();

    class AutoTextViewData{
        public $name;
        function __construct($name){
            $this->name = $name;
        }
    }

    while ($row = mysqli_fetch_assoc($dataCategory)){
        array_push($response,new AutoTextViewData(
            $row['category_name']
        ));
    }

    while($row = mysqli_fetch_assoc($dataqueryShop)){
        array_push($response,new AutoTextViewData(
            $row['shop_name']
        ));
    }

    while ($row = mysqli_fetch_assoc($dataProduct)){
        array_push($response,new AutoTextViewData(
            $row['product_name']
        ));
    }

    echo json_encode($response);
 
    mysqli_close($conn);
?>