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
                        <h1> Premium Songs </h1>
                        <div class="songlist-container">

                            <ul class="songlist">
                                <li class='songlist-header'>
                                    <div class='song-count'>
                                        <span class='song-number'> # </span>
                                    </div>

                                    <div class='song-info'>
                                        <span class='song-title'> Title </span>
                                    </div>
                                </li>

                                <div id="songlist"></div>
                                <button class="previous-button" type="button" onclick=prevPage(<?php echo $_SESSION['user_id']?>)><i class="fa fa-angle-left"></i></button>
                                <button type="button" class="next-button" onclick=nextPage(<?php echo $_SESSION['user_id']?>)><i class="fa fa-angle-right"></i></button>

                            </ul>
                            
                        </div>
                        
                    </div>
                </div>
            </div>

            <div id="song-player-container">
                <div id="song-player-bar">
                    <div id="songplayer-left">
                        <div class="content">
                   
                            <div class="trackInfo">
                                <span class="trackName pointer">
                                    <p class="song-track-title" id="song-track-title"> No Song Chosen.. </p>
                                </span>
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

                                <button class="controlButton play" title="Play" onclick="sp.play();">
                                    <img src="../../../public/img/play.png" alt="Play">
                                </button>

                                <button class="controlButton pause" title="Pause" onclick="sp.pause();">
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

        <script src="../../../public/js/premsonglist.js"></script>
        <script>
            getAllPremiumSongs(<?php echo $_SESSION['user_id']?>, "<?php echo $data['path']?>");
        </script>
    </body>
</html>