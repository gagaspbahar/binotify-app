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

const getPremiumArtistList = (id) => {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost:8080/api/artist?page=1", true);

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
      let artists = response.data.artists;

      let artistList = document.getElementById("artists-table-body2");
      artistList.innerHTML = "";

      let count = 1;

      artists.forEach((artist) => {
        artistList.innerHTML += `
                    <tr>
                        <th id="artist-no">${count}</th>
                        <th id="artist-name">${artist.name}</th>
                        <th><button class="button subscribe-button" id="subscribe-button">Subscribe</button></th>
                    </tr>
                `;
        count++;
      });
    } else {
      alert("Gagal mengambil data");
    }
  };
  xhr.send();
  getSubscriptionStatus(id, page);
};

const updateSubscription = (id) => {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `../../api/subscription/check.php?id=${id}`, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onload = function () {
    if (this.status == 200) {
      console.log("Berhasil update subscription");
    } else {
      console.log("Gagal update subscription");
    }
  };
  xhr.send();
}

const getSubscriptionStatus = (id, path, mode=1) => {
  const refresh = () => {
    updateSubscription(id)
    setTimeout(refresh, 5000)
  }

  const xhrToRest = new XMLHttpRequest();
  window.history.replaceState("", "","/?premiumartists" + path);
  
  let artists = [];

  xhrToRest.onreadystatechange = function () {
    if (xhrToRest.readyState == 4 && xhrToRest.status == 200) {
      // document.getElementById("universal-loading").innerHTML = "";
    } else {
      document.getElementById("universal-loading").innerHTML = "Loading...";
    }
  };

  xhrToRest.open("GET", `http://localhost:8080/api/artist${path.replace("&", "?")}`, true);
  xhrToRest.onload = function () {
    if (this.status == 200) {
      let response = JSON.parse(this.responseText);
      artists = response.data.artists;
    } else {
      alert("Gagal mengambil data");
    }
    const xhr = new XMLHttpRequest();

    const subUrl = `../../api/subscription/subscriptionstatus.php?id=${id}`
    xhr.open(
      "GET",
      subUrl,
      true
    );

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById("universal-loading").innerHTML = "";
      } else {
        document.getElementById("universal-loading").innerHTML = "Loading...";
      }
    };

    xhr.onload = function () {
      if (this.status == 200) {
        let artistList = document.getElementById("artists-table-body");
        artistList.innerHTML = "";

        let count = 1;
        let response = JSON.parse(this.responseText);
        // response = mode == 1 ? response : response.data
        // console.log(response)

        artists.forEach((artist) => {
          response.forEach((data) => {
            if (artist.user_id == data.creator_id) {
              if (data.status == "ACCEPTED") {
                // listen
                artist.flag = 1;
              } else if (data.status == "PENDING") {
                // pending
                artist.flag = 2;
                artist.status = data.status;
              } else {
                // reject
                artist.flag = 3;
                artist.status = data.status;
              }
            } else {
              if (artist.flag != 1 && artist.flag != 2 && artist.flag != 3) {
                // subscribe
                artist.flag = 0;
              }
            }
          });
          if (artist.flag == 1) {
            artistList.innerHTML += `
                    <tr>
                        <th id="artist-no">${count}</th>
                        <th id="artist-name">${artist.name}</th>
                        <th> <button class="button listen-button" id="listen-button" onClick="location.href='/?premiumsongs/${artist.user_id}'">   Listen now   </button></th>
                    </tr>
                `;
            count++;
          } else if (artist.flag == 2) {
            artistList.innerHTML += `
                    <tr>
                        <th id="artist-no">${count}</th>
                        <th id="artist-name">${artist.name}</th>
                        <th><button class="button pending-button" id="pending-button" disabled=true>${artist.status}</button></th>
                    </tr>
                `;
            count++;
          } else if (artist.flag == 3) {
            artistList.innerHTML += `
                    <tr>
                        <th id="artist-no">${count}</th>
                        <th id="artist-name">${artist.name}</th>
                        <th><button class="button rejected-button" id="rejected-button"  onClick="resubscribe(${id}, ${artist.user_id});">Resubscribe</button></th>
                    </tr>
                `;
            count++;
          } 
          
          
          else {
            artistList.innerHTML += `
                    <tr>
                        <th id="artist-no">${count}</th>
                        <th id="artist-name">${artist.name}</th>
                        <th><button class="button subscribe-button" id="subscribe-button" onClick="subscribe(${id}, ${artist.user_id})">Subscribe</button></th>
                    </tr>
                `;
            count++;
          }
        });
        refresh()
      } else {
        alert("Gagal mengambil data");
      }
    };
    xhr.send();
  };

  xhrToRest.send();
};


const resubscribe = (subscriber_id, creator_id) => {
  const xhr = new XMLHttpRequest();
  xhr.open("PUT", `http://localhost:8080/api/resubscribe`, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  const params = {
    subscriber_id: subscriber_id,
    creator_id: creator_id,
  };

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("universal-loading").innerHTML = "";
    } else {
      document.getElementById("universal-loading").innerHTML = "Loading...";
    }
  };

  xhr.onload = function () {
    if (this.status == 200) {
      alert("Berhasil request resubscribe");
      location.reload();
    } else {
      alert("Gagal request resubscribe");
    }
  };
  xhr.send(JSON.stringify(params));
}

const subscribe = (subscriber_id, creator_id) => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", `http://localhost:8080/api/artist/subscribe`, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  const params = {
    subscriber_id: subscriber_id,
    creator_id: creator_id,
  };

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("universal-loading").innerHTML = "";
    } else {
      document.getElementById("universal-loading").innerHTML = "Loading...";
    }
  };

  xhr.onload = function () {
    if (this.status == 200) {
      alert("Berhasil request subscribe");
      location.reload();
    } else {
      alert("Gagal request subscribe");
    }
  };
  xhr.send(JSON.stringify(params));
};

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

  getSubscriptionStatus(id, "&" + link.split("&")[1]);
};

const nextPage = (id) => {
  let newPage = parseInt(getQueryVariable("page")) + 1;
  const link = updateQueryStringParameter(
    window.location.href,
    "page",
    newPage
  );
  getSubscriptionStatus(id, "&" + link.split("&")[1]);
};
