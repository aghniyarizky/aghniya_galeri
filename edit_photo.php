<?php
include 'connection.php';
session_start();
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_username'];
    $user ? $_SESSION['aghniya_user_id'] : null;
    $userid = $_SESSION['aghniya_user_id'];
    include "sidebar.php";
}

$photoid = isset($_GET['photo_id']) ? $_GET['photo_id'] : null;

$sql = mysqli_query($conn, "SELECT * FROM aghniya_album JOIN aghniya_foto ON aghniya_album.aghniya_album_id = aghniya_foto.aghniya_album_id WHERE aghniya_album.aghniya_user_id = $userid AND aghniya_foto.aghniya_foto_id = $photoid");

if (mysqli_num_rows($sql) == 0 ){
    $album = true;
}else{
    $album = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Photo</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <?php
    if ((isset($_SESSION['aghniya_username'])) && (!$album) ) { ?>
        <div class="p-12 sm:ml-64">
            <div class="p-8 border border-1 border-gray-800 rounded-xl mb-8">
                <div class="text-2xl font-semibold">Edit Photo</div> 
                <form action="cek_add_photo.php" method="POST" enctype="multipart/form-data">  
                    <div class="flex flex-col xl:flex-row gap-8">
                        <?php while ($data = mysqli_fetch_assoc($sql)) { 
                            // echo $data['aghniya_deskripsi_foto'];
                        ?>
                        <div class="w-full lg:w-1/2 content-center">
                            <!-- <img src="public/nature.jpg" alt="" class="h-auto w-full my-4 rounded-md"> -->
                                <?php if (!empty($data['aghniya_lokasi_file'])): ?>
                                    <img src="<?=$data['aghniya_lokasi_file']?>" class="w-20 h-20 mb-4 mx-auto">
                                <?php endif; ?>
                            <input type="file" name="photo" class="content-center justify-center items-center sm:mt-4 xl:mt-0" value="<?=$data['aghniya_lokasi_file']?>" required>
                        </div>
                        
                        <div class="w-full xl:w-1/2">
                            <div class="p-1">
                                Title
                                <input type="text" name="title" class="w-full rounded-md text-sm p-2 font-base border" placeholder="Add Title" value="<?=$data['aghniya_judul_foto']?>" required>
                            </div>
                            <div class="p-1">
                                Description
                                <textarea placeholder="Description" name="description" class="text-sm border w-full p-1 rounded-lg h-full" required><?=$data['aghniya_deskripsi_foto']?></textarea>
                            </div>
                            <div class="p-1">
                                Add To Album <br>
                                <select name="album" id="" class="w-full border rounded-lg p-1" required>
                                        <option value="<?=$data['aghniya_album_id']?>"><?=$data['aghniya_nama_album']?></option>
                                </select>
                            </div>
                            <input type="hidden" name="user" value="<?=$_SESSION['aghniya_user_id']?>">
                            <div class="p-5 my-5">
                                <input type="submit" name="submit" class="w-full p-2 font-semibold text-white bg-gray-50 dark:bg-gray-800 hover:bg-gray-900 border rounded-lg shadow-lg hover:shadow-2xl" value="Edit Photo">
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </form> 
            </div>
    <?php }else{ ?>
        <div class="p-12 sm:ml-64">

        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span class="font-medium">Info alert!</span> You should have an album before you want to add photo!
        </div>
        </div>
    
    <?php } ?>


    <?php 
        if (isset($_POST['submit'])) {
            $username   = $_POST['username'];
            $password   = !empty($_POST['password']) ? md5($_POST['password']) : $data['aghniya_password'];
            $email      = $_POST['email'];
            $full_name  = $_POST['full_name'];
            $user       = $_POST['user'];
        
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $title = strtolower(str_replace(' ', '_', $_POST['username']));
                $photo_tmp = $_FILES['photo']['tmp_name'];
                $photo_name = $_FILES['photo']['name'];
                $photo_ext = pathinfo($photo_name, PATHINFO_EXTENSION);
                $photo_new_name = $title . '_' . $user . '.' . $photo_ext;
                $target_dir = 'public/';
                $target_file = $target_dir . $photo_new_name;
        
                if (move_uploaded_file($photo_tmp, $target_file)) {
                    $change = mysqli_query($conn, "UPDATE aghniya_user SET aghniya_username = '$username', aghniya_password = '$password', aghniya_email = '$email', aghniya_nama_lengkap = '$full_name', aghniya_foto_profile = '$target_file' WHERE aghniya_user_id = $user");
                } else {
                    $change = mysqli_query($conn, "UPDATE aghniya_user SET aghniya_username = '$username', aghniya_password = '$password', aghniya_email = '$email', aghniya_nama_lengkap = '$full_name' WHERE aghniya_user_id = $user");
                }
            } else {
                $change = mysqli_query($conn, "UPDATE aghniya_user SET aghniya_username = '$username', aghniya_password = '$password', aghniya_email = '$email', aghniya_nama_lengkap = '$full_name' WHERE aghniya_user_id = $user");
            }
        
            if ($change) {
                $_SESSION['aghniya_username'] = $username;
                echo "<script>
                    alert('Change Profile Successfully!');
                    location.href='user_page.php';
                </script>";
            } else {
                echo "<script>
                    alert('Failed to Change Profile!');
                    location.href='edit_profile.php';
                </script>";
            }
        }
        
    ?>
</body>
</html>