<?php
    require "connection.php";

    $id = $_GET['id'];
    $product = getProduct($id);


    function getProduct($id){
        $conn = connection();
        $sql  = "SELECT * FROM products WHERE id = $id";
    
        if($result = $conn->query($sql)){
            return $result->fetch_assoc();
            //return an associate array
        } else {
            die("Error retreiving all products: " . $conn->error);
        }
    }

    function deleteProduct($id){
        $conn = connection();
        $sql  = "DELETE FROM products WHERE id = $id";

        if($conn->query($sql)){
            header("location: products.php");
            exit;
        } else {
            die("Error in deleting product" . $conn->error);
        }

    }

    if(isset($_POST['btn_delete'])){
        $id = $_GET['id'];
        deleteProduct($id);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Delete Product</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-3">

                <div class="text-center mb-4">
                    <i class="fa-solid fa-triangle-exclamation text-warning display-4"></i>
                    <h2 class="fw-light mb-3 text-danber">Delete Product</h2>
                    <p class="fw-bold mb-0">Are you sure want to delete " <?= $product['name']?>"?</p>
                </div>

                <div class="row">
                    <div class="col">
                        <a href="products.php" class="btn btn-secondary w-100">Cancel</a>
                    </div>
                    <div class="col">
                        <form action="" method="post">
                            <button type="submit" class="btn btn-outline-secondary w-100" name="btn_delete">Delete</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>
</html>