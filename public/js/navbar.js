const navbar = (status = -1) => {
  if(status == 1){
    return `<ul><li><i class="fas fa-home"></i><a href='/?home'> Home </a></li>
    <li><i class="fas fa-search"></i><a href='/?search'> Search </a></li>
    <li><i class="fas fa-list"></i><a href='/?album'> Album </a></li>
    <hr class="rounded">
    <li><i class="fas fa-plus"></i><a href='/?album/add'> Add Album </a></li>
    <li><i class="fas fa-plus"></i><a href='/?song/add'> Add Song </a></li>
    <li><i class="fas fa-user"></i><a href='/?admin'> User List </a></li>  
    <li><a href='/api/auth/logout.php'> Log Out </a></li>
    <li><a id="universal-loading"></a></li></ul>  
    
    `
  } else if (status == 0){
    return `<ul><li><i class="fas fa-home"></i><a href='/?home'> Home </a></li>
    <li><i class="fas fa-search"></i><a href='/?search'> Search </a></li>
    <li><i class="fas fa-list"></i><a href='/?album'> Album </a></li>
    <hr class="rounded">
    <li><a href='/api/auth/logout.php'> Log Out </a></li>
    <li><a id="universal-loading"></a></li></ul>`
  } else {
    return `<ul><li><i class="fas fa-home"></i><a href='/?home'> Home </a></li>
    <li><i class="fas fa-search"></i><a href='/?search'> Search </a></li>
    <li><i class="fas fa-list"></i><a href='/?album'> Album </a></li>
    <hr class="rounded">
    <li><a href='/?login'> Log In </a></li>        
    <li><a href='/?register'> Register </a></li>
    <li><a id="universal-loading"></a></li></ul>`
  }
}

const addnavbar = (status = -1) => {
  document.getElementById("navbar").innerHTML = navbar(status);
}