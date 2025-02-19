<?php 
    if (isset($_SESSION['aghniya_username'])) { 
?>
<?php if ($_SESSION['aghniya_role_id'] == 1){ ?>

<?php
include "connection.php";
if (isset($_SESSION['aghniya_username'])) {
    $users = $_SESSION['aghniya_user_id'];

    $verif = mysqli_query($conn, "SELECT * FROM aghniya_user WHERE aghniya_verifikasi = 0;");
    $total_verif = mysqli_num_rows($verif);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM6g0g5z5e5e5e5e5e5e5e5e5e5e5e5e5e5e5e" crossorigin="anonymous">
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="w-full bg-gray-800">
        <div class="flex text-white p-4">
            <div class="w-full md:w-3/12 flex md:mx-auto sm:mb-0 flex">
                <a href="index.php" class="flex items-center p-2 text-gray-900 dark:text-white group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                    </svg>
                    <span class="ms-3 font-bold text-xs sm:text-sm md:text-md">Aghniya Picts</span>
                </a>
            </div>
            <div class="sm:w-6/12 md:w-10/12 my-auto mx-5">
                <div class="w-full rounded-lg px-2 py-1 py-auto my-auto text-black"></div>
            </div>
            <div class="w-5/12 md:w-2/12 flex justify-center content-center mx-auto my-auto text-center">
                <div class="flex">
                    <div class="w-full mx-auto my-auto flex gap-3">
                        <div class="relative bottom-1 left-6">
                            <?php if (isset($_SESSION['aghniya_username']) && $total_verif > 0 ): ?>
                                <span class="inline-flex items-center justify-center w-2 h-2 p-2 text-xs text-white bg-red-700 rounded-full"><?=$total_verif?></span>
                            <?php endif; ?>
                        </div>
                            <a href="user_verification.php">
                                <svg xmlns="http://www.w3.org/2000/svg"class="w-6 h-6 md:h-8 md:w-8" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                                </svg>
                            </a>
                        
                        
                        <a href="user_page.php">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:h-8 md:w-8" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('user').addEventListener('click', function() {
        window.location.href = 'user_page.php'; 
    });
</script>
</body>
</html>

<?php } ?>


<?php if ($_SESSION['aghniya_role_id'] == 2){ ?>

<?php
include "connection.php";
if (isset($_SESSION['aghniya_username'])) {
    $users = $_SESSION['aghniya_user_id'];

    //udah BACA notifnya/belum
    $sql_not_read = mysqli_query($conn, "SELECT aghniya_notifikasi.*, aghniya_user.*, aghniya_komentar_foto.*, aghniya_like_foto.*
        FROM aghniya_notifikasi
        LEFT JOIN aghniya_komentar_foto ON aghniya_notifikasi.aghniya_komentar_id = aghniya_komentar_foto.aghniya_komentar_id
        LEFT JOIN aghniya_user ON aghniya_notifikasi.aghniya_user_id = aghniya_user.aghniya_user_id
        LEFT JOIN aghniya_like_foto ON aghniya_notifikasi.aghniya_like_id = aghniya_like_foto.aghniya_like_id
        WHERE aghniya_notifikasi.aghniya_user_photo_id = $users AND aghniya_notifikasi.is_read = 0;");

    $total_not_read = mysqli_num_rows($sql_not_read);

    //udah MUNCUL notifnya/belum
    $sql_not_notif = mysqli_query($conn, "SELECT aghniya_notifikasi.*, aghniya_user.*, aghniya_komentar_foto.*, aghniya_like_foto.*
        FROM aghniya_notifikasi
        LEFT JOIN aghniya_komentar_foto ON aghniya_notifikasi.aghniya_komentar_id = aghniya_komentar_foto.aghniya_komentar_id
        LEFT JOIN aghniya_user ON aghniya_notifikasi.aghniya_user_id = aghniya_user.aghniya_user_id
        LEFT JOIN aghniya_like_foto ON aghniya_notifikasi.aghniya_like_id = aghniya_like_foto.aghniya_like_id
        WHERE aghniya_notifikasi.aghniya_user_photo_id = $users AND aghniya_notifikasi.is_read = 0 AND aghniya_notifikasi.is_notif = 0");

    $total_not_notif = mysqli_num_rows($sql_not_notif);

    if ($total_not_notif > 0) {
        $data = mysqli_fetch_assoc($sql_not_notif);
        $username = $data['aghniya_username'];
        $comment = $data['aghniya_isi_komentar'];

        if ($data['aghniya_komentar_id']) {
            $message = "$username Commented on your post: $comment";
        } else if ($data['aghniya_like_id']) {
            $message = "$username Liked your post";
        }

        echo "<script>
            var result = confirm('$message. Do you want to open the notification right now?');
            if (result) {
                window.location.href = 'notification.php';
            }
        </script>";

        $id_notif = $data['aghniya_notifikasi_id'];
        $sql_update_notif = mysqli_query($conn, "UPDATE aghniya_notifikasi SET is_notif = 1 WHERE aghniya_notifikasi_id = $id_notif");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM6g0g5z5e5e5e5e5e5e5e5e5e5e5e5e5e5e5e" crossorigin="anonymous">
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="w-full bg-gray-800">
        <div class="flex text-white p-4">
            <div class="w-full md:w-3/12 flex md:mx-auto sm:mb-0 flex">
                <a href="index.php" class="flex items-center p-2 text-gray-900 dark:text-white group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                    </svg>
                    <span class="ms-3 font-bold text-xs sm:text-sm md:text-md">Aghniya Picts</span>
                </a>
            </div>
            <div class="sm:w-6/12 md:w-10/12 my-auto mx-5">
                <div class="w-full rounded-lg px-2 py-1 py-auto my-auto text-black"></div>
            </div>
            <div class="w-5/12 md:w-2/12 flex justify-center content-center mx-auto my-auto text-center">
                <div class="flex">
                    <div class="w-full mx-auto my-auto flex gap-3">
                        <div class="relative bottom-1 left-6">
                            <?php if (isset($_SESSION['aghniya_username'])): ?>
                                <span class="inline-flex items-center justify-center w-2 h-2 p-2 text-xs text-white bg-red-700 rounded-full"><?=$total_not_read?></span>
                            <?php endif; ?>
                        </div>
                            <a href="notification.php">
                                <svg xmlns="http://www.w3.org/2000/svg"class="w-6 h-6 md:h-8 md:w-8" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                                </svg>
                            </a>
                        
                        
                        <a href="user_page.php">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:h-8 md:w-8" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('user').addEventListener('click', function() {
        window.location.href = 'user_page.php'; 
    });
</script>
</body>
</html>

<?php } ?>
<?php }else{ ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM6g0g5z5e5e5e5e5e5e5e5e5e5e5e5e5e5e5e" crossorigin="anonymous">
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="w-full bg-gray-800">
        <div class="flex text-white p-4">
            <div class="w-full md:w-3/12 flex md:mx-auto sm:mb-0 flex">
                <a href="index.php" class="flex items-center p-2 text-gray-900 dark:text-white group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                    </svg>
                    <span class="ms-3 font-bold text-xs sm:text-sm md:text-md">Aghniya Picts</span>
                </a>
            </div>
            <div class="sm:w-6/12 md:w-10/12 my-auto mx-5">
                <div class="w-full rounded-lg px-2 py-1 py-auto my-auto text-black"></div>
            </div>
            <div class="w-5/12 md:w-2/12 flex justify-center content-center mx-auto my-auto text-center">
                <div class="flex">
                    <div class="w-full mx-auto my-auto flex gap-3">                        
                        <a href="user_page.php">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:h-8 md:w-8" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('user').addEventListener('click', function() {
        window.location.href = 'user_page.php'; 
    });
</script>
</body>
</html>
<?php } ?>