<?php
include 'connection.php';
    if (!isset($_SESSION['first_load'])) {
        $_SESSION['first_load'] = true;
        $order_by = "ORDER BY RAND()";
    } else {
        $order_by = ""; 
    }

        $sql = mysqli_query($conn, "SELECT 
            aghniya_foto.aghniya_foto_id, 
            aghniya_foto.aghniya_lokasi_file, 
            aghniya_user.aghniya_username AS username,
            aghniya_user.aghniya_user_id,
            COUNT(aghniya_like_foto.aghniya_like_id) AS like_count,
            COUNT(aghniya_komentar_foto.aghniya_komentar_id) AS comment_count
            FROM 
                aghniya_foto
            LEFT JOIN 
                aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
            LEFT JOIN 
                aghniya_like_foto ON aghniya_foto.aghniya_foto_id = aghniya_like_foto.aghniya_foto_id
            LEFT JOIN 
                aghniya_komentar_foto ON aghniya_foto.aghniya_foto_id = aghniya_komentar_foto.aghniya_foto_id
            GROUP BY 
                aghniya_foto.aghniya_foto_id
            $order_by");

        $user = null;
        if (isset($_SESSION['aghniya_username'])) {
            $user = $_SESSION['aghniya_user_id'];
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
</head>
<body>
    <div class="w-full">
            <div class="flex flex-wrap sm:flex-row flex-col gap-5 sm:gap-12 content-center justify-center">
                <?php while($data = mysqli_fetch_array($sql)) { 
                    $foto = $data['aghniya_foto_id'];
                    $sql_likes = mysqli_query($conn, "SELECT aghniya_like_id FROM aghniya_like_foto WHERE aghniya_foto_id = $foto");
                    $data_likes = mysqli_num_rows($sql_likes);

                    $sql_comment = mysqli_query($conn, "SELECT aghniya_komentar_id FROM aghniya_komentar_foto WHERE aghniya_foto_id = $foto");
                    $data_comment = mysqli_num_rows($sql_comment);
                    
                    if($user){
                        $liked = mysqli_query($conn, "SELECT * FROM aghniya_like_foto WHERE aghniya_foto_id = $foto AND aghniya_user_id = $user");
                    }       
                ?>


                <?php if (isset($_SESSION['aghniya_username'])) { ?>
                <a href="photo_detail.php?id_photo=<?=$data['aghniya_foto_id']?>" class="bg-gray-100 border border-2 border-gray-200 p-2 w-3/5 sm:w-2/5 lg:w-1/5 rounded-lg shadow-md">
                <?php }else { ?>
                    <a href="login.php" class="bg-gray-100 border border-2 border-gray-200 p-2 rounded-lg shadow-md">
                <?php } ?>

                <!-- <div class="bg-gray-100 border border-2 border-gray-200 p-2 w-1/5 rounded-lg shadow-md"> -->
                    <div class="w-full border border-2 border-gray-300 border-opacity-80 h-48 rounded-lg">
                        <img src="<?=$data['aghniya_lokasi_file']?>" alt="" class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="flex">
                        <div class="w-1/3 justify-start my-auto">
                            <div class="text-sm font-semibold px-1 text-wrap"><?=$data['username']?></div>
                        </div>
                        <form action="<?php echo isset($_SESSION['aghniya_username']) ? 'cek_likes.php' : 'login.php'; ?>" method="POST" id="like" class="mx-auto my-auto w-1/3">
                            <input type="hidden" value="<?=$data['aghniya_foto_id']?>" name="id_photo">
                            <input type="hidden" value="<?=$user?>" name="id_user">
                            <input type="hidden" value="<?=$data['aghniya_user_id']?>" name="id_user_photo">
                            <input type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>" name="direction_path">


                            <div class="w-full mx-auto my-auto">
                                <div class="flex my-3 text-sm">
                                    <div class="w-1/2 my-auto">
                                        <?php if (isset($_SESSION['aghniya_username'])){ ?>
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
                                        <?php } else { ?>
                                            <button type="submit" name="likes" class="p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart text-sm" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                </svg>
                                            </button>
                                        <?php } ?>
                                    </div>
                                    <div class="w-1/2 mx-auto my-auto text-sm">
                                    <?=$data_likes?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="w-1/4 mx-auto my-auto">
                            <div class="flex my-3">
                                <div class="w-1/2 my-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat text-sm" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </div>
                                <div class="w-1/2 mx-auto my-auto text-sm">
                                <?=$data_comment?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                </a>
                <?php } ?>
            </div>
        </a>
    </div>
</body>
</html>