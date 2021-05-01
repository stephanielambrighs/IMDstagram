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
