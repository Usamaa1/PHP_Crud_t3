<?php


require('connection.php');

    $sql_select = 'SELECT * from products';

    $result = mysqli_query($conn, $sql_select);

   
     





?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>All Products!</h1>


    <div class="container">
        <div class="row">

        <?php
         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                ?>

            <div class="card" style="width: 18rem;">
            <img src="<?php echo 'images/'.$row['prod_image'] ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['prod_name'] ?></h5>
                    <p class="card-text"><?php echo $row['prod_desc'] ?></p>
                    <a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Update</a>
                </div>
            </div>


            <?php 
                    }
                } else {
                    echo "0 results";
                }
            
            ?>




        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>