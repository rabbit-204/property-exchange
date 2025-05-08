const images = window.imageData || [];
const captions = window.captionData || [];
const captionText = document.querySelector(".slider-text");

captions.forEach((cap) => {
  console.log(cap);
});

let currentIndex = 1;

const wrapper = document.getElementById("sliderWrapper");

function loadImages() {
  wrapper.innerHTML = "";

  // Clone ảnh cuối -> đầu
  const lastClone = document.createElement("img");
  lastClone.src = images[images.length - 1];
  lastClone.classList.add("slider-image");
  wrapper.appendChild(lastClone);

  // Ảnh chính
  images.forEach((src) => {
    const img = document.createElement("img");
    img.src = src;
    img.classList.add("slider-image");
    wrapper.appendChild(img);
  });

  // Clone ảnh đầu -> cuối
  const firstClone = document.createElement("img");
  firstClone.src = images[0];
  firstClone.classList.add("slider-image");
  wrapper.appendChild(firstClone);
}

// Cập nhật vị trí
function updateSlider(animate = true) {
  if (!animate) {
    wrapper.style.transition = "none";
  } else {
    wrapper.style.transition = "transform 0.5s ease-in-out";
  }
  wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;

  let captionIndex = currentIndex - 1;
  if (captionIndex < 0) captionIndex = images.length - 1;
  if (captionIndex >= images.length) captionIndex = 0;

  captionText.textContent = captions[captionIndex] || "";
}

function nextImage() {
  currentIndex++;
  updateSlider();

  if (currentIndex === images.length + 1) {
    setTimeout(() => {
      currentIndex = 1;
      updateSlider(false); // nhảy tức thì về ảnh đầu
    }, 500);
  }
}

function prevImage() {
  currentIndex--;
  updateSlider();

  if (currentIndex === 0) {
    setTimeout(() => {
      currentIndex = images.length;
      updateSlider(false); // nhảy tức thì về ảnh cuối
    }, 500);
  }
}

// Khởi tạo
loadImages();
updateSlider(false);
setInterval(nextImage, 3000);
