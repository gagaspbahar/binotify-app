const saveChanges = () => {
  console.log("kepanggil");
  const title = document.getElementById("input-title").value;
  const genre = document.getElementById("input-genre").value;
  const date = document.getElementById("input-date").value;

  const data = new FormData();
  data.append("id", song_id);
  data.append("judul", title);
  data.append("genre", genre);
  data.append("tanggal_terbit", date);
  data.append("file", document.getElementById("input-file-1").files[0]);

  for (var p of data) {
    let name = p[0];
    let value = p[1];

    console.log(name, value);
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../api/music/edit.php", true);
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
  xhr.onload = () => {
    if (xhr.status === 200) {
      console.log("success");
      window.location.href = "/?song/" + song_id;
      alert("Edit song sukses :D");
    } else {
      alert("EDIT song failed :(");
    }
  };
  xhr.send(data);
};

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
      document.getElementById("input-title").value = song.judul;
      document.getElementById("input-genre").value = song.genre;
      document.getElementById("input-date").value =
        getReleaseDateBuatYangBanyakMau(song.tanggal_terbit);
      document.getElementById("input-image").src = song.image_path;
    } else {
      window.location = "../?404";
    }
  };
  xhr.send();
};

const cancelEdit = () => {
  window.location.href = "/?song/" + song_id;
};

const deleteSong = () => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../api/music/delete.php", true);
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
  xhr.onload = () => {
    if (xhr.status === 200) {
      window.location.href = "/?home";
      alert("Delete song success :D");
    } else {
      alert("Delete song failed :(");
    }
  }
  const data = new FormData();
  data.append("id", song_id);
  xhr.send(data);
}