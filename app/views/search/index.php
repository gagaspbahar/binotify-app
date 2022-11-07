<?php
    include_once 'app/core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title> Binotify </title>
        <link rel="stylesheet" href="../../../public/css/search.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../../../public/js/utility.js"></script>
        <script src="../../../public/js/search.js"></script>
        <script src="../../../public/js/navbar.js"></script>
    </head>

    <body>
        <script>
            searchSong("<?php echo $data['path'] ?>");
        </script>

        <div class="main-contaner">
            <div class="homepage">
                <div class="side-navbar-container">
                    <img src="../../../public/img/logo.png" alt="" class="logo">
                    <nav class="navbar" id="navbar">
                        <script>
                            addnavbar(<?php echo (isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : -1);?>)
                        </script>
                    </nav>
                </div>

                <div class="homepage-container">
                  <nav class="profile-navbar">
                    <div class="searchbar-container">
                        <div class="search-box">
                            <input type="text" class="searchTerm "id="search-input" placeholder="What do you want to listen to?"> </input>
                            <button type="submit" class="search-button" onclick=searchSong()><i class="fa fa-search"></i></button>
                        </div>
                    </div>

                    <div class="username-container">
                        <h1 class="user"> Hello, <h2 class="username"><?php echo (isset($_SESSION['is_admin']) ? $_SESSION['username'] : "Guest");?> </h2> <i class="fa fa-user"></i> </h1>
                    </div>
                        <!-- <a href="album.html" class="user"> Hello, </a> -->
                  </nav>

                    <div class="song-container">
                        <h1> Good Afternoon </h1>
                        <div class="select">
                            <select name="filter" id="filter" onchange=searchSong()>
                                <option value="Pop">Pop</option>
                                <option value="Jazz">Jazz</option>
                                <option value="RnB">RnB</option>
                                <option value="Rock">Rock</option>
                                <option value="Soul">Soul</option>
                                <option value="Classic">Classic</option>
                                <option value="Contemporary">Contemporary</option>
                                <option value="Country">Country</option>
                                <option value="KPop">KPop</option>
                                <option value="" selected>Filter Genre</option>
                            </select>

                        </div>

                        <div class="select sort">
                            <select name="sort" id="sort" onchange=searchSong()>
                            <option value="">Sort By</option>
                            <option value="_judul">Title Asc</option>
                            <option value="-judul">Title Desc</option>
                            <option value="_tanggal_terbit"> Date Asc</option>
                            <option value="-tanggal_terbit">Date Desc</option>
                            </select>
                        </div>
                
                        <!-- KODE AJAIB -->
                        <!-- <input type="text" id="page"></input> -->
                        <!-- END OF KODE AJAIB -->

                        <br>
                        <button class="previous-button" type="button" onclick=prevPage()><i class="fa fa-angle-left"></i></button>
                        <button type="button" class="next-button" onclick=nextPage()><i class="fa fa-angle-right"></i></button>
                        
                        <li class='songlist-header'>
                          <div class='song-count'>
                              <span class='song-number'> # </span>
                          </div>

                          <div class='song-info'>
                              <span class='song-title'> Title </span>
                          </div>

                          <div class='song-releasedate'>
                              <span class='release-date'>Date</span>
                          </div>

                          <div class='song-genre'>
                              <span class='genre'>Genre</span>
                          </div>

                          <div class='trackOptions'>
                              <!-- <img class='optionButton' src='../../../public/img/more.png'> -->
                          </div>
                        </li>

          
                        <div id="song-list"></div>

                        <!-- <h2 class="top-10-newest">Top 10</h2> -->




                        <div class="songlist-container">

                            <ul class="songlist">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>