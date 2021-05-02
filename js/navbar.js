// select toggle button and dropdown menu
const toggleButton = document.getElementsByClassName('toggle-button')[0]
const dropdownMenu = document.getElementsByClassName('dropdown-menu')[0]

//
toggleButton.addEventListener('click', ()=>{
    dropdownMenu.classList.toggle('active');
    toggleButton.classList.toggle('active');
})