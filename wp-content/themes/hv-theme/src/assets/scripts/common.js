console.log(">> Common script is loaded.");
const navigation = document.querySelector(".navigation-mobile");
const burgerButton = document.querySelector(".burger-btn");

function toggleMenu() {
  navigation.classList.toggle("open");
  burgerButton.classList.toggle("open");
}

burgerButton.addEventListener("click", toggleMenu);
