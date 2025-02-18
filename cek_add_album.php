<?php

include 'connection.php';

    if (isset($_POST['submit'])) {
        $title          = $_POST['title'];
        $description    = $_POST['description'];
        $user           = $_POST['user'];

        $title = strtolower(str_replace("'", "`", $title)); 
        $sql = mysqli_query($conn, "INSERT INTO aghniya_album VALUES (NULL, '$title', '$description', now(), '$user')");
        if($sql){
            echo "<script>
                    alert('Add Album Sucessfully!');
                    location.href='user_page.php';
                </script>";
        }else{
            echo "<script>
                    alert('Failed to Add Album!');
                    location.href='add_album.php';
                </script>";
        }
    }

?>