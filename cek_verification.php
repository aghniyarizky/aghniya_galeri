<?php

include "connection.php";

if(isset($_POST['verif'])){
    $user   = $_POST['id_user'];
    $username   = $_POST['username'];
    $verif  = $_POST['verif'];
    

    $sql = mysqli_query($conn, "UPDATE aghniya_user SET aghniya_verifikasi = 1 WHERE aghniya_user_id = $user");

    if($sql){
        echo "<script>
            alert('Succesfully verify $username');
            location.href='user_verification.php';
        </script>";
    }
}

?>