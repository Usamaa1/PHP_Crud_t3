<?php

require "connection.php";

$prodId = $_GET["id"];

$sql_select = "SELECT * FROM products WHERE id = '$prodId'";
$result_data = mysqli_query($conn, $sql_select);

if (mysqli_num_rows($result_data) > 0) {
    $row = mysqli_fetch_assoc($result_data);
}

if (isset($_POST['btn'])) {
    $prodName = $_POST['prodName'];
    $prodPrice = $_POST['prodPrice'];
    $prodDesc = $_POST['prodDesc'];
    $oldImage = $_POST['oldImage'];

    // Handle image upload
    if ($_FILES['prodImage']['name']) {
        // If a new image is selected
        $prodImage = $_FILES['prodImage']['name'];
        $tempName = $_FILES['prodImage']['tmp_name'];
        $extension = explode('.', $prodImage);
        $newName = uniqid() . '.' . $extension[1];

        move_uploaded_file($tempName, "images/$newName");
    } else {
        // If no new image is selected, keep the old image
        $newName = $oldImage;
    }

    // Update query
    $sql = "UPDATE `products` SET 
        `prod_name`='$prodName',
        `prod_price`='$prodPrice',
        `prod_desc`='$prodDesc',
        `prod_image`='$newName' 
        WHERE `id` = '$prodId'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {
        echo "Record updated successfully";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <script>
        // JavaScript to preview the selected image
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
            imagePreview.onload = function () {
                URL.revokeObjectURL(imagePreview.src); // Free memory
            }
        }
    </script>
</head>
<body>
    <h1>Update Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
       Product Name: <input type="text" name="prodName" value="<?php echo $row['prod_name']; ?>"> <br>
       Product Price: <input type="text" name="prodPrice" value="<?php echo $row['prod_price']; ?>"> <br>
       Product Description: <input type="text" name="prodDesc" value="<?php echo $row['prod_desc']; ?>"> <br>
       
       <!-- Store the old image in a hidden field -->
       <input type="hidden" name="oldImage" value="<?php echo $row['prod_image']; ?>">

       <!-- Display current image -->
       <img id="imagePreview" src="images/<?php echo $row['prod_image']; ?>" alt="Product Image" width="200px"> <br>

       <!-- File input with onchange to trigger JavaScript image preview -->
       Product Image: <input type="file" name="prodImage" onchange="previewImage(event)"> <br>

       <input type="submit" value="Submit" name="btn">
    </form>
</body>
</html>
