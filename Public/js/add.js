const add = document.querySelector('input[placeholder="Search for games"]');
const button = document.querySelector("#plus");
const gameToAdd = document.getElementById("found-game");
const img = document.getElementById("game-img");
const gameContainer = document.getElementById("game");


button.addEventListener("click", addGame);

function addGame(){
    const data= {add: add.value};

    gameToAdd.value = add.value;

    /*fetch('/add', {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });*/

   /* const data = {
        title: 'Test title',
        body: 'Test body',
        userId: 42
    }*/

    /*const options = {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch('/add', options)
        .then(response => response.json())
        .then(game => foundGame(game));*/
}


function foundGame(games) {
        console.log(game);
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



