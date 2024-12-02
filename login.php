<?php

    require "connection.php";

    function login($username, $password){
        $conn  =  connection();
        $sql   = "SELECT * FROM users WHERE username = '$username' ";
    
        if($results = $conn->query($sql)){
            if($results->num_rows == 1){
                $user = $results->fetch_assoc();
            
                if(password_verify($password,$user['password'])){
                    // SESSTION
                    session_start();

                    $_SESSION['id']          =   $user['id'];
                    $_SESSION['username']    =   $user['username'];
                    $_SESSION['full_name']   =   $user['first_name'] . " " . $user['last_name'];

                    header("location: products.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger'>Incorrect Password</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Username not found.</div>";
            }
        } else {
            die("Error retreiving the user: " . $conn->error);
        }
    }

    if(isset($_POST['btn_log_in'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        login($username, $password);
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
<body class="bg-light">
    <div style= "heigt: 100vh;">
        <div class="row h-100">
            <div class="card w-25 mx-auto my-auto p-0">

                <div class="card-header text-primary bg-whigt">
                    <h1 class="card-title text-center mb-0">Minimart Catalog</h1>
                </div>

                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-lebel small fw-bold">User Name: </label>
                            <input type="text" name="username" id="username" class="form-control" maxlength="50" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-lebel small fw-bold">Password: </label>
                            <input type="password" name="password" id="password" class="form-control" maxlength="50" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100" name="btn_log_in">Login</button>

                    </form>

                    <div class="text-center" mt-3>
                        <a href="sign-up.php" class="small">Create Account</a>
                    </div>
                </div>

            </div>
        </div>
    </div>    
</body>
</html>