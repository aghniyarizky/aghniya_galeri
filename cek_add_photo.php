<?php

include 'connection.php';

    if (isset($_POST['submit'])) {
        // $photo          = $_POST['photo'];
        $title          = $_POST['title'];
        $description    = $_POST['description'];
        $album          = $_POST['album'];
        $user           = $_POST['user'];

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $title = strtolower(str_replace("'", "`", $title)); 
            // $title = strtolower(str_replace(' ', ' ', $_POST['title']));
            // $username = strtolower($_SESSION['aghniya_username']);
            $photo_tmp = $_FILES['photo']['tmp_name'];
            $photo_name = $_FILES['photo']['name'];
            $photo_ext = pathinfo($photo_name, PATHINFO_EXTENSION);
            $photo_new_name = $title . '_' . $user . '.'. $photo_ext;
            $target_dir = 'public/'; 
            $target_file = $target_dir . $photo_new_name; 
    
            if (move_uploaded_file($photo_tmp, $target_file)) {
                $sql = mysqli_query($conn, "INSERT INTO aghniya_foto 
                                           VALUES (NULL, '$title', '$description', now(), '$target_file', '$album', '$user')");
                if ($sql) {
                    echo "<script>
                            alert('Add Photo Successfully!');
                            location.href='user_page.php';
                        </script>";
                } else {
                    echo "<script>
                            alert('Failed to Add Photo!');
                            location.href='add_photo.php';
                        </script>";
                }
            } else {
                echo "<script>
                        alert('Failed to Upload the Photo!');
                        location.href='add_photo.php';
                    </script>";
            }
        } else {
            echo "<script>
                    alert('Please select a valid photo to upload!');
                    location.href='add_photo.php';
                </script>";
        }
    }

?>