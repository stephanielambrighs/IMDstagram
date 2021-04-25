let editButton = document.getElementById("editProfile");
let showProfile = document.getElementById("showProfile");
let editFormProfile = document.getElementById("editFormProfile");
let updateProfile = document.getElementById("updateProfile");
let cancelProfile = document.getElementById("cancelProfile");
let follow = document.getElementById("btn-follow");


let show = true;
showProfile.style.display = "grid";
//editFormProfile.style.display = "none";
follow.addEventListener('click', function(e) {
    console.log("clicked");
    
    let followerId = this.dataset.followerid;
    let userId = this.dataset.userid;
    alert(followerId + " " + userId);

    e.preventDefault();
})

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




