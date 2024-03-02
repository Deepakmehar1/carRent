const img_items = document.querySelectorAll(".hr_img");
function showNextimg() {
  const itemCount = img_items.length;
  img_items[count].classList.remove("active");

  if (count < itemCount - 1) {
    count++;
  } else {
    count = 0;
  }
  img_items[count].classList.add("active");
}

function toggleAnswer(id) {
  var answer = document.getElementById(id);
  if (answer.style.display === "none") {
    answer.style.display = "block";
  } else {
    answer.style.display = "none";
  }
}
function stick_navigatio() {
  window.addEventListener("scroll", function () {
    var nav = this.document.querySelector("nav");
    nav.classList.toggle("sticky", window.scrollY > 0);
  });
}
stick_navigatio();

/* user */
var cancel = document.querySelector(".cancel");
var ed = document.querySelector(".ed");
var main = document.querySelector("main");
var footer = document.querySelector("footer");
var nav = document.querySelector("nav");
var edit = document.querySelector(".edit");
function card_apear() {
  
  ed.addEventListener("click", () => {
    edit.style.display = "block";
  main.style.pointerEvents = "none";
  main.style.opacity = "0.4";
  nav.style.pointerEvents = "none";
  nav.style.opacity = "0.4";
  footer.style.pointerEvents = "none";
  footer.style.opacity = "0.4";
});
cancel.addEventListener("click", () => {
  edit.style.display = "none";
  main.style.pointerEvents = "all";
  main.style.opacity = "1";
  nav.style.pointerEvents = "all";
  nav.style.opacity = "1";
  footer.style.pointerEvents = "all";
  footer.style.opacity = "1";
});
}