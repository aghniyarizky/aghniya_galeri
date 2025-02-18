<?php
session_start();
include "connection.php";
if (isset($_SESSION['aghniya_username']) && isset($_SESSION['aghniya_role_id']) && $_SESSION['aghniya_role_id']== 1) {
    include "sidebar.php";

    $sql = mysqli_query($conn, "SELECT * FROM aghniya_user WHERE aghniya_verifikasi = 0");
    $total_data = mysqli_num_rows($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>

<?php 
    if (isset($_SESSION['aghniya_username'])) { ?>
        <div class="p-12 sm:ml-64">
            <div class="text-xl font-semibold mb-8 border border-blue-500 rounded-lg px-10 py-3 text-blue-500 bg-blue-100">
                You have <?=$total_data?> User Waiting for Your Verification ! 
            </div>

    <?php } else {
        echo '<div class="flex flex-col justify-center items-center min-h-screen bg-gray-50 dark:bg-gray-800 opacity-90">
        <div class="mb-3 font-semibold text-xl text-center bg-white bg-opacity-80 text-center p-6 rounded-lg border-2 border-red-800 shadow-lg w-1/4">
            You haven\'t logged in
        </div>
      
      <div class="flex justify-center items-center">
        <a href="login.php" class="hover:shadow-lg text-lg border-2 bg-white border-red-800 px-6 py-1 rounded-lg shadow-lg">Login Now</a>
      </div></div>';
    }
?>


<?php }else{ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>

<?php 
    if (isset($_SESSION['aghniya_username'])) { 
        include "sidebar.php";
        ?>
    
        <div class="p-12 sm:ml-64">
            <div class="text-xl text-center font-semibold mb-8">
                <?= $_SESSION['aghniya_username'] . "'s Page";
                ?>
            </div>
            <?php include "album.php";?>

    <?php } else {
        echo '<div class="flex flex-col justify-center items-center min-h-screen bg-gray-50 dark:bg-gray-800 opacity-90">
        <div class="mb-3 font-semibold text-xl text-center bg-white bg-opacity-80 text-center p-6 rounded-lg border-2 border-red-800 shadow-lg w-1/4">
            You haven\'t logged in
        </div>
      
      <div class="flex justify-center items-center">
        <a href="login.php" class="hover:shadow-lg text-lg border-2 bg-white border-red-800 px-6 py-1 rounded-lg shadow-lg">Login Now</a>
      </div></div>';
    }
?>

<?php } ?>
</body>
</html>