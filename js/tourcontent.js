let togglemenu = document.getElementById("togglemenu");
let menu = document.getElementById("sub-menu");

togglemenu.onclick = function () {
  // console.log("Done");
  menu.classList.toggle("menu-open");
};

let section = document.querySelector("section");
let overlay = document.querySelector(".overlay");
let showBtn = document.querySelector(".main");
/* let closeBtn = document.querySelector("#create"); */

let tournamentName = document.getElementById("tournament-name");
let teamsNumber = document.getElementById("teams-number");
let tournamentEmail = document.getElementById("tournament-email");
let tournamentLogo = document.getElementById("file");
let tournamentDiscription = document.getElementById("tournament-discription");

// function createCard() {
//   let mainHead = document.getElementById("head");
//   let card = document.createElement("div");
//   let pname = document.createElement("p");
//   let pdisc = document.createElement("P");
//   let img = document.createElement("img");
//   let link = document.createElement("a");
//   let reader = new FileReader();

//   card.className = "add-card";
//   pname.id = "name";
//   pname.textContent = tournamentName.value;
//   pdisc.id = "disc";
//   pdisc.textContent = tournamentDiscription.value;
//   reader.readAsDataURL(tournamentLogo.files[0]);
//   reader.onload = () => {
//     img.setAttribute("src", reader.result);
//   };
//   img.id = "event";

//   //page link is here --------------------------------------------------
//   // link.href = "../Dashboard/tournaments/tournament page/tourpage.html";
//   link.href = "./tournament page/tourpage.html";
//   //page link is here --------------------------------------------------

//   link.append(pname);
//   link.append(pdisc);
//   link.append(img);
//   card.append(link);
//   mainHead.append(card);
// }

showBtn.addEventListener("click", () => {
  tournamentName.value = "";
  teamsNumber.value = "";
  tournamentEmail.value = "";
  tournamentLogo.value = "";
  tournamentDiscription.value = "";
  section.classList.add("active");
});

overlay.addEventListener("click", () => section.classList.remove("active"));

// closeBtn.addEventListener("click", (e) => {
//   e.preventDefault();
  // console.log(tournamentName.value);
  // console.log(teamsNumber.value);
  // console.log(tournamentEmail.value);
  // console.log(tournamentLogo.value);
  // console.log(tournamentDiscription.value);
//   if (
//     tournamentName.value === "" ||
//     teamsNumber.value === "" ||
//     tournamentLogo.value === "" ||
//     /\w+@\w+\.\w+/gi.test(tournamentEmail.value) === false ||
//     tournamentDiscription.value === ""
//   ) {
//     console.log("error");
//     console.log(tournamentEmail.value);
//   } else {
//     createCard();
//     section.classList.remove("active");
//   }
// }); 
