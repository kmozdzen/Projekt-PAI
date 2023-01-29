const add = document.querySelector('input[placeholder="Search for games"]');
const button = document.querySelector(".fa-plus");
const gameToAdd = document.getElementById("found-game");
const img = document.getElementById("game-img");
const gameContainer = document.getElementById("game");
const games = document.getElementById("scripts");


button.addEventListener("click", addGame);

function addGame(){
    const data= {add: add.value};

    for(let i = 0; i < games.options.length; i++){
        if(add.value == games.options[i].value){
            gameToAdd.value = add.value;
            break;
        }
    }

    /*fetch(`/add`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (game) {
        gameToAdd.value = "weszlo";
        //foundGame(game)
    });*/
       /* console.log("inside handleGetJson");
        fetch(`/add`, {
            method: "POST",
            headers : {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then((response) => response.json())
            .then((messages) => {console.log("messages");});*/
}


function foundGame(game) {
    createGame(game)
}


function createGame(game) {
    const template = document.querySelector("#game-template");
    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = "Public/img/god_of_war.avif";
    const title = clone.querySelector(add.value);
    title.value = game.value;

    gameContainer.appendChild(clone);

    // gameToAdd.value = add.value;
    //img.src = "Public/img/god_of_war.avif";
}



