<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List Of Client</h2><br>
        <button type='button' class='btn btn-primary' onclick="location.href='/myshop_crud/created.php'">New Client</button><br><br>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "myshop";

                    //Create connection
                    $connection = new mysqli($servername, $username, $password, $database);

                    //Check connection
                    if($connection -> connect_error){
                        die("Connection failed :" . $connection->connect_error);
                    }

                    //read all row from databse table
                    $sql = "SELECT * FROM clients";
                    $results = $connection ->query($sql);

                    if(!$results){
                        die("Invalid query :" .$connection->error);
                    }

                    //read the data from each row 
                    while($row = $results -> fetch_assoc()){
                        echo "
                            <tr>
                                <td>$row[id]</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$row[phone]</td>
                                <td>$row[address]</td>
                                <td>$row[created_at]</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='/myshop_crud/edit.php?id=$row[id]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='/myshop_crud/delete.php?id=$row[id]'>Delete</a>
                                </td>
                            </tr>
                        ";
                    }
                ?>
                
            
            </tbody>
        </table>
    </div>
</body>
</html>