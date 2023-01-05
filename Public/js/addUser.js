const add = document.querySelector('input[placeholder="Search for users"]');
const button = document.querySelector(".plus");
const user= document.getElementById("user-name");
const likes= document.getElementById("likes");

button.addEventListener("click", addUser);

function addUser() {
    const data = {add: add.value};

    user.value = add.value;
    likes.innerHTML = '4';

}
