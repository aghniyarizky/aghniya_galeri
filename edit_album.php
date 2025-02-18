<?php
include 'connection.php';
session_start();
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_username'];
    $user ? $_SESSION['aghniya_user_id'] : null;
    include "sidebar.php";
}

$album_id = isset($_GET['album_id'])? $_GET['album_id'] : NULL;

$sql = mysqli_query($conn, "SELECT * FROM aghniya_album WHERE aghniya_album_id = $album_id");
$data = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <?php
    if (isset($_SESSION['aghniya_username'])) { ?>
        <div class="p-12 sm:ml-64">
            <div class="p-8 border border-1 border-gray-800 rounded-xl mb-8">
                <div class="flex">
                    <div class="w-1/2 justify-start">
                        <div class="text-2xl font-semibold">Edit Album</div> 
                    </div>
                    <div class="w-1/2 text-right">
                        <form action="delete_album.php" method="POST" id="deleteForm">
                            <input type="hidden" name="album_id" value="<?=$album_id?>">
                            <div class="my-auto text-right">
                                <button type="submit" name="trash" id="trash">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <form action="" method="POST">  
                    <div class="8">
                        <!-- <div class="w-1/2 content-center">
                            <img src="public/nature.jpg" alt="" class="h-auto w-full my-4 rounded-md">
                            <input type="file" class="content-center justify-center items-center">
                        </div> -->
                        <div class="w-full mt-5">
                            <div class="p-1">
                                Album Name
                                <input type="text" name="album" class="w-full rounded-md text-sm p-2 font-base border" value="<?=$data['aghniya_nama_album']?>" placeholder="Change Album Name">
                            </div>
                            <div class="p-1">
                                Description
                                <textarea placeholder="Change Description" name="description" class="text-sm border w-full p-1 rounded-lg h-full"> <?=$data['aghniya_deskripsi']?></textarea>
                            </div>
                            <input type="hidden" name="user" value="<?=$_SESSION['aghniya_user_id']?>">
                            <input type="hidden" name="album_id" value="<?=$album_id?>">
                            <div class="p-5 my-5">
                                <input type="submit" name="submit" class="w-full p-2 font-semibold text-white bg-gray-50 dark:bg-gray-800 hover:bg-gray-900 border rounded-lg shadow-lg hover:shadow-2xl" value="Change Album">
                            </div>
                        </div>
                    </div>
                </form> 
            </div>

    <?php 
    
    if (isset($_POST['submit'])){
        $album        = $_POST['album'];
        $description  = $_POST['description'];
        $user         = $_POST['user'];
        $album_id     = $_POST['album_id'];

        $change = mysqli_query($conn, "UPDATE aghniya_album SET aghniya_nama_album = '$album', aghniya_deskripsi = '$description' WHERE aghniya_album_id = $album_id");
    
        if($change){
            echo "<script>
                    alert('Change Album Sucessfully!');
                    location.href='user_page.php';
                </script>";
        }else{
            echo "<script>
                    alert('Failed to Change Album!');
                    location.href='edit_album.php';
                </script>";
        }
    }

    ?>
    <?php } ?>
    <script>
        document.getElementById('deleteForm').addEventListener('submit', function(e) {
            let choice = confirm('Are you sure you want to remove this album?');
            if (!choice) {
                e.preventDefault();
                alert('Hapus Album dibatalkan!');
            }
        });
    </script>
</body>
</html>