<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errorMessage = "";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        do{
            if(empty($name) || empty($email) || empty($phone) || empty($address)){
                $errorMessage = "All the fields are required.";
                break;
            }

            //add new client database
            $sql = "INSERT INTO clients (name, email, phone, address)" . 
                    "VALUES ('$name','$email','$phone','$address')";

            $result = $connection ->query($sql);

            if(!$result){
                die("Invalid query :" .$connection->error);
            }

            
            $name = "";
            $email = "";
            $phone = "";
            $address = "";
     
            $successMessage = "Client Added Successfully.";

            header("location: /myshop_crud/index.php");
            exit;

        }while(false);
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2><br>
        <?php
            if(!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        <form class="row g-3" method="post">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>" >
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" >
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" name="phone" id="phone" value="<?php echo $phone ?>" >
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="<?php echo $address ?>" >
            </div>
            <?php 
                if(!empty($successMessage)){
                    echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    "; 
                }
            ?>
            <div class="col-10"></div>
            <div class="col-1">
                <button type="button" class="btn btn-light">Cancel</button>
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</body>
</html>