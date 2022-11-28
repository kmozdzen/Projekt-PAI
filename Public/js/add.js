const search = document.querySelector('input[placeholder="Search for games"]');
const add = document.querySelector(".add-game");
const button = document.querySelector("#plus");
const gameToAdd = document.getElementById("found-game");

button.addEventListener("click", addGame);

function addGame(){
    const data= {add: search.value};

    fetch("/add", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (game) {
        foundGame(game);
    });
}

function foundGame(game) {
    gameToAdd.innerHTML="yoo";
}
