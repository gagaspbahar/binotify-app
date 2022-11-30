let playButton = document.querySelector(".play");
let pauseButton = document.querySelector(".pause");

let track = document.createElement("audio");
track.src = "../../../public/song/keshi - beside you.mp3";

function playSong() {
    track.play();
    playButton.style.display = "none";
    pauseButton.style.display = "inline";
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

const getPremiumSongs = (artist_id, user_id) => {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost:8080/api/artist/song"+artist_id+"user_id="+user_id+"&page=1", true);
    // xhr.open("GET", "http://localhost:8080/api/artist/song/2?user_id=6&page=1", true);

    try {
        document.getElementById("universal-loading").innerHTML = "Loading...";
    } catch {

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
            let songs = response.data.songList;
            console.log(songs);

            let songList = document.getElementById("songlist");
            songList.innerHTML = "";

        

            let count = 1;
            songs.forEach((song) => {
                const xhr2 = new XMLHttpRequest();
                xhr2.open("GET", "http://localhost:8080"+song.audio_path, true);
                xhr2.onload = function () {
                    track.src = this.responseText;
                }
                xhr2.send();
                console.log(song.audio_path)
                console.log(song);
                songList.innerHTML += `
                <li class='songlist-row'>
                    <div class='song-count'>
                        <button class='controlButton play list' title='Play' onclick='playSong();'>
                            <img src='../../../public/img/play-white.png'>
                        </button>

                        <button class='controlButton pause list' title='Pause' onclick='pauseSong();'>
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
}
