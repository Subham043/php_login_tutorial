<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "training";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname );
session_start();


   if(isset($_SESSION["id"])){
        if($_SESSION["id"]){
            header("Location: dashboard.php");
            die();
        }
   }



?>

<form action="http://localhost/training/login.php" method="post">
    <input type="email" name="email" id="email" placeholder="email"><br>

    <input type="password" name="password" id="password" placeholder="password"><br>
    <input type="submit" name="submit" value="send">
</form>

<?php

if(isset($_POST['submit'])){

    
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    $password = mysqli_real_escape_string($conn, $_REQUEST['password']);
    $hashPassword = md5($password);
    
    // Attempt insert query execution
    $sql = "SELECT * from user WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // if($hashPassword == $result)
        $row = $result -> fetch_assoc();
        if($row['password']==$hashPassword){
            $_SESSION["id"] = $row['id'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["name"] = $row['firstname']." ".$row['lastname'];
            header("Location: dashboard.php");
            die();
        }else{
            echo "Enter valid password";
        }
    }else{
        echo "User Doesn't Exist";
    }

    
    // Close connection
    $conn->close();

}