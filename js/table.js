
// select all of the rows with the class row
const trs = document.querySelectorAll('.row');

// this function removes the info-shown class from every row
const clearInfoShown = () => {
    trs.forEach(tr=>{
        if(tr.classList.contains('info-shown')){
            tr.classList.remove("info-shown");
        }
    })
}

// when a row is clicked, if shown, then hide it, else show it
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