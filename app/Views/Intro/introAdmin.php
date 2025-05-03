<div id="view" class="container py-4" style="margin-top: 100px">
    <div class="d-flex justify-content-between">
        <h3>Danh sách thành phố nổi bật</h3>


    </div>
    <form class="mb-3" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Tên Tỉnh/Thành phố</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Ảnh Thumbnail</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
        </div>
        <button id="addProvince" style="font-size: 20px; font-weight: 500; " type="button" class="btn btn-outline-success mb-3 d-flex justify-content-end"><i class="bi bi-plus-circle"></i> Thêm Tỉnh</button>

    </form>
    <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc;" class=" rounded shadow-sm bg-white">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark sticky-top">
                <tr>
                    <th style="width: 33%;">Tên</th> <!-- 4 phần -->
                    <th style="width: 33%;">Ảnh</th> <!-- 4 phần -->
                    <th style="width: 17%;">Chỉnh sửa</th> <!-- 2 phần -->
                    <th style="width: 17%;">Xóa</th> <!-- 2 phần -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listProvince as $province): ?>
                    <tr>
                        <td><?= htmlspecialchars($province['name']) ?></td>
                        <td>
                            <img src="data:image/jpeg;base64,<?= base64_encode($province['thumbnail']) ?>"
                                alt="image"
                                style="width:80px; height:60px; object-fit:cover; border-radius:8px;">

                        </td>
                        <td>
                            <?php
                            $provinceCopy = $province;
                            $provinceCopy['thumbnail'] = base64_encode($province['thumbnail']);
                            ?>
                            <a style="font-size: 20px; font-weight: 500;"
                                data-province='<?= json_encode($provinceCopy, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                class="btn btn-warning btn-sm editBtnProvince">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </a>

                        </td>
                        <td>
                            <button style="font-size: 20px; font-weight: 500;" data-id="<?= $province['id'] ?>" class="btn btn-danger btn-sm deleteBtnProvince">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="editProvinceModal" tabindex="-1" aria-labelledby="editProvinceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProvinceModalLabel">Chỉnh sửa Tỉnh/Thành phố</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProvinceForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="provinceId">

                        <div class="mb-3">
                            <label for="provinceName" class="form-label">Tên Tỉnh/Thành phố</label>
                            <input type="text" class="form-control" id="provinceName" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="provinceThumbnail" class="form-label">Ảnh Thumbnail</label>
                            <div class="mb-2">
                                <img id="currentThumbnail" src="" alt="Thumbnail hiện tại"
                                    style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
                            </div>
                            <input type="file" class="form-control" id="provinceThumbnail" name="thumbnail" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveProvinceChanges">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
</div>