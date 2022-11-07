const removeSong = (songId) => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../api/album/rmsong.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.status == 200) {
        alert("Song removed");
        document.getElementById("songlist-row-" + songId).remove();
      }
    }
  }

  const data = new FormData();
  data.append("id", songId);

  xhr.send(data);
}

const addSong = (songId, albumId) => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../api/album/addsong.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.status == 200) {
        alert("Song added");
        document.getElementById("songlist-row-" + songId).remove();
      }
    }
  }

  const data = new FormData();
  data.append("song_id", songId);
  data.append("album_id", albumId);

  xhr.send(data);
}

const done = (album_id) => {
  window.location.href = "/?album/detail/" + album_id;
}