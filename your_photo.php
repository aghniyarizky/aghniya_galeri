<?php
include 'connection.php';
session_start();
    if (isset($_SESSION['aghniya_username'])) {
        $user = $_SESSION['aghniya_username'];
        $userid = $_SESSION['aghniya_user_id'];
        include "sidebar.php";
    }

    $sql = mysqli_query($conn, "SELECT DISTINCT aghniya_foto.aghniya_foto_id, aghniya_foto.aghniya_lokasi_file, aghniya_user.aghniya_username
            FROM aghniya_foto
            LEFT JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
            WHERE aghniya_user.aghniya_username = '$user'
    ");

if (isset($_GET['filter'])) {
    $filter_kategori = $_GET['kategori']; 
    $filter_total = $_GET['total'];
    if ($filter_kategori == 'like') {
        $from = "aghniya_like_foto";
        $count_column = "COUNT(aghniya_like_id) AS count";
    } else {
        $from = "aghniya_komentar_foto";
        $count_column = "COUNT(aghniya_komentar_id) AS count"; 
    }

    $sql = mysqli_query($conn, "
        SELECT aghniya_foto.*, aghniya_user.aghniya_username
        FROM aghniya_foto
        LEFT JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
        LEFT JOIN (
            SELECT aghniya_foto_id, $count_column
            FROM $from
            GROUP BY aghniya_foto_id
        ) AS count_table ON aghniya_foto.aghniya_foto_id = count_table.aghniya_foto_id
         WHERE aghniya_user.aghniya_username = '$user'
        ORDER BY count_table.count $filter_total LIMIT 3
    ");
}
    if (isset($_GET['all'])) {
        unset($_GET['kategori']); 
        unset($_GET['total']); 

        $sql = mysqli_query($conn, "SELECT DISTINCT aghniya_foto.aghniya_foto_id, aghniya_foto.aghniya_lokasi_file, aghniya_user.aghniya_username
            FROM aghniya_foto
            LEFT JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
            WHERE aghniya_user.aghniya_username = '$user'
        ");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Photo</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="p-12 sm:ml-64">
        <div class="text-2xl font-semibold">My Photo</div> 

        <div class="py-4">
            <div class="text-lg justify-center content-center py-auto my-auto">
                Filter Berdasarkan:
            </div>
            <form action="your_photo.php" method="GET">
                <div class="w-full">
                    <div class="flex mt-3 gap-5 text-gray-800">
                        <div class="w-3/5">
                            <select name="kategori" class="border border-1 w-full px-2 py-2 mx-2 rounded-lg">
                                <option value="like" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'like') ? 'selected' : ''; ?>>Like</option>
                                <option value="comment" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'comment') ? 'selected' : ''; ?>>Comment</option>
                            </select>
                        </div>
                        <div class="w-3/5">
                            <select name="total" class="border border-1 w-full px-2 py-2 mx-2 rounded-lg">
                                <option value="DESC" <?php echo (isset($_GET['total']) && $_GET['total'] == 'DESC') ? 'selected' : ''; ?>>Terbanyak</option>
                                <option value="ASC" <?php echo (isset($_GET['total']) && $_GET['total'] == 'ASC') ? 'selected' : ''; ?>>Tersedikit</option>
                            </select>
                        </div>
                        <div class="w-1/5 flex">
                            <button type="submit" name="filter" class="border border-1 w-1/2 px-1 py-2 mx-2 rounded-lg bg-gray-800 text-white text-xs font-bold">Filter</button>
                            <button type="submit" name="all" class="border border-1 w-1/2 px-1 py-2 mx-2 rounded-lg bg-gray-800 text-white text-xs font-bold">All</button>
                        </div>
                    </div>
                </div>      
            </form>
        </div>

        <div class="flex flex-wrap gap-8 sm:gap-12 content-center justify-center my-14">
            <?php while($data = mysqli_fetch_array($sql)) { 
                $foto = $data['aghniya_foto_id'];
                $sql_likes = mysqli_query($conn, "SELECT aghniya_like_id FROM aghniya_like_foto WHERE aghniya_foto_id = $foto");
                $data_likes = mysqli_num_rows($sql_likes);

                $sql_comment = mysqli_query($conn, "SELECT aghniya_komentar_id FROM aghniya_komentar_foto WHERE aghniya_foto_id = $foto");
                $data_comment = mysqli_num_rows($sql_comment);

                $liked = mysqli_query($conn, "SELECT * FROM aghniya_like_foto WHERE aghniya_foto_id = $foto AND aghniya_user_id = $userid");
            ?>
                <a href="photo_detail_user.php?photo_id=<?=$data['aghniya_foto_id']?>" class="bg-gray-100 border border-2 p-2 xs:w-full sm:w-full md:w-1/3 lg:w-1/4 border-gray-200 rounded-lg shadow-md">
                    <div class="w-full border border-2 border-gray-200 border-opacity-80 h-48 rounded-lg">
                        <img src="<?=$data['aghniya_lokasi_file']?>" alt="" class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="flex">
                        <div class="w-1/3 justify-start my-auto">
                            <div class="text-sm font-semibold px-1 text-wrap">@<?=$data['aghniya_username']?></div>
                        </div>

                        <form action="cek_likes_user.php" method="POST" class="w-1/3">
                            <input type="hidden" value="<?=$data['aghniya_foto_id']?>" name="id_photo">
                            <input type="hidden" value="<?=$userid?>" name="id_user">
                            <input type="hidden" value="<?=$userid?>" name="id_user_photo">
                            <input type="hidden" value="your_photo.php?id_photo=<?=$data['aghniya_foto_id']?>" name="direction_path">

                            <div class="w-full mx-auto my-auto">
                                <div class="flex my-3 text-sm">
                                    <div class="w-1/2 my-auto">
                                        <button type="submit" name="likes" class="p-2">
                                            <?php
                                                if (mysqli_num_rows($liked) == 0 ){
                                            ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart text-sm" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                </svg>
                                            <?php } else { ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#990000" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                </svg>
                                            <?php } ?>
                                        </button>
                                    </div>
                                    <div class="w-1/2 mx-auto my-auto text-sm">
                                        <?=$data_likes?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="w-1/5 mx-auto my-auto">
                            <div class="flex my-3 mx-auto my-auto">
                                <div class="my-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </div>
                                <div class="ml-3 my-auto">
                                    <?=$data_comment?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>