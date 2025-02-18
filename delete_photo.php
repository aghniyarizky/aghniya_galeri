<?php

include "connection.php";

if (isset($_POST['trash'])){
    // var_dump($_POST);
    $photo_id = $_POST['photo_id'];
    $album_id = $_POST['album_id'];

    $delete_comments = mysqli_query($conn, "DELETE FROM aghniya_komentar_foto WHERE aghniya_foto_id = $photo_id");
    $delete_notif = mysqli_query($conn, "DELETE FROM aghniya_notifikasi WHERE aghniya_foto_id = $photo_id");
    $delete_likes = mysqli_query($conn, "DELETE FROM aghniya_like_foto WHERE aghniya_foto_id = $photo_id");

    // $sql = mysqli_query($conn, "DELETE FROM aghniya_foto WHERE aghniya_foto_id = $photo_id");

    if ($delete_comments && $delete_notif && $delete_likes) {
        $sql = mysqli_query($conn, "DELETE FROM aghniya_foto 
            WHERE aghniya_foto.aghniya_foto_id = $photo_id");

        if ($sql) {
            echo "<script>
            alert('Foto berhasil dihapus');
            location.href='your_photo.php';
            </script>";
        }else {
            echo "<script>
            alert('Gagal menghapus foto');
            location.href='your_photo.php';
            </script>";
        }
    }
}

?>