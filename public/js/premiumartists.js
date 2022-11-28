// const getPremiumArtistList = async () => {
//     const response = await fetch('localhost:8000/api/artist?page=1').then(res => res.json()).then((data) => console.log(data));
// }

const getPremiumArtistList = () => {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost:8001/api/artist?page=1", true);

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
            // console.log(artists)
            // console.log(artists[0].name)
            
            // let i = 0;

            for (let i=0; i<artists.length; i++) {
                // console.log(artist.user_id);
                // console.log(artist.name);
                document.getElementById("artist-no").innerHTML = i+1;
                document.getElementById("artist-name").innerHTML = artists[i].name;
            } 
        
        } else {
            alert("Gagal mengambil data");
        }
    };
    xhr.send();
}