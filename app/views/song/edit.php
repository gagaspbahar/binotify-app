<?php
include_once 'app/core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Binotify </title>
    <link rel="stylesheet" href="../../../public/css/songdetail.css" />
    <link rel="stylesheet" href="../../../public/css/styles.css" />
    <!-- <link rel="stylesheet" href="../../../public/css/addsong.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        var song_id = '<?php echo $data['id']; ?>';
    </script>
    <script src="../../../public/js/utility.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../../../public/js/navbar.js"></script>

</head>

<body>
    <div class="main-contaner">
        <div class="homepage">
            <div class="side-navbar-container">
                <img src="../../../public/img/logo.png" alt="" class="logo">
                <nav class="navbar" id="navbar">
                    <script>
                        addnavbar(<?php echo (isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : -1); ?>)
                    </script>
                </nav>
            </div>

            <div class="homepage-container">
                <nav class="profile-navbar">
                <h1 class="user"> Hello, <h2 class="username"><?php echo (isset($_SESSION['is_admin']) ? $_SESSION['username'] : "Guest");?> </h2> <i class="fa fa-user"></i> </h1>
                </nav>

                <div class="song-container">
                    <div class="arr left">
                        <div></div>
                    </div>
                    <h1> Edit Song Details </h1>

                    <div class="songlist-container">

                        <div class='songlist-row'>
                            <!-- edit detail -->

                            <div class="column left">
                                <div class="song-image-detail">
                                    <img class='song-image' id='input-image' src='../../../public/img/binomify-logo.png'>
                                </div>
                            </div>

                            <div class="column right">

                                <div class='song-info'>
                                    <form action="javascript:;" submit="return saveChanges()" class="edit-form">
                                        <div class="song-details">
                                            <div class="input-box">
                                                <span class="details">Title</span>
                                                <input id="input-title" name="title" type="text" placeholder="Enter song title">
                                            </div>
                                            <div class="input-box">
                                                <span class="details">Release Date</span>
                                                <input id="input-date" name="release-date" type="date" placeholder="Enter song release date">
                                            </div>
                                            <div class="input-box filter" id="filter">
                                                <span class="details">Genre</span>
                                                <!-- <input id="input-genre" name="genre" type="text" placeholder="Enter song genre"> -->
                                                <select id="input-genre" name="genre">
                                                    <option value="Pop">Pop</option>
                                                    <option value="Jazz">Jazz</option>
                                                    <option value="RnB">RnB</option>
                                                    <option value="Rock">Rock</option>
                                                    <option value="Soul">Soul</option>
                                                    <option value="Classic">Classic</option>
                                                    <option value="Contemporary">Contemporary</option>
                                                    <option value="Country">Country</option>
                                                    <option value="KPop">KPop</option>
                                                    <option value="none" selected>select genre</option>
                                                </select>
                                            </div>
                                            <div class="input-box file-upload">
                                                <span class="details">Song Cover</span>
                                                <input id="input-file-1" name="file[]" type="file" class="upload-box" placeholder="Enter song cover">
                                            </div>
                                        </div>

                                    </form>

                                    <br><br>
                                    <div class="button">
                                        <button class="savechanges-button" onclick=saveChanges()>
                                            Save Changes
                                            <!-- <input type="submit" value="Add"> -->
                                        </button>
                                        <button class="cancel-button" onclick=cancelEdit()>
                                            cancel
                                            <!-- <input type="submit" value="Add"> -->
                                        </button>
                                    </div>
                                </div>

                                <div class="delete">
                                    <button onclick=deleteSong() class="delete-song"> Delete </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br><br><br><br>


                </div>
            </div>
        </div>

        <!-- <div id="song-player-container">
                <div id="song-player-bar">
                    <div id="songplayer-left">
                        <div class="content">
                            <span class="album-image">
                                <img id="song-album-image" src="../../../public/img/binomify-logo.png" alt="album" class="album-img">
                            </span>
                            <div class="trackInfo">
                                <span class="trackName pointer">
                                    <p class="song-track-title"
                                    > loading title..</p>
                                </span>
                                <span class="artistName pointer">
                                    <span class="song-track-artist"> loading artist..</span>
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

                                <button class="controlButton play" title="Play" onclick="playSong();">
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
        </div> -->
        <script src="../../../public/js/songedit.js"></script>
        <script>
            getSongDetail(<?php echo $data['id'] ?>);
        </script>
</body>

</html>