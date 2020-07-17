var modal = document.getElementById('myModal');
var modalImg = document.getElementById("img01");
var timeout;
if(timeout!== null){
    clearTimeout(timeout);
}
timeout = setTimeout(function() {
    modal.style.display = "block";
    modalImg.src = "moeghli.jpg";
},2000);

modalImg.onclick = function(){
    modal.style.display = "none";
};

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}