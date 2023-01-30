const add = document.querySelector('input[placeholder="Search for games"]');
const button = document.querySelector("#add-plus");
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
}


