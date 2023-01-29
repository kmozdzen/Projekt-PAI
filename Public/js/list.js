const list = document.querySelector(".fa-list");
const buttons = document.getElementsByClassName("button");
const strap = document.getElementsByClassName("strap");
const ul = document.getElementById("lis");
const listItems = ul.getElementsByTagName('li');
const setting = document.querySelector(".setting-button");

list.addEventListener("click", getList);

function getList(){

    if(list.style.color == "black"){
        for (let i = 0; i <= listItems.length - 1; i++) {
            listItems[i].style.display = "block";
        }
        list.style.color = "#14B727";
        buttons[0].style.display = "block";
        buttons[1].style.display = "block";
        buttons[2].style.display = "block";
        buttons[3].style.display = "block";
        setting.style.display = "block";
    }else{
        for (let i = 0; i <= listItems.length - 1; i++) {
            listItems[i].style.display = "none";
        }
        buttons[0].style.display = "none";
        buttons[1].style.display = "none";
        buttons[2].style.display = "none";
        buttons[3].style.display = "none";
        list.style.color = "black";
        setting.style.display = "none";
    }


}