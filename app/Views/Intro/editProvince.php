<div id="editProvince" class="container py-4" style="margin-top: 50px;">
    <h3>Chỉnh sửa thông tin Tỉnh/Thành phố</h3>
    <form id="editProvinceForm" enctype="multipart/form-data" method="POST" action="index.php?controller=province&action=update">
        <input type="hidden" name="id" value="<?= htmlspecialchars($province['id']) ?>"> <!-- ID của province -->

        <div class="mb-3">
            <label for="name" class="form-label">Tên Tỉnh/Thành phố</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($province['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Ảnh Thumbnail</label>
            <div class="mb-2">
                <img src="data:image/jpeg;base64,<?= base64_encode($province['thumbnail']) ?>" 
                     alt="Thumbnail hiện tại" 
                     style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
            </div>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Lưu thay đổi
        </button>
    </form>
</div>