
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
        console.log("Success: ", data);
        if (data['status'] == "success"){
            hidePost(postId);
        }
        alert(data['message']);
    })
    .catch((error) => {
        console.log("Error: ", error);
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
        console.log("Success: ", data);
        if (data['status'] == "success"){
            hidePost(postId);
        }
        alert(data['message']);
    })
    .catch((error) => {
        console.log("Error: ", error);
    });
};


function hidePost(postId){
    document.querySelector(".col-9.post-" + postId).style.display = "none";
    document.querySelector(".col-3.post-" + postId).style.display = "none";
    document.querySelector(".feed.post-" + postId).style.display = "none";
};

