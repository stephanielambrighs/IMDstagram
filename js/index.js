let button = document.getElementById("btn-feed");
let form = document.getElementById("form");
form.style.display = "grid";
let click = true;
button.addEventListener("click", function(e) {
    if(click == true){
        console.log("hidden");
        click = false;
        form.style.display = "none";
    }
    else{
        console.log("visible");
        click = true;
        form.style.display= "grid";
    }
    e.preventDefault();
});


let postReportButtons = document.querySelectorAll(".dropdown-item.btn-report");
postReportButtons.forEach(function(reportButton) {
    reportButton.addEventListener("click", function() {

        postId = reportButton.id.replace("post-", "");

        // add the user and post to the reports table
        addEntryToReportsTable(postId);

    });
});


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
    })
    .catch((error) => {
        console.log("Error: ", error);
    });
};