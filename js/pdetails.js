let togglemenu = document.getElementById("togglemenu");
let menu = document.getElementById("sub-menu");

togglemenu.onclick = function () {
  // console.log("Done");
  menu.classList.toggle("menu-open");
};

let videosContainer = document.querySelector(".cot");
let videosNumber = document.getElementById("vn");
let createbtn = document.getElementById("create");

createbtn.onclick = (e) => {
  e.preventDefault();
  if (parseInt(videosNumber.value) > 0) {
    for (let i = 0; i < parseInt(videosNumber.value); i++) {
      let video = document.createElement("div");
      video.className = "videos";
      for (let v = 0; v < 4; v++) {
        let solidDiv = document.createElement("div");
        let vlabelname = document.createElement("label");
        if (v == 0) {
          vlabelname.textContent = `video name`;
          let inp = document.createElement("input");
          inp.type = "text";
          inp.name = "videoname[]";
          solidDiv.append(vlabelname);
          solidDiv.append(inp);
        }
        if (v == 1) {
          vlabelname.textContent = `video discription`;
          let inp = document.createElement("textarea");
          inp.name = "videodiscription[]";
          solidDiv.append(vlabelname);
          solidDiv.append(inp);
        }
        if (v == 2) {
          vlabelname.textContent = `video  source`;
          let inp = document.createElement("input");
          inp.type = "text";
          inp.name = "videosource[]";
          solidDiv.append(vlabelname);
          solidDiv.append(inp);
        }
        if (v == 3) {
          let inp = document.createElement("button");
          inp.textContent = "remove";
          inp.id = "remove";
          inp.setAttribute("onclick", "remvid(this)");
          solidDiv.append(inp);
        }
        video.append(solidDiv);
      }
      videosContainer.append(video);
    }
  } else {
    alert("the number must be postive");
  }
  videosNumber.value = "";
};

function remvid(re) {
  re.parentElement.parentElement.remove();
}

let warmupContainer = document.querySelector(".wcot");
let warmupNumber = document.getElementById("wn");
let wcreatebtn = document.getElementById("wcreate");

wcreatebtn.onclick = (e) => {
  e.preventDefault();
  if (parseInt(warmupNumber.value) > 0) {
    for (let i = 0; i < parseInt(warmupNumber.value); i++) {
      let warmup = document.createElement("div");
      warmup.className = "warmup";
      for (let w = 0; w < 4; w++) {
        let solidDiv = document.createElement("div");
        let wlabelname = document.createElement("label");
        if (w == 0) {
          wlabelname.textContent = `warmup name`;
          let winp = document.createElement("input");
          winp.type = "text";
          winp.name = "warmupname[]";
          solidDiv.append(wlabelname);
          solidDiv.append(winp);
        }
        if (w == 1) {
          wlabelname.textContent = `warmup discription`;
          let winp = document.createElement("textarea");
          winp.name = "warmupdiscription[]";
          solidDiv.append(wlabelname);
          solidDiv.append(winp);
        }
        if (w == 2) {
          wlabelname.textContent = `warmup  logo`;
          let winp = document.createElement("input");
          winp.type = "file";
          winp.name = "warmuplogo[]";
          solidDiv.append(wlabelname);
          solidDiv.append(winp);
        }
        if (w == 3) {
          let winp = document.createElement("button");
          winp.textContent = "remove";
          winp.id = "wremove";
          winp.setAttribute("onclick", "remvid(this)");
          solidDiv.append(winp);
        }
        warmup.append(solidDiv);
      }
      warmupContainer.append(warmup);
    }
  } else {
    alert("the number must be postive");
  }
  warmupNumber.value = "";
};

let toolsContainer = document.querySelector(".tcot");
let toolsNumber = document.getElementById("tn");
let tcreatebtn = document.getElementById("tcreate");

tcreatebtn.onclick = (e) => {
  e.preventDefault();
  if (parseInt(toolsNumber.value) > 0) {
    for (let i = 0; i < parseInt(toolsNumber.value); i++) {
      let tools = document.createElement("div");
      tools.className = "tools";
      for (let t = 0; t < 4; t++) {
        let solidDiv = document.createElement("div");
        let tlabelname = document.createElement("label");
        if (t == 0) {
          tlabelname.textContent = `tools name`;
          let tinp = document.createElement("input");
          tinp.type = "text";
          tinp.name = "toolsname[]";
          solidDiv.append(tlabelname);
          solidDiv.append(tinp);
        }
        if (t == 1) {
          tlabelname.textContent = `tools discription`;
          let tinp = document.createElement("textarea");
          tinp.name = "toolsdiscription[]";
          solidDiv.append(tlabelname);
          solidDiv.append(tinp);
        }
        if (t == 2) {
          tlabelname.textContent = `tools  logo`;
          let tinp = document.createElement("input");
          tinp.type = "file";
          tinp.name = "toolslogo[]";
          solidDiv.append(tlabelname);
          solidDiv.append(tinp);
        }
        if (t == 3) {
          let tinp = document.createElement("button");
          tinp.textContent = "remove";
          tinp.id = "tremove";
          tinp.setAttribute("onclick", "remvid(this)");
          solidDiv.append(tinp);
        }
        tools.append(solidDiv);
      }
      toolsContainer.append(tools);
    }
  } else {
    alert("the number must be postive");
  }
  toolsNumber.value = "";
};


