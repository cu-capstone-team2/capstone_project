// selects the backdrop of the page, else the forms and search button
const backdrop = document.querySelector('.backdrop');
const form = document.querySelector('.search-form');
const searchButton = document.querySelector('.search-button');

// when the backdrop is clicked, then hide the forms, and show the button
backdrop.addEventListener('click',(e)=>{
  backdrop.classList.toggle('active');
  form.classList.toggle("active");
  searchButton.classList.toggle('active');
})

// when the search button is clicked, then show the search form and backdrop
searchButton.addEventListener('click',(e)=>{
  backdrop.classList.toggle('active');
  form.classList.toggle("active");
  searchButton.classList.toggle('active');
  
    const input = form.querySelectorAll('input')[1];
    setTimeout(()=>input.focus(),250);

})