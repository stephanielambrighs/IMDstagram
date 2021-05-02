let showProfile = document.getElementById("showProfile");
let editFormProfile = document.getElementById("editFormProfile");
let follow = document.getElementById("btn-follow");


$( document ).ready(function(e) {
    console.log("wheeeeee");
    if(follow.classList.contains('following')){
        follow.innerHTML = 'Following';
    } else {
        follow.innerHTML = 'Follow';
    }
    e.preventDefault();
});


let show = true;
showProfile.style.display = "grid";
//editFormProfile.style.display = "none";


follow.addEventListener('click', function(e) {
    console.log("clicked");
    $button = $(this);
    if($button.hasClass('following')){
        // Unfollow
        unfollowUser(); 
        $button.removeClass('following');
        $button.removeClass('unfollow');
        $button.text('Follow');
    } else {
        // Follow
        followUser();
        $button.addClass('following');
        $button.text('Following');
    }
    e.preventDefault();
})


function followUser () {
    //follow.innerText = "following";

    let followerId = follow.dataset.followerid;
    let userId = follow.dataset.userid;

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
}

function unfollowUser () {
    //follow.innerText = "following";

    let followerId = follow.dataset.followerid;
    let userId = follow.dataset.userid;

    let formData = new FormData();
    formData.append("user_id", userId);
    formData.append("follower_id", followerId);

    fetch("ajax/unfollow.php", {
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
}