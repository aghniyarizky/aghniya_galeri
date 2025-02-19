<?php
include 'connection.php';
session_start();
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_username'];
    $userid =  $_SESSION['aghniya_user_id'];
    include "sidebar.php";
}
$sql = mysqli_query($conn, "SELECT * FROM aghniya_user WHERE aghniya_verifikasi = 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Verification</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="p-12 sm:ml-64">
        <div class="text-2xl font-semibold">User Verification</div> 
        <div class="overflow-x-auto">
            <table class="table-auto border border-2 border-gray-700 w-9/12 my-10 mx-auto shadow-lg">
                <thead>
                    <tr class="px-4 py-2 border-b border-gray-500">
                        <th class="px-4 py-2 border-r border-gray-500">Username</th>
                        <th class="px-4 py-2 border-r border-gray-500">E-mail</th>
                        <th class="px-4 py-2 border-r border-gray-500">Full Name</th>
                        <th class="px-4 py-2">Verification</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($data = mysqli_fetch_array($sql)) {      
                    ?>
                    <tr>
                        <td class="px-4 py-3 border-r border-gray-500"><?=$data['aghniya_username']?></td>
                        <td class="px-4 py-3 border-r border-gray-500"><?=$data['aghniya_email']?></td>
                        <td class="px-4 py-3 border-r border-gray-500"><?=$data['aghniya_nama_lengkap']?></td>
                        <td>
                            <form action="cek_verification.php" method="POST">
                                <input type="hidden" name="id_user" value="<?=$data['aghniya_user_id']?>">
                                <input type="hidden" name="username" value="<?=$data['aghniya_username']?>">
                                <label for="default-checkbox" class="flex items-center cursor-pointer">
                                <input type="submit" value="Verification" name="verif" class="px-4 py-2 mx-auto bg-blue-500 text-white text-sm font-semibold rounded">
                                <!-- <input id="default-checkbox" name="verif" type="submit" value="1" class="w-4 h-4 mx-auto flex content-center text-blue-600 bg-white border border-gray-500 rounded"></td> -->
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>

</body>
</html>