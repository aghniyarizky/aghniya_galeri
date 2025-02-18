<?php
session_start();
include 'connection.php';

$username       = $_POST['username'];
$password       = md5($_POST['password']);

$sql = mysqli_query($conn, "SELECT * FROM aghniya_user WHERE aghniya_username='$username' AND aghniya_password='$password'");

$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    $data = mysqli_fetch_array($sql);

    if ($data['aghniya_verifikasi'] != 0){
        $_SESSION['aghniya_user_id'] = $data['aghniya_user_id'];
        $_SESSION['aghniya_username'] = $data['aghniya_username'];
        $_SESSION['aghniya_role_id'] = $data['aghniya_role_id'];
        $_SESSION['aghniya_verifikasi'] = $data['aghniya_verifikasi'];
        $_SESSION['status'] = 'login';

        echo "
        <script>
            alert('Login Sucessfully!');
            location.href='index.php';
        </script>";
    }else{
        echo "
        <script>
            alert('You have not verification from admin! Try Again');
            location.href='login.php';
        </script>";
    }
}  else {
    echo "
    <script>
        alert('Wrong Username or Password! Try Again');
        location.href='login.php';
    </script>";
}

?>