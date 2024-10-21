<?php

require("connection.php");



if(isset($_POST['btn']))
{
    $prodName = $_POST['prodName'];
    $prodPrice = $_POST['prodPrice'];
    $prodDesc = $_POST['prodDesc'];
    $prodImage = $_FILES['prodImage']['name'];
    $tempName = $_FILES['prodImage']['tmp_name'];

    $extension = explode('.', $prodImage);
    $newName = uniqid() . '.'. $extension[1];

    move_uploaded_file($tempName, "images/$newName");

    $sql = "INSERT INTO `products`(`prod_name`, `prod_price`, `prod_desc`, `prod_image`) VALUES ('$prodName','$prodPrice','$prodDesc','$newName')";

    $result = mysqli_query($conn,$sql);

    if(!$result)
    {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
    else{
        echo "New record created successfully";
    }

  
}







?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
       Product Name: <input type="text" name="prodName"> <br>
       Product Price: <input type="text" name="prodPrice"> <br>
       Product Description: <input type="text" name="prodDesc"> <br>
       Product Image: <input type="file" name="prodImage"> <br>
       <input type="submit" value="Submit" name="btn">
    </form>
</body>
</html>