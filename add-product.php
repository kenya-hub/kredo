<?php
require "connection.php";


    function getAllSections(){
        $conn = connection();
        $sql = "SELECT * FROM section";

        if($results = $conn->query($sql)){
            return $results;
        } else {
            die("Error adding new product section: " . $conn->error);
        }
    }

    function createProduct($name, $description, $price, $section_id){
        $conn = connection();
        $sql  = "INSERT INTO `products` (`name` ,`description`, price, section_id)
        VALUES ('$name' ,'$description', $price, $section_id)";

        if($conn->query($sql)){
            header("location: products.php");
            exit;
        } else {
            die("Error adding new product" . $conn->error);
        }
    }

    if(isset($_POST['btn_add'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];

        createProduct($name, $description, $price, $section_id);

    }

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <h2 class="fw-light mb-3">New Product</h2>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="from-label small fw-bold">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                        max="50" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label small fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label small fw-bold">Price</label>
                        <div class="input-group">
                            <div class="input-group-text">$</div>
                            <input type="number" name="price" id="price" class="form-control" step="any" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="section-id" class="form-label small fw-bold">Section</label>
                        <select name="section_id" id="section-id" class="form-select" required>
                            <option value="" hidden>Select Section</option>
                            <?php
                                $all_sections = getAllSections();

                                while($section = $all_sections->fetch_assoc()){
                                    echo "<option value='" . $section['id']. "'>" . 
                                    $section['name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <a href="products.php" class="btn btn-outline-success">Cancel</a>
                    <button type="submit" name="btn_add" class="btn btn-success fw-bold px-5">
                        <i class="fa-solid fa-plus"></i> Add
                    </button>

                </form>
            </div>
        </div>
    </main>
</body>
</html>