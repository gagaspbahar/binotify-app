const getPremiumArtistList = () => {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost:8080/api/artist?page=1", true);

    // xhr.setRequestHeader("header", "Authorization")

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

            let artistList = document.getElementById("artists-table-body");
            artistList.innerHTML = "";

            let count = 1;

            artists.forEach((artist) => {
                console.log(artist.user_id)
                artistList.innerHTML += `
                    <tr>
                        <th id="artist-no">${count}</th>
                        <th id="artist-name">${artist.name}</th>
                        <th><button class="button subscribe-button">Subscribe</button></th>
                    </tr>
                `;
                count++;
            });
                
        } else {
            alert("Gagal mengambil data");
        }
    };
    xhr.send();
}

const getSubscriptionStatus = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../../api/subscription/subscriptionstatus.php?id=${id}`, true);

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
            let subscription = response;
            console.log(subscription)

            console.log(subscription.status);

            document.querySelector(".subsription-status").innerHTML = subscription.status;
            document.querySelector(".creator-id").innerHTML = subscription.creator_id;

            // if (subscription.status == "PENDING") {
            //     document.getElementById("subscription-status").innerHTML = "PENDING";
            // } else if (subscription.status == "ACCEPTED") {
            //     document.getElementById("subscription-status").innerHTML = "ACCEPTED";
            // } else if (subscription.status == "REJECTED") {
            //     document.getElementById("subscription-status").innerHTML = "REJECTED";
            // }
        } else {
            alert("Gagal mengambil data");
        }
    };

    xhr.send();
};