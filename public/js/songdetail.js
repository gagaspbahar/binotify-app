let playButton = document.querySelector(".play");
let pauseButton = document.querySelector(".pause");

let track = document.createElement("audio");
track.src = "../../../public/song/keshi - beside you.mp3";

function playSong(isGuest) {
  if (isGuest && checkGuestSongCount()){
    if (track.currentTime == 0) {
      incrementGuestSongCount();
    }
    track.play();
    playButton.style.display = "none";
    pauseButton.style.display = "inline";
  } else if (!isGuest) {
    track.play();
    playButton.style.display = "none";
    pauseButton.style.display = "inline";
  } else {
    // Guest yg udah abis, do nothing
  }
}

function pauseSong() {
  track.pause();
  playButton.style.display = "inline";
  pauseButton.style.display = "none";
}

let currentStart = document.getElementById("currentStart");
let currentEnd = document.getElementById("currentEnd");
let seek = document.getElementById("seek");

track.addEventListener("timeupdate", () => {
  let music_curr = track.currentTime;
  let music_dur = track.duration;

  let min = Math.floor(music_dur / 60);
  let sec = Math.floor(music_dur % 60);
  if (sec < 10) {
    sec = `0${sec}`;
  }
  currentEnd.innerText = `${min}:${sec}`;

  let min1 = Math.floor(music_curr / 60);
  let sec1 = Math.floor(music_curr % 60);
  if (sec1 < 10) {
    sec1 = `0${sec1}`;
  }
  currentStart.innerText = `${min1}:${sec1}`;

  let progressbar = parseInt((track.currentTime / track.duration) * 100);
  seek.value = progressbar;
});

seek.addEventListener("change", () => {
  track.currentTime = (seek.value * track.duration) / 100;
});

const getSongDetail = (id) => {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `../../api/music/detail.php?id=${id}`, true);
  try {
    document.getElementById("universal-loading").innerHTML = "Loading...";
  } catch {
    // do na na
  }
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("universal-loading").innerHTML = "";
    } else {
      document.getElementById("universal-loading").innerHTML = "Loading...";
    }
  };
  xhr.onload = function () {
    if (this.status == 200) {
      let response = JSON.parse(this.responseText);
      let song = response;
      document.querySelector(".song-title").innerHTML = song.judul;
      document.querySelector(".song-track-title").innerHTML = song.judul;
      document.querySelector(".song-artist").innerHTML = song.penyanyi;
      document.querySelector(".song-track-artist").innerHTML = song.penyanyi;
      document.querySelector(".song-album").innerHTML += song.judul_album == "No Album" ? "No Album" : ("<a href='/?album/detail/" + song.album_id+ "'>" + song.judul_album + "</a>");
      document.querySelector(".genre").innerHTML = song.genre;
      document.querySelector(".duration").innerHTML = getDuration(song.duration);
      document.getElementById("song-release-date").innerHTML = getReleaseDate(song.tanggal_terbit);
      document.querySelector(".song-image").src = song.image_path;
      document.querySelector(".album-img").src = song.image_path;
      track.src = song.audio_path;
    }
    else {
      window.location = "../?404";
    }
  };
  xhr.send();
};