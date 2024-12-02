<?php
    require "connection.php";


    function createUser($first_name ,$last_name, $username, $password){
        $conn  =  connection();
        
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (`first_name`, `last_name`, `username`, `password`)
                VALUES  ('$first_name', '$last_name', '$username', '$password')";

        if($conn->query($sql)){
            header("location: login.php");
            exit;
        } else {
            die("Error signing up: " . $conn->error);
        }

    }



    if(isset($_POST['btn_sign_up'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];


    if($password == $confirm_password){
        createUser($first_name ,$last_name, $username, $password);
    } else {
        echo "<p class='alert alert-danger'>Password and Confirm Passowrd do not mathc.</p>";
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
    <title>Delete Product</title>
</head>
<body>
    <div style="height= 100vh;" class="mt-4">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto p-0">
                <div class="card-header text-success">
                    <h3 class="card-title mb-0">Create your own account</h3>
                </div>

                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="first-name" class="form-lebel small fw-bold">First Name: </label>
                            <input type="text" name="first_name" id="first_name" class="form-control" maxlength="50" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="last-name" class="form-lebel small fw-bold">Last Name: </label>
                            <input type="text" name="last_name" id="last_name" class="form-control" maxlength="50" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-lebel small fw-bold">User Name: </label>
                            <input type="text" name="username" id="username" class="form-control" maxlength="50" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-lebel small fw-bold">Password: </label>
                            <input type="password" name="password" id="password" class="form-control" maxlength="50" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-lebel small fw-bold">Confirm Password: </label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" maxlength="50" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100" name="btn_sign_up">Sign Up</button>

                        <div class="text-center mt-3">
                            <p class="small">Already have an account? <a href="login.php">Log in</a>.</p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>