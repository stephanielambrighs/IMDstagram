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
    }else if(postPlacedFailed){
        setTimeout(() => {
            document.querySelector(".alert.alert-danger.feed").style.display = "none";
        }, 4000);
    }
});


let title = document.querySelector("#title");
let description = document.querySelector("#description");
let genre = document.querySelector("#dropdown-genres");
let uploadFile = document.querySelector("#file");
let btnSubmit = document.querySelector("#submit");


// btnSubmit.setAttribute('disabled', 'disabled');

title.addEventListener("keyup", function(){
    if(checkTitle()){
        hideMessage("#msg-title");
    }
    else{
        showMessage("#msg-title");
    }
    checkBtn();
});

description.addEventListener("keyup", function(){
    if(checkDescription()){
        hideMessage("#msg-description");
    }
    else{
        showMessage("#msg-description");
    }
    checkBtn();
});

genre.addEventListener("change", function(){
    // alert(genre.selectedIndex);
    // console.log(genre);
    if(checkGenre()){
        hideMessage("#msg-genres");
    }
    else{
        showMessage("#msg-genres");
    }
    checkBtn();
});

uploadFile.addEventListener("change", function(){
    // alert(genre.selectedIndex);
    if(checkUploadFile()){
        hideMessage("#msg-uploadfile");
    }
    else{
        showMessage("#msg-uploadfile");
    }
    checkBtn();
});


function checkBtn(){
    if(checkDescription() == true && checkTitle() == true && checkGenre() == true && checkUploadFile() == true){
        enableBtn();
    }else{
        disableBtn();
    }
}

function disableBtn(){
    btnSubmit.setAttribute('disabled', 'disabled');
}

function enableBtn(){
    btnSubmit.removeAttribute('disabled');
}

function showMessage(msgQueryselector){
    document.querySelector(msgQueryselector).innerHTML = "Sorry, this field cannot be empty.";
    document.querySelector(msgQueryselector).style.display = "grid";
}

function hideMessage(msgQueryselector){
    document.querySelector(msgQueryselector).innerHTML = "";
    document.querySelector(msgQueryselector).style.display = "none";
}

window.addEventListener('load',  (event) => {
    disableBtn();
});


// 4 methodes

function checkTitle(){
    if(title.value === ""){
        return false;
    }
    else{
       return true;
    }
}

function checkDescription(){
    if(description.value === ""){
        return false;
    }
    else{
       return true;
    }
}

function checkGenre(){
    // console.log(genre.value);
    if(genre.selectedIndex == 0){
        return false;
    }
    else{
       return true;
    }
}

function checkUploadFile(){
    if(uploadFile.value === ""){
        return false;
    }
    else{
       return true;
    }
}
