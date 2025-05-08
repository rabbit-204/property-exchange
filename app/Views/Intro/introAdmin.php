<div id="view" class="container py-4" style="margin-top: 60px">
    <!-- <div>

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
                        <th style="width: 33%;">Tên</th> 
                        <th style="width: 33%;">Ảnh</th> 
                        <th style="width: 17%;">Chỉnh sửa</th> 
                        <th style="width: 17%;">Xóa</th> 
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
    </div> -->
    <div class="d-flex justify-content-between">
        <h3>Danh sách thông tin giới thiệu</h3>
    </div>
    <form class="mb-3" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Tên mục</label>
            <input type="text" class="form-control" id="nameIntro" name="name" required>
        </div>
        <!-- <div class="mb-3">
            <label for="content" class="form-label">Mô tả</label>
            <textarea type="text" class="form-control" id="contentIntro" name="content" required>
        </div> -->
        <div class="mb-3">
            <label for="contentIntro" class="form-label">Mô tả</label>
            <textarea class="form-control" id="contentIntro" name="content" required></textarea>
        </div>


        <div class="mb-3">
            <label for="thumbnail" class="form-label">Ảnh tượng trưng</label>
            <input type="file" class="form-control" id="thumbnailIntro" name="thumbnail" accept="image/*" required>
        </div>
        <button id="addIntro" style="font-size: 20px; font-weight: 500; " type="button" class="btn btn-outline-success mb-3 d-flex justify-content-end"><i class="bi bi-plus-circle"></i> Thêm thông tin</button>

    </form>
    <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc;" class=" rounded shadow-sm bg-white">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark sticky-top">
                <tr>
                    <th style="width: 25%;">Tên</th> <!-- 4 phần -->
                    <th style="width: 25%;">Nội dung</th> <!-- 4 phần -->
                    <th style="width: 20%;">Ảnh</th> <!-- 4 phần -->
                    <th style="width: 18%;">Chỉnh sửa</th> <!-- 2 phần -->
                    <th style="width: 12%;">Xóa</th> <!-- 2 phần -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listIntro as $intro): ?>
                    <tr>
                        <td><?= htmlspecialchars($intro['name']) ?></td>
                        <td><?= htmlspecialchars($intro['detail']) ?></td>
                        <td>
                            <img src="data:image/jpeg;base64,<?= base64_encode($intro['img']) ?>"
                                alt="image"
                                style="width:80px; height:60px; object-fit:cover; border-radius:8px;">

                        </td>
                        <td>
                            <?php
                            $IntroCopy = $intro;
                            $IntroCopy['img'] = base64_encode($intro['img']);
                            ?>
                            <button style="font-size: 20px; font-weight: 500;"
                                data-intro='<?= json_encode($IntroCopy, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                class="btn btn-warning btn-sm editBtnIntro">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </button>

                        </td>
                        <td>
                            <button style="font-size: 20px; font-weight: 500;" data-id="<?= $intro['id'] ?>" class="btn btn-danger btn-sm deleteBtnIntro">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="editIntroModal" tabindex="-1" aria-labelledby="editIntroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIntroModalLabel">Chỉnh sửa thông tin giới thiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editIntroForm" enctype="multipart/form-data">
                        <input type="hidden" name="introId" id="introId">

                        <div class="mb-3">
                            <label for="introName" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="introName" name="introName" required>
                        </div>
                        <div class="mb-3">
                            <label for="introDetail" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="introDetail" name="introDetail" required></textarea>
                        </div>


                        <div class="mb-3">
                            <label for="introThumbnail" class="form-label">Ảnh</label>
                            <div class="mb-2">
                                <img id="currentThumbnailIntro" src="" alt="Thumbnail hiện tại"
                                    style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
                            </div>
                            <input type="file" class="form-control" id="introThumbnail" name="introThumbnail" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveIntroChanges">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
</div>