let playButton = document.querySelector(".play");
let pauseButton = document.querySelector(".pause");

let track = document.createElement("audio");
track.src = "../../../public/song/keshi - beside you.mp3";

function getParams() {
  let url = window.location.href;
  let urlSplit = url.split("/");
  let artistId = urlSplit[urlSplit.length - 1];
  return artistId;
}

const getPremiumSongs = (user_id, path) => {
  let artist_id = getParams().split("&")[0];
  window.history.replaceState("", "", "?premiumsongs/" + artist_id + path)
  let headerTitle = document.getElementById("header-title");

  const xhrArtist = new XMLHttpRequest();
  xhrArtist.open("GET", "http://localhost:8080/api/name/" + artist_id, true);
  xhrArtist.onload = function () {
    if (this.status == 200) {
      const artist = JSON.parse(this.responseText);
      headerTitle.innerText = "Songs by " + artist.data.name;
    }
  }
  xhrArtist.send()



  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "http://localhost:8080/api/artist/song/" +
      artist_id +
      "?user_id=" +
      user_id +
      path,
    true
  );
  try {
    document.getElementById("universal-loading").innerHTML = "Loading...";
  } catch {}

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
      let songs = response.data.songList;

      let songList = document.getElementById("songlist");

      songList.innerHTML = "";

      let count = 1;
      songs.forEach((song) => {
        track.src = "http://localhost:8080" + song.audio_path;
        songList.innerHTML += `
                <li class='songlist-row'>
                    <div class='song-count'>
                        <button class='controlButton play list' title='Play' onclick='
                        sp.setTrack("${track.src}", "${song.title}");
                        sp.play();'>
                            <img class='play' src='../../../public/img/play-white.png'>
                        </button>

                        <button class='controlButton pause list' title='Pause' onclick='sp.pause();'>
                            <img src='../../../public/img/pause-white.png'>
                        </button>
                        <span class='song-number'> ${count}</span>
                    </div>

                    <div class='song-info'>
                        
                        <span class='song-title'>${song.title}</span>
                        
                    </div>

                    <div class='trackOptions'>
                        <img class='optionButton' src='../../../public/img/more.png'>
                    </div>
                </li>
                `;
        count++;
      });
    } else {
      alert("Gagal mengambil data");
    }
  };
  xhr.send();
};

function getQueryVariable(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    if (decodeURIComponent(pair[0]) == variable) {
      return decodeURIComponent(pair[1]);
    }
  }
  console.log("Query variable %s not found", variable);
}

function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf("?") !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, "$1" + key + "=" + value + "$2");
  } else {
    return uri + separator + key + "=" + value;
  }
}

const prevPage = (id) => {
  let newPage = parseInt(getQueryVariable("page")) - 1;
  if (newPage == 0) {
    newPage = 1;
  }

  const link = updateQueryStringParameter(
    window.location.href,
    "page",
    newPage
  );

  getPremiumSongs(id, "&page" + link.split("&page")[1]);
};

const nextPage = (id) => {
  let newPage = parseInt(getQueryVariable("page")) + 1;
  if (newPage == 0) {
    newPage = 1;
  }

  const link = updateQueryStringParameter(
    window.location.href,
    "page",
    newPage
  );

  getPremiumSongs(id, "&page" + link.split("&page")[1]);
};

class SongPlayer {
  constructor() {
    this.currentlyPlaying;
    this.audio = document.createElement("audio");
    this.playButton = document.querySelector(".play");
    this.pauseButton = document.querySelector(".pause");
    this.currentStart = document.getElementById("currentStart");
    this.currentEnd = document.getElementById("currentEnd");
    this.currentEnd.innerText = "0:00";
    this.seek = document.getElementById("seek");
    this.title = document.getElementById("song-track-title");
  }

  setTrack(path, title) {
    this.currentlyPlaying = title;
    this.audio.src = path;
    this.title.innerText = title;

    this.audio.addEventListener("timeupdate", () => {
      let music_curr = this.audio.currentTime;
      let music_dur = this.audio.duration;

      let min = Math.floor(music_dur / 60);
      let sec = Math.floor(music_dur % 60);
      if (sec < 10) {
        sec = `0${sec}`;
      }
      
      min && sec ? (this.currentEnd.innerText = `${min}:${sec}`) : "0:00";

      let min1 = Math.floor(music_curr / 60);
      let sec1 = Math.floor(music_curr % 60);
      if (sec1 < 10) {
        sec1 = `0${sec1}`;
      }
      this.currentStart.innerText = `${min1}:${sec1}`;

      let progressbar = parseInt((this.audio.currentTime / this.audio.duration) * 100);
      this.seek.value = progressbar;
    });

    this.seek.addEventListener("change", () => {
      this.audio.currentTime = (this.seek.value * this.audio.duration) / 100;
    });
  }

  play() {
    this.audio.play();
    this.playButton.style.display = "none";
    this.pauseButton.style.display = "inline";
  }

  pause() {
    this.audio.pause();
    this.playButton.style.display = "inline";
    this.pauseButton.style.display = "none";
  }
}

const sp = new SongPlayer();