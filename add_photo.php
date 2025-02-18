<?php
include 'connection.php';
session_start();
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_username'];
    $user ? $_SESSION['aghniya_user_id'] : null;
    $userid = $_SESSION['aghniya_user_id'];
    include "sidebar.php";
}

$sql = mysqli_query($conn, "SELECT * FROM aghniya_album WHERE aghniya_user_id = $userid");

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
    <title>Add Photo</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <?php
    if ((isset($_SESSION['aghniya_username'])) && (!$album) ) { ?>
        <div class="p-12 sm:ml-64">
            <div class="p-8 border border-1 border-gray-800 rounded-xl mb-8">
                <div class="text-2xl font-semibold">Add Photo</div> 
                <form action="cek_add_photo.php" method="POST" enctype="multipart/form-data">  
                    <div class="flex flex-col xl:flex-row gap-8">
                        <div class="w-full lg:w-1/2 content-center">
                            <!-- <img src="public/nature.jpg" alt="" class="h-auto w-full my-4 rounded-md"> -->
                            <input type="file" name="photo" class="content-center justify-center items-center sm:mt-4 xl:mt-0" required>
                        </div>
                        <div class="w-full xl:w-1/2">
                            <div class="p-1">
                                Title
                                <input type="text" name="title" class="w-full rounded-md text-sm p-2 font-base border" placeholder="Add Title" required>
                            </div>
                            <div class="p-1">
                                Description
                                <textarea placeholder="Description" name="description" class="text-sm border w-full p-1 rounded-lg h-full" required></textarea>
                            </div>
                            <div class="p-1">
                                Add To Album <br>
                                <select name="album" id="" class="w-full border rounded-lg p-1" required>
                                    <?php while ($data = mysqli_fetch_assoc($sql)) { ?>
                                        <option value="<?=$data['aghniya_album_id']?>"><?=$data['aghniya_nama_album']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" name="user" value="<?=$_SESSION['aghniya_user_id']?>">
                            <div class="p-5 my-5">
                                <input type="submit" name="submit" class="w-full p-2 font-semibold text-white bg-gray-50 dark:bg-gray-800 hover:bg-gray-900 border rounded-lg shadow-lg hover:shadow-2xl" value="Add Photo">
                            </div>
                        </div>
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

</body>
</html>