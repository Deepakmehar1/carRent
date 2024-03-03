const img_items = document.querySelectorAll(".hr_img");
let count = 0;
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
/* booking */
      function calculatePrice(rental_price) {
          var startDate = document.getElementById('start_date').value;
          var endDate = document.getElementById('end_date').value;

          // Perform validation
          var startDateObj = new Date(startDate);
          var endDateObj = new Date(endDate);

          if (startDate === "" || endDate === "" || startDateObj >= endDateObj) {
              alert("Please select valid dates.");
              return;
          }

          var rentalDays = Math.ceil((endDateObj - startDateObj) / (1000 * 60 * 60 * 24)); // Number of days rounded up

          // Retrieve rental price per day from PHP variable (you should set this value dynamically)
          var rentalPricePerDay = rental_price;

          // Calculate total price
          var total_cost = rentalDays * rentalPricePerDay;
          // Display the total price to the user
          document.getElementById('total_cost').value = total_cost.toFixed(2);
      }

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
/* testimonial */
const t_items = document.querySelectorAll(".elem");
const nextItem = document.querySelector(".next");
const previousItem = document.querySelector(".previous");
const TitemCount = t_items.length;
let Tcount = 0;

function showNextTItem() {
  t_items[Tcount].classList.remove("active");

  if (Tcount < TitemCount - 1) {
    Tcount++;
  } else {
    Tcount = 0;
  }

  t_items[Tcount].classList.add("active");
}

function showPreviousTItem() {
  t_items[Tcount].classList.remove("active");

  if (Tcount > 0) {
    Tcount--;
  } else {
    Tcount = TitemCount - 1;
  }

  t_items[Tcount].classList.add("active");
  console.log(Tcount);
}
