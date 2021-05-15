let button = document.getElementById("btn-feed");
let form = document.getElementById("form");
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

$(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.post-img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function(){
        readURL(this);
    });
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

window.addEventListener('load', (event) => {
    // console.log('page is fully loaded');
    if(postPlacedSuccess){
        setTimeout(() => {
            document.querySelector(".alert.alert-success.feed").style.display = "none";
        }, 4000);
    }
});