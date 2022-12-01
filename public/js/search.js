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

const searchSong = (data = "") => {
  let base_url = "../../api/music/search.php?";
  let add_url = "";

  try {
    const title = document.getElementById("search-input").value;
    const sort = document.getElementById("sort").value;
    const filter = document.getElementById("filter").value;
    if (title.length > 0) {
      add_url += "judul=" + title;
    }
    if (sort.length > 0) {
      add_url += "&sort=" + sort;
    }
    if (filter.length > 0) {
      add_url += "&genre=" + filter;
    }
    if (page.length > 0) {
      add_url += "&page=" + page;
    } else {
      add_url += "&page=1";
    }
  } catch (e) {
    console.log(e);
  }

  const xhr = new XMLHttpRequest();

  if (data != "") {
    final_url = base_url + data;
    add_url = data;
  } else {
    final_url = base_url + add_url;
  }

  if (!final_url.includes("page=")) {
    final_url += "&page=1";
    add_url += "&page=1";
  }

  xhr.open("GET", final_url, true);
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
      let songList = document.getElementById("song-list");
      songList.innerHTML = "";
      window.history.pushState("", "", "/?search/" + add_url);
      let count = 1 + (parseInt(getQueryVariable("page")) - 1) * 5;
      if (response["status"] == "error") {
        songList.innerHTML = `<div class="bino-sed-container" id="bino-sed-container">
        <img
          src="../../../public/img/bino-sed.jpg"
          alt="logo"
          class="not-found-pic"
        />
        <p>Sorry, no more songs :(</p>
      </div>`;
      } else {
        response.forEach((song) => {
          songList.innerHTML += `
              <div class='songlist-row'>
                <div class='song-count'>
                    <a href='/?detailalbum'>
                        <img class='play' src='../../../public/img/play-white.png'>
                    </a>
                    <span class='song-number'> ${count}.</span>
                </div>
                <div class='song-image'>
                  <img class='songimage' src='../../../${song.image_path}'>
                </div>
  
                <div class='song-info'>
                  <span class='song-title'><a class='detail' href='/?song/${
                    song.song_id
                  }'>${song.judul}</a></span>
                  <span class='singer'>${song.penyanyi}</span>
                </div>
  
                <div class='song-releasedate'>
                    <span class='release-date'>${getReleaseDate(
                      song.tanggal_terbit
                    )}</span>
                </div>
  
                <div class='song-genre'>
                    <span class='genre'>${song.genre}</span>
                </div>
  
                <div class='trackOptions'>
                    <img class='optionButton' src='../../../public/img/more.png'>
                </div>
              </div>
            `;
          count++;
        });
      }
    }
  };
  xhr.send();
};

const prevPage = () => {
  let newPage = parseInt(getQueryVariable("page")) - 1;
  if (newPage == 0) {
    newPage = 1;
  }

  const link = updateQueryStringParameter(
    window.location.href,
    "page",
    newPage
  );

  searchSong(link.split("?")[1].split("/")[1]);
};

const nextPage = () => {
  let newPage = parseInt(getQueryVariable("page")) + 1;
  const link = updateQueryStringParameter(
    window.location.href,
    "page",
    newPage
  );
  searchSong(link.split("?")[1].split("/")[1]);
};
