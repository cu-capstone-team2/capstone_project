const showButtons = document.querySelectorAll('.show-more-button');
const useCaseButtons = document.querySelectorAll('.use-case-button');
const backdrop = document.querySelector(".backdrop");
const useCaseDesign = document.querySelector('.use-case-design');
const useCaseCloseButton = document.querySelector('.use-case-close-button');
const leftButton = document.querySelector('#left');
const rightButton = document.querySelector('#right');

const images = [
	"Student",
	"Faculty",
	"Secretary",
	"Chair",
	"Admin"
];

let currIndex = null;

showButtons.forEach(button=>{
  button.onclick = e => {
    if(button.classList.contains('showing')){
      button.classList.remove('showing');
    } else{
      button.classList.add('showing');
    }
  }
})


const removeActive = () => {
	useCaseButtons.forEach(button=>{
		if(button.classList.contains('active'))
			button.classList.remove('active');
	});
}

const closeBackdrop = () => {
	backdrop.classList.remove('showing');
}

backdrop.onclick = closeBackdrop;
useCaseCloseButton.onclick = closeBackdrop;

const setImage = () => {
	useCaseDesign.style.backgroundImage = `url('images/use_case/UML_${images[currIndex]}.png')`;
}

const changeCurrIndex = (ch) => {
	if(ch < 0){
		currIndex = currIndex > 0? currIndex - 1 : images.length-1;
	} else{
		currIndex = (currIndex + 1)%images.length;
	}
	setImage();
}


leftButton.onclick = () => changeCurrIndex(-1);
rightButton.onclick = () => changeCurrIndex(1);

useCaseButtons.forEach((button,index)=>{
	button.onclick = e => {
		removeActive();
		button.classList.add('active');
		currIndex = index;
		backdrop.classList.add('showing');
		setImage();
	}
});
