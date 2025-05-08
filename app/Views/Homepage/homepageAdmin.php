<div id="view" class="container py-4" style="margin-top: 100px">
    <div class="d-flex justify-content-between">
        <h3>Danh Sách Hình Ảnh Trong Slider</h3>
    </div>
    <form class="mb-3" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Image: </label>
            <input type="file" id="image" name="image" style="width: 100%" required>
        </div>
        <div class="mb-3">
            <label for="caption" class="form-label">Caption: </label>
            <input type="text" id="caption" name="caption" style="width: 100%">
        </div>
        <button id="uploadImageSlider" style="font-size: 20px; font-weight: 500; " type="button" class="btn btn-outline-success mb-3 d-flex justify-content-end"><i class="bi bi-plus-circle"></i> Thêm Hình Ảnh</button>

    </form>

    <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc;" class=" rounded shadow-sm bg-white">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark sticky-top">
                <tr>
                    <th style="width: 33%;">Ảnh</th>
                    <th style="width: 33%;">Caption</th>
                    <th style="width: 17%;">Chỉnh sửa</th>
                    <th style="width: 17%;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listScreen as $screen): ?>
                    <tr>
                        <td>
                            <img src="data:image/jpeg;base64,<?= base64_encode($screen['image']) ?>"
                                alt="image"
                                style="width:80px; height:60px; object-fit:cover; border-radius:8px;">

                        </td>
                        <td><?= htmlspecialchars($screen['caption']) ?></td>
                        <td>
                            <?php
                            $screenCopy = $screen;
                            $screenCopy['image'] = base64_encode($screen['image']);
                            ?>
                            <a style="font-size: 20px; font-weight: 500;"
                                data-screen='<?= json_encode($screenCopy, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                class="btn btn-warning btn-sm editBtnSlider">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </a>

                        </td>
                        <td>
                            <button style="font-size: 20px; font-weight: 500;" data-id="<?= $screen['id'] ?>" class="btn btn-danger btn-sm deleteBtnScreen">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="editScreenModal" tabindex="-1" aria-labelledby="editScreenModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editScreenModalLabel">Chỉnh sửa Screen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editScreenForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="screenId">

                        <div class="mb-3">
                            <label for="screenCaption" class="form-label">Caption: </label>
                            <input type="text" class="form-control" id="screenCaption" name="caption" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveScreenChanges">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
</div>







<div id="view" class="container py-4" style="margin-top: 100px">
    <div class="d-flex justify-content-between">
        <h3>Danh Sách Tỉnh Thành Nổi Bật</h3>
    </div>
    <form class="mb-3" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Tên tỉnh thành: </label>
            <input type="text" id="name" name="name" style="width: 100%">
        </div>
        <div class="mb-3">
            <label for="imageCard" class="form-label">Image: </label>
            <input type="file" id="imageCard" style="width: 100%" name="imageCard" required>
        </div>
        <div class="mb-3">
            <label for="num" class="form-label">Ước lượng số lượng căn hộ: </label>
            <input type="number" id="num" name="num" style="width: 100%">
        </div>
        <button id="uploadCard" style="font-size: 20px; font-weight: 500; " type="button" class="btn btn-outline-success mb-3 d-flex justify-content-end"><i class="bi bi-plus-circle"></i> Thêm Thẻ</button>
    </form>

    <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc;" class=" rounded shadow-sm bg-white">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark sticky-top">
                <tr>
                    <th stype="width: 17%;">Tên</th>
                    <th style="width: 34%;">Ảnh</th> <!-- 4 phần -->
                    <th style="width: 17%;">Số lượng</th> <!-- 4 phần -->
                    <th style="width: 16%;">Chỉnh sửa</th> <!-- 2 phần -->
                    <th style="width: 16%;">Xóa</th> <!-- 2 phần -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listCard as $card): ?>
                    <tr>
                        <td><?= htmlspecialchars($card['name'])  ?></td>
                        <td>
                            <img src="data:image/jpeg;base64,<?= base64_encode($card['image']) ?>"
                                alt="image"
                                style="width:80px; height:60px; object-fit:cover; border-radius:8px;">

                        </td>
                        <td><?= htmlspecialchars($card['num']) ?></td>
                        <td>
                            <?php
                            $cardCopy = $card;
                            $cardCopy['image'] = base64_encode($card['image']);
                            ?>
                            <a style="font-size: 20px; font-weight: 500;"
                                data-card='<?= json_encode($cardCopy, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                class="editBtnCard btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </a>

                        </td>
                        <td>
                            <button style="font-size: 20px; font-weight: 500;" data-id="<?= $card['id'] ?>" class="btn btn-danger btn-sm deleteBtnCard">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="editCardModal" tabindex="-1" aria-labelledby="editCardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCardModalLabel">Chỉnh sửa Screen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCardForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="cardId">

                        <div class="mb-3">
                            <label for="screenCaption" class="form-label">Ước lượng: </label>
                            <input type="text" class="form-control" id="cardNum" name="num" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveCardChanges">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
</div>







<style>
    #icon-picker i {
        font-size: 24px;
        cursor: pointer;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
    }

    #icon-picker i.selected {
        border-color: #28a745;
        background-color: #e6ffe6;
    }

    #icon-picker i,
    #edit-icon-picker i {
        font-size: 24px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    #icon-picker i:hover,
    #edit-icon-picker i:hover {
        background-color: #f0f0f0;
        transform: scale(1.05);
    }

    #icon-picker i.selected,
    #edit-icon-picker i.selected {
        background-color: #198754;
        color: white;
        border-color: #198754;
    }
</style>
<div id="view" class="container py-4" style="margin-top: 100px">
    <div class="d-flex justify-content-between">
        <h3>Danh Sách Giới Thiệu</h3>
    </div>
    <form class="mb-3" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Chọn biểu tượng:</label>
            <div id="icon-picker" class="d-flex flex-wrap gap-3">
                <i class="bi bi-house icon-option" data-icon="bi bi-house"></i>
                <i class="bi bi-building icon-option" data-icon="bi bi-building"></i>
                <i class="bi bi-briefcase icon-option" data-icon="bi bi-briefcase"></i>
                <i class="bi bi-globe icon-option" data-icon="bi bi-globe"></i>
                <i class="bi bi-people icon-option" data-icon="bi bi-people"></i>
                <i class="bi bi-building-add icon-option" data-icon="bi bi-building-add"></i>
                <i class="bi bi-door-open icon-option" data-icon="bi bi-door-open"></i>
                <i class="bi bi-person-check icon-option" data-icon="bi bi-person-check"></i>
                <i class="bi bi-people-fill icon-option" data-icon="bi bi-people-fill"></i>
                <i class="bi bi-chat-dots icon-option" data-icon="bi bi-chat-dots"></i>
                <i class="bi bi-cart icon-option" data-icon="bi bi-cart"></i>
                <i class="bi bi-currency-dollar icon-option" data-icon="bi bi-currency-dollar"></i>
                <i class="bi bi-receipt icon-option" data-icon="bi bi-receipt"></i>
                <i class="bi bi-cash-stack icon-option" data-icon="bi bi-cash-stack"></i>
                <i class="bi bi-wallet2 icon-option" data-icon="bi bi-wallet2"></i>
                <i class="bi bi-person-plus icon-option" data-icon="bi bi-person-plus"></i>
                <i class="bi bi-clipboard-check icon-option" data-icon="bi bi-clipboard-check"></i>
                <i class="bi bi-shield-check icon-option" data-icon="bi bi-shield-check"></i>
                <i class="bi bi-shield-lock icon-option" data-icon="bi bi-shield-lock"></i>
                <i class="bi bi-lock icon-option" data-icon="bi bi-lock"></i>
                <i class="bi bi-shield icon-option" data-icon="bi bi-shield"></i>
            </div>
            <input type="hidden" name="icon" id="selected-icon">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề của mục giới thiệu: </label>
            <input type="text" id="title" name="title" style="width: 100%">
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Diễn giải chi tiết cho mục giới thiệu: </label>
            <input type="text" id="detail" name="detail" style="width: 100%">
        </div>
        <button id="uploadIntroduction" style="font-size: 20px; font-weight: 500; " type="button" class="btn btn-outline-success mb-3 d-flex justify-content-end"><i class="bi bi-plus-circle"></i> Thêm Mục Giới Thiệu</button>

    </form>

    <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc;" class=" rounded shadow-sm bg-white">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark sticky-top">
                <tr>
                    <th style="width: 16%;">Biểu tượng</th>
                    <th style="width: 16%;">Tiêu đề</th>
                    <th style="width: 34%;">Chi tiết</th>
                    <th style="width: 17%;">Chỉnh sửa</th>
                    <th style="width: 17%;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listIntroduction as $introduction): ?>
                    <tr>
                        <td><i class="<?= htmlspecialchars($introduction['symbol']) ?>"></i></td>
                        <td><?= htmlspecialchars($introduction['title']) ?></td>
                        <td><?= htmlspecialchars($introduction['detail']) ?></td>
                        <td>
                            <?php
                            $introductionCopy = $introduction;
                            ?>
                            <a style="font-size: 20px; font-weight: 500;"
                                data-introduction='<?= json_encode($introductionCopy, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                class="btn btn-warning btn-sm editBtnIntroduction">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </a>

                        </td>
                        <td>
                            <button style="font-size: 20px; font-weight: 500;" data-id="<?= $introduction['id'] ?>" class="btn btn-danger btn-sm deleteBtnIntroduction">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="editIntroductionModal" tabindex="-1" aria-labelledby="editIntroductionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIntroductionModalLabel">Chỉnh sửa Introduction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editIntroductionForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="introductionId">
                        <div class="mb-3">
                            <label class="form-label">Chọn biểu tượng:</label>
                            <div id="edit-icon-picker" class="d-flex flex-wrap gap-3">
                                <i class="bi bi-house icon-option" data-icon="bi bi-house"></i>
                                <i class="bi bi-building icon-option" data-icon="bi bi-building"></i>
                                <i class="bi bi-briefcase icon-option" data-icon="bi bi-briefcase"></i>
                                <i class="bi bi-globe icon-option" data-icon="bi bi-globe"></i>
                                <i class="bi bi-people icon-option" data-icon="bi bi-people"></i>
                                <i class="bi bi-building-add icon-option" data-icon="bi bi-building-add"></i>
                                <i class="bi bi-door-open icon-option" data-icon="bi bi-door-open"></i>
                                <i class="bi bi-person-check icon-option" data-icon="bi bi-person-check"></i>
                                <i class="bi bi-people-fill icon-option" data-icon="bi bi-people-fill"></i>
                                <i class="bi bi-chat-dots icon-option" data-icon="bi bi-chat-dots"></i>
                                <i class="bi bi-cart icon-option" data-icon="bi bi-cart"></i>
                                <i class="bi bi-currency-dollar icon-option" data-icon="bi bi-currency-dollar"></i>
                                <i class="bi bi-receipt icon-option" data-icon="bi bi-receipt"></i>
                                <i class="bi bi-cash-stack icon-option" data-icon="bi bi-cash-stack"></i>
                                <i class="bi bi-wallet2 icon-option" data-icon="bi bi-wallet2"></i>
                                <i class="bi bi-person-plus icon-option" data-icon="bi bi-person-plus"></i>
                                <i class="bi bi-clipboard-check icon-option" data-icon="bi bi-clipboard-check"></i>
                                <i class="bi bi-shield-check icon-option" data-icon="bi bi-shield-check"></i>
                                <i class="bi bi-shield-lock icon-option" data-icon="bi bi-shield-lock"></i>
                                <i class="bi bi-lock icon-option" data-icon="bi bi-lock"></i>
                                <i class="bi bi-shield icon-option" data-icon="bi bi-shield"></i>
                            </div>
                            <input type="hidden" name="symbol" id="edit-selected-icon">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề:</label>
                            <input type="text" class="form-control" name="title" id="titleIntroduction">
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="form-label">Chi tiết:</label>
                            <input type="text" class="form-control" name="detail" id="detailIntroduction">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveIntroductionChanges">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
</div>