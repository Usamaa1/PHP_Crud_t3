<?php


    try {
        $conn = mysqli_connect("localhost", "root","","products");
    } catch (Exception $e) {
        echo "Connection failed: ". $e->getMessage();
    }

?>