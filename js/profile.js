let editButton = document.getElementById("editProfile");
let showProfile = document.getElementById("showProfile");
let editFormProfile = document.getElementById("editFormProfile");
let updateProfile = document.getElementById("updateProfile");
let cancelProfile = document.getElementById("cancelProfile");



let show = true;
showProfile.style.display = "grid";
editFormProfile.style.display = "none";


editButton.addEventListener("click", function(e){
    if(show == true){
        console.log("show");
        showProfile.style.display = "none";
        editFormProfile.style.display = "grid";
        show = false;
    }
    e.preventDefault();
})

updateProfile.addEventListener("click", function(e){
    if(show == false){
        editFormProfile.style.display = "none";
        showProfile.style.display = "grid";
        // console.log("false");
        show = true;
    }
    else{
        // console.log("true");
        show = false;
    }
    e.preventDefault();
})

cancelProfile.addEventListener("click", function(e){
    if(show == false){
        editFormProfile.style.display = "none";
        showProfile.style.display = "grid";
        // console.log("false");
        show = true;
    }
    else{
        // console.log("true");
        show = false;
    }
    e.preventDefault();
})




let buttonPrivate = document.querySelector("#btn-private");

window.addEventListener('load', (event) => {
    myBody = new FormData();
    myBody.append("userId", userId);

    fetch("ajax/getProfileStatus.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.json())
    .then(data => {
        if(data['status']){
            buttonPrivate.innerHTML = "Set public";
        }else{
            buttonPrivate.innerHTML = "Set private";
        }
    })
    .catch((error) => {
        console.log("Error: ", error);
    })
});

buttonPrivate.addEventListener("click", function() {
    myBody = new FormData();
    myBody.append("userId", userId);

    fetch("ajax/switchProfileStatus.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.json())
    .then(data => {
        // console.log("Success: ", data);
        if(data['profile_private']){
            console.log("Switched profile to private");
            buttonPrivate.innerHTML = "Set public";
        }else{
            console.log("Switched profile to public");
            buttonPrivate.innerHTML = "Set private";
        }
    })
    .catch((error) => {
        console.log("Error: ", error);
    })
});




let followerRequestAcceptButtons = document.querySelectorAll(".btn.btn-outline-success.accept");
followerRequestAcceptButtons.forEach(function(acceptButton) {
    acceptButton.addEventListener("click", function() {
        let followerId = acceptButton.id.replace("btn-accept-", "");
        acceptFollowerRequest(userId, followerId);
    });
});


function acceptFollowerRequest(userId, followerId) {
    myBody = new FormData();
    myBody.append("userId", userId);
    myBody.append("followerId", followerId);

    fetch("ajax/acceptFollowerRequest.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.json())
    .then(data => {
        console.log("Success: ", data);
        if(data["status"] == "success"){
            hideFollowerRequest(followerId);
            document.querySelector(".alert.alert-success.accept").innerHTML = "Successfully accept follower request";
            document.querySelector(".alert.alert-success.accept").style.display = "grid";
            setTimeout(() => {
                document.querySelector(".alert.alert-success.accept").style.display = "none";
            }, 4000);
        }
    })
    .catch((error) => {
        console.log("Error: ", error);
    })
};


let followerRequestDeclineButtons = document.querySelectorAll(".btn.btn-outline-danger.decline");
followerRequestDeclineButtons.forEach(function(declineButton) {
    declineButton.addEventListener("click", function() {
        let followerId = declineButton.id.replace("btn-decline-", "");
        declineFollowerRequest(userId, followerId);
    });
});


function declineFollowerRequest(userId, followerId) {
    myBody = new FormData();
    myBody.append("userId", userId);
    myBody.append("followerId", followerId);

    fetch("ajax/declineFollowerRequest.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.json())
    .then(data => {
        console.log("Success: ", data);
        if(data["status"] == "success"){
            hideFollowerRequest(followerId);
            document.querySelector(".alert.alert-danger.decline").innerHTML = "Successfully decline follower request";
            document.querySelector(".alert.alert-danger.decline").style.display = "grid";
            setTimeout(() => {
                document.querySelector(".alert.alert-danger.decline").style.display = "none";
            }, 4000);
        }

    })
    .catch((error) => {
        console.log("Error: ", error);
    })
};


function hideFollowerRequest(followerId){
    document.querySelector(".col-md-6.m-b-2.follower-" + followerId).style.display = "none";
};
