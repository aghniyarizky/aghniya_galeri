<?php
include "connection.php";

if (isset($_POST['comment_user'])) {
    $comment =  $_POST['comment_user'];

    $id_photo = $_POST['id_photo'];
    $id_user = $_POST['id_user']; // Si B yang komen
    $id_user_photo = $_POST['id_user_photo']; // Si A yang punya
    $direction_path = $_POST['direction_path'];

    $sql_comment = mysqli_query($conn, "INSERT INTO aghniya_komentar_foto VALUES(NULL, $id_photo, $id_user, '$comment', now())");

    if ($sql_comment) {
        $id_komen = mysqli_insert_id($conn);

        $sql_notification = mysqli_query($conn, "INSERT INTO aghniya_notifikasi VALUES (NULL, $id_photo, $id_komen, $id_user, now(), $id_user_photo, 0, 0, 0, 0)");

        if ($sql_notification) {
            // $redirect_url = isset($_GET['photo_id']) ? "photo_detail.php?id_photo=$id_photo" : "photo_detail_user.php?photo_id=$id_photo";

            echo "<script>
                    location.href='$direction_path';
                </script>";
        }
    } else {
        // $redirect_url = isset($_GET['photo_id']) ? "photo_detail.php?id_photo=$id_photo" : "photo_detail_user.php?photo_id=$id_photo";
        echo "<script>
                alert('Gagal Komentar');
                location.href='$direction_path';
            </script>";
    }
}
?>
