<?php
include 'connection.php';
if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_username'];
    $user ? $_SESSION['aghniya_user_id'] : null;
}

$sql = mysqli_query($conn, "
    SELECT aghniya_album.*, COUNT(aghniya_foto.aghniya_foto_id) AS total_foto
    FROM aghniya_album 
    LEFT JOIN aghniya_user ON aghniya_album.aghniya_user_id = aghniya_user.aghniya_user_id
    LEFT JOIN aghniya_foto ON aghniya_foto.aghniya_album_id = aghniya_album.aghniya_album_id
    WHERE aghniya_user.aghniya_username = '$user'
    GROUP BY aghniya_album.aghniya_album_id 
");

$total_picts = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="flex flex-wrap gap-8 items-center justify-center content-center">
    <?php while($data = mysqli_fetch_assoc($sql)) { 
        $album_id = $data['aghniya_album_id'];
        $first_sql = mysqli_query($conn, "
            SELECT aghniya_lokasi_file 
            FROM aghniya_foto 
            WHERE aghniya_album_id = $album_id 
            ORDER BY aghniya_tanggal_unggah ASC 
            LIMIT 1
        ");
        
        $first_sql = mysqli_fetch_assoc($first_sql);
    ?>
        <div class="w-full sm:w-1/3 md:w-1/3 lg:w-1/4 p-1 transition-all duration-300 hover:transform hover:scale-105">
            <a href="album_detail.php?album_id=<?=$data['aghniya_album_id']?>">
                <div class="relative bg-black rounded-lg h-32 overflow-hidden hover:shadow-xl">
                    <?php if ($first_sql) { ?>
                        <img src="<?=$first_sql['aghniya_lokasi_file']?>" alt="" class="w-full h-full object-cover rounded-lg">
                    <?php } else { ?>
                        <img src="public/anonim.jpg" alt="No Image" class="w-full h-full object-cover rounded-lg">
                    <?php } ?>
                    <div class="absolute inset-0 bg-black opacity-50 rounded-lg"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-white">
                        <span class="text-lg"><?=str_replace(['.jpg', '.png', '.webp', '.svg'], '', $data['aghniya_nama_album']) ?></span>
                    </div>
                </div>
            </a>
                <div class="flex">
                    <div class="w-4/5 ml-1">
                        <a href="">
                            <div class="text-lg font-semibold mt-3"><?=$data['total_foto']?> picts</div>
                            <div class="text-sm font-light mt-1"><?=$data['aghniya_tanggal_dibuat']?></div>
                        </a>
                    </div>
                    <div class="w-1/5 mx-1 my-auto">
                        <a href="edit_album.php?album_id=<?=$data['aghniya_album_id']?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</body>
</html>