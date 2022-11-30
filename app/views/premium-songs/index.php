<?php
    include_once 'app/core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title> Binotify </title>
        <link rel="stylesheet" href="../../../public/css/premiumsong.css" />
        <!-- <link rel="stylesheet" href="../../../public/css/songdetail.css" /> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../../../public/js/utility.js"></script>
        <script src="../../../public/js/navbar.js"></script>
    </head>

    <body>
        <div class="main-contaner">
            <div class="homepage">
                <div class="side-navbar-container">
                    <img src="../../../public/img/logo.png" alt="" class="logo">
                    <nav id="navbar" class="navbar">
                            <!--
                            <li><i class="fas fa-home"></i><a href="/?home"> Home </a></li>
                            <li><i class="fas fa-search"></i><a href="/?search"> Search </a></li>
                            <li><i class="fas fa-list"></i><a href="/?album"> Album </a></li>
                            <hr class="rounded">
                            <li><a href="/?login"> Login </a></li>
                            <li><a href="/?register"> Sign Up </a></li>
                            -->
                            <script>
                                addnavbar(<?php echo (isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : -1);?>)
                            </script>
                    </nav>
                </div>

                <div class="homepage-container">
                    <nav class="profile-navbar">
                        <h1 class="user"> Hello, <h2 class="username"><?php echo (isset($_SESSION['is_admin']) ? $_SESSION['username'] : "Guest");?> </h2> <i class="fa fa-user"></i> </h1>
                    </nav>

                    <div class="song-container">
                        <h1 class="title"> Songs by Tulus </h1>

                        <div class="songlist-container">

                            <ul class="songlist">
                                <li class='songlist-header'>
                                    <div class='song-count'>
                                        <span class='song-number'> # </span>
                                    </div>

                                    <div class='song-info'>
                                        <span class='song-title'> Title </span>
                                    </div>

                                    <div class='song-releasedate'>
                                        <span class='release-date'>Duration</span>
                                    </div>

                                    <!-- <div class='song-genre'>
                                        <span class='genre'>Genre</span>
                                    </div> -->

                                    <div class='trackOptions'>
                                        <!-- <img class='optionButton' src='../../../public/img/more.png'> -->
                                    </div>
                                </li>
                                <?php 
                                    $db = new Database;
                                    $query = "SELECT * FROM (SELECT * FROM songs ORDER BY song_id DESC LIMIT 10)top ORDER BY LOWER(judul) ASC";
                                    $db->query($query);
                                    $songs = $db->resultSet();

                                    $count = 1;
                                    foreach ($songs as $song) {
                                        $song_id = $song['song_id'];
                                        $date = date("d/m/Y", strtotime($song['tanggal_terbit']));
                                        echo "  
                                            <li class='songlist-row'>
                                                <div class='song-count'>
                                                    
                                                    <button class='controlButton play list' title='Play' onclick='playSong();'>
                                                        <img src='../../../public/img/play-white.png'>
                                                    </button>

                                                    <button class='controlButton pause list' title='Pause' onclick='pauseSong();'>
                                                        <img src='../../../public/img/pause-white.png'>
                                                    </button>
                                                 
                                                    <span class='song-number'> $count</span>
                                                </div>
                
                                                <div class='song-info'>
                                                    
                                                    <span class='song-title'>$song[judul]</span>
                                                    
                                                </div>
                
                                                <div class='song-releasedate'>
                                                    <span class='release-date'>$date</span>
                                                </div>
                
                                                <div class='trackOptions'>
                                                    <img class='optionButton' src='../../../public/img/more.png'>
                                                </div>
                                            </li>";
                                        $count++;
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="song-player-container">
                <div id="song-player-bar">
                    <div id="songplayer-left">
                        <div class="content">
                            <!-- <span class="album-image">
                                <img id="song-album-image" src="../../../public/img/binomify-logo.png" alt="album" class="album-img">
                            </span> -->
                            <div class="trackInfo">
                                <span class="trackName pointer">
                                    <p class="song-track-title"> No Song Chosen.. </p>
                                </span>
                                <!-- <span class="artistName pointer">
                                    <span class="song-track-artist"> loading artist..</span>
                                </span> -->
                            </div>
                        </div>

                    </div>

                    <div id="songplayer-center">
                        <div class="content playerControls">
                            <div class="buttons">
                                <button class="controlButton shuffle" title="Shuffle" onclick="setShuffle();">
                                    <i class="fas fa-random"></i>
                                </button>

                                <button class="controlButton previous" title="Previous" onclick="previousSong();">
                                    <i class="fas fa-step-backward"></i>
                                </button>

                                <button class="controlButton play" title="Play" onclick="playSong(isGuest);">
                                    <img src="../../../public/img/play.png" alt="Play">
                                </button>

                                <button class="controlButton pause" title="Pause" onclick="pauseSong();">
                                    <img src="../../../public/img/pause.png" alt="Pause">
                                </button>

                                <button class="controlButton next" title="Next" onclick="nextSong();">
                                    <i class="fas fa-step-forward"></i>
                                </button>

                                <button class="controlButton repeat" title="Repeat" onclick="setRepeat();">
                                    <i class="fas fa-undo-alt"></i>
                                </button>
                            </div>

                            <div class="playbackBar">
                                <span class="progressTime current" id="currentStart">0.00</span>
                                <div class="progressBar">
                                    <input type="range" id="seek" class="progressBarBG" value="0" min="0" max="100">
                                </div>
                                <span class="progressTime end" id="currentEnd">0.00</span>
                            </div>
                        </div>
                    </div>

                    <div id="songplayer-right">
                        <div class="volumeBar">
                            <button class="controlButton volume" title="Volume" onclick="setMute();">
                                <i class="fas fa-volume-down"></i>
                            </button>
                            <div class="progressBar">
                                <div class="progressBarBG">
                                    <div class="progress"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../../../public/js/songdetail.js"></script>
        <script>
            getPremiumSongs(<?php echo $data['id']?>);
            // getSongDetail(<?php echo $data['id'] ?>);
        </script>
    </body>
</html>