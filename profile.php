<?php
    session_start();
    require "connection.php";

    $user = getUser();

    function getUser(){
        $conn = connection();

        $id   = $_SESSION['id'];
        $sql  = "SELECT * FROM users WHERE id = $id";

        if($result = $conn->query($sql)){
            return $result->fetch_assoc();
        } else {
            die("Error retreiving your data: " . $conn->error);
        }
    }


    function updatePhoto($id, $photo_name, $photo_tmp){
        $conn = connection();

        $sql  = "UPDATE users SET photo = '$photo_name' WHERE id = $id";

        if($conn->query($sql)){
            $destination = "asset/images/$photo_name";
            move_uploaded_file($photo_tmp, $destination);
            header('refresh: 0');
        } else {
            die("Error uploading photo: " . $conn->error);
        }
    }


    if(isset($_POST['btn_upload_photo'])){
        $id         = $_SESSION['id'];  
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp  = $_FILES['photo']['tmp_name'];

        updatePhoto($id, $photo_name, $photo_tmp);

    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="asset/css/style.css">
    <title>Profile</title>
</head>
<body>
    <?php
        include 'main-nav.php';
    ?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                
                <?php
                    if($user['photo']){
                ?>

                    <img src="asset/images/<?= $user['photo'] ?>" alt="<?= $user['photo'] ?>" class="profile-photo d-block mx-auto border img-thumbnail">

                <?php
                    } else {
                ?>

                    <i class="fa-regular fa-user d-block text-center profile-icon"></i>
                
                <?php
                    }
                ?>

                <div class="mt-2 mb-3 text-center">
                    <h4 class="mb-0"><?= $user['username'] ?></h4>
                    <p><?= $user['first_name'] . " " . $user['last_name'] ?></p>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="input-group mb-2">
                        <input type="file" name="photo" class="form-control" accept="image/*">
                        <button type="submit" class="btn btn-outline-secondary" name="btn_upload_photo">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>