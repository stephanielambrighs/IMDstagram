
let postRemoveStrikesButtons = document.querySelectorAll(".dropdown-item.btn-remove-strikes");
postRemoveStrikesButtons.forEach(function(RemoveStrikesButton) {
    RemoveStrikesButton.addEventListener("click", function() {

        postId = RemoveStrikesButton.id.replace("btn-remove-strikes-post-", "");
        removeStrikesFromPost(postId);

    });
});


let postDeletePostButtons = document.querySelectorAll(".dropdown-item.btn-delete-post");
postDeletePostButtons.forEach(function(DeletePostButton) {
    DeletePostButton.addEventListener("click", function() {

        postId = DeletePostButton.id.replace("btn-delete-post-post-", "");
        deletePost(postId);

    });
});


function removeStrikesFromPost(postId){
    myBody = new FormData();
    myBody.append("postId", postId);

    fetch("removeStrikesFromPost.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.json())
    .then(data => {
        // console.log("Success: ", data);
        if (data['status'] == "success"){
            hidePost(postId);
            showStrikesSuccessMessage();
        }
        else{
            showStrikesFailedMessage();
        }
        // alert(data['message']);
    })
    .catch((error) => {
        // console.log("Error: ", error);
        showStrikesFailedMessage(error);
    });
};


function deletePost(postId){
    myBody = new FormData();
    myBody.append("postId", postId);

    fetch("deletePost.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.json())
    .then(data => {
        // console.log("Success: ", data);
        if (data['status'] == "success"){
            hidePost(postId);
            showDeleteSuccessMessage();
        }
        else{
            showDeleteFailedMessage();
        }
        // alert(data['message']);
    })
    .catch((error) => {
        // console.log("Error: ", error);
        showDeleteFailedMessage(error);
    });
};


function hidePost(postId){
    document.querySelector(".col-9.post-" + postId).style.display = "none";
    document.querySelector(".col-3.post-" + postId).style.display = "none";
    document.querySelector(".feed.post-" + postId).style.display = "none";
};

function showStrikesSuccessMessage(){
    document.querySelector(".alert.alert-success").style.display = "block";
    document.querySelector(".alert.alert-success").innerHTML = "Successfully removed strikes for post!";
    setTimeout(() => {
        document.querySelector(".alert.alert-success").style.display = "none";
    }, 4000);
}

function showStrikesFailedMessage(){
    document.querySelector(".alert.alert-danger").style.display = "block";
    document.querySelector(".alert.alert-danger").innerHTML = "Failed to remove strikes for post!";
    setTimeout(() => {
        document.querySelector(".alert.alert-danger").style.display = "none";
    }, 4000);
}

function showDeleteSuccessMessage(){
    document.querySelector(".alert.alert-success").style.display = "block";
    document.querySelector(".alert.alert-success").innerHTML = "Successfully deleted post!";
    setTimeout(() => {
        document.querySelector(".alert.alert-success").style.display = "none";
    }, 4000);
}


function showDeleteFailedMessage(){
    document.querySelector(".alert.alert-danger").style.display = "block";
    document.querySelector(".alert.alert-danger").innerHTML = "Failed to delete post!";
    setTimeout(() => {
        document.querySelector(".alert.alert-danger").style.display = "none";
    }, 4000);
}
