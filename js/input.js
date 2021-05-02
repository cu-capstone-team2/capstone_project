/*
THIS IS THE LOGIC TO ALLOW INPUT LABELS TO MOVE UP AND DOWN
*/
const container_inputs = document.querySelectorAll('.container__input');
const container_selects = document.querySelectorAll('.container__select');

// check if the input is filled, if so add closs, else remove it
const check_filled = (input,label) => {
    console.log('called');
    if(input.value.length === 0 && label.classList.contains('container__input__filled')){
        label.classList.remove('container__input__filled');
    } else if(input.value.length > 0 && !label.classList.contains('container__input__filled')){
        label.classList.add('container__input__filled');
    }
}

// add event listeners when each input is updated and check if filled with data
container_inputs.forEach(ci=>{
    const label = ci.querySelector('label');
    const input = ci.querySelector("input");
    if(input){
        input.addEventListener('input',(e)=>{
            check_filled(input,label);
        });
        check_filled(input,label);
    } else{
        const textarea = ci.querySelector('textarea');
        textarea.addEventListener('input',(e)=>{
            check_filled(textarea,label);
        });
        check_filled(textarea,label);
    }

})

// the same as the inputs, but for the select elements
container_selects.forEach(ci=>{
    const label = ci.querySelector('label');
    const input = ci.querySelector("select");
    input.addEventListener('change',(e)=>{
        check_filled(input,label);
    });
    check_filled(input,label);
})