let showProfile = document.getElementById("showProfile");
let editFormProfile = document.getElementById("editFormProfile");
let follow = document.getElementById("btn-follow");


let show = true;
showProfile.style.display = "grid";
//editFormProfile.style.display = "none";


follow.addEventListener('click', function(e) {
    console.log("clicked");

    let followerId = this.dataset.followerid;
    let userId = this.dataset.userid;

    alert(followerId + " " + userId);

    let formData = new FormData();
    formData.append("user_id", userId);
    formData.append("follower_id", followerId);

    fetch("ajax/follow.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            console.log("Succes:", result);
        })
        .catch(error => {
            console.log("Error:", error);
        })

    e.preventDefault();
})
