let togglemenu = document.getElementById("togglemenu");
let menu = document.getElementById("sub-menu");

togglemenu.onclick = function () {
  // console.log("Done");
  menu.classList.toggle("menu-open");
};
{
  let progressCircle = document.querySelector(".players");

  let radius = progressCircle.r.baseVal.value;

  let circumference = radius * 2 * Math.PI;
  progressCircle.style.strokeDasharray = circumference;
  let trynewone = document.getElementById("players-number");

  setProgress(trynewone.textContent);

  function setProgress(percent) {
    progressCircle.style.strokeDashoffset =
      circumference - (percent / 100) * circumference;
  }
}
{
  let progressCircle = document.querySelector(".teams");

  let radius = progressCircle.r.baseVal.value;

  let circumference = radius * 2 * Math.PI;
  progressCircle.style.strokeDasharray = circumference;
  let trynewone = document.getElementById("teams-number");

  setProgress(trynewone.textContent);

  function setProgress(percent) {
    progressCircle.style.strokeDashoffset =
      circumference - (percent / 100) * circumference;
  }
}
{
  let progressCircle = document.querySelector(".tournaments");

  let radius = progressCircle.r.baseVal.value;

  let circumference = radius * 2 * Math.PI;
  progressCircle.style.strokeDasharray = circumference;
  let trynewone = document.getElementById("tournaments-number");

  setProgress(trynewone.textContent);

  function setProgress(percent) {
    progressCircle.style.strokeDashoffset =
      circumference - (percent / 100) * circumference;
  }
}

const curser = document.querySelector(".curser");
document.addEventListener("mousemove", function (e) {
  let X = e.clientX;
  let Y = e.clientY;
  curser.style.left = X + "px";
  curser.style.top = Y + "px";
});
