//#region slider
document.getElementById("uploadImageSlider").addEventListener("click", function (e) {
  e.preventDefault();
  var formData = new FormData();
  formData.append("image", document.getElementById("image").files[0]);
  formData.append("caption", document.getElementById("caption").value);
  $.ajax({
    url: "index.php?controller=homepage&action=uploadImageSlider",
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
  const editButtons = document.querySelectorAll(".editBtnSlider");

  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const screenData = JSON.parse(this.dataset.screen); //Lấy dữ liệu

      // Điền dữ liệu vào modal
      document.getElementById("screenId").value = screenData.id;
      document.getElementById("screenCaption").value = screenData.caption;
      // document.getElementById("currentThumbnail").src = `data:image/jpeg;base64,${provinceData.thumbnail}`;

      // Hiển thị modal
      const editProvinceModal = new bootstrap.Modal(document.getElementById("editScreenModal"));
      editProvinceModal.show();
    });
  });

  // Xử lý lưu thay đổi
  document.getElementById("saveScreenChanges").addEventListener("click", function () {
    const formData = new FormData(document.getElementById("editScreenForm"));
    // for (let pair of formData.entries()) {
    //   console.log(`${pair[0]}:`, pair[1]);
    // }

    // Gửi yêu cầu AJAX để cập nhật dữ liệu
    fetch("index.php?controller=homepage&action=updateScreen", {
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

$(document).on("click", ".deleteBtnScreen", function (e) {
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
        url: "index.php?controller=homepage&action=deleteScreen",
        method: "POST",
        data: { id },
        success: function (response) {
          // Hiển thị thông báo sau khi xóa thành công
          Swal.fire("Đã xóa!", "Screen đã được xóa thành công.", "success").then(() => {
            location.reload(); // Reload sau khi người dùng bấm OK
          });
        },
        error: function (xhr, status, error) {
          // Hiển thị lỗi nếu có vấn đề trong quá trình xóa
          Swal.fire("Lỗi!", "Đã có sự cố khi xóa screen.", "error");
        },
      });
    }
  });
});
//#endregion

//#region card
document.getElementById("uploadCard").addEventListener("click", function (e) {
  e.preventDefault();
  var formData = new FormData();
  formData.append("name", document.getElementById("name").value);
  formData.append("image", document.getElementById("imageCard").files[0]);
  formData.append("num", document.getElementById("num").value);
  $.ajax({
    url: "index.php?controller=homepage&action=uploadCard",
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
  const editButtons = document.querySelectorAll(".editBtnCard");

  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const cardData = JSON.parse(this.dataset.card); //Lấy dữ liệu

      // Điền dữ liệu vào modal
      document.getElementById("cardId").value = cardData.id;
      document.getElementById("cardNum").value = cardData.num;
      // document.getElementById("currentThumbnail").src = `data:image/jpeg;base64,${provinceData.thumbnail}`;

      // Hiển thị modal
      const editProvinceModal = new bootstrap.Modal(document.getElementById("editCardModal"));
      editProvinceModal.show();
    });
  });

  // Xử lý lưu thay đổi
  document.getElementById("saveCardChanges").addEventListener("click", function () {
    const formData = new FormData(document.getElementById("editCardForm"));
    // for (let pair of formData.entries()) {
    //   console.log(`${pair[0]}:`, pair[1]);
    // }

    // Gửi yêu cầu AJAX để cập nhật dữ liệu
    fetch("index.php?controller=homepage&action=updateCard", {
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

$(document).on("click", ".deleteBtnCard", function (e) {
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
        url: "index.php?controller=homepage&action=deleteCard",
        method: "POST",
        data: { id },
        success: function (response) {
          // Hiển thị thông báo sau khi xóa thành công
          Swal.fire("Đã xóa!", "Thẻ đã được xóa thành công.", "success").then(() => {
            location.reload(); // Reload sau khi người dùng bấm OK
          });
        },
        error: function (xhr, status, error) {
          // Hiển thị lỗi nếu có vấn đề trong quá trình xóa
          Swal.fire("Lỗi!", "Đã có sự cố khi xóa thẻ.", "error");
        },
      });
    }
  });
});
//#endregion

//#region introduction
document.querySelectorAll("#icon-picker i").forEach((icon) => {
  icon.addEventListener("click", () => {
    // Gỡ chọn cũ
    document.querySelectorAll("#icon-picker i").forEach((i) => i.classList.remove("selected"));
    // Chọn biểu tượng mới
    icon.classList.add("selected");
    // Gán giá trị vào input hidden
    document.getElementById("selected-icon").value = icon.dataset.icon;
  });
});

document.querySelectorAll("#edit-icon-picker i").forEach((icon) => {
  icon.addEventListener("click", () => {
    document.querySelectorAll("#edit-icon-picker i").forEach((i) => i.classList.remove("selected"));
    icon.classList.add("selected");
    document.getElementById("edit-selected-icon").value = icon.dataset.icon;
  });
});

document.getElementById("uploadIntroduction").addEventListener("click", function (e) {
  e.preventDefault();
  var formData = new FormData();
  formData.append("symbol", document.getElementById("selected-icon").value);
  formData.append("title", document.getElementById("title").value);
  formData.append("detail", document.getElementById("detail").value);
  $.ajax({
    url: "index.php?controller=homepage&action=uploadIntroduction",
    method: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (jsonResponse) {
      console.log("Uyên1");
      try {
        if (jsonResponse.status === "success") {
          console.log("Uyên2");
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
          console.log("Uyên3");
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
  const editButtons = document.querySelectorAll(".editBtnIntroduction");

  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const introductionData = JSON.parse(this.dataset.introduction); //Lấy dữ liệu

      // Điền dữ liệu vào modal
      document.getElementById("introductionId").value = introductionData.id;
      document.getElementById("edit-selected-icon").value = introductionData.symbol;
      document.getElementById("titleIntroduction").value = introductionData.title;
      document.getElementById("detailIntroduction").value = introductionData.detail;
      // document.getElementById("currentThumbnail").src = `data:image/jpeg;base64,${provinceData.thumbnail}`;

      document.querySelectorAll("#edit-icon-picker i").forEach((icon) => {
        icon.classList.remove("selected");
        if (icon.dataset.icon === introductionData.symbol) {
          icon.classList.add("selected");
        }
      });

      // Hiển thị modal
      const editProvinceModal = new bootstrap.Modal(document.getElementById("editIntroductionModal"));
      editProvinceModal.show();
    });
  });

  // Xử lý lưu thay đổi
  document.getElementById("saveIntroductionChanges").addEventListener("click", function () {
    const formData = new FormData(document.getElementById("editIntroductionForm"));
    // for (let pair of formData.entries()) {
    //   console.log(`${pair[0]}:`, pair[1]);
    // }

    // Gửi yêu cầu AJAX để cập nhật dữ liệu
    fetch("index.php?controller=homepage&action=updateIntroduction", {
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

$(document).on("click", ".deleteBtnIntroduction", function (e) {
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
        url: "index.php?controller=homepage&action=deleteIntroduction",
        method: "POST",
        data: { id },
        success: function (response) {
          // Hiển thị thông báo sau khi xóa thành công
          Swal.fire("Đã xóa!", "Đoạn giới thiệu đã được xóa thành công.", "success").then(() => {
            location.reload(); // Reload sau khi người dùng bấm OK
          });
        },
        error: function (xhr, status, error) {
          // Hiển thị lỗi nếu có vấn đề trong quá trình xóa
          Swal.fire("Lỗi!", "Đã có sự cố khi xóa đoạn giới thiệu.", "error");
        },
      });
    }
  });
});
//#endregion
