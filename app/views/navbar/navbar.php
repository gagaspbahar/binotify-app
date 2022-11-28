<?php
    if(isset($_SESSION['is_admin'])){
        if ($_SESSION['is_admin'] == 1) {
            echo "
            <li><a href='/?home'> Home </a></li>
            <li><a href='/?search'> Search </a></li>
            <li><a href='/?album'> Album </a></li>
            <li><a href='/?addalbum'> Add Album </a></li>
            <li><a href='/?addsong'> Add Lagu </a></li>
            <li><a href='/?admin'> User List </a></li>
            <li><a href='/?premiumartists'> Premium Artists</a></li>    
            <li><a href='/api/auth/logout.php'> Log Out </a></li>  
            ";
    } else {
        echo "
        <li><a href='/?home'> Home </a></li>
        <li><a href='/?search'> Search </a></li>
        <li><a href='/?album'> Album </a></li>
        <li><a href='/?premiumartists'> Premium Artists</a></li>  
        <li><a href='/api/auth/logout.php'> Log Out </a></li>       
        ";
    }
} else {
    echo "
        <li><a href='/?home'> Home </a></li>
        <li><a href='/?search'> Search </a></li>
        <li><a href='/?album'> Album </a></li>
        <li><a href='/?login'> Log In </a></li>        
        <li><a href='/?register'> Register </a></li>  
    ";
}
?>