<?php
require "connection.php";

function getAllSections(){
    $conn = connection();
    $sql  = "SELECT * FROM section";

    if($results = $conn->query($sql)){
        return $results;
    } else {
        die("Error retreiving all sections: " . $conn->error);
    }
}

function createSection($name){
    // CONNECTION
    $conn = connection();

    // SQL
    $sql = "INSERT INTO section(`name`) VALUE ('$name')";

    // EXECUTION
    if($conn->query($sql)){
        // success
        header("refresh:0");
        // refresh the current page after 0 seconds
    } else {
        // Fails
        die("Error adding new product section: " . $conn->error);

    }
}

function deleteSection($section_id){
    $conn = connection();
    $sql  = "DELETE FROM section WHERE id = $section_id";

    if($conn->query($sql)){
        header('refresh: 0');
    } else {
        die('Error deleting the product section: ' . $conn->error);
    }
}

    if(isset($_POST['btn_add'])){
        $name = $_POST['name'];
        createSection($name);
    }
    if(isset($_POST['btn_delete'])){
        $section_id = $_POST['btn_delete'];
        deleteSection($section_id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sections</title>
</head>
<body>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <h2 class="fw-light mb-3">Sections</h2>

                <!-- Form -->
                 <div class="mb-3">
                    <form action="" method="post">
                        <div class="row gx-2">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Add a new section here..." max="50" required autofocus>
                            </div>
                            <div class="col-auto">
                                <button type="submit" name="btn_add" class="btn btn-info w-100 fw-bold"><i class="fa-solid fa-plus"></i> ADD</button>
                            </div>
                        </div>
                    </form>
                 </div>

                 <!-- TABLE -->
                  <table class="table table-sm align-middle text-center">
                    <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $all_sections = getAllSections();
                            while($section = $all_sections->fetch_assoc()){
                                // fetch->assoc = transforms results into associative array
                        ?>
                        <tr>
                            <td><?= $section['id'] ?></td>
                            <td><?= $section['name'] ?></td>
                            <td>
                                <form action="" method="post">
                                    <button type="submit" name="btn_delete" value="<?= $section['id'] ?>" class="btn btn-outline-danger border-0" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                  </table>

            </div>
        </div>
    </main>
</body>
</html>