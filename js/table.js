
const trs = document.querySelectorAll('.row');

const clearInfoShown = () => {
    trs.forEach(tr=>{
        if(tr.classList.contains('info-shown')){
            tr.classList.remove("info-shown");
        }
    })
}

trs.forEach(tr=>{
    tr.onclick = (e) => {
        if(tr.classList.contains('info-shown')){
            tr.classList.remove('info-shown');
        } else{
            clearInfoShown();
            tr.classList.add('info-shown');
        }
    }
})