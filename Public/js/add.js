const add = document.querySelector('input[placeholder="Search for games"]');
const button = document.querySelector("#plus");
const gameToAdd = document.getElementById("found-game");

button.addEventListener("click", addGame);

function addGame(){
    const data= {add: add.value};

    gameToAdd.value =add.value;

    /*fetch("/add", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (game) {
        foundGame(game);
    });*/
}

/*function foundGame(game) {
    gameToAdd.innerHTML="yoo";
}*/
