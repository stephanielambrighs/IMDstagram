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
})


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
    })
    .catch((error) => {
        console.log("Error: ", error);
    });

});


