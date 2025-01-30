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
const API_KEY ="m43xjV5NaeEv4VCcVfED8t71"

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
    console.log(document.querySelector("input[type='text']#profilepicture").value);
};
    activescreen(downloadCard);
 });
});
uploadAnother.addEventListener("click",()=>{
    window.location.reload();
});







// --
const elemToggleFunc = function (elem) { elem.classList.toggle("active"); }
const navbar = document.querySelector("[data-nav]");
const navOpenBtn = document.querySelector("[data-nav-open-btn]");
const navCloseBtn = document.querySelector("[data-nav-close-btn]");
const overlay = document.querySelector("[data-overlay]");

const navElemArr = [navOpenBtn, navCloseBtn, overlay];

for (let i = 0; i < navElemArr.length; i++) {

  navElemArr[i].addEventListener("click", function () {
    elemToggleFunc(navbar);
    elemToggleFunc(overlay);
    elemToggleFunc(document.body);
  })

}


let togglemenu = document.getElementById("togglemenu");
let menu = document.getElementById("sub-menu");

togglemenu.onclick = function () {
  // console.log("Done");
  menu.classList.toggle("menu-open");
};
