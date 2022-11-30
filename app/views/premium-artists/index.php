<?php
include_once 'app/core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Binotify </title>
    <link rel="stylesheet" href="../../../public/css/premiumartists.css" />
    <link rel="stylesheet" href="../../../public/css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../../../public/js/navbar.js"></script>
</head>

<body>
    <div class="main-contaner">
        <div class="homepage">
            <div class="side-navbar-container">
                <img src="../../../public/img/logo.png" alt="" class="logo">
                <nav id="navbar" class="navbar">
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

                    <h2 class="users-table">Premium Artists</h2>
                    <div class="table-container">
                        <div class="user-list">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Artists</th>
                                        <th></th>
                                    </tr>
                                </thead>
                               
                                <tbody id="artists-table-body">
                                    <tr>
                                        <td id="creator-id">1</td>
                                        <td id="susbcription-status">Artist 1</td>
                                        <!-- <td><button class="subscribe-btn">Subscribe</button></td> -->
                                    </tr>
                                </tbody>
                                
                                <!-- <tr id="subscription-status"></tr> -->

                                <?php
                                    $subscriber_id = $data['subscriber_id'];
                                    $db = new Database;
                                    $query = "SELECT * FROM subscription WHERE subscriber_id = " . $subscriber_id;
                                    $db->query($query);
                                    $subscriber = $db->resultSet();

                                    if($subscriber){
                                        foreach($subscriber as $sub){
                                            echo "<tr>";
                                            echo "<td>".$sub['creator_id']."</td>";
                                            echo "<td>".$sub['subscription_status']."</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td> No subscriptions </td>";
                                        echo "</tr>";
                                    }

                                    // foreach ($subscribers as $subscriber) {
                                    //     $status = $subscriber['status'];
                                    //     $creator_id = $subscriber['creator'];

                                    //     echo "
                                    //     <tr>
                                    //         <td>$creator_id</td>
                                    //         <td>$status</td>
                                    //     "

                                    // }
                                ?>
                                <!-- <tbody>
                                    <tr>
                                        <th id="artist-no">1</th>
                                        <th id="artist-name">Loading artists...</th>
                                        <th><button class="button subscribe-button">Subscribe</button></th>
                                    </tr>
                                </tbody> -->
                        
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../public/js/premiumartists.js"></script>
    <script>getPremiumArtistList()</script>
    <script>
        getSubscriptionStatus(<?php echo $data['subscriber_id'] ?>);
    </script>
</body>

</html>