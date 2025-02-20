<?php
include 'connection.php';
session_start();

    if (isset($_SESSION['aghniya_username'])) {
        $user = $_SESSION['aghniya_user_id'];
        // $user ? $_SESSION['aghniya_user_id'] : null;
        include "navbar.php";
    }

    $photoid = isset($_GET['id_photo']) ? $_GET['id_photo'] : null;

    $sql = mysqli_query($conn, "SELECT * FROM aghniya_foto JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id WHERE aghniya_foto.aghniya_foto_id = $photoid");

    $sql_likes = mysqli_query($conn, "SELECT aghniya_like_id FROM aghniya_like_foto WHERE aghniya_foto_id = $photoid");
    $data_likes = mysqli_num_rows($sql_likes);

    $sql_comment = mysqli_query($conn, "SELECT * FROM aghniya_komentar_foto LEFT JOIN aghniya_user ON aghniya_komentar_foto.aghniya_user_id = aghniya_user.aghniya_user_id WHERE aghniya_foto_id = $photoid");
    $data_comment = mysqli_num_rows($sql_comment);

// $total_likes = 0;
// $total_comments = 0;


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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <?php
    if (isset($_SESSION['aghniya_username'])) { ?>
        <div class="p-12">
            <div class="mx-auto max-w-4xl shadow-lg rounded-lg">
                <div class="border border-1 border-gray-800 rounded-xl mb-8">
                    <?php
                        while ($data = mysqli_fetch_assoc($sql)) {
                            $foto = $data['aghniya_foto_id'];
                            $liked = mysqli_query($conn, "SELECT * FROM aghniya_like_foto WHERE aghniya_foto_id = $foto AND aghniya_user_id = $user");
                            // $foto = $data['aghniya_komentar_id'];                            
                            // $total_likes += isset($data['aghniya_like_id']) ? 1 : 0;
                            // $total_comments += isset($data['aghniya_komentar_id']) ? 1 : 0;
                    ?>
                        <div class="flex justify-center gap-8">
                            <div class="w-1/2">
                                <img src="<?=$data['aghniya_lokasi_file']?>" alt="" class="h-full w-full object-cover rounded-tl-xl rounded-bl-lg">
                            </div>
                            <div class="w-1/2 my-5">
                                <div class="p-1 font-bold text-3xl mb-5">
                                    <?=$data['aghniya_judul_foto']?>
                                </div>
                                <div class="p-1 text-sm text-justify pr-8">
                                    <?=$data['aghniya_deskripsi_foto']?>
                                </div>
                                <div class="p-1 text-sm text-justify pr-8 font-semibold">
                                    <?=$data['aghniya_username']?>
                                </div>
                                
                                <form action="cek_likes.php" method="POST" name="like">
                                    <input type="hidden" value="<?=$data['aghniya_foto_id']?>" name="id_photo">
                                    <input type="hidden" value="<?=$user?>" name="id_user">
                                    <input type="hidden" value="<?=$data['aghniya_user_id']?>" name="id_user_photo">
                                    <input type="hidden" value="photo_detail.php?id_photo=<?=$photoid?>" name="direction_path">

                                    <div class="my-5 p-1 flex border border-gray-300 rounded-md mr-3">
                                        <div class="w-1/2">
                                            <div class="flex my-auto">
                                                <button type="submit" name="likes" class="p-2">
                                                    <?php
                                                        if (mysqli_num_rows($liked) == 0 ){
                                                    ?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                        </svg>

                                                    <?php } else { ?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#990000" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                        </svg>

                                                    <?php
                                                        }
                                                    ?>
                                                </button>
                                                <div class="ml-3 my-auto">
                                                    <?=$data_likes?>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                                    <div class="w-1/2">
                                        <div class="flex my-auto h-full">
                                            <div class="w-20 px-3 my-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                                    <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                                    <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
                                                </svg>
                                            </div>
                                            <div class="w-1/3 ml-3 my-auto">
                                            <?=$data_comment?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <fieldset class="border border-gray-300 rounded-md p-4 mr-3 shadow-lg h-auto flex flex-col text-sm">
                                    <legend class="text-md font-semibold text-gray-700 px-2">Comments</legend>
                                    <div class="flex-grow overflow-y-auto h-24">
                                        <?php
                                            while($comments = mysqli_fetch_array($sql_comment)){
                                        ?>
                                            <div class="flex justify-between">
                                                <div class="font-bold"><?=$comments['aghniya_username']?></div>
                                                <div class="ml-2 text-sm text-start w-2/3 break-words">
                                                    <?=$comments['aghniya_isi_komentar']?>
                                                </div>
                                                <div class="ml-2 text-xs"><?=timeAgo($comments['aghniya_tanggal_komentar'])?></div>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    </div>

                                    <form action="cek_comment.php" method="POST">
                                        <input type="hidden" value="<?=$data['aghniya_foto_id']?>" name="id_photo">
                                        <input type="hidden" value="<?=$user?>" name="id_user">                                        
                                        <input type="hidden" value="<?=$data['aghniya_user_id']?>" name="id_user_photo">
                                        <input type="hidden" value="photo_detail.php?id_photo=<?=$photoid?>" name="direction_path">

                                        <div class="flex gap-8 mt-2">
                                            <div class="w-5/6">
                                                <textarea name="comment_user" class="w-full border border-gray-300 rounded-lg p-2 text-xs" placeholder="Send Comment..."></textarea>
                                            </div>
                                            <div class="w-1/6">
                                                <button type="submit" name="submit" class="p-2 text-white bg-gray-800 hover:bg-gray-900 border rounded-lg shadow-lg hover:shadow-2xl">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            
            <div class="mt-36">
            <?php include "photo.php" ?>
            </div>
    <?php } ?>

    
</body>
</html>