<?php
    include_once 'app/core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title> Binotify </title>
        <link rel="stylesheet" href="../../../public/css/editalbum.css" />
        <link rel="stylesheet" href="../../../public/css/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script type="text/javascript">
            var album_id = '<?php echo $data['id']; ?>';
        </script>
        <script src="../../../public/js/navbar.js"></script>
        <script src="../../../public/js/albumedit.js"></script>
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

                <div class="detail-album-container">
                    <nav class="profile-navbar">
                        <h1 class="user"> Hello, <h2 class="username"><?php echo (isset($_SESSION['is_admin']) ? $_SESSION['username'] : "Guest");?> </h2> <i class="fa fa-user"></i> </h1>
                    </nav>
                    <div class="album-info-container">
                        <div class="album-photo">
                            <img class="album-img" id="album-img" src="../../../public/img/binotify-mascot.svg">
                        </div>
                        <div class="album-info">
                            <form>
                                <div class="song-details">
                                    <div class="input-box">
                                        <span class="details">New Title</span>
                                        <input id="input-title" type="text" placeholder="Enter album title" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">New Album Cover</span>
                                        <input id="input-file" type="file" placeholder="Enter song cover" required>
                                    </div>
                                </div>
                                <div class="button-select">
                                    <div class="button save">
                                        <input type="button" value="Save changes" onclick=submitForm()>
                                    </div>
                                    <div class="button cancel">
                                        <button type="button" onclick=cancelForm()>Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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