<?php
require 'connect.php';

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $query = "UPDATE user SET username='$username', first_name='$first_name', last_name='$last_name', gender='$gender', password='$password' WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $query);

     if ($result) {
        header('Location: form-update.php?success_update=true');
    } else {
        header('Location: form_update.php?failed_update=false');
        exit(0);
    }
}
?>
