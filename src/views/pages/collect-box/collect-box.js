//This code for filters repeat
document.querySelectorAll(".filter-content").forEach(function (content) {
  content.style.height = content.scrollHeight + "px";
});

document.querySelectorAll(".filter-header").forEach(function (header) {
  header.addEventListener("click", function () {
    const contents = header.parentNode.querySelectorAll(".filter-content");

    contents.forEach(function (content) {
      if (content.style.height === "0px" || content.style.height === "") {
        content.style.height = content.scrollHeight + "px";
        header.classList.add("active");

        setTimeout(function () {
          content.style.height = "auto";
        }, 300);
      } else {
        content.style.height = content.scrollHeight + "px";

        setTimeout(function () {
          content.style.height = "0";
        }, 10);

        header.classList.remove("active");
      }
    });
  });
});

let currentIndex = 0;
const photos = document.querySelectorAll('.collect-box-photo');
const thumbnails = document.querySelectorAll('.collect-box-thumbnail');
const fullscreenBtn = document.querySelector('.collect-box-fullscreen-btn');
const fullscreenModal = document.getElementById('fullscreenModal');
const fullscreenImage = document.getElementById('fullscreenImage');
const closeBtn = document.querySelector('.close-btn');

function selectPhoto(index) {
  photos[currentIndex].classList.remove('active');
  thumbnails[currentIndex].classList.remove('active');
  currentIndex = index;
  photos[currentIndex].classList.add('active');
  thumbnails[currentIndex].classList.add('active');
}

function showFullscreen() {
  const currentPhotoSrc = photos[currentIndex].src;
  fullscreenImage.src = currentPhotoSrc;
  fullscreenModal.classList.add('active');
}

function closeFullscreen() {
  fullscreenModal.classList.remove('active');
}

thumbnails.forEach((thumbnail, index) => {
  thumbnail.addEventListener('click', () => selectPhoto(index));
});

fullscreenBtn.addEventListener('click', showFullscreen);

fullscreenModal.addEventListener('click', closeFullscreen);

closeBtn.addEventListener('click', closeFullscreen);

fullscreenImage.addEventListener('click', (event) => {
  event.stopPropagation();
});