document.getElementById("uploadInfo").addEventListener("click", function (e) {
  e.preventDefault();
  var formData = new FormData();
  formData.append("phone", document.getElementById("phone").value);
  formData.append("email", document.getElementById("email").value);
  formData.append("address", document.getElementById("address").value);
  $.ajax({
    url: "index.php?controller=contact&action=uploadInfo",
    method: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (jsonResponse) {
      try {
        if (jsonResponse.status === "success") {
          Swal.fire({
            title: "Thành công!",
            text: jsonResponse.message,
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => {
            location.reload(); // Reload sau khi người dùng bấm OK
          });
          document.querySelector("form").reset();
        } else {
          Swal.fire({
            title: "Lỗi!",
            text: jsonResponse.message,
            icon: "error",
            confirmButtonText: "OK",
          });
        }
      } catch (e) {
        console.error("Lỗi JSON:", e);
        Swal.fire({
          title: "Lỗi!",
          text: "Đã xảy ra lỗi không xác định!",
          icon: "error",
          confirmButtonText: "OK",
        });
      }
    },
    error: function (xhr, status, error) {
      console.error("Có lỗi xảy ra:", error);
    },
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".editBtnInfo");

  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const infoData = JSON.parse(this.dataset.info); //Lấy dữ liệu

      // Điền dữ liệu vào modal
      document.getElementById("infoId").value = infoData.id;
      document.getElementById("infoPhone").value = infoData.phone;
      document.getElementById("infoEmail").value = infoData.email;
      document.getElementById("infoAddress").value = infoData.address;

      // Hiển thị modal
      const editProvinceModal = new bootstrap.Modal(document.getElementById("editInfo"));
      editProvinceModal.show();
    });
  });

  // Xử lý lưu thay đổi
  document.getElementById("saveInfoChanges").addEventListener("click", function () {
    const formData = new FormData(document.getElementById("editInfoForm"));
    for (let pair of formData.entries()) {
      console.log(`${pair[0]}:`, pair[1]);
    }

    // Gửi yêu cầu AJAX để cập nhật dữ liệu
    fetch("index.php?controller=contact&action=updateInfo", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Thành công!",
            text: "Cập nhật thành công!",
          }).then(() => {
            location.reload(); // Reload sau khi người dùng bấm OK
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Thất bại!",
            text: "Cập nhật thất bại!",
          });
        }
      })
      .catch((error) => {
        console.error("Lỗi:", error);
        Swal.fire({
          icon: "error",
          title: "Lỗi hệ thống",
          text: "Có lỗi xảy ra, vui lòng thử lại!",
        });
      });
  });
});

$(document).on("click", ".deleteBtnInfo", function (e) {
  var id = $(this).data("id");
  Swal.fire({
    title: "Bạn có chắc chắn muốn xóa?",
    text: "Hành động này không thể hoàn tác!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Có, xóa!",
    cancelButtonText: "Hủy",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "index.php?controller=contact&action=deleteInfo",
        method: "POST",
        data: { id },
        success: function (response) {
          // Hiển thị thông báo sau khi xóa thành công
          Swal.fire("Đã xóa!", "Thông tin liên lạc đã được xóa thành công.", "success").then(() => {
            location.reload(); // Reload sau khi người dùng bấm OK
          });
        },
        error: function (xhr, status, error) {
          // Hiển thị lỗi nếu có vấn đề trong quá trình xóa
          Swal.fire("Lỗi!", "Đã có sự cố khi xóa thông tin liên lạc.", "error");
        },
      });
    }
  });
});
