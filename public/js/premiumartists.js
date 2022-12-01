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
        console.log(artist.user_id);
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
  getSubscriptionStatus(id);
};

const getSubscriptionStatus = (id) => {
  const xhrToRest = new XMLHttpRequest();
  let artists = [];
  xhrToRest.open("GET", "http://localhost:8080/api/artist?page=1", true);
  xhrToRest.onload = function () {
    if (this.status == 200) {
      let response = JSON.parse(this.responseText);
      artists = response.data.artists;
    } else {
      alert("Gagal mengambil data");
    }
    const xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      `../../api/subscription/subscriptionstatus.php?id=${id}`,
      true
    );

    xhr.onload = function () {
      if (this.status == 200) {
        let artistList = document.getElementById("artists-table-body");
        console.log(artistList);
        artistList.innerHTML = "";

        let count = 1;
        let response = JSON.parse(this.responseText);

        artists.forEach((artist) => {
          response.forEach((data) => {
            if (artist.user_id == data.creator_id) {
              if (data.status == "ACCEPTED") {
                // listen
                artist.flag = 1;
              } else {
                // pending
                artist.flag = 2;
                artist.status = data.status;
              }
            } else {
              if (artist.flag != 1 && artist.flag != 2) {
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
                        <th><button class="button rejected-button" id="rejected-button" disabled=true>${artist.status}</button></th>
                    </tr>
                `;
            count++;
          } else {
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
      } else {
        alert("Gagal mengambil data");
      }
      console.log(artists);
    };
    xhr.send();
  };

  xhrToRest.send();
};

const subscribe = (subscriber_id, creator_id) => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", `http://localhost:8080/api/artist/subscribe`, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  const params = {
    subscriber_id: subscriber_id,
    creator_id: creator_id,
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
