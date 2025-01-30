let togglemenu = document.getElementById("togglemenu");
let menu = document.getElementById("sub-menu");

togglemenu.onclick = function () {
  // console.log("Done");
  menu.classList.toggle("menu-open");
};

// -------------------------------------------------------

let tabs = document.querySelectorAll(".tabs li");
let tabsArray = Array.from(tabs);
let divs = document.querySelectorAll(".content .tebs-content > div");
let divsArray = Array.from(divs);

// console.log(tabsArray);

tabsArray.forEach((ele) => {
  ele.addEventListener("click", function (e) {
    // console.log(ele);
    tabsArray.forEach((ele) => {
      ele.classList.remove("btnactive");
    });
    e.currentTarget.classList.add("btnactive");
    divsArray.forEach((div) => {
      div.style.display = "none";
    });
    // console.log(e.currentTarget.dataset.cont);
    if (e.currentTarget.dataset.cont == ".two") {
      document.querySelector(e.currentTarget.dataset.cont).style.display =
        "flex";
    } else {
      document.querySelector(e.currentTarget.dataset.cont).style.display =
        "block";
    }
  });
});

let threetabs = document.querySelectorAll(".three li");
let threetabsArray = Array.from(threetabs);
let threedivs = document.querySelectorAll(".three .tab2 > div");
let threedivsArray = Array.from(threedivs);

// console.log(tabsArray);

threetabsArray.forEach((newele) => {
  newele.addEventListener("click", function (newe) {
    // console.log(newele);
    threetabsArray.forEach((newele) => {
      newele.classList.remove("newactive");
    });
    newe.currentTarget.classList.add("newactive");
    threedivsArray.forEach((newdiv) => {
      newdiv.style.display = "none";
    });
    // console.log(e.currentTarget.dataset.cont);
    // document.querySelector(e.currentTarget.dataset.cont).style.display =
    //   "block";
    if (newe.currentTarget.dataset.cont == ".newtwo") {
      document.querySelector(newe.currentTarget.dataset.cont).style.display =
        "flex";
    } else {
      document.querySelector(newe.currentTarget.dataset.cont).style.display =
        "block";
    }
  });
});

// let update = document.querySelectorAll("#update");

// update.forEach((e) => {
//   e.onclick = (ele) => {
//     ele.preventDefault();
//     console.log("Done");
//   };
// });

// ------------------------------------------------------------------

$(document).on("ready", function () {
  var knownBrackets = [2, 4, 8, 16, 32], // brackets with "perfect" proportions (full fields, no byes)
    exampleTeams = _.shuffle([
      "raad",
      "anoubis",
      "3",
      "4",
      "5",
      "6",
      "7",
      "8",
      // "team i",
      // "team j",
      // "team k",
      // "team l",
      // "team m",
      // "team n",
      // "team o",
      // "team p",
      // "team q",
      // "team r",
      // "team s",
      // "team t",
      // "team u",
      // "team v",
      // "team w",
      // "team x",
      // "team y",
      // "team z",
      // "team a",
      // "team b",
      // "team c",
      // "team d",
      // "team e",
      // "team f",
      // "team g",
      // "New Jersey Devils",
      // "New York Islanders",
      // "New York Rangers",
      // "Philadelphia Flyers",
      // "Pittsburgh Penguins",
      // "Boston Bruins",
      // "Buffalo Sabres",
      // "Montreal Canadiens",
      // "Ottawa Senators",
      // "Toronto Maple Leafs",
      // "Carolina Hurricanes",
      // "Florida Panthers",
      // "Tampa Bay Lightning",
      // "Washington Capitals",
      // "Winnipeg Jets",
      // "Chicago Blackhawks",
      // "Columbus Blue Jackets",
      // "Detroit Red Wings",
      // "Nashville Predators",
      // "St. Louis Blues",
      // "Calgary Flames",
      // "Colorado Avalanche",
      // "Edmonton Oilers",
      // "Minnesota Wild",
      // "Vancouver Canucks",
      // "Anaheim Ducks",
      // "Dallas Stars",
      // "Los Angeles Kings",
      // "Phoenix Coyotes",
      // "San Jose Sharks",
      // "Montreal Wanderers",
      // "Quebec Nordiques",
      // "Hartford Whalers",
    ]), // because a bracket needs some teams!
    bracketCount = 0;

  /*
   * Build our bracket "model"
   */
  function getBracket(base) {
    var closest = _.find(knownBrackets, function (k) {
        return k >= base;
      }),
      byes = closest - base;

    if (byes > 0) base = closest;

    var brackets = [],
      round = 1,
      baseT = base / 2,
      baseC = base / 2,
      teamMark = 0,
      nextInc = base / 2;

    for (i = 1; i <= base - 1; i++) {
      var baseR = i / baseT,
        isBye = false;

      if (byes > 0 && (i % 2 != 0 || byes >= baseT - i)) {
        isBye = true;
        byes--;
      }

      var last = _.map(
        _.filter(brackets, function (b) {
          return b.nextGame == i;
        }),
        function (b) {
          return { game: b.bracketNo, teams: b.teamnames };
        }
      );

      brackets.push({
        lastGames: round == 1 ? null : [last[0].game, last[1].game],
        nextGame: nextInc + i > base - 1 ? null : nextInc + i,
        teamnames:
          round == 1
            ? [exampleTeams[teamMark], exampleTeams[teamMark + 1]]
            : [last[0].teams[_.random(1)], last[1].teams[_.random(1)]],
        bracketNo: i,
        roundNo: round,
        bye: isBye,
      });
      teamMark += 2;
      if (i % 2 != 0) nextInc--;
      while (baseR >= 1) {
        round++;
        baseC /= 2;
        baseT = baseT + baseC;
        baseR = i / baseT;
      }
    }

    renderBrackets(brackets);
  }

  /*
   * Inject our brackets
   */
  function renderBrackets(struct) {
    var groupCount = _.uniq(
      _.map(struct, function (s) {
        return s.roundNo;
      })
    ).length;

    var group = $(
        '<div class="group' +
          (groupCount + 1) +
          '" id="b' +
          bracketCount +
          '"></div>'
      ),
      grouped = _.groupBy(struct, function (s) {
        return s.roundNo;
      });

    for (g = 1; g <= groupCount; g++) {
      var round = $('<div class="r' + g + '"></div>');
      _.each(grouped[g], function (gg) {
        if (gg.bye) round.append("<div></div>");
        else
          round.append(
            '<div class = "edit"><div class="bracketbox"><span class="info">' +
              // '<div><div class="bracketbox"><span class="info" contenteditable>' +
              "" +
              // (gg.bracketNo - gg.bracketNo) +
              // '</span><span class="teama" contenteditable>' +
              '</span><span class="teama" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true" id = "brack-box">' +
              // gg.teamnames[0] +
              "" +
              // '</span><span class="info" contenteditable>' +
              '</span><span class="info">' +
              "" +
              // ( gg.bracketNo - gg.bracketNo ) +
              // '</span><span class="teamb" contenteditable>' +
              '</span><span class="teamb" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true" id = "brack-box">' +
              "" +
              // gg.teamnames[1] +
              "</span></div></div>"
          );
      });
      group.append(round);
    }
    group.append(
      '<div class="r' +
        (groupCount + 1) +
        '"><div class="final"><div class="bracketbox"><span class="teamc">' +
        "" +
        // _.last(struct).teamnames[_.random(1)] +
        "</span></div></div></div>"
    );
    let tr = document.querySelector(".two #brackets");
    let tre = document.querySelector(".two #brackets div");
    if (tr.childElementCount == 0) {
      // console.log(tr.childElementCount);
      $(".two #brackets").append(group);
    } else {
      tre.remove();
      $(".two #brackets").append(group);
    }

    bracketCount++;
    // $("html,body").animate({
    //   scrollTop: $("#b" + (bracketCount - 1)).offset().top,
    // });
  }
  // document.getElementById("ksjdf").onload
  // $("#add").on("click", function () {
  // $(".tour-size").on("change", function () {
  // $(".trty").on("load", function () {
  document.querySelector("body").onload = function () {
  // document.querySelector(".tour-size").onchange = function () {
    // var opts = parseInt(prompt("Bracket size (number of teams):", 32));
    var opts = parseInt(document.querySelector(".tour-size").value);
    // console.log(opts);
    // if (!_.isNaN(opts) && opts <= _.last(knownBrackets)) getBracket(opts);
    // else alert("The bracket size you specified is not currently supported.");
    let secbrack = document.querySelector(".two .brackets");
    if (secbrack.childElementCount == 0) {
      if (!_.isNaN(opts) && opts <= _.last(knownBrackets)) getBracket(opts);
      else alert("The bracket size you specified is not currently supported.");
      // } else {
      //   let test = document.querySelectorAll(".bracketbox #brack-box");
      //   test.forEach((e) => {
      //     let emptytds = document.querySelectorAll("tbody tr td.td");
      //     emptytds.forEach((td) => {
      //       if (td.childElementCount == 0) {
      //         td.append(e);
      //       }
      //     });
      //   });
    }
    if (!_.isNaN(opts) && opts <= _.last(knownBrackets)) getBracket(opts);
    else alert("The bracket size you specified is not currently supported.");
  };
});

// -------------------------------------------------------------------
const allBoxes = document.querySelectorAll("#brack-box");
const allTasks = document.querySelectorAll("#team-drag");
const trash = document.querySelector(".recycle");

allTasks.forEach((task) => {
  task.addEventListener("dragstart", () => {
    task.classList.add("is-dragging");
    // if (task.parentElement.className == "td") {
    //   let span = document.createElement("span");
    //   span.id = "team-drag";
    //   span.draggable = true;
    //   span.textContent = task.textContent;
    //   task.parentElement.append(span);
    // } else {
    //   task.classList.add("is-dragging");
    //   // console.log("looooooooooooooooo");
    // }
  });
  task.addEventListener("dragend", () => {
    task.classList.remove("is-dragging");
  });
});

allBoxes.forEach((box) => {
  box.addEventListener("dragover", (e) => {
    e.preventDefault();

    let curTask = document.querySelector(".is-dragging");

    box.append(curTask);
  });
});

trash.addEventListener("dragover", (e) => {
  e.preventDefault();
  let emptytds = document.querySelectorAll("tbody tr td.td");
  emptytds.forEach((e) => {
    if (e.childElementCount == 0) {
      let trcon = document.querySelector(".is-dragging");
      e.append(trcon);
    }
  });
  // trcon.remove();
});
document.querySelector(".recycle").ondblclick = (e) => {
  e.preventDefault();
  let brackdata = document.querySelectorAll(".bracketbox #brack-box span");
  brackdata.forEach((bd) => {
    let emptytds = document.querySelectorAll("tbody tr td.td");
    emptytds.forEach((td) => {
      if (td.childElementCount == 0) {
        td.append(bd);
      }
    });
  });
};
// trash.addEventListener("dragend", (e) => {
//   e.preventDefault();
//   // e.remove();
//   // console.log("try");
//   let emptytds = document.querySelectorAll("tbody tr td.td");
//   emptytds.forEach((e) => {
//     if (e.childElementCount == 0) {
//       let trcon = document.querySelector(".is-dragging");
//       e.append(trcon);
//     }
//   });
// });
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.append(document.getElementById(data));
}
// -------------------------------------------------------------------

let saver1br = document.querySelector(".two #update");
saver1br.onclick = () => {
  let firstbracket = document.querySelector(".two #brackets");
  let secoundbracket = document.querySelector(".three #brackets");
  let secoundbracketdiv = document.querySelector(".three #brackets div");
  var clone = firstbracket.cloneNode(true);
  clone.id = "bracket";
  clone.className = "brackets";

  if (secoundbracket.childElementCount == 0) {
    secoundbracket.append(clone);
  } else {
    secoundbracketdiv.remove();
    secoundbracket.append(clone);
  }
  let act = document.querySelectorAll(".three .brackets .bracketbox");
  act.forEach((e) => {
    e.setAttribute(
      "onclick",
      "matchres(this.children[1],this.children[3],this.parentElement.parentElement.nextElementSibling.children , this)"
    );
  });
};

// -------------------------------------------------------------------

let section = document.querySelector("section");
let overlay = document.querySelector(".overlay");
let showBtn = document.querySelectorAll(".three div.edit .bracketbox");
let closeBtn = document.querySelector("#savematch");

let teama = document.querySelectorAll(".teama-name");
let teamb = document.querySelectorAll(".teamb-name");

function apendteama(b, x) {
  x.forEach((e) => {
    e.textContent = b.textContent;
  });
}
function apendteamb(r, y) {
  y.forEach((e) => {
    e.textContent = r.textContent;
  });
}

let think1 = 0;
let think2 = 0;
let tree = 0;
function matchres(b, r, x, y) {
  section.classList.add("active");
  section.style.zIndex = "10";

  apendteama(b, teama);
  apendteamb(r, teamb);

  think1 = x;
  think2 = y;
}

// showBtn.forEach((e) => {
//   e.onclick = () => {
//     matchres();
//     let teama = document.querySelector(".teama-name");
//     let teamb = document.querySelector(".teamb-name");
//     // console.log(e.children[1].textContent);
//     // console.log(e.children[3].textContent);
//     teama.textContent = e.children[1].textContent;
//     teamb.textContent = e.children[3].textContent;
//     // teamname.forEach((tn) => {});
//     // console.log(teamname);
//     // e.children.item.name;
//   };
// });

document.querySelectorAll(".three .brackets span").forEach((e) => {
  if (e.hasAttribute("draggable") === true) {
    e.removeAttribute("draggable");
  }
});

overlay.addEventListener("click", () => {
  let tascore = document.querySelector(".teama-score");
  let tbscore = document.querySelector(".teamb-score");
  let date = document.getElementById("date");
  let time = document.getElementById("time");
  let tabs2li = document.querySelectorAll(".tabs2 li");
  taw.style.backgroundColor = "#8181817a";
  taw.style.border = "1px solid #414141";
  tal.style.backgroundColor = "#8181817a";
  tal.style.border = "1px solid #414141";
  tbw.style.backgroundColor = "#8181817a";
  tbw.style.border = "1px solid #414141";
  tbl.style.backgroundColor = "#8181817a";
  tbl.style.border = "1px solid #414141";
  tascore.value = "";
  tbscore.value = "";
  date.value = "";
  time.value = "";
  if (tabs2li[1].className == "newactive") {
    document.querySelector(".tabs2 li.newactive").classList.remove("newactive");
    document.querySelector(".newtwo").style.display = "none";
    document.querySelector(".newone").style.display = "block";
    document.querySelectorAll(".tabs2 li")[0].classList.add("newactive");
  }
  section.classList.remove("active");
});

let r2 = document.querySelector(".three .brackets");

function firstteams(pl, dta) {
  let tester = document.querySelector(".three .brackets .brackets");
  // console.log(
  //   // tester.children[0].children[4].children[0].children[0],
  //   tester.children[0].children[1].children[0].children[0],
  //   tester.children[0].children[2].children[0].children[0].children[0]
  // );
  // console.log(
  //   tester.children[0].children[4].children[0].children[0].children[0]
  // );
  // 2 Teams
  if (
    r2.children[0].children[0].children[0].children[0].nextElementSibling ==
    null
  ) {
    // console.log(pl);
    // console.log(
    //   tester.children[0].children[1].children[0].children[0].children[0]
    // );
    if (think2 == tester.children[0].children[0].children[0].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[0].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[0]
      // );
      // console.log("2");
    }
  } else if (
    r2.children[0].children[0].children[0].children[0].nextElementSibling
      .nextElementSibling == null
  ) {
    //4 teams
    // console.log(
    //   tester.children[0].children[1].children[0].children[0].children[3]
    // );
    // console.log(think2);
    // console.log(
    //   tester.children[0].children[2].children[0].children[0].children[0]
    // );
    if (think2 == tester.children[0].children[0].children[0].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[1]
      // );
    }
    if (think2 == tester.children[0].children[0].children[1].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[1].children[0].children[0]) {
      tester.children[0].children[2].children[0].children[0].children[0].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
      // console.log("Done");
    }
    // console.log("4");
    // console.log(
    //   r2.children[0].children[0].children[0].children[0].nextElementSibling
    // );
  } else if (
    r2.children[0].children[0].children[0].children[0].nextElementSibling
      .nextElementSibling.nextElementSibling.nextElementSibling == null
  ) {
    // 8 teams
    if (think2 == tester.children[0].children[0].children[0].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[1]
      // );
    }
    if (think2 == tester.children[0].children[0].children[1].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[1].children[0].children[0]) {
      tester.children[0].children[2].children[0].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[0].children[2].children[0]) {
      tester.children[0].children[1].children[1].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[0].children[3].children[0]) {
      tester.children[0].children[1].children[1].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[1].children[1].children[0]) {
      tester.children[0].children[2].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[2].children[0].children[0]) {
      tester.children[0].children[3].children[0].children[0].children[0].textContent =
        dta.textContent;
      // console.log("Done");
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    // console.log(dta);
    // console.log("8");
    // console.log(think2.children[1]);
    // console.log(think2);
    // console.log(tester.children[0].children[0].children[0].children[0]);
    // console.log(
    //   r2.children[0].children[0].children[0].children[0].nextElementSibling
    //     .nextElementSibling.nextElementSibling
    // );
  } else if (
    r2.children[0].children[0].children[0].children[0].nextElementSibling
      .nextElementSibling.nextElementSibling.nextElementSibling
      .nextElementSibling.nextElementSibling.nextElementSibling
      .nextElementSibling == null
  ) {
    // 16 teams
    if (think2 == tester.children[0].children[0].children[0].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[1]
      // );
    }
    if (think2 == tester.children[0].children[0].children[1].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[1].children[0].children[0]) {
      tester.children[0].children[2].children[0].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[0].children[2].children[0]) {
      tester.children[0].children[1].children[1].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[0].children[3].children[0]) {
      tester.children[0].children[1].children[1].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[1].children[1].children[0]) {
      tester.children[0].children[2].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[2].children[0].children[0]) {
      tester.children[0].children[3].children[0].children[0].children[1].textContent =
        dta.textContent;
    }
    if (think2 == tester.children[0].children[0].children[4].children[0]) {
      tester.children[0].children[1].children[2].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[1]
      // );
    }
    if (think2 == tester.children[0].children[0].children[5].children[0]) {
      tester.children[0].children[1].children[2].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[0].children[6].children[0]) {
      tester.children[0].children[1].children[3].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[0].children[7].children[0]) {
      tester.children[0].children[1].children[3].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[1].children[2].children[0]) {
      tester.children[0].children[2].children[1].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[1].children[3].children[0]) {
      tester.children[0].children[2].children[1].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[2].children[1].children[0]) {
      tester.children[0].children[3].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log("Done");
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[3].children[0].children[0]) {
      tester.children[0].children[4].children[0].children[0].children[0].textContent =
        dta.textContent;
      // console.log("Done");
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
  } else if (
    r2.children[0].children[0].children[0].children[0].nextElementSibling
      .nextElementSibling.nextElementSibling.nextElementSibling
      .nextElementSibling.nextElementSibling.nextElementSibling
      .nextElementSibling.nextElementSibling.nextElementSibling
      .nextElementSibling.nextElementSibling.nextElementSibling
      .nextElementSibling.nextElementSibling.nextElementSibling == null
  ) {
    if (think2 == tester.children[0].children[0].children[0].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[1]
      // );
    }
    if (think2 == tester.children[0].children[0].children[1].children[0]) {
      tester.children[0].children[1].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[1].children[0].children[0]) {
      tester.children[0].children[2].children[0].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[0].children[2].children[0]) {
      tester.children[0].children[1].children[1].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[0].children[3].children[0]) {
      tester.children[0].children[1].children[1].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[1].children[1].children[0]) {
      tester.children[0].children[2].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[2].children[0].children[0]) {
      tester.children[0].children[3].children[0].children[0].children[1].textContent =
        dta.textContent;
    }
    if (think2 == tester.children[0].children[0].children[4].children[0]) {
      tester.children[0].children[1].children[2].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[1]
      // );
    }
    if (think2 == tester.children[0].children[0].children[5].children[0]) {
      tester.children[0].children[1].children[2].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[0].children[6].children[0]) {
      tester.children[0].children[1].children[3].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[0].children[7].children[0]) {
      tester.children[0].children[1].children[3].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[1].children[2].children[0]) {
      tester.children[0].children[2].children[1].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[1].children[3].children[0]) {
      tester.children[0].children[2].children[1].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[2].children[1].children[0]) {
      tester.children[0].children[3].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log("Done");
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[3].children[0].children[0]) {
      tester.children[0].children[4].children[0].children[0].children[1].textContent =
        dta.textContent;
      // console.log("Done");
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    // 32 teams
    // console.log("32");
    // console.log(
    //   r2.children[0].children[0].children[0].children[0].nextElementSibling
    //     .nextElementSibling.nextElementSibling.nextElementSibling
    //     .nextElementSibling.nextElementSibling.nextElementSibling
    //     .nextElementSibling.nextElementSibling.nextElementSibling
    //     .nextElementSibling.nextElementSibling.nextElementSibling
    //     .nextElementSibling.nextElementSibling
    // );
    if (think2 == tester.children[0].children[0].children[8].children[0]) {
      tester.children[0].children[1].children[4].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[1]
      // );
    }
    if (think2 == tester.children[0].children[0].children[9].children[0]) {
      tester.children[0].children[1].children[4].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[0].children[10].children[0]) {
      tester.children[0].children[1].children[5].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[0].children[11].children[0]) {
      tester.children[0].children[1].children[5].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[0].children[12].children[0]) {
      tester.children[0].children[1].children[6].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[0].children[13].children[0]) {
      tester.children[0].children[1].children[6].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[0].children[14].children[0]) {
      tester.children[0].children[1].children[7].children[0].children[1].textContent =
        dta.textContent;
    }
    if (think2 == tester.children[0].children[0].children[15].children[0]) {
      tester.children[0].children[1].children[7].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[1]
      // );
      //--------------------------------------------------------------
    }
    if (think2 == tester.children[0].children[1].children[4].children[0]) {
      tester.children[0].children[2].children[2].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[1].children[5].children[0]) {
      tester.children[0].children[2].children[2].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[1].children[6].children[0]) {
      tester.children[0].children[2].children[3].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[1].children[0].children[0].children[3]
      // );
    }
    if (think2 == tester.children[0].children[1].children[7].children[0]) {
      tester.children[0].children[2].children[3].children[0].children[3].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[2].children[2].children[0]) {
      tester.children[0].children[3].children[1].children[0].children[1].textContent =
        dta.textContent;
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[2].children[3].children[0]) {
      tester.children[0].children[3].children[1].children[0].children[3].textContent =
        dta.textContent;
      // console.log("Done");
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[3].children[1].children[0]) {
      tester.children[0].children[4].children[0].children[0].children[3].textContent =
        dta.textContent;
      // console.log("Done");
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
    if (think2 == tester.children[0].children[4].children[0].children[0]) {
      tester.children[0].children[5].children[0].children[0].children[0].textContent =
        dta.textContent;
      // console.log("Done");
      // console.log(
      //   tester.children[0].children[2].children[0].children[0].children[0]
      // );
    }
  } else {
    console.log("Error");
  }
}

let ta;
let tb;
closeBtn.addEventListener("click", (e) => {
  e.preventDefault();
  let tascore = document.querySelector(".teama-score");
  let tbscore = document.querySelector(".teamb-score");
  if (taw.style.backgroundColor == "darkgreen") {
    firstteams(think2, teama[0]);
  }
  if (tbw.style.backgroundColor == "darkgreen") {
    firstteams(think2, teamb[0]);
  }
  think2.children[0].textContent = tascore.value;
  think2.children[2].textContent = tbscore.value;
  // console.log(tascore.value);
  // console.log(tbscore.value);

  taw.style.backgroundColor = "#8181817a";
  taw.style.border = "1px solid #414141";
  tal.style.backgroundColor = "#8181817a";
  tal.style.border = "1px solid #414141";
  tbw.style.backgroundColor = "#8181817a";
  tbw.style.border = "1px solid #414141";
  tbl.style.backgroundColor = "#8181817a";
  tbl.style.border = "1px solid #414141";
  tascore.value = "";
  tbscore.value = "";
  section.classList.remove("active");
});

let taw = document.getElementById("taw");
let tal = document.getElementById("tal");
let tbw = document.getElementById("tbw");
let tbl = document.getElementById("tbl");
let closeres = document.querySelector("th div.clear-mark");

taw.onclick = () => {
  taw.style.backgroundColor = "darkgreen";
  tbl.style.backgroundColor = "darkred";
  tal.style.backgroundColor = "#8181817a";
  tal.style.border = "1px solid #414141";
  tbw.style.backgroundColor = "#8181817a";
  tbw.style.border = "1px solid #414141";
};
tbw.onclick = () => {
  tbw.style.backgroundColor = "darkgreen";
  tal.style.backgroundColor = "darkred";
  tbl.style.backgroundColor = "#8181817a";
  tbl.style.border = "1px solid #414141";
  taw.style.backgroundColor = "#8181817a";
  taw.style.border = "1px solid #414141";
};

tal.onclick = () => {
  tbw.style.backgroundColor = "darkgreen";
  tal.style.backgroundColor = "darkred";
  taw.style.backgroundColor = "#8181817a";
  taw.style.border = "1px solid #414141";
  tbl.style.backgroundColor = "#8181817a";
  tbl.style.border = "1px solid #414141";
};
tbl.onclick = () => {
  taw.style.backgroundColor = "darkgreen";
  tbl.style.backgroundColor = "darkred";
  tbw.style.backgroundColor = "#8181817a";
  tbw.style.border = "1px solid #414141";
  tal.style.backgroundColor = "#8181817a";
  tal.style.border = "1px solid #414141";
};

closeres.onclick = () => {
  taw.style.backgroundColor = "#8181817a";
  taw.style.border = "1px solid #414141";
  tal.style.backgroundColor = "#8181817a";
  tal.style.border = "1px solid #414141";
  tbw.style.backgroundColor = "#8181817a";
  tbw.style.border = "1px solid #414141";
  tbl.style.backgroundColor = "#8181817a";
  tbl.style.border = "1px solid #414141";
};

// let savebr = document.getElementById("save");
// savebr.onclick = (w) => {
//   let ashraf = document.getElementById("ashraf");
//   let mainbr = document.querySelector(".three .brackets");
//   let cloner = document.getElementById("cloner");
//   let brcl = mainbr.cloneNode(true);
//   w.preventDefault();
//   cloner.append(brcl);
//   let clonecli = document.querySelectorAll("#cloner .bracketbox");
//   let clonedrag = document.querySelectorAll("#cloner .bracketbox #brack-box");
//   clonecli.forEach((e) => {
//     e.removeAttribute("onclick");
//   });
//   clonedrag.forEach((e) => {
//     e.removeAttribute("ondrop");
//     e.removeAttribute("ondragover");
//   });
//   ashraf.value = cloner.innerHTML;
//   console.log(ashraf.value);
// };

// section.classList.remove("active");

let savedate = document.getElementById("savedate");
savedate.onclick = (e) => {
  e.preventDefault();
  // let mainbracketbox = document.querySelectorAll(".three .bracketbox");
  let date = document.getElementById("date");
  let time = document.getElementById("time");
  if (date.value != "" && time.value != "") {
    let ct = window.getComputedStyle(think2, "::before");
    think2.style.setProperty(
      "--beforebrdate",
      `"${date.value} | ${time.value}"`
    );
    console.log(ct.content);
  }

  document.querySelector(".tabs2 li.newactive").classList.remove("newactive");
  document.querySelector(".newtwo").style.display = "none";
  document.querySelector(".newone").style.display = "block";
  document.querySelectorAll(".tabs2 li")[0].classList.add("newactive");
  date.value = "";
  time.value = "";
  section.classList.remove("active");
};

var node = document.querySelector(".three .brackets");
      let imgUrl ;

// function submitForm() {

//   document.getElementById("tournamentbracketform").submit();
// }

let savebracket = document.getElementById("save");
savebracket.onclick = (w) => {
  let tournamentbracketadmin = document.getElementById("tournamentbracketadmin");
  let mainbracket = document.querySelector(".three .brackets");
  tournamentbracketadmin.value = mainbracket.innerHTML;
  domtoimage.toPng(node)
  .then(function (dataUrl) {
      imgUrl = dataUrl
   document.querySelector("input[type='text']#tournamentbracket").value= dataUrl
   document.getElementById("tournamentbracketform").submit();
   console.log(document.querySelector("input[type='text']#tournamentbracket").value);
   })
  // console.log(tournamentbracketadmin.value);
};

// var node = document.querySelector(".three .brackets");
//       let imgUrl ;
// function htmlToImg(){
// 	domtoimage.toPng(node)
//   .then(function (dataUrl) {
//       imgUrl = dataUrl
//    document.querySelector("input[type='text']#tournamentbracket").value= dataUrl
//    console.log(document.querySelector("input[type='text']#tournamentbracket").value);
//    })
//   }
//   .catch(function (error) {
//       console.error('oops, something went wrong!', error);
//   });
// }

// function imgDown(){
// 	var a = document.createElement('a');
// 	a.href = imgUrl;
// 	a.download = "htmlToImg.png";
// 	a.click();
// }


