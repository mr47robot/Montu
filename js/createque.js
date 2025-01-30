let questionsNumber = document.getElementById("qsn");
let create = document.getElementById("qsn-btn");
let qscont = document.getElementById("qanda");
let pqn = document.querySelector("p.qsnumber");
let delall = document.getElementById("delate-all");
let savall = document.getElementById("save");

create.onclick = (e) => {
  e.preventDefault();
  if (parseInt(questionsNumber.value) > 0) {
    pqn.textContent =
      parseInt(questionsNumber.value) + parseInt(pqn.textContent);
    for (let i = 0; i < parseInt(questionsNumber.value); i++) {
      let qs = document.createElement("div");
      qs.id = "qs";
      for (let x = 0; x <= 6; x++) {
        let inp = document.createElement("input");
        inp.setAttribute("type", "text");
        if (x == 0) {
          inp.placeholder = "Question " ;
          inp.name = `Question[]`;
          qs.append(inp);
        } else if (x == 1) {
          inp.placeholder = `Answer${x}`;
          inp.id = "ans";
          inp.name = `answer${x}[]`;
          inp.className = "ansdta";
          qs.append(inp);
        } else if (x == 6) {
          let btn = document.createElement("button");
          btn.id = "ans";
          btn.textContent = "delete";
          btn.setAttribute("onclick", "del(this)");
          qs.append(btn);
        } else if (x == 5) {
          let sel = document.createElement("select");
          let opt1 = document.createElement("option")
          let opt2 = document.createElement("option")
          let opt3 = document.createElement("option")
          let opt4 = document.createElement("option")
          sel.append(opt1);
          sel.append(opt2);
          sel.append(opt3);
          sel.append(opt4);
          sel.placeholder = `Correct Answer`;
          sel.name = `corrans[]`;
          sel.id = "ans";
          sel.className = "chma";
          sel.setAttribute("onclick","testy(this)");
          qs.append(sel);
        } else {
          inp.placeholder = `Answer${x}`;
          inp.id = "ans";
          inp.name = `answer${x}[]`;
          inp.className = "ansdta";
          qs.append(inp);
        }
        qscont.append(qs);
      }
    }
    questionsNumber.value = "";
    savall.style.display = "block";
    // if (qscont.childElementCount != parseInt(questionsNumber.value)) {
    // } else {
    //   alert("You Entered The Same Questions Number That Created Before");
    // }
  } else {
    alert("The Number Must Be Greater Than Zero");
  }
}

function del(loc) {
  loc.parentElement.remove();
  pqn.textContent = parseInt(pqn.textContent) - 1;
}

delall.onclick = (e) => {
  e.preventDefault();
  let al = document.querySelectorAll("#qs");
  al.forEach((e) => {
    e.remove();
  });
  pqn.textContent = "0";
  savall.style.display = "none";
};
// questionsNumber.parentElement.children.item(0)
// questionsNumber.childNodes
// savall.onclick = (e) => {
//   e.preventDefault();
// };




// questionsNumber.onclick = ()=>{
//   console.log(questionsNumber.value);
// }


// lastqnsforall.forEach((e)=>{
//   e.onchange = ()=>{
  //     console.log("Done");
  //   }
  // })
  
function testy (xe){
  let datacontainer = "";
  let opts = document.querySelectorAll("option");
  xe.parentElement.childNodes.forEach((e)=>{
    if(e != undefined && e.className == "ansdta"){
      // xe.value += e.value;
      datacontainer += (e.value + "-");
    }
  });
  datacontainer = datacontainer.split("-");
  xe.childNodes[0].textContent = datacontainer[0]
  xe.childNodes[1].textContent = datacontainer[1]
  xe.childNodes[2].textContent = datacontainer[2]
  xe.childNodes[3].textContent = datacontainer[3]
  // console.log(datacontainer[0]);
  // console.log(xe.childNodes[0]);
}