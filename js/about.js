const showButtons = document.querySelectorAll('.show-more-button');

showButtons.forEach(button=>{
  button.onclick = e => {
    if(button.classList.contains('showing')){
      button.classList.remove('showing');
    } else{
      button.classList.add('showing');
    }
  }
})