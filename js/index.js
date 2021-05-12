let button = document.getElementById("btn-feed");
let form = document.getElementById("form");
let loc = document.querySelector(".p-location");

window.addEventListener('load', function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        loc.innerHTML = "Geolocation is not supported by this browser.";
    }
})

function showPosition(position) {
    document.getElementById("location-latitude").value = position.coords.latitude;
    document.getElementById("location-longitude").value = position.coords.longitude;
}

form.style.display = "none";
let click = true;



button.addEventListener("click", function(e) {
    if(click == true){
        console.log("visible");
        click = false;
        form.style.display = "grid";
    }
    else{
        console.log("hidden");
        click = true;
        form.style.display= "none";
    }
    e.preventDefault();
});


document.querySelector("#btn-load-more").addEventListener("click", function() {
    myBody = new FormData();
    pagePostCount = parseInt(pagePostCount) + parseInt(postsPerPage);
    myBody.append("pagePostCount", pagePostCount);

    fetch("loadPosts.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.text())
    .then(data => {
        document.querySelector(".row").innerHTML = data;
    });
});


let postReportButtons = document.querySelectorAll(".dropdown-item.btn-report");
postReportButtons.forEach(function(reportButton) {
    reportButton.addEventListener("click", function() {

        postId = reportButton.id.replace("btn-report-post-", "");

        // add the user and post to the reports table
        // only unique combinations of userId and postId will be added
        addEntryToReportsTable(postId);

    });
});


function checkReportCount(postId){
    myBody = new FormData();
    myBody.append("postId", postId);

    fetch("getReportsCount.php", {
        method: "POST",
        body: myBody,
    })
    .then(response => response.json())
    .then(data => {
        console.log("Success: ", data);
        let reportcount = data['reportcount'];
        if (data['reportcount'] >= 3){
            hidePost(postId);
        }
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


function addEntryToReportsTable(postId){
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


//Comments

document.querySelectorAll(".btn-comment").forEach(item => {
    item.addEventListener("click", function(){
        //console.log("Morgane");
        //Zoek postid en comment tekst
        let postid = this.dataset.postid;
        let text = this.previousElementSibling.value;
        console.log(postid);
        console.log(text);

        //post naar databank (AJAX)
        let formData = new FormData();
        formData.append('text', text);
        formData.append('postid', postid);
        formData.append("userId", userId);

        fetch('ajax/savecomment.php', {
        method: 'POST',
        body: formData
        })
        .then(response => response.json())
        .then(result => {
        console.log('Success:', result);
        })
        .catch(error => {
        console.error('Error:', error);
        });
    });
});

window.addEventListener('load', (event) => {
    // console.log('page is fully loaded');
    if(postPlacedSuccess){
        setTimeout(() => {
            document.querySelector(".alert.alert-success.feed").style.display = "none";
        }, 4000);
    }
});


//Likes
document.querySelectorAll(".btn-info-like").forEach(item => {
    item.addEventListener("click", function(){
        //console.log("Morgane");
        //Zoek postid en comment tekst    
        myBody = new FormData();
        let postId = this.dataset.postid;
        myBody.append("postId", postId);
        myBody.append("userId", userId);
        //myBody.append("countLikes", countLikes);

        console.log(postId);
        console.log(userId);
        //console.log(this.innerHTML)
        //console.log(countLikes);
        likes = document.getElementById(postId);
       // likes.dataset.likeid = postId;
        

        fetch("ajax/clickLike.php", {
            method: "POST",
            body: myBody,
        })
        .then(response => response.json())
        .then(data => {
            status = data['status'];
            count = data['count'];
            console.log(count);
            console.log(likes);
            if(status == 'like'){
                //console.log(data['status']);
                this.innerHTML = status;
                if(count == 1){
                    likes.innerHTML = count+" like";
                }
                else{
                    likes.innerHTML = count+" likes";
                }
                //console.log(image.innerHTML);
            }else{
                //console.log(data['status']);
                this.innerHTML = status;
                if(count == 1){
                    likes.innerHTML = count+" like";
                }
                else{
                    likes.innerHTML = count+" likes";
                }
                //console.log(image.innerHTML);
            }
        })
        .catch((error) => {
            console.log("Error: ", error);
        });
    });
});

