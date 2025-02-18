<?php
// session_start();
    $users = $_SESSION['aghniya_user_id'];
    $sql = mysqli_query($conn, "SELECT aghniya_notifikasi.*, aghniya_user.*, aghniya_komentar_foto.*, aghniya_like_foto.*
        FROM aghniya_notifikasi
        LEFT JOIN aghniya_komentar_foto ON aghniya_notifikasi.aghniya_komentar_id = aghniya_komentar_foto.aghniya_komentar_id
        LEFT JOIN aghniya_user ON aghniya_notifikasi.aghniya_user_id = aghniya_user.aghniya_user_id
        LEFT JOIN aghniya_like_foto ON aghniya_notifikasi.aghniya_like_id = aghniya_like_foto.aghniya_like_id
        WHERE aghniya_notifikasi.aghniya_user_photo_id = $users AND aghniya_notifikasi.is_read = 0;");

    $total = mysqli_num_rows($sql);

    $sql2 = mysqli_query($conn, "SELECT aghniya_foto_profile FROM aghniya_user WHERE aghniya_user_id = $users");


    $verif = mysqli_query($conn, "SELECT * FROM aghniya_user WHERE aghniya_verifikasi = 0;");
    $total_verif = mysqli_num_rows($verif);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>

<!-- admin page -->
<?php if ($_SESSION['aghniya_role_id'] == 1){ ?>

    <button id="toggle-sidebar" data-drawer-target="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <div class="flex gap-1">
                <button class="text-white bg-gray-700 p-1 rounded-full w-1/6">
                    <div class="text-white bg-gray-700 p-2 rounded-full w-1/6" onclick="window.history.back();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                        </svg>
                    </div>
                </button>
                <button id="close-sidebar" data-drawer-target="default-sidebar" aria-controls="default-sidebar" type="button" class="sm:hidden block text-white bg-gray-700 p-1 rounded-full w-1/6">
                    <div class="text-white bg-gray-700 p-2 rounded-full w-1/6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                        </svg>
                    </div>
                </button>
            </div>
            <div class="my-5 text-white mb-8">
                <div class="flex items-center justify-center">
                    <div class="w-14 my-2">
                        <?php while ($data = mysqli_fetch_array($sql2)):
                            if ($data['aghniya_foto_profile'] == NULL): ?>
                                <img src="public/anonim.jpg" class="rounded-full" alt="">
                            <?php else: ?>
                                <img src="<?=$data['aghniya_foto_profile']?>" class="rounded-full w-14 h-14" alt="">   
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
                    <div class="my-1 text-center font-bold">
                        <?= $_SESSION['aghniya_username']?>
                    </div>
                    <div class="flex my-2 items-center justify-center content-center">
                        <a href="edit_profile.php" class="my-1 text-xs font-semibold  bg-blue-500 p-2 rounded-lg text-center w-1/3 hover:bg-blue-600 hover:shadow-2xl">edit profile</a>
                    </div>
            </div>
        <ul class="space-y-2 font-medium">
            <li>
                <li>
                    <a href="user_verification.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                        </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">User Verification</span>
                    <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full"><?=$total?></span> -->
                        <?php if($total_verif > 0 ): ?>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 text-sm font-medium text-white bg-red-700 rounded-full"><?=$total_verif?></span>
                        <?php endif; ?>
                    </a>
                </li>
                    <a href="report.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                        <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                        </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Report</span>
                    </a>
                </li>
            <li>
                <a id="logout" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
            
        </ul>
    </div>
    </aside>

<!-- user page -->
<?php }else{?>

    <button id="toggle-sidebar" data-drawer-target="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <div class="flex gap-1">
                <button class="text-white bg-gray-700 p-1 rounded-full w-1/6">
                    <div class="text-white bg-gray-700 p-2 rounded-full w-1/6" onclick="window.history.back();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                        </svg>
                    </div>
                </button>
                <button id="close-sidebar" data-drawer-target="default-sidebar" aria-controls="default-sidebar" type="button" class="sm:hidden block text-white bg-gray-700 p-1 rounded-full w-1/6">
                    <div class="text-white bg-gray-700 p-2 rounded-full w-1/6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                        </svg>
                    </div>
                </button>
            </div>
                <div class="my-5 text-white mb-8">
                    <div class="flex items-center justify-center">
                        <div class="w-14 my-2">
                                <?php while ($data = mysqli_fetch_array($sql2)):
                                    if ($data['aghniya_foto_profile'] == NULL): ?>
                                        <img src="public/anonim.jpg" class="rounded-full" alt="">
                                    <?php else: ?>
                                        <img src="<?=$data['aghniya_foto_profile']?>" class="rounded-full h-14 w-14" alt="">   
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="my-1 text-center font-bold">
                            <?= $_SESSION['aghniya_username']?>
                        </div>
                        <div class="flex my-2 items-center justify-center content-center">
                            <a href="edit_profile.php" class="my-1 text-xs font-semibold  bg-blue-500 p-2 rounded-lg text-center w-1/3 hover:bg-blue-600 hover:shadow-2xl">edit profile</a>
                        </div>
                </div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="your_photo.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
                        </svg>
                    <span class="ms-3">Your Photo</span>
                    </a>
                </li>
                <li>
                    <a href="add_photo.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Add Photo</span>
                    </a>
                </li>
                <li>
                    <a href="user_page.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
                        </svg>
                    <span class="ms-3">Your Album</span>
                    </a>
                </li>
                <li>
                    <a href="add_album.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Add Album</span>
                    </a>
                </li>
                <li>
                    <a href="notification.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                        </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Notification</span>
                    <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full"><?=$total?></span> -->
                        <?php if($total > 0 ): ?>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 text-sm font-medium text-white bg-red-700 rounded-full"><?=$total?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li>
                    <a id="logout" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                    </a>
                </li>
                <li class="absolute bottom-1 w-full pr-6">
                    <a href="index.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                        </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap"> Aghniya Picts</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
<?php } ?>
    <script>
        const toggleButton = document.getElementById('toggle-sidebar');
        const closeButton = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('default-sidebar');
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full'); 
        });

        closeButton.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full'); 
        });

        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
            });
        });

        document.getElementById('logout').addEventListener('click', function() {
            let choice = confirm('Are you sure to logout?');
            if (choice) {
                window.location.href = 'logout.php'; 
            } else {
                alert('Logout dibatalkan!');
            }
        });
    </script>


</body>
</html>