<?php
include 'connection.php';
session_start();

if (isset($_SESSION['aghniya_username'])) {
    $user = $_SESSION['aghniya_username'];
    $userid = $_SESSION['aghniya_user_id'];
    include "sidebar.php";
}

// pagination
    $limit = 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $sql_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM aghniya_foto
        LEFT JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
        WHERE aghniya_user.aghniya_username = '$user'");

    $count_result = mysqli_fetch_assoc($sql_count);
    $total_records = $count_result['total'];
    $total_pages = ceil($total_records / $limit);

    $sql = mysqli_query($conn, "SELECT DISTINCT aghniya_foto.aghniya_foto_id, aghniya_foto.aghniya_lokasi_file, aghniya_user.aghniya_username
            FROM aghniya_foto
            LEFT JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
            WHERE aghniya_user.aghniya_username = '$user'
            LIMIT $limit OFFSET $offset");
            

//data all likes & comments
    //TOTAL ALL LIKES PUNYA USER
        $sql_total_likes_user = mysqli_query($conn, "
            SELECT COUNT(*) AS total_likes
            FROM aghniya_like_foto
            WHERE aghniya_foto_id IN (SELECT aghniya_foto_id FROM aghniya_foto WHERE aghniya_user_id = '$userid')
        ");
        $data_likes_user = mysqli_fetch_assoc($sql_total_likes_user);
        $total_likes_user = $data_likes_user['total_likes'];

    //TOTAL ALL COMMENTS PUNYA USER
        $sql_total_comments_user = mysqli_query($conn, "
            SELECT COUNT(aghniya_komentar_foto.aghniya_komentar_id) AS total_comments
            FROM aghniya_komentar_foto
            LEFT JOIN aghniya_foto ON aghniya_komentar_foto.aghniya_foto_id = aghniya_foto.aghniya_foto_id
            WHERE aghniya_foto.aghniya_user_id = '$userid'
        ");
        $data_comments_user = mysqli_fetch_assoc($sql_total_comments_user);
        $total_comments_user = $data_comments_user['total_comments'];


//filter 
    if (isset($_GET['filter'])) {
        $filter_album = $_GET['album'];

        $album_query = mysqli_query($conn, "SELECT aghniya_nama_album FROM aghniya_album WHERE aghniya_album_id = '$filter_album'");

        if (!$album_query) {
            die("Query gagal: " . mysqli_error($conn));
        }

        // $album_get = mysqli_fetch_assoc($album_query);
        // var_dump($album_get);

        $foto_query = mysqli_query($conn, "SELECT * FROM aghniya_foto WHERE aghniya_album_id = '$filter_album'");

        if (!$foto_query) {
            die("Query gagal: " . mysqli_error($conn));
        }

        $foto_get = mysqli_fetch_assoc($foto_query);
        $jum_foto = mysqli_num_rows($foto_query);
        // var_dump($foto_get);

        
        //total likes
            $sql_likes_album = mysqli_query($conn, "
                SELECT COUNT(*) as total_likes
                FROM aghniya_like_foto
                WHERE aghniya_foto_id IN (SELECT aghniya_foto_id FROM aghniya_foto WHERE aghniya_album_id = '$filter_album')
            ");
            $data_likes_album = mysqli_fetch_assoc($sql_likes_album);
            $total_likes_album = $data_likes_album['total_likes'];

        //total comment 
            $sql_total_comments_album = mysqli_query($conn, "
                SELECT COUNT(aghniya_komentar_foto.aghniya_komentar_id) AS total_comments
                FROM aghniya_komentar_foto
                LEFT JOIN aghniya_foto ON aghniya_komentar_foto.aghniya_foto_id = aghniya_foto.aghniya_foto_id
                WHERE aghniya_foto.aghniya_album_id = '$filter_album'
            ");
            $data_comments_album = mysqli_fetch_assoc($sql_total_comments_album);
            $total_comments_album = $data_comments_album['total_comments'];

            $sql = mysqli_query($conn, "
                SELECT aghniya_foto.*, aghniya_user.aghniya_username
                FROM aghniya_foto
                LEFT JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
                LEFT JOIN aghniya_album ON aghniya_foto.aghniya_album_id = aghniya_album.aghniya_album_id
                WHERE aghniya_user.aghniya_username = '$user' AND (aghniya_album.aghniya_album_id = '$filter_album' OR '$filter_album' IS NULL)
                LIMIT $limit OFFSET $offset
        ");
    } else {
        $sql = mysqli_query($conn, "SELECT DISTINCT aghniya_foto.aghniya_foto_id, aghniya_foto.aghniya_lokasi_file, aghniya_user.aghniya_username
            FROM aghniya_foto
            LEFT JOIN aghniya_user ON aghniya_foto.aghniya_user_id = aghniya_user.aghniya_user_id
            WHERE aghniya_user.aghniya_username = '$user'
            LIMIT $limit OFFSET $offset
        ");
    }

// all
    if (isset($_GET['all'])) {
        unset($_GET['album']);
        
        $album_query = mysqli_query($conn, "SELECT aghniya_nama_album, aghniya_album_id FROM aghniya_album WHERE aghniya_user_id = $userid");
        if (!$album_query) {
            die("Query gagal: " . mysqli_error($conn));
        }

        $albums = [];
        while ($data = mysqli_fetch_assoc($album_query)) {
            $albums[] = $data;
        }

        $total_likes_all = 0;
        $total_comments_all = 0;

        if (!empty($albums)) {
            foreach ($albums as $album_data) {
                $id_alb = $album_data['aghniya_album_id'];
                $nama_album = $album_data['aghniya_nama_album'];

                $sql_likes_album = mysqli_query($conn, "
                    SELECT COUNT(aghniya_like_foto.aghniya_foto_id) AS total_likes
                    FROM aghniya_like_foto
                    LEFT JOIN aghniya_foto ON aghniya_like_foto.aghniya_foto_id = aghniya_foto.aghniya_foto_id
                    WHERE aghniya_foto.aghniya_album_id = $id_alb
                ");
                $data_likes_album = mysqli_fetch_assoc($sql_likes_album);
                $total_likes_album = $data_likes_album['total_likes'];

                $sql_total_comments_album = mysqli_query($conn, "
                    SELECT COUNT(aghniya_komentar_foto.aghniya_komentar_id) AS total_comments
                    FROM aghniya_komentar_foto
                    LEFT JOIN aghniya_foto ON aghniya_komentar_foto.aghniya_foto_id = aghniya_foto.aghniya_foto_id
                    WHERE aghniya_foto.aghniya_album_id = $id_alb
                ");
                $data_comments_album = mysqli_fetch_assoc($sql_total_comments_album);
                $total_comments_album = $data_comments_album['total_comments'];

                
                $total_likes_all += $total_likes_album;
                $total_comments_all += $total_comments_album;
            }
        } else {
            echo "Tidak ada album yang ditemukan.";
        }
    }

// data album dropdown
    $albums = mysqli_query($conn, "SELECT aghniya_album_id, aghniya_nama_album FROM aghniya_album WHERE aghniya_user_id = $userid");

// data user
    $sql_user = mysqli_query($conn, "SELECT * FROM aghniya_user WHERE aghniya_user_id = $userid");
    $data_user = mysqli_fetch_assoc($sql_user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link href="./src/output.css" rel="stylesheet">
    <style>
        @media print {
            #default-sidebar {
                display: none;
            }

            #report {
                width: 100%;
                margin-left: 0;
            }

            #filter_album{
                display: none;
            }

            #pagination_report {
                display: none;
            }

            #print_info {
                display: block;
                margin-top: 5%;
            }

            #title_report {
                display: none;
                text-align: center;
            }

            #kop_surat {
                font-size: small;
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
    <div class="p-12 sm:ml-64" id="report">
        <div class="text-2xl font-semibold" id="title_report">Report</div>

        <div class="py-4" id="filter_album">
            <div class="text-lg justify-center content-center py-auto my-auto">
                Filter Berdasarkan Album:
                
            </div>
            <form action="report_user.php" method="GET">
                <div class="w-full">
                    <div class="flex mt-3 gap-5 text-gray-800">
                        <div class="w-3/5">
                            <select name="album" class="border border-1 w-full px-2 py-2 mx-2 rounded-lg">
                                <!-- <option value="all" <?php echo !isset($_GET['album']) ? 'selected' : ''; ?>>Semua Album</option> -->
                                <?php while ($album = mysqli_fetch_assoc($albums)) { ?>
                                    <option value="<?=$album['aghniya_album_id']?>" <?php echo (isset($_GET['album']) && $_GET['album'] == $album['aghniya_album_id']) ? 'selected' : ''; ?>><?=$album['aghniya_nama_album']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w-1/2 lg:w-1/2 flex">
                            <button type="submit" name="filter" class="border border-1 w-1/2 px-1 py-2 mx-2 rounded-lg bg-gray-800 text-white text-xs font-bold">Filter</button>
                            <button type="submit" name="all" class="border border-1 w-1/2 px-1 py-2 mx-2 rounded-lg bg-gray-800 text-white text-xs font-bold">All</button>
                            <button type="button"  onclick="printPage()" name="cetak" class="border border-1 w-1/2 px-1 py-2 mx-2 rounded-lg bg-gray-800 text-white text-xs font-bold">Cetak</button>
                        </div>
                    </div>
                </div>      
            </form>
        </div>

        <!-- <div class="flex flex-wrap gap-8 sm:gap-12 content-center justify-center my-10">
            <?php while($data = mysqli_fetch_array($sql)) { 
                $foto = $data['aghniya_foto_id'];
                $sql_likes = mysqli_query($conn, "SELECT aghniya_like_id FROM aghniya_like_foto WHERE aghniya_foto_id = $foto");
                $data_likes = mysqli_num_rows($sql_likes);

                $sql_comment = mysqli_query($conn, "SELECT aghniya_komentar_id FROM aghniya_komentar_foto WHERE aghniya_foto_id = $foto");
                $data_comment = mysqli_num_rows($sql_comment);

                $liked = mysqli_query($conn, "SELECT * FROM aghniya_like_foto WHERE aghniya_foto_id = $foto AND aghniya_user_id = $userid");
            ?>
                <a href="photo_detail_user.php?photo_id=<?=$data['aghniya_foto_id']?>" class="bg-gray-100 border border-2 p-2 xs:w-full sm:w-1/3 md:w-1/3 lg:w-1/4 border-gray-200 rounded-lg shadow-md">
                    <div class="w-full border border-2 border-gray-200 border-opacity-80 h-48 rounded-lg">
                        <img src="<?=$data['aghniya_lokasi_file']?>" alt="" class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="flex">
                        <div class="w-1/3 justify-start my-auto">
                            <div class="text-sm font-semibold px-1 text-wrap"><?=$data['aghniya_username']?></div>
                        </div>

                        <form action="cek_likes_user.php" method="POST" class="w-1/3">
                            <input type ="hidden" value="<?=$data['aghniya_foto_id']?>" name="id_photo">
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
        </div> -->

        <div class="mt-9" id="kop_surat">
            <div class="flex content-center justify-center items-center">
                <div class="flex-row content-center justify-center items-center" style="width:100px">
                    <div class="text-center font-semibold">
                        <div class="px-auto text-center flex content-center justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                            </svg>
                        </div>
                        Aghniya Picts
                    </div>
                </div>
                <div class="flex-row text-center" style="margin-left:25px">
                    <div class="font-bold text-lg">AGHNIYA PICTS GALLERY</div>
                    <div class="">Jl. Apel Km. 4 No. 11 Kel. Baros Kec. Cimahi Tengah</div>
                    <div class="">Telp/Fax: (022)102205834 E-mail: aghniyapictsgallery@yahoo.com Kota Cimahi 40521</div>
                </div>
                
            </div>
            <hr class="mt-3 mb-7" style="border-top: 0.5px solid black;">


            <div class="font-bold text-lg justify-center content-center flex"> LAPORAN DATA ALBUM </div>
                <table class="mt-4">
                    <tr>
                        <td class="px-3 py-1">Username</td>
                        <td class="px-3 py-1">:</td>
                        <td class="px-3 py-1"><?=$user?></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1">Nama Lengkap</td>
                        <td class="px-3 py-1">:</td>
                        <td class="px-3 py-1"><?=$data_user['aghniya_nama_lengkap']?></td>
                    </tr>

                </table>
        </div>

        <div id="print_info" style="display: <?= isset($_GET['album']) ? 'block' : 'none'; ?>;">
            <!-- <div class="text-lg font-semibold my-4" id="data">Data Album</div> -->
            <div class="text-md font-semibold mt-6 p-5">
                <table class="border border-3 border-black w-full">
                    <tr>
                        <th class="w-1/3 border p-3">Nama Album</th>
                        <th class="w-1/3 border p-3">Jumlah Like</th>
                        <th class="w-1/3 border p-3">Jumlah Komentar</th>
                    </tr>
                    <?php while ($album_get = mysqli_fetch_assoc($album_query)) { ?>
                    <tr>
                        <td class="text-center border p-2"><?=$album_get['aghniya_nama_album']?></td>
                        <td class="text-center border p-2"><?=$total_likes_album?></td>
                        <td class="text-center border p-2"><?=$total_comments_album?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <div id="print_info" style="display: <?= isset($_GET['album']) ? 'none' : 'block'; ?>;">
            <!-- <div class="text-lg font-semibold my-4" id="data">Data Album</div> -->
            <div class="text-md font-semibold mt-6 p-5">
                <table class="border border-3 border-black w-full">
                    <tr>
                        <th class="w-1/3 border p-3">Nama Album</th>
                        <th class="w-1/3 border p-3">Jumlah Like</th>
                        <th class="w-1/3 border p-3">Jumlah Komentar</th>
                    </tr>

                    <?php
                    $total_likes_all = 0;
                    $total_comments_all = 0;

                    if (!empty($albums)) {
                        foreach ($albums as $album_get) {
                            $id_alb = $album_get['aghniya_album_id'];
                            $nama_album = $album_get['aghniya_nama_album'];
                    
                            $sql_likes_album = mysqli_query($conn, "
                                SELECT COUNT(aghniya_like_foto.aghniya_foto_id) AS total_likes
                                FROM aghniya_like_foto
                                LEFT JOIN aghniya_foto ON aghniya_like_foto.aghniya_foto_id = aghniya_foto.aghniya_foto_id
                                WHERE aghniya_foto.aghniya_album_id = $id_alb
                            ");
                            $data_likes_album = mysqli_fetch_assoc($sql_likes_album);
                            $total_likes_album = $data_likes_album['total_likes'];
                    
                            $sql_total_comments_album = mysqli_query($conn, "
                                SELECT COUNT(aghniya_komentar_foto.aghniya_komentar_id) AS total_comments
                                FROM aghniya_komentar_foto
                                LEFT JOIN aghniya_foto ON aghniya_komentar_foto.aghniya_foto_id = aghniya_foto.aghniya_foto_id
                                WHERE aghniya_foto.aghniya_album_id = $id_alb
                            ");
                            $data_comments_album = mysqli_fetch_assoc($sql_total_comments_album);
                            $total_comments_album = $data_comments_album['total_comments'];    

                            $total_likes_all += $total_likes_album;
                            $total_comments_all += $total_comments_album;

                    ?>
                    <tr>
                        <td class="text-center border p-2"><?=$nama_album?></td>
                        <td class="text-center border p-2"><?=$total_likes_album?></td>
                        <td class="text-center border p-2"><?=$total_comments_album?></td>
                    </tr>
                    <?php 
                        }
                    ?>

                    <tr>
                        <td class="text-center border p-2">Total</td>
                        <td class="text-center border p-2"><?=$total_likes_all?></td>
                        <td class="text-center border p-2"><?=$total_comments_all?></td>
                    </tr>
                    <?php
                    } else {
                        echo "<tr><td colspan='3' class='text-center'>Tidak ada album yang ditemukan</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <div class="">
            <?php 
                date_default_timezone_set('Asia/Jakarta');
                $date = new DateTime();
                
                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                $formatter->setPattern('dd MMMM yyyy');
                
                $tanggal = $formatter->format($date);
            ?>
            <div class="flex justify-end mt-5 mx-2">
                <div class="w-1/3 mt-5">
                    <div class="text-center">Cimahi, <?=$tanggal?></div>
                    <div class="border-b w-full text-center" style="border-bottom: 0.5px solid black; margin-top:75px"><?=$data_user['aghniya_nama_lengkap']?></div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function printPage() {
        window.print();
    }
</script>

</body>
</html>