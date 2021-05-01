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
        console.log(data);
        // if (data['status'] == "success"){
        //     hidePost(postId);
        //     showMessage(".alert.alert-success", "Successfully removed strikes for post!");
        // }
        // else{
        //     showMessage(".alert.alert-danger", "Failed to remove strikes for post!");
        // }
        // alert(data['message']);
    })
    .catch((error) => {
        console.log("Error: ", error);
        // showMessage(".alert.alert-danger", error);
    })
});
