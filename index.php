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
    <div class="w-full p-6 md:p-12">
        <div class="sm:text-sm md:text-xl font-semibold mb-12">
            <?php if (isset($_SESSION['aghniya_username'])) { ?>
                Hi <?=$_SESSION['aghniya_username']?> ! <br>
                What would you like to see at this moment?
            <?php } else {
                echo "Let's begin now! What would you like to see at this moment?";
                }
                ?>
        </div>

        <div class="flex-4">
            <?php include "photo.php"; ?>
        </div>
    </div>
</body>
</html>