<?php
    $conn = mysqli_connect("localhost", "root", "123456", "hkdng5");
    mysqli_query($conn, "SET NAME '.utf8.'");
    // if ($conn) {
    //     echo "Kết nối thành công";
    // } else {
    //     echo "Kết nối thất bại";
    // }
?>