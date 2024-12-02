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

    function getAllSections(){
        $conn = connection();
        $sql  = "SELECT * FROM section";
    
        if($results = $conn->query($sql)){
            return $results;
        } else {
            die("Error retreiving all sections: " . $conn->error);
        }
    }

    
    function updateProduct($id,  $name, $description, $price, $section_id){
        $conn = connection();
        $sql = "UPDATE products 
                SET `name` = '$name',  `description` = '$description',  `price` = '$price', `section_id` = '$section_id'
                WHERE id = '$id'
               ";

        if($conn->query($sql)){
            header("location: products.php");
            exit;
        } else {
            die("Error updating new product" . $conn->error);
        }
    }

    if(isset($_POST['btn_update'])){
        $id   =   $_GET['id'];
        $name =   $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];

        updateProduct($id,  $name, $description, $price, $section_id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit Product</title>
</head>
<body>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <h2 class="fw-light mb-3">EDIT PRODUCT</h2>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label small fw-bold">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                            value="<?= $product['name']?>" max="50" required autofocus>
                        </div>


                        <div class="mb-3">
                            <label for="description" class="form-label small fw-bold">Description</label>
                            <textarea name="description" id="description" row="5" 
                            class="form-control" required><?= $product['description']?></textarea>
                        </div>


                        <div class="mb-3">
                            <label for="price" class="form-label small fw-bold">Price</label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" name="price" class="form-control" <?= $product['price']?>
                                step="any" required>
                            </div>
                        </div>


                        <div class="mb-4">
                            <label for="section-id" class="form-label small fw-bold"></label>
                            <select name="section_id" id="section-id" class="form-select" required>
                                <option value="" hidden>Select Section</option>
                                <?php
                                    $all_sections = getAllSections();

                                    while ($section = $all_sections->fetch_assoc()) {
                                        if ($section['id'] == $product['section_id']) {
                                            echo "<option value='" . $section['id'] . "' selected>" . $section['name'] . "</option>";
                                        }
                                    }
                                                                    
                                ?>
                            </select>
                        </div>


                        <a href="product.php" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" name="btn_update"  class="btn btn-secondary fw-bold px-5">
                                <i class="fa-solid fa-check"></i> Save Changes
                            </button>

                    </form>
            </div>    
        </div>
    </main>

    
</body>
</html>