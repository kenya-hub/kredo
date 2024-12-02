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



function createSection($name){
    // connection
    $conn = connection();

    // SQL
    $sql = "INSERT INTO section(`name`) VALUE ('$name')";

    // ECEDUTION
    if($conn->query($sql)){
        // success
        header("refresh:0");
        // refresh teh current page after 0 seconds
    }  else {
        // Fails
        die("Error adding new product section: " . $conn->error);
    }
}

function deleteSection(){
    $conn = connection();
    $sql  = "DELETE FROM section WHERE id = $section_id";

    if($conn->query($sql)){
        header("refresh:0");
    }  else {
        die("Error delteting new product section: " . $conn->error);
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
    <title>Sections</title>
    <link href=“https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css” rel=“stylesheet” integrity=“sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65” crossorigin=“anonymous”>
    <link rel=“stylesheet” href=“https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css” integrity=“sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==” crossorigin=“anonymous” referrerpolicy=“no-referrer” />
</head>
<body>

    <main class="container">
            <div class="row justify-content-center">
                <div class="col-3">
                    <h2 class="fw-light mb-3">Section</h2>

                    <div class="mb-3">
                        <form action="" method="post">
                            <div class="row gx-2">
                                <div class="col">
                                    <input type="text" name="name" class="form-control" placeholder="Add a new section here..." 
                                    max="50" required autofocus>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" name="btn_add" class="btn btn-info w-100 fw-bold"><i class="fa-solid"></i>ADD</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                            <td><?= $section['id']?></td>
                            <td><?= $section['name']?></td>
                            <td>
                                <from action="" method="post">
                                    <button type="submit" name="btn_delete" value="<?=
                                    $section['id'] ?>" class="btn btn-outline-danger 
                                    border-0" title="delete"><i class="fa-solid fa-trash-can"></i></button>
                                </from>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>


</body>
</html>