<?php
    include_once 'app/core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title> Binotify </title>
        <link rel="stylesheet" href="../../../public/css/deletesongalbum.css" />
        <link rel="stylesheet" href="../../../public/css/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        
        <script src="../../../public/js/utility.js"></script>
        <script src="../../../public/js/removesong.js"></script>
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

                <div class="detailalbum-container">
                    <nav class="profile-navbar">
                        <h1 class="user"> Hello, <h2 class="username"><?php echo (isset($_SESSION['is_admin']) ? $_SESSION['username'] : "Guest");?> </h2> <i class="fa fa-user"></i> </h1>
                    </nav>
                    <a href="/?album/detail/<?php echo $data['id']; ?>" class="previous-button">&#8249;</a>
                    <div class="albuminfo-container">
                        <div class="album-photo">
                            <img class="album-img" src="../../../public/img/binomify-logo.png">
                        </div>
                        <div class="album-info">
                            <ul>
                                <li class='album'>ALBUM</li>
                                <li class='album-title'>Loading...</li>
                                <li class='album-artist'>Loading...</li>
                                <ul>
                                    <li class='album-year'>Loading...</li>
                                    <li class='album-genre'>Loading...</li>
                                    <li class='album-duration'>Loading...</li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="song-container">
                        <ul class="songlist">
                            <?php 
                                $album_id = $data['id'];
                                $db = new Database;
                                $query = "SELECT penyanyi FROM albums WHERE album_id = $album_id";
                                $db->query($query);
                                $penyanyi = $db->single();
                                $query2 = "select song_id, judul from songs where album_id is null and penyanyi = '" . $penyanyi['penyanyi'] . "'";
                                $db->query($query2);
                                $songs = $db->resultSet();
                                foreach ($songs as $song) {
                                    $song_id = $song['song_id'];
                                    echo "
                                    <li class='songlist-row' id='songlist-row-$song_id'>
                                        <div class='song-count'>
                                            <img class='play' src='../../../public/img/plus.svg' onclick='addSong($song_id, $album_id)' >
                                        </div>
                                        <div class='song-info'>
                                            <span class='song-title'>$song[judul]</span>
                                        </div>
                                    </li>
                                    ";
                                }
                                ?>     
                        </ul>
                    </div>
                    <div class="button-container">
                        <button class="done-button" type="button" onclick=done(<?php echo $data['id'] ?>) ">Done</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../../public/js/albumdetail.js"></script>
        <script>
            getAlbumDetail(<?php echo $data['id'] ?>);
        </script>
    </body>
</html>