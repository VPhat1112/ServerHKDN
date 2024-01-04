<?php
    include("connect.php");
    if(!empty($_POST['image'])){
        $images='image/' . date("d-m-y").'-'.time().'-'.rand(10000,100000).'.jpg';
        if(file_put_contents($images, base64_decode($_POST['image']))){
            $sql="INSERT INTO images(path) VALUES ('$images')";
            if(mysqli_query($conn, $sql)){
                echo 'success';
            }
            else{echo 'Faild to upload images to database';}
        }else echo 'Faild to upload images';
    }else echo 'NO IMAGE FOUND';
?>
