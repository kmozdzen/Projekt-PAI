const clearButton = document.querySelector(".fa-xmark");
const field = document.querySelector('input[placeholder="Search for users"]');

clearButton.addEventListener("click", clearField);

function clearField(){
    field.value = "";
}