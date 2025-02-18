<?php
include 'connection.php';
session_start();
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_username'];
    $user ? $_SESSION['aghniya_user_id'] : null;
    include "sidebar.php";
}

$sql = mysqli_query($conn, "SELECT * FROM aghniya_album");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Album</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <?php
    if (isset($_SESSION['aghniya_username'])) { ?>
        <div class="p-12 sm:ml-64">
            <div class="p-8 border border-1 border-gray-800 rounded-xl mb-8">
                <div class="text-2xl font-semibold">Add Album</div> 
                <form action="cek_add_album.php" method="POST">  
                    <div class="w-full">
                        <div class="w-full">
                            <div class="p-1">
                                Title
                                <input type="text" name="title" class="w-full rounded-md text-sm p-2 font-base border" placeholder="Add Title" required>
                            </div>
                            <div class="p-1">
                                Description
                                <textarea placeholder="Description" name="description" class="text-sm border w-full p-1 rounded-lg h-full" required></textarea>
                            </div>
                            <input type="hidden" name="user" value="<?=$_SESSION['aghniya_user_id']?>">
                            <div class="p-5 my-5">
                                <input type="submit" name="submit" class="w-full p-2 font-semibold text-white bg-gray-50 dark:bg-gray-800 hover:bg-gray-900 border rounded-lg shadow-lg hover:shadow-2xl" value="Add Album">
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
    <?php } ?>

</body>
</html>