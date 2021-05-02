
/*
THIS PAGE IS FOR THE ABOUT PAGE
IT ALLOWS THE PAGE TO FEEL LESS STATIC
*/

// all of the elements necessary are selected to add event listeners
const showButtons = document.querySelectorAll('.show-more-button');
const useCaseButtons = document.querySelectorAll('.use-case-button');
const backdrop = document.querySelector(".backdrop");
const useCaseDesign = document.querySelector('.use-case-design');
const useCaseCloseButton = document.querySelector('.use-case-close-button');
const leftButton = document.querySelector('#left');
const rightButton = document.querySelector('#right');

// links for the images
const images = [
	"Student",
	"Faculty",
	"Secretary",
	"Chair",
	"Admin"
];

// current index for the design part is null
let currIndex = null;

// When a button is clicked, it toggles the class 'showing', so the information is shown
showButtons.forEach(button=>{
  button.onclick = e => {
    if(button.classList.contains('showing')){
      button.classList.remove('showing');
    } else{
      button.classList.add('showing');
    }
  }
})

// remove actice class from all use case buttons
const removeActive = () => {
	useCaseButtons.forEach(button=>{
		if(button.classList.contains('active'))
			button.classList.remove('active');
	});
}

// close backdrop by removing showing class
const closeBackdrop = () => {
	backdrop.classList.remove('showing');
}

backdrop.onclick = closeBackdrop;
useCaseCloseButton.onclick = closeBackdrop;

// change image based on the current index
const setImage = () => {
	useCaseDesign.style.backgroundImage = `url('images/use_case/UML_${images[currIndex]}.png')`;
}

// left and right buttons switch between each image, changes current index
const changeCurrIndex = (ch) => {
	if(ch < 0){
		currIndex = currIndex > 0? currIndex - 1 : images.length-1;
	} else{
		currIndex = (currIndex + 1)%images.length;
	}
	setImage();
}

// left button moves index left one, right button moves index right one
leftButton.onclick = () => changeCurrIndex(-1);
rightButton.onclick = () => changeCurrIndex(1);

// use case buttons change which image is currently showing
useCaseButtons.forEach((button,index)=>{
	button.onclick = e => {
		removeActive();
		button.classList.add('active');
		currIndex = index;
		backdrop.classList.add('showing');
		setImage();
	}
});
