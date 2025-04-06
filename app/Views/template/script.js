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