<?php
    session_start();
    include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="w-full p-5">
        <div class="text-xl font-semibold mb-5">
            Hi <?= $_SESSION['aghniya_username'] ?> !
        </div>

        <div class="flex-4">
            <?php include "photo.php"; ?>
        </div>
    </div>
</body>
</html>