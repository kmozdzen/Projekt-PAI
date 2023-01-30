const add = document.querySelector('input[placeholder="Search for users"]');
const button = document.querySelector("#user-serach-button");
const user= document.getElementById("user-name");
const likes= document.getElementById("likes");
const userContainer = document.querySelector(".game-list");

button.addEventListener("click", addUser);

function addUser() {
    const data = {add: add.value};

    fetch(`/getUserStats`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (games) {
        userContainer.innerHTML = "";
        loadGames(games);
    });
}


function loadGames(games) {
    let num = 0;
    games.forEach(game => {
        console.log(game);
        num++;
        createGame(game, num);
    });
}

function createGame(game, num) {
    const template = document.querySelector("#games-element-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/Public/img/${game.image}`;

    const game_name = clone.querySelector(".game-name");
    game_name.innerHTML = game.title;

    const rating = clone.querySelector(".rate");
    rating.innerHTML = game.rating;

    const number = clone.querySelector(".number-p");
    number.innerHTML = num;

    console.log(number.innerHTML);
    user.value = add.value;
    likes.innerHTML = game.your_likes;
    userContainer.appendChild(clone);
}