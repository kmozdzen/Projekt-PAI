const heartButton = document.querySelector(".fa-heart");
const like = document.querySelector("#likes");
const userName = document.querySelector("#user-name");

heartButton.addEventListener("click", giveLike);

function giveLike(){
    const data = {userName: userName.value};
    if(like.innerHTML != ''){
        fetch(`/likes`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (likeResponse) {
            if(likeResponse != null){
                like.innerHTML = likeResponse[0].your_likes;
                console.log(likeResponse);
            }
        else
            alert("You like this profile!");
        });

    }
}


