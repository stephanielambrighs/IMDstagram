
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
            showMessage(".alert.alert-success", "Successfully removed strikes for post!");
        }
        else{
            showMessage(".alert.alert-danger", "Failed to remove strikes for post!");
        }
        // alert(data['message']);
    })
    .catch((error) => {
        // console.log("Error: ", error);
        showMessage(".alert.alert-danger", error);
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
            showMessage(".alert.alert-success", "Successfully deleted post!");
        }
        else{
            showMessage(".alert.alert-danger", "Failed to delete post!");
        }
        // alert(data['message']);
    })
    .catch((error) => {
        // console.log("Error: ", error);
        showMessage(".alert.alert-danger", error);
    });
};


function hidePost(postId){
    document.querySelector(".col-9.post-" + postId).style.display = "none";
    document.querySelector(".col-3.post-" + postId).style.display = "none";
    document.querySelector(".feed.post-" + postId).style.display = "none";
};

function showMessage(querySelector, message){
    document.querySelector(querySelector).style.display = "block";
    document.querySelector(querySelector).innerHTML = message;
    setTimeout(() => {
        document.querySelector(querySelector).style.display = "none";
    }, 4000);
}
