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