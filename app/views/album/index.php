<?php
    include_once 'app/core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title> Binotify </title>
        <link rel="stylesheet" href="../../../public/css/album.css" />
        <link rel="stylesheet" href="../../../public/css/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="../../../public/js/navbar.js"></script>
    </head>

    <body>
        <div class="main-container">
            <div class="homepage">
                <div class="side-navbar-container">
                   <img src="../../../public/img/logo.png" alt="" class="logo">
                   <nav class="navbar" id="navbar">
                        <script>
                            addnavbar(<?php echo (isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : -1);?>)
                        </script>
                    </nav>
                </div>

                <div class="albumpage-container">
                    <nav class="profile-navbar">
                        <h1 class="user"> Hello, <h2 class="username"><?php echo (isset($_SESSION['is_admin']) ? $_SESSION['username'] : "Guest");?> </h2> <i class="fa fa-user"></i> </h1>
                    </nav>

                    <div class="album-container">
                        <h1> Album Collections </h1>

                        <div class="grid-container">
                            <?php 
                                $db = new Database;
                                $query = "SELECT album_id, judul, penyanyi, image_path, extract(year from TANGGAL_TERBIT) AS TAHUN_TERBIT, genre FROM albums ORDER BY LOWER(JUDUL);";
                                $db->query($query);
                                $albums = $db->resultSet();
                                foreach ($albums as $album) {
                                    $album_id = $album['album_id'];
                                echo "
                                    <div class='grid-item'>
                                        <a class='detail' href='/?album/detail/$album[album_id]'>
                                            <div class='album-image'>
                                            <img src='../../../$album[image_path]'>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li class='album-title'>$album[judul]</li>
                                                    <li class='album-singer'>$album[penyanyi]</li>
                                                    <li class='album-year'>$album[tahun_terbit]</li>
                                                    <li class='album-genre'>$album[genre]</li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>";
                                }
                            ?>    
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </body>
</html>