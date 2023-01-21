const heartButton = document.querySelector(".fa-heart");
const like = document.querySelector("#likes");
const userName = document.querySelector("#user-name");

var delayInMilliseconds = 900;

heartButton.addEventListener("click", giveLike);

function giveLike(){
    if(like.innerHTML != ''){
        const name = userName.value;
        fetch(`/likes/${name}`)
            .then(function () {
                like.innerHTML = parseInt(like.innerHTML) + 1;
            })
        setTimeout(function() {
            heartButton.style.color = "green";
        }, delayInMilliseconds);
    }
}



