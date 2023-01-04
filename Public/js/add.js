const add = document.querySelector('input[placeholder="Search for games"]');
const button = document.querySelector("#plus");
const gameToAdd = document.getElementById("found-game");
const img = document.getElementById("game-img");


button.addEventListener("click", addGame);

function addGame(){
    const data= {add: add.value};

    gameToAdd.value = add.value;

    window.location.href = "http://localhost:8080/statistics";
    window.location.replace("http://localhost:8080/statistics");
    fetch('/updateAllGames')
        .then(function () {
            document.getElementById("all-games").innerHTML = 2;
        })

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

/*
function foundGame(game) {
    gameToAdd.innerHTML="yoo";
    img.src = "Public/img/god_of_war.avif";
}
*/
