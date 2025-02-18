<?php

include "connection.php";

if(isset($_POST['likes'])){
    $likes = $_POST['likes'];
    $id_photo = $_POST['id_photo'];
    $id_user = $_POST['id_user'];
    $id_user_photo = $_POST['id_user_photo']; // si A yang punya
    $direction_path = $_POST['direction_path'];

    $sql = mysqli_query($conn, "SELECT * FROM aghniya_like_foto WHERE aghniya_foto_id = $id_photo AND aghniya_user_id = $id_user");
    if (mysqli_num_rows($sql) == 0 ){
        $sql_likes = mysqli_query($conn, "INSERT INTO aghniya_like_foto VALUES(NULL, $id_photo, $id_user, now())");

        if($sql_likes){
            $id_like = mysqli_insert_id($conn);
            $sql_notification = mysqli_query($conn, "INSERT INTO aghniya_notifikasi VALUES (NULL, $id_photo, 0, $id_user, now(), $id_user_photo, 0, $id_like, 0)");

            echo "<script>
                    location.href='$direction_path';
                </script>";
        }
    }else{
        $sql_delete = mysqli_query($conn, "DELETE FROM aghniya_like_foto WHERE aghniya_foto_id = $id_photo AND aghniya_user_id = $id_user");
        if($sql_delete){
            $sql_notification = mysqli_query($conn, "DELETE FROM aghniya_notifikasi WHERE aghniya_foto_id = $id_photo AND aghniya_user_id = $id_user");
            echo "<script>
                    location.href='$direction_path';
                </script>";
        }
    }
}

?>