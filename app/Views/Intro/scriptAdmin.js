$(document).on('click', '.deleteBtnProvince', function (e) {

    var id = $(this).data('id');
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Hành động này không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Có, xóa!',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '/index.php?controller=intro&action=deleteProvince',
                method: 'POST',
                data: { id },
                success: function (response) {
                    // Hiển thị thông báo sau khi xóa thành công
                    Swal.fire(
                        'Đã xóa!',
                        'Tỉnh đã được xóa thành công.',
                        'success'
                    ).then(() => {
                        location.reload(); // Reload sau khi người dùng bấm OK
                    });
                },
                error: function (xhr, status, error) {
                    // Hiển thị lỗi nếu có vấn đề trong quá trình xóa
                    Swal.fire(
                        'Lỗi!',
                        'Đã có sự cố khi xóa tỉnh.',
                        'error'
                    );
                }
            });
        }
    });
});
document.getElementById('addProvince').addEventListener('click', function (e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append("name", document.getElementById("name").value);
    formData.append("thumbnail", document.getElementById("thumbnail").files[0]);
    $.ajax({
        url: '/index.php?controller=intro&action=addProvince',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (jsonResponse) {
            try {

                if (jsonResponse.status === 'success') {
                    Swal.fire({
                        title: 'Thành công!',
                        text: jsonResponse.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Reload sau khi người dùng bấm OK
                    });
                    document.querySelector('form').reset();

                } else {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: jsonResponse.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (e) {
                console.error("Lỗi JSON:", e);
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Đã xảy ra lỗi không xác định!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function (xhr, status, error) {
            console.error("Có lỗi xảy ra:", error);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editBtnProvince');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const provinceData = JSON.parse(this.dataset.province); // Lấy dữ liệu từ thuộc tính data-province

            // Điền dữ liệu vào modal
            document.getElementById('provinceId').value = provinceData.id;
            document.getElementById('provinceName').value = provinceData.name;
            document.getElementById('currentThumbnail').src = `data:image/jpeg;base64,${provinceData.thumbnail}`;

            // Hiển thị modal
            const editProvinceModal = new bootstrap.Modal(document.getElementById('editProvinceModal'));
            editProvinceModal.show();
        });
    });

    // Xử lý lưu thay đổi
    document.getElementById('saveProvinceChanges').addEventListener('click', function () {
        const formData = new FormData(document.getElementById('editProvinceForm'));
        for (let pair of formData.entries()) {
            console.log(`${pair[0]}:`, pair[1]);
        }


        // Gửi yêu cầu AJAX để cập nhật dữ liệu
        fetch('index.php?controller=intro&action=updateProvince', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: 'Cập nhật thành công!',
                    }).then(() => {
                        location.reload(); // Reload sau khi người dùng bấm OK
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại!',
                        text: 'Cập nhật thất bại!',
                    });
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi hệ thống',
                    text: 'Có lỗi xảy ra, vui lòng thử lại!',
                });
            });
    });
});













$(document).on('click', '.deleteBtnIntro', function (e) {

    var id = $(this).data('id');
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Hành động này không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Có, xóa!',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '/index.php?controller=intro&action=deleteIntro',
                method: 'POST',
                data: { id },
                success: function (response) {
                    // Hiển thị thông báo sau khi xóa thành công
                    Swal.fire(
                        'Đã xóa!',
                        'Thông tin đã được xóa thành công.',
                        'success'
                    ).then(() => {
                        location.reload(); // Reload sau khi người dùng bấm OK
                    });
                },
                error: function (xhr, status, error) {
                    // Hiển thị lỗi nếu có vấn đề trong quá trình xóa
                    Swal.fire(
                        'Lỗi!',
                        'Đã có sự cố khi xóa thông tin.',
                        'error'
                    );
                }
            });
        }
    });
});
document.getElementById('addIntro').addEventListener('click', function (e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append("name", document.getElementById("nameIntro").value);
    formData.append("content", document.getElementById("contentIntro").value);
    formData.append("thumbnail", document.getElementById("thumbnailIntro").files[0]);
    $.ajax({
        url: '/index.php?controller=intro&action=addIntro',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (jsonResponse) {
            try {

                if (jsonResponse.status === 'success') {
                    Swal.fire({
                        title: 'Thành công!',
                        text: jsonResponse.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Reload sau khi người dùng bấm OK
                    });
                    document.querySelector('form').reset();

                } else {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: jsonResponse.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (e) {
                console.error("Lỗi JSON:", e);
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Đã xảy ra lỗi không xác định!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function (xhr, status, error) {
            console.error("Có lỗi xảy ra:", error);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editBtnIntro');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const introData = JSON.parse(this.dataset.intro); // Lấy dữ liệu từ thuộc tính data-intro

            // Điền dữ liệu vào modal
            document.getElementById('introId').value = introData.id;
            document.getElementById('introDetail').value = introData.detail;
            document.getElementById('introName').value = introData.name;
            document.getElementById('currentThumbnailIntro').src = `data:image/jpeg;base64,${introData.img}`;

            // Hiển thị modal
            const editIntroModal = new bootstrap.Modal(document.getElementById('editIntroModal'));
            editIntroModal.show();
        });
    });

    // Xử lý lưu thay đổi
    document.getElementById('saveIntroChanges').addEventListener('click', function () {
        const formData = new FormData(document.getElementById('editIntroForm'));
        for (let pair of formData.entries()) {
            console.log(`${pair[0]}:`, pair[1]);
        }


        // Gửi yêu cầu AJAX để cập nhật dữ liệu
        fetch('index.php?controller=intro&action=updateIntro', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: 'Cập nhật thành công!',
                    }).then(() => {
                        location.reload(); // Reload sau khi người dùng bấm OK
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại!',
                        text: 'Cập nhật thất bại!',
                    });
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi hệ thống',
                    text: 'Có lỗi xảy ra, vui lòng thử lại!',
                });
            });
    });
});

