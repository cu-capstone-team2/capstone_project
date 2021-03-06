const backdrop = document.querySelector('.backdrop');
const form = document.querySelector('.search-form');
const searchButton = document.querySelector('.search-button');

backdrop.addEventListener('click',(e)=>{
  backdrop.classList.toggle('active');
  form.classList.toggle("active");
  searchButton.classList.toggle('active');
})

searchButton.addEventListener('click',(e)=>{
  backdrop.classList.toggle('active');
  form.classList.toggle("active");
  searchButton.classList.toggle('active');
  
    const input = form.querySelectorAll('input')[1];
    setTimeout(()=>input.focus(),250);

})