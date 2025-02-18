<?php
include 'connection.php';
session_start();
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_user_id'];
    include "sidebar.php";
}

$sql = mysqli_query($conn, "SELECT * FROM aghniya_user WHERE aghniya_user_id = $user");
$data = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <?php
    if (isset($_SESSION['aghniya_username'])) { ?>
        <div class="p-12 sm:ml-64">
            <div class="p-8 border border-1 border-gray-800 rounded-xl mb-8">
                <div class="text-2xl font-semibold">Edit Profile</div> 
                <form action="" method="POST" enctype="multipart/form-data">  
                    <div class="">
                        <div class="w-full mt-5">
                            <div class="p-1">
                                <?php if (!empty($data['aghniya_foto_profile'])): ?>
                                    <img src="<?=$data['aghniya_foto_profile']?>" class="rounded-full w-32 h-32 mb-4 mx-auto" alt="Current Profile Picture">
                                <?php else: ?>
                                    <img src="public/anonim.jpg" class="rounded-full w-32 h-32 mb-4" alt="Default Profile Picture">
                                <?php endif; ?>
                                Photo
                                <input type="file" name="photo" value="<?=$data['aghniya_foto_profile']?>" class="w-full rounded-md text-sm p-2 font-base border">
                            </div>
                            <div class="p-1">
                                Username
                                <input type="text" name="username" class="w-full rounded-md text-sm p-2 font-base border" value="<?=$data['aghniya_username']?>" placeholder="Change Username">
                            </div>
                            <div class="p-1">
                                Password
                                <input type="text" name="password" class="w-full rounded-md text-sm p-2 font-base border" placeholder="Leave it as is if there are no changes">
                            </div>
                            <div class="p-1">
                                E-mail
                                <input type="email" name="email" class="w-full rounded-md text-sm p-2 font-base border" value="<?=$data['aghniya_email']?>" placeholder="Change E-mail">
                            </div>
                            <div class="p-1">
                                Full Name
                                <input type="text" name="full_name" class="w-full rounded-md text-sm p-2 font-base border" value="<?=$data['aghniya_nama_lengkap']?>" placeholder="Change Full Name">
                            </div>
                            <input type="hidden" name="user" value="<?=$_SESSION['aghniya_user_id']?>">
                            <div class="p-5 my-5">
                                <input type="submit" name="submit" class="w-full p-2 font-semibold text-white bg-gray-50 dark:bg-gray-800 hover:bg-gray-900 border rounded-lg shadow-lg hover:shadow-2xl" value="Change Profile">
                            </div>
                        </div>
                    </div>
                </form> 
            </div>

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
                $target_dir = 'profile/';
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
    <?php } ?>
    </body>
</html>