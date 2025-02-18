<?php
session_start();
include 'connection.php';

    $username = $_POST['username'];
    $password = md5($_POST['password']); 
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $sql_check = mysqli_query($conn,"SELECT * FROM aghniya_user WHERE aghniya_username = '$username'");

    $cek = mysqli_num_rows($sql_check);

    if ($cek> 0) {
        echo "<script>
            alert('Username already taken, please choose a different username');
            location.href='register.php';
        </script>";
    } else {
        $sql_insert = mysqli_query($conn, "INSERT INTO aghniya_user VALUES(null, '$username', '$password', '$email', '$full_name', '$alamat', 2, 0, NULL)");
        if ($sql_insert){
            echo "<script>
                alert('Registration successful! You should wait verification from admin');
                location.href='login.php';
            </script>";
        }
    }

?>