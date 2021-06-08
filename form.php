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

<form action="http://localhost/training/form.php" method="post">
<input type="email" name="email" id="email" placeholder="email"><br>
<input type="text" name="fname" id="fname" placeholder="First Name"><br>
<input type="text" name="lname" id="lname" placeholder="Last Name"><br>
<input type="password" name="password" id="password" placeholder="password"><br>
<input type="submit" name="submit" value="send">
</form>

<?php

if(isset($_POST['submit'])){

    $first_name = mysqli_real_escape_string($conn, $_REQUEST['fname']);
    $last_name = mysqli_real_escape_string($conn, $_REQUEST['lname']);
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    $password = mysqli_real_escape_string($conn, $_REQUEST['password']);
    $hashPassword = md5($password);
    
    // Attempt insert query execution
    $sql = "INSERT INTO user (firstname, lastname, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashPassword')";
    if(mysqli_query($conn, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
    // Close connection
    $conn->close();

}



?>