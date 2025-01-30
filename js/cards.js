let togglemenu = document.getElementById("togglemenu");
let menu = document.getElementById("sub-menu");

togglemenu.onclick = function () {
  menu.classList.toggle("menu-open");
};

let section = document.querySelector("section");
let overlay = document.querySelector(".overlay");
let showBtn = document.querySelector(".main");
let closeBtn = document.querySelector("#create");

let gameName = document.getElementById("game-name");
let gameLogo = document.getElementById("file");
let gameDiscription = document.getElementById("game-discription");

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
  // gameName.value = "";
  // gameLogo.src = "";
  // gameDiscription.value = "";
  section.classList.add("active");
});

overlay.addEventListener("click", () => section.classList.remove("active"));

closeBtn.addEventListener("click", (e) => {
  // e.preventDefault();
  if (
    gameName.value === "" ||
    gameLogo.value === "" ||
    gameDiscription.value === ""
  ) {
    alert("Fill The Fields");
  } else {
    // createCard();
    section.classList.remove("active");
  }
});
