const pics = document.querySelectorAll('img');
const next = document.querySelector('.next');
const prev = document.querySelector('.prev');
const nbSlide = pics.length;
let count = 0;
console.log(nbSlide);

for(let pic of pics){
    pic.addEventListener('click', ()=>{
        pic.classList.toggle("show");
        const nav = document.querySelector('.navigate');
        nav.classList.toggle("shownav");
    })
}
function rca(){
    for(let pic of pics){
   pic.classList.remove("show");  
}
}
function nextSlide(){
    count++;
    if(count >= nbSlide){
        count = 0;
    }
    rca();
    pics[count].classList.add('show');
}
next.addEventListener('click', ()=>{
    nextSlide();
});

function prevSlide(){
    count--;
    if(count <= 0){
        count = nbSlide-1;
    }
    rca();
   pics[count].classList.add('show');
}
 
prev.addEventListener("click", ()=>{
    prevSlide();
});