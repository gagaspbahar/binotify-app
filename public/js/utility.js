const getDuration = (length) => {
  let minutes = Math.floor(length / 60);
  let seconds = Math.floor(length - minutes * 60);
  return `${minutes}:${seconds}`;
};

const getReleaseDate = (date) => {
  let year = date.slice(0, 4);
  let month = date.slice(5, 7);
  let day = date.slice(8, 10);
  return `${day}-${month}-${year}`;
};

const getReleaseDateBuatYangBanyakMau = (date) => {
  let year = date.slice(0, 4);
  let month = date.slice(5, 7);
  let day = date.slice(8, 10);
  return `${year}-${month}-${day}`;
} 

const getReleaseYear = (date) => {
  let year = date.slice(0, 4);
  return `${year}`;
};

function getFancyTimeFormat(duration)
{   
    var hrs = ~~(duration / 3600);
    var mins = ~~((duration % 3600) / 60);
    var secs = ~~duration % 60;

    var ret = "";
    if (hrs > 0) {
        ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
    }
    ret += "" + mins + ":" + (secs < 10 ? "0" : "");
    ret += "" + secs;
    return ret;
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function setCookie(cname, cvalue, ex) {
  let expires = "expires="+ toString(ex);
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

const incrementGuestSongCount = () => {
  let guestSongCount = getCookie("GUEST");
  let expireCookie = getCookie("GUEST_EXPIRE")
  guestSongCount++
  setCookie("GUEST", guestSongCount, expireCookie);
}

const checkGuestSongCount = () => {
  let guestSongCount = getCookie("GUEST");
  let expireCookie = getCookie("GUEST_EXPIRE")
  if (guestSongCount >= 3){
    if (Math.floor(Date.now() / 1000) > expireCookie){
      let expiry = Math.floor(Date.now() / 1000) + 86400;
      setCookie("GUEST", 0, expiry);
      setCookie("GUEST_EXPIRE", expiry, expiry);
      return true;
    }
    alert("You have reached your maximum song play limit. Please register to continue listening to songs.");
    return false
  }
  return true
}

const decrementGuestSongCount = () => {
  let guestSongCount = getCookie("GUEST");
  let expireCookie = getCookie("GUEST_EXPIRE")
  guestSongCount--
  setCookie("GUEST", guestSongCount, expireCookie);
}