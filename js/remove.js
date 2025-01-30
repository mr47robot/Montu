let addCard=document.getElementById("addCard");
let displayCard=document.getElementById("displayCard");
let loadingCard=document.getElementById("loadingCard");
let downloadCard=document.getElementById("downloadCard");
let fileInput =document.getElementById("fileInput");
let imageBefore=document.getElementById("display-img");
let startBtn=document.getElementById("startBtn");
let imageAter=document.querySelector(".image-after");
let imageBeforeSM=document.querySelector(".image-before");
let uploadAnother=document.getElementById("uploadAnother")
let downloadHref= document.getElementById("downloadHref");
const reader = new FileReader();
const formData=new FormData();
let file=null;
const API_URL="https://api.remove.bg/v1.0/removebg"
const API_KEY ="pL3cXsPk1R8SGD8zYkzr2wmb"

const activescreen =(screen)=>{
addCard.style.display='none';
displayCard.style.display="none";
loadingCard.style.display="none";
downloadCard.style.display="none";  
screen.style.display="flex"  
}
activescreen(addCard);

fileInput.addEventListener("input",()=>{
    file=fileInput.files[0];
    reader.readAsDataURL(file);
    reader.onload=()=>{(reader.result);
        console.log(reader.result);
    imageBefore.src=reader.result;
    imageBeforeSM.src=reader.result;
};
activescreen(displayCard)
})

startBtn.addEventListener("click",()=>{
    formData.append('image_file',file)
 activescreen(loadingCard);
 fetch(API_URL,{
    method : "post",
    headers:{
        "X-Api-Key":API_KEY,
    },
    body:formData,
 }).then((res)=>res.blob()).then((blob)=>{
    reader.readAsDataURL(blob);
    reader.onload=()=>{;
    imageAter.src=reader.result;
    document.querySelector("input[type='text']#profilepicture").value = reader.result  ;
    console.log(document.querySelector("input[type='text']#tournamentbracket").value);
    downloadHref.setAttribute("href",reader.result);
};
    activescreen(downloadCard);
 });
});
uploadAnother.addEventListener("click",()=>{
    window.location.reload();
});


