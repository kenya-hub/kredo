<?php
    session_start();
    require "connection.php";


    function getAllProducts(){
        $conn = connection();
        $sql  = "SELECT products.id AS id,
                        products.name AS `name`,
                        products.description AS `description`,
                        products.price AS price,
                        section.name AS section
                 FROM products
                 INNER JOIN section
                 ON products.section_id = section.id
                 ORDER BY products.id";

        if($result = $conn->query($sql)){
            return $result;
        } else {
            die("Error retrieving all products: " . $conn->error);
        }
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Products Dashboard</title>
</head>
<body>
    <?php
        include 'main-nav.php';
    ?>
    <main class="container">
        <div class="row mb-4">
            <di class="col">
                <h2 class="fw-light">Products</h2>
            </di>

            <div class="col text-end">
                <a href="add-product.php" class="btn btn-success"><i class="fa-solid 
                fa-plus-circle"></i>New Product</a>
            </div>
        </div>

        <table class="table table-hover align-middle border">
            <thead class="small table-success">
                <th>ID</th>
                <th styel="width:250px;">NAME</th>
                <th>Description</th>
                <th>PRICE</th>
                <th>SECTION</th>
                <th styel="width:90px;"></th>
            </thead>
            <tbody>
                <?php
                    $all_products = getAllProducts();

                    while($product = $all_products->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $product['id']?></td>
                        <td><?= $product['name']?></td>
                        <td><?= $product['description']?></td>
                        <td><?= $product['price']?></td>
                        <td><?= $product['section']?></td>
                        <td>
                            <a href="edit-product.php?id=<?= $product['id']?>" 
                            class="btn btn-outline-secondary btn-sm" title="edit">
                                <i class="fa-solid fa-pencil-alt"></i>
                            </a>
                            <a href="delete-product.php?id=<?= $product['id']?>" 
                            class="btn btn-outline-danger btn-sm" title="delete">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
    
</body>
</html>