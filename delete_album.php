<?php

include "connection.php";

if (isset($_POST['trash'])) {
    $album_id = $_POST['album_id'];

    $deleteNotifications = mysqli_query($conn, "DELETE FROM aghniya_notifikasi WHERE aghniya_foto_id IN (SELECT aghniya_foto_id FROM aghniya_foto WHERE aghniya_album_id = $album_id)");

    $deleteLikes = mysqli_query($conn, "DELETE FROM aghniya_like_foto WHERE aghniya_foto_id IN (SELECT aghniya_foto_id FROM aghniya_foto WHERE aghniya_album_id = $album_id)");

    $deleteComments = mysqli_query($conn, "DELETE FROM aghniya_komentar_foto WHERE aghniya_foto_id IN (SELECT aghniya_foto_id FROM aghniya_foto WHERE aghniya_album_id = $album_id)");

    $deleteFotos = mysqli_query($conn, "DELETE FROM aghniya_foto WHERE aghniya_album_id = $album_id");

    $deleteAlbum = mysqli_query($conn, "DELETE FROM aghniya_album WHERE aghniya_album_id = $album_id");

    if ($deleteAlbum) {
        echo "<script>
        alert('Album berhasil dihapus');
        location.href='user_page.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menghapus album');
        location.href='user_page.php';
        </script>";
    }
}

?>
