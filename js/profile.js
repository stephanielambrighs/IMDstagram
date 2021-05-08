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
    e.preventDefault();q
})


let profileEditPostBtn = document.querySelectorAll(".dropdown-item.btn-delete");
profileEditPostBtn.forEach(function(editPostButton) {
    editPostButton.addEventListener("click", function() {
        console.log("yes you clicked dropdown");
        postId = editPostButton.id.replace("btn-report-post-", "");

        // archieve (remove) posts
        archievePost(postId);

    });
});

function archievePost(postId){
    myBody = new FormData();
    myBody.append("postId", postId);
    myBody.append("userId", userId);

    fetch("addEntryToReportsTable.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.json())
    .then(data => {
        console.log("Success: ", data);
        // check current report count for this postId and hide if needed
        checkReportCount(postId);
    })
    .catch((error) => {
        console.log("Error: ", error);
    });
};