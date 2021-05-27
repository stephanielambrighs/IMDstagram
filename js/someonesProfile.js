let showProfile = document.getElementById("showProfile");
let editFormProfile = document.getElementById("editFormProfile");
let followButton = document.getElementById("btn-follow");


// let show = true;
// showProfile.style.display = "grid";
//editFormProfile.style.display = "none";


followButton.addEventListener('click', function(e) {

    getFollowStatus();

    // e.preventDefault();
})


function getFollowStatus(){
    let formData = new FormData();
    formData.append("user_id", someonesId);
    formData.append("follower_id", userId);

    fetch("ajax/getFollowStatus.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        console.log("Follow status: " + result['status']);

        if (result['status'] == "present"){
            unfollow();
            followButton.innerHTML = "Follow";
        }
        else{
            follow();
            followButton.innerHTML = "Unfollow";
        }

    })
    .catch(error => {
        console.log("Error:", error);
    })
}


function follow(){
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
}


function unfollow(){
    let formData = new FormData();
    formData.append("user_id", someonesId);
    formData.append("follower_id", userId);

    fetch("ajax/unfollow.php", {
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
}
