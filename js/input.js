const container_inputs = document.querySelectorAll('.container__input');
const container_selects = document.querySelectorAll('.container__select');

const check_filled = (input,label) => {
    console.log('called');
    if(input.value.length === 0 && label.classList.contains('container__input__filled')){
        label.classList.remove('container__input__filled');
    } else if(input.value.length > 0 && !label.classList.contains('container__input__filled')){
        label.classList.add('container__input__filled');
    }
}

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

container_selects.forEach(ci=>{
    const label = ci.querySelector('label');
    const input = ci.querySelector("select");
    input.addEventListener('change',(e)=>{
        check_filled(input,label);
    });
    check_filled(input,label);
})