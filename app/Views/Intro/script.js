
// document.addEventListener("DOMContentLoaded", function () {
//     const listProvince = [
//         {
//             name: "Hà Nội",
//             thumbnail: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjXo4pZZczFKB_i1fzxviT781yY3EqDtdqAQ&s"
//         },
//         {
//             name: "Hồ Chí Minh",
//             thumbnail: "https://imgcdn.tapchicongthuong.vn/tcct-media/23/1/2/thanh-pho-ho-chi-minh.jpg"
//         },
//         {
//             name: "Đà Nẵng",
//             thumbnail: "https://cdn11.dienmaycholon.vn/filewebdmclnew/DMCL21/Picture/News/News_expe_12587/12587.png?version=290523"
//         },
//         {
//             name: "Nha Trang",
//             thumbnail: "https://images2.thanhnien.vn/528068263637045248/2025/3/24/nha-trang-17428130131821343548929.jpg"
//         },
//         {
//             name: "Hải Phòng",
//             thumbnail: "https://xdcs.cdnchinhphu.vn/446259493575335936/2023/3/31/hai-phong-6-1680234763392125722891.jpg"
//         },
//         {
//             name: "Huế",
//             thumbnail: "https://t2.ex-cdn.com/crystalbay.com/resize/1860x570/files/content/2024/06/03/cam-nang-du-lich-hue-1-1550.jpg"
//         },
//         {
//             name: "Đà Lạt",
//             thumbnail: "https://toongadventure.vn/wp-content/uploads/2022/08/nu-hoa-Atiso-khong-lo-tai-Da-Lat-.png"
//         },
//         {
//             name: "Vũng Tàu",
//             thumbnail: "https://bariavungtautourism.com.vn/wp-content/uploads/2023/12/kinh-nghiem-du-lich-vung-tau-1.jpg"
//         },
//         {
//             name: "Cần Thơ",
//             thumbnail: "https://anhdaomekong2hotel.vn/upload/images/du-lich-can-tho-1.png"
//         },
//         {
//             name: "Quảng Ninh",
//             thumbnail: "https://ik.imagekit.io/tvlk/blog/2022/02/dia-diem-du-lich-quang-ninh-2.jpg?tr=dpr-2,w-675"
//         }
//     ];

//     let imageList = document.getElementById("province-container");
//     let currentIndex = 0;
//     const imagesToShow = 5;
//     const imageWidth = 210; // Kích thước ảnh 100px + khoảng cách margin
//     let totalImages;

//     // Render images
//     function renderImages() {
//         listProvince.forEach(province => {
//             let divx = document.createElement("div");
//             divx.classList.add("province-item");
//             divx.innerHTML = `<img src="${province.thumbnail}" width="100"><h3>${province.name}</h3>`;
//             imageList.appendChild(divx);
//         });

//         totalImages = document.querySelectorAll(".province-item").length;
//     }

//     renderImages(); // Gọi hàm để hiển thị ảnh

//     function updateSlider() {
//         const translateX = -currentIndex * imageWidth;
//         imageList.style.transform = `translateX(${translateX}px)`;
//     }

//     function nextSlide() {
//         if (currentIndex < totalImages - imagesToShow) {
//             currentIndex++;
//         } else {
//             currentIndex = 0; // Quay lại ảnh đầu tiên khi đến cuối
//         }
//         updateSlider();
//     }

//     function prevSlide() {
//         if (currentIndex > 0) {
//             currentIndex--;
//         } else {
//             currentIndex = totalImages - imagesToShow; // Quay lại ảnh cuối nếu đang ở ảnh đầu
//         }
//         updateSlider();
//     }

//     // Tự động cuộn sau mỗi 30 giây
//     let autoScroll = setInterval(nextSlide, 10000);

//     // Dừng tự động cuộn khi người dùng bấm nút
//     document.querySelector("button[onclick='prevSlide()']").addEventListener("click", function () {
//         clearInterval(autoScroll);
//         // autoScroll = setInterval(nextSlide, 30000);
//         prevSlide();
//     });

//     document.querySelector("button[onclick='nextSlide()']").addEventListener("click", function () {
//         clearInterval(autoScroll);
//         // autoScroll = setInterval(prevSlide, 30000);
//         nextSlide();
//     });
// });
document.addEventListener("DOMContentLoaded", function () {
    let elements = document.querySelectorAll(".box_vision-content");

    let observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, { threshold: 0.3 }); // Kích hoạt khi div xuất hiện 50% trên màn hình

    elements.forEach(element => {
        observer.observe(element);
    });
});
document.addEventListener("DOMContentLoaded", function () {
    let elements = document.querySelectorAll("#loadImg");

    let observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, { threshold: 0.8 }); // Kích hoạt khi div xuất hiện 50% trên màn hình

    elements.forEach(element => {
        observer.observe(element);
    });
});

// console.log($listIntro);
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    slidesPerGroup: 1,
    loop: true,
    loopFillGroupWithBlank: true,

    autoplay: {
        delay: 10000, // 10 giây (10000ms)
        disableOnInteraction: false, // Vẫn auto sau khi người dùng click
    },

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        }
    }
});

