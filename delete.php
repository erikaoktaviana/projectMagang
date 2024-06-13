<?php 

require 'connect.php';
$user_id = $_GET['user_id'];

    $query = "DELETE FROM user WHERE user_id=".$user_id;
    $result = mysqli_query($conn,$query);

    if($result)
    {  
        $_SESSION['message'] = "Data Berhasil di Hapus";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Data Gagal di Hapus";
        header("Location: index.php");
        exit(0);
    }
 ?>