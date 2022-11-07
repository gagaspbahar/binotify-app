const submitForm = () => {
  const title = document.getElementById("input-title").value;

  const data = new FormData();
  data.append("id", album_id);
  data.append("judul", title);
  data.append("file", document.getElementById("input-file").files[0]);


  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../api/album/edit.php", true);
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
    if (this.status === 200) {
      alert("Edit album berhasil!");
      window.location.href = "/?album/detail/" + album_id;
    } else {
      console.log(this.responseText);
      alert("Edit album failed..");
    }
  };
  xhr.send(data);
};

const cancelForm = () => {
  window.location.href = "/?album/detail/" + album_id;
}

const getAlbumDetail = (id) => {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `../../api/album/detail.php?id=${id}`, true);
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
      let album = response;
      document.getElementById("input-title").value = album.judul;
      document.getElementById("album-img").src = album.image_path;
    } else {
      window.location = "../?404";
    }
  };
  xhr.send();
};
