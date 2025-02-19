<?php
include 'connection.php';
session_start();
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_username'];
    $userid = $_SESSION['aghniya_user_id'];
    include "sidebar.php";
}

$album_id = isset($_GET['album_id']) ? $_GET['album_id'] : NULL;

if ($album_id) {
    // Mengambil data album
    $sql = mysqli_query($conn, "
        SELECT * FROM aghniya_album 
        LEFT JOIN aghniya_user ON aghniya_album.aghniya_user_id = aghniya_user.aghniya_user_id 
        WHERE aghniya_album.aghniya_album_id = $album_id
    ");
    $album_data = mysqli_fetch_assoc($sql);

    if ($album_data) {
        $perPage = 6;
        
        // Menghitung total foto dalam album
        $fotoCountQuery = mysqli_query($conn, "
            SELECT COUNT(*) as total FROM aghniya_foto 
            WHERE aghniya_album_id = $album_id AND aghniya_lokasi_file IS NOT NULL
        ");
        $fotoCount = mysqli_fetch_assoc($fotoCountQuery)['total'];
        
        $totalPages = ceil($fotoCount / $perPage);  // Total halaman foto

        // Mendapatkan halaman saat ini dari URL (default halaman pertama)
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $currentPage = ($currentPage > 0) ? $currentPage : 1;

        // Menghitung offset untuk query foto
        $start = ($currentPage - 1) * $perPage;

        // Mengambil foto berdasarkan album, dengan pagination
        $foto_data = mysqli_query($conn, "
            SELECT * FROM aghniya_foto 
            LEFT JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
            WHERE aghniya_album_id = $album_id AND aghniya_lokasi_file IS NOT NULL
            ORDER BY aghniya_foto.aghniya_tanggal_unggah DESC 
            LIMIT $start, $perPage
        ");
    }

    $dataArray = [];
    while ($data = mysqli_fetch_assoc($foto_data)) {
        $dataArray[] = $data;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="p-12 sm:ml-64">
        <div class="h-auto">
            <?php if ($album_data) { ?>
                <div class="my-5 text-white mb-12 my-24">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-2/3 my-2 items-center justify-center mx-auto">
                            <?php if (!empty($dataArray)){ ?>
                                <img class="rounded-full h-24 w-24 object-cover mx-auto mb-4" src="<?=$dataArray[0]['aghniya_lokasi_file']?>" alt="">
                            <?php }else{ ?>
                                <img class="rounded-full h-24 w-24 object-cover mx-auto mb-4" src="public/anonim.jpg" alt="">
                            <?php } ?>
                            <div class="text-lg text-black font-semibold text-center my-2"><?=$album_data['aghniya_nama_album']?></div>
                            <div class="text-light text-black text-center"><?=$album_data['aghniya_deskripsi']?></div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-8 sm:gap-12 content-center justify-center mt-9">
                    <?php if (empty($dataArray)){ ?>
                        <div class="text-center font-semibold text-xl text-gray-500">You have 0 picture in this album</div>
                    <?php }else{                             
                        foreach ($dataArray as $data){ 
                            $foto = $data['aghniya_foto_id'];
                            $sql_likes = mysqli_query($conn, "SELECT aghniya_like_id FROM aghniya_like_foto WHERE aghniya_foto_id = $foto");
                            $data_likes = mysqli_num_rows($sql_likes);
            
                            $sql_comment = mysqli_query($conn, "SELECT aghniya_komentar_id FROM aghniya_komentar_foto WHERE aghniya_foto_id = $foto");
                            $data_comment = mysqli_num_rows($sql_comment);
            
                            $liked = mysqli_query($conn, "SELECT * FROM aghniya_like_foto WHERE aghniya_foto_id = $foto AND aghniya_user_id = $userid");
            
                        ?>
                            <a href="photo_detail_user.php?photo_id=<?=$data['aghniya_foto_id']?>" class="bg-gray-100 border border-2 p-2 xs:w-full sm:w-full md:w-1/3 lg:w-1/4  border-gray-200 rounded-lg shadow-md">
                                <div class="w-full border border-2 border-gray-600 border-opacity-80 h-48 rounded-lg">
                                    <img src="<?=$data['aghniya_lokasi_file']?>" alt="" class="w-full h-full object-cover rounded-md">
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 mx-auto my-auto">
                                        <div class="text-sm font-semibold px-1 text-wrap"><?=$data['aghniya_username']?></div>
                                    </div>
                                    <form action="cek_likes_user.php" method="POST" id="like" class="w-1/3">
                                        <input type="hidden" value="<?=$data['aghniya_foto_id']?>" name="id_photo">
                                        <input type="hidden" value="<?=$userid?>" name="id_user">
                                        <input type="hidden" value="<?=$userid?>" name="id_user_photo">
                                        <input type="hidden" value="album_detail.php?album_id=<?=$album_id?>" name="direction_path">
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

                                                        <?php
                                                            }
                                                        ?>
                                                    </button>
                                                </div>
                                                <div class="w-1/2 mx-auto my-auto text-sm">
                                                    <?=$data_likes?>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="w-1/4 mx-auto my-auto">
                                        <div class="flex my-3">
                                            <div class="w-1/2 mx-auto my-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.36-2.8c.755-.331 2.076-.7 3.87-1.13C8.387 10.034 8 9.667 8 9c0-1.078-.562-2.042-1.421-2.717C6.42 6.619 7.531 6 9 6c.253 0 .487.027.717.08C9.536 4.235 7.597 3 5 3c-3.313 0-6 2.684-6 6s2.687 6 6 6c2.83 0 5.396-1.58 6.21-3.79-2.456-.53-3.801-.885-4.621-.7 1.538 2.467 4.271 4 7.66 4 3.657 0 6-2.807 6-6s-2.343-6-6-6"/>
                                                </svg>
                                            </div>
                                            <div class="w-1/2 mx-auto my-auto text-sm">
                                                <?=$data_comment?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } } ?>
                    </div>
                    <!-- Pagination Controls -->
                    <div class="flex justify-center mt-6">
                        <div class="flex gap-4">
                            <!-- Previous -->
                            <a href="album_detail.php?page=<?= max(1, $page - 1) ?>" 
                                class="<?= $page == 1 ? 'disabled' : '' ?> flex items-center justify-center px-3 h-8 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-xl hover:bg-gray-100 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-3 bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                                </svg>
                                Previous
                            </a>

                            <!-- Next -->
                            <a href="album_detail.php?page=<?= min($page + 1, $total_pages) ?>" 
                                class="<?= $page == $total_pages ? 'disabled' : '' ?> flex items-center justify-center px-3 h-8 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-xl hover:bg-gray-100 hover:text-gray-700">
                                Next
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ml-3 bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="text-center font-semibold text-xl text-gray-500">Album Not Found</div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
