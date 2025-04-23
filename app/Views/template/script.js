function handleOpenSidebar() {
    let sidebar = document.getElementById("sidebar");

    if (sidebar) {
        sidebar.style.display = "block";
        sidebar.style.opacity = "0";
        sidebar.style.transform = "translateY(-100%)";

        setTimeout(() => {
            sidebar.style.transition = "opacity 0.5s ease, transform 0.5s ease";
            sidebar.style.opacity = "1";
            sidebar.style.transform = "translateY(0)";
        }, 10);
        document.body.style.overflow = "hidden";
    }
}

function handleCloseSidebar() {
    let sidebar = document.getElementById("sidebar");

    if (sidebar) {
        sidebar.style.transition = "opacity 0.5s ease, transform 0.5s ease";
        sidebar.style.opacity = "0";
        sidebar.style.transform = "translateY(-100%)"; // Trượt sidebar ra ngoài

        setTimeout(() => {
            sidebar.style.display = "none"; // Ẩn sau khi hiệu ứng kết thúc
        }, 500); // Đợi hết animation (0.5s)
        document.body.style.overflow = "auto";
    }
}
document.addEventListener("DOMContentLoaded", function () {
    const btnLogin = document.getElementById("btnLogin");
    if (btnLogin) {
        btnLogin.addEventListener("click", function () {
            window.location.href = "/index.php?controller=login&action=index";
        });
    }

    
}
);
document.addEventListener("DOMContentLoaded", function () {
    const btnLogout = document.getElementById("btnLogout");
    if (btnLogout) {
        btnLogout.addEventListener("click", function () {
            // console.log(document.cookie);
            // document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            // console.log(document.cookie);
            $.ajax({
                url: '/index.php?controller=login&action=logout', // Thay đổi URL phù hợp với controller của bạn
                method: 'POST',
                success: function (response) {
                    console.log(response);
                    // alert('Đăng xuất thành công!');
                    window.location.href = "/index.php?controller=login&action=index"; // Chuyển hướng về trang đăng nhập
                },
                error: function () {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
            // window.location.href = "/index.php?controller=login&action=index";
        });
    }

    
}
);
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('ratingForm');
    const submitButton = document.getElementById('submitRating');

    submitButton.addEventListener('click', function () {
        // Lấy giá trị rating và message
        const rating = form.querySelector('input[name="star-radio"]:checked')?.value;
        const message = form.querySelector('textarea[name="message"]').value;
        console.log(rating, message);
        if (!rating) {
            alert('Vui lòng chọn số sao để đánh giá!');
            return;
        }

        // Gửi dữ liệu đến server qua AJAX
        $.ajax({
            url: '/index.php?controller=rating&action=submit', // Thay đổi URL phù hợp với controller của bạn
            method: 'POST',
            data: { rating, message },
            success: function (response) {
                console.log(response);
                alert('Cảm ơn bạn đã đánh giá!');
                form.reset(); // Reset form sau khi gửi thành công
            },
            error: function () {
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            }
        });
    });
});

{/* <script> */}
var swiper = new Swiper(".mySwiper", {
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  slidesPerView: 1,
  spaceBetween: 30,
  autoplay: {
    delay: 5000,
  },
});
{/* </script> */}


