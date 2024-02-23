<style>
  .slider {
    display: flex;
    justify-content: space-around;
    align-items: center;
  }
  button {
    cursor: pointer;
    outline: none;
    border: 0;
    vertical-align: middle;
    text-decoration: none;
    background: transparent;
    padding: 20px 5px;
    font-size: 2rem;
  }
  .container {
    width: 70%;
  }
  .elem {
    max-width: 100%;
    display: none;
    text-align: center;
  }

  .elem.active {
    display: block;
    animation: fadeImg 0.8s;
  }

  @keyframes fadeImg {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }
</style>
<div class="slider">
  <button class="previous">pich</button>
  <div class="container">
    <div class="active elem">
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget magna in libero pharetra placerat. Etiam at eros ac justo lobortis fermentum."</p>
        <p>- John Doe</p>
    </div>
    <div class="elem">
        <p>"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam auctor magna sed risus semper, nec ultricies elit fermentum."</p>
        <p>- Jane Smith</p>
    </div>
  
  </div>
  <button class="next">new</button>
</div>
<script>
  const items = document.querySelectorAll(".elem");
  const nextItem = document.querySelector(".next");
  const previousItem = document.querySelector(".previous");
  const itemCount = items.length;
  let count = 0;
  // items[count].style.fontSize = 500;

  function showNextItem() {
    items[count].classList.remove("active");

    if (count < itemCount - 1) {
      count++;
    } else {
      count = 0;
    }

    items[count].classList.add("active");
    console.log(count);
  }

  function showPreviousItem() {
    items[count].classList.remove("active");

    if (count > 0) {
      count--;
    } else {
      count = itemCount - 1;
    }

    items[count].classList.add("active");
    console.log(count);
  }

  function keyPress(e) {
    e = e || window.event;

    if (e.keyCode == "37") {
      showPreviousItem();
    } else if (e.keyCode == "39") {
      showNextItem();
    }
  }

  nextItem.addEventListener("click", showNextItem);
  previousItem.addEventListener("click", showPreviousItem);
  document.addEventListener("keydown", keyPress);
</script>
