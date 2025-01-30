const elemToggleFunc = function (elem) { elem.classList.toggle("active"); }



/**
 * navbar variables
 */

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

//   let landingpage =document.querySelector('.land');
// let imgarray=["02.jpg","03.jpg"];
// setInterval(()=>{
// let randomnumber=Math.floor(Math.random()*imgarray.length);
// landingpage.style.backgroundImage='url("img/' + imgarray[randomnumber] + '")';

// },2000);
