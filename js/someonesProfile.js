let showProfile = document.getElementById("showProfile");
let editFormProfile = document.getElementById("editFormProfile");
let followButton = document.getElementById("btn-follow");


let show = true;
showProfile.style.display = "grid";
//editFormProfile.style.display = "none";


followButton.addEventListener('click', function(e) {

    // let someonesId = this.dataset.someonesId;
    // let userId = this.dataset.userId;

    console.log(someonesId);
    console.log(userId);

    let formData = new FormData();
    formData.append("user_id", someonesId);
    formData.append("follower_id", userId);

    fetch("ajax/follow.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        // .then(response => response.text())
        .then(result => {
            console.log("Succes:", result);
        })
        .catch(error => {
            console.log("Error:", error);
        })

    e.preventDefault();
})
