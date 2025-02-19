
<?php
session_start();
include "connection.php";
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_user_id'];

    $sql = mysqli_query($conn, "SELECT aghniya_notifikasi.*, aghniya_user.*, aghniya_komentar_foto.*, aghniya_like_foto.*
        FROM aghniya_notifikasi
        LEFT JOIN aghniya_komentar_foto 
            ON aghniya_notifikasi.aghniya_komentar_id = aghniya_komentar_foto.aghniya_komentar_id
        LEFT JOIN aghniya_user ON aghniya_notifikasi.aghniya_user_id = aghniya_user.aghniya_user_id
        LEFT JOIN aghniya_like_foto ON aghniya_notifikasi.aghniya_like_id = aghniya_like_foto.aghniya_like_id
        WHERE aghniya_notifikasi.aghniya_user_photo_id = $user AND aghniya_notifikasi.is_read = 0;");

    $total = mysqli_num_rows($sql);

    if(isset($_POST['read'])){
        $sql_read = mysqli_query($conn, "UPDATE aghniya_notifikasi
        SET is_read = 1
        WHERE aghniya_user_photo_id = $user");
    }

    function timeAgo($timestamp) {
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
      
        $minutes      = round($seconds / 60);    
        $hours        = round($seconds / 3600);      
        $days         = round($seconds / 86400);     
        $weeks        = round($seconds / 604800);      
        $months       = round($seconds / 2629440);     
        $years        = round($seconds / 31553280); 
      
        if ($seconds <= 60) {
            return "Just Now";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "an hour ago";
            } else {
                return "$hours hours ago";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return "yesterday";
            } else {
                return "$days days ago";
            }
        } else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months months ago";
            }
        } else {
            if ($years == 1) {
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <?php 
        if (isset($_SESSION['aghniya_username'])) { 
        include "sidebar.php";
    ?>
    
        <div class="p-4 sm:p-12 sm:ml-64">
            <div class="text-2xl font-semibold mb-8">
                Notification
            </div>

            <?php if($total > 0): ?>
            <?php while ($data = mysqli_fetch_assoc($sql)){?>
                <div class="flex flex-col  text-normal border border-gray-300 rounded-lg px-4 py-2 mx-2 my-3 text-gray-500 bg-gray-100 break-words">
                    <div class="font-bold mr-3"><?=$data['aghniya_username']?></div>
                    <div class="mr-1">
                        <?php if($data['aghniya_komentar_id'] != 0 ): ?>
                            Commented on your post:
                            <div class="font-normal break-words">"<?=$data['aghniya_isi_komentar']?>"</div>
                        <?php elseif($data['aghniya_like_id'] != 0 ): ?>
                            Liked your post
                        <?php endif; ?>  
                    </div>
                    <div class="font-normal text-right w-full mt-2">
                        <div class="flex justify-between items-center">
                            <div class="text-sm font-semibold">
                                <?php 
                                if($data['aghniya_komentar_id'] != 0 && !empty($data['aghniya_tanggal_komentar'])) {
                                    echo timeAgo($data['aghniya_tanggal_komentar']);
                                } elseif($data['aghniya_like_id'] != 0 && !empty($data['aghniya_tanggal_like'])) {
                                    echo timeAgo($data['aghniya_tanggal_like']);
                                }
                                ?>   
                            </div>
                            <form action="cek_notification.php" method="POST">
                                <input type="hidden" name="id_notif" value="<?=$data['aghniya_notifikasi_id']?>">
                                <button type="submit" name="trash" id="trash" class="ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div> 
                </div>
            <?php } ?>

            <form action="notification.php" method="POST" class="mt-4">
                <button type="submit" name="read" class="underline hover:text-blue-700">mark as read</button>
            </form>

            <?php else: ?>
                <div class="flex text-normal border border-gray-300 rounded-lg px-4 py-2 mx-2 my-3 text-gray-500 bg-gray-100 break-words">You have 0 notification to read</div>
            <?php endif; ?>
        </div>

    <?php } else { 
        echo '<div class="flex flex-col justify-center items-center min-h-screen bg-gray-50 dark:bg-gray-800 opacity-90">
                    <div class="mb-3 font-semibold text-xl text-center bg-white bg-opacity-80 text-center p-6 rounded-lg border-2 border-red-800 shadow-lg w-3/4 md:w-1/4">
                        You haven\'t logged in
                    </div>
                
                <div class="flex justify-center items-center">
                    <a href="login.php" class="hover:shadow-lg text-lg border-2 bg-white border-red-800 px-6 py-1 rounded-lg shadow-lg">Login Now</a>
                </div>
            </div>';
    } ?>

</body>
</html>