document.querySelector("#btnComment").addEventListener("click", funcrion(){
    //post id?
    //Comment text?
    let postId = this.DataTransferItem.postId;
    let text = document.querySelector("").value; //Zoeken naar de parent van het huidig object en daarbinnen zoek je het tekstvak

    //Posten naar databank (AJAX)

    //Antwoord ok? => toon comments onderaan
});
