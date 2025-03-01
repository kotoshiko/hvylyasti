//This code for filters repeat
document.querySelectorAll(".filter-content").forEach(function (content) {
  content.style.height = "auto";
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

//Modal
document.addEventListener('DOMContentLoaded', function () {
  const button = document.querySelector('.button-sum');
  const modal = document.getElementById('productModal');
  const closeButton = document.querySelector('.close-btn');

  button.addEventListener('click', function(event) {
    event.preventDefault();
    modal.style.display = 'flex';
  });

  closeButton.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  modal.addEventListener('click', function(event) {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });
});

//Modal accordion
document.addEventListener('DOMContentLoaded', function () {
  const tasteElements = document.querySelectorAll('.product-taste');
  const compositionElements = document.querySelectorAll('.product-composition');

  tasteElements.forEach((tasteElement, index) => {
    tasteElement.addEventListener('click', function () {
      const currentCompositionElement = compositionElements[index];

      compositionElements.forEach((compositionElement, compIndex) => {
        if (compIndex !== index && compositionElement.classList.contains('open')) {
          compositionElement.style.height = `${compositionElement.scrollHeight}px`;
          requestAnimationFrame(() => {
            compositionElement.style.height = '0';
          });
          compositionElement.classList.remove('open');
        }
      });

      tasteElement.classList.toggle('open');

      if (currentCompositionElement.classList.contains('open')) {
        currentCompositionElement.style.height = `${currentCompositionElement.scrollHeight}px`;
        requestAnimationFrame(() => {
          currentCompositionElement.style.height = '0';
        });
        currentCompositionElement.classList.remove('open');
      } else {
        currentCompositionElement.style.height = '0';
        currentCompositionElement.classList.add('open');
        requestAnimationFrame(() => {
          currentCompositionElement.style.height = `${currentCompositionElement.scrollHeight}px`;
        });
      }
    });
  });

  compositionElements.forEach((compositionElement) => {
    compositionElement.addEventListener('transitionend', function () {
      if (!compositionElement.classList.contains('open')) {
        compositionElement.style.height = '';
      } else {
        compositionElement.style.height = 'auto';
      }
    });
  });
});