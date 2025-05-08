<div id="view" class="container py-4" style="margin-top: 100px">
    <div class="d-flex justify-content-between">
        <h3>Các Thông Tin Liên Lạc</h3>
    </div>
    <form class="mb-3" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại: </label>
            <input type="text" id="phone" name="phone" style="width: 100%">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email: </label>
            <input type="email" id="email" name="email" style="width: 100%">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ: </label>
            <input type="text" id="address" name="address" style="width: 100%">
        </div>
        <button id="uploadInfo" style="font-size: 20px; font-weight: 500; " type="button" class="btn btn-outline-success mb-3 d-flex justify-content-end"><i class="bi bi-plus-circle"></i> Thêm Thông Tin Liên Lạc</button>

    </form>
    <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc;" class=" rounded shadow-sm bg-white">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark sticky-top">
                <tr>
                    <th style="width: 16%;">Số điện thoại</th>
                    <th style="width: 17%;">Email</th>
                    <th style="width: 33%;">Địa chỉ</th>
                    <th style="width: 17%;">Chỉnh sửa</th>
                    <th style="width: 17%;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listInfo as $info): ?>
                    <tr>
                        <td><?= htmlspecialchars($info['phone']) ?></td>
                        <td><?= htmlspecialchars($info['email']) ?></td>
                        <td><?= htmlspecialchars($info['address']) ?></td>

                        <td>
                            <?php
                            $infoCopy = $info;
                            ?>
                            <a style="font-size: 20px; font-weight: 500;"
                                data-info='<?= json_encode($infoCopy, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                class="btn btn-warning btn-sm editBtnInfo">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </a>

                        </td>
                        <td>
                            <button style="font-size: 20px; font-weight: 500;" data-id="<?= $info['id'] ?>" class="btn btn-danger btn-sm deleteBtnInfo">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="editInfo" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInfoModalLabel">Chỉnh sửa Screen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editInfoForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="infoId">
                        <div class="mb-3">
                            <label for="infoPhone" class="form-label">Số Điện Thoại: </label>
                            <input type="text" class="form-control" id="infoPhone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="infoEmail" class="form-label">Email: </label>
                            <input type="email" class="form-control" id="infoEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="infoAddress" class="form-label">Địa chỉ: </label>
                            <input type="text" class="form-control" id="infoAddress" name="address" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveInfoChanges">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
</div>