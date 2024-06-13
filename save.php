<?php
require 'connect.php';

if (isset($_POST['submit'])) {    
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $query = "INSERT INTO user (user_id, username, first_name, last_name, gender, password) VALUES ('$user_id','$username','$first_name','$last_name','$gender','$password')";
    $result = mysqli_query($conn, $query); 

    if ($result) {
        header('Location: add.php?success=true');
    } else {
        header('Location: add.php?failed=false');
        exit(0);
    }
}
?>

