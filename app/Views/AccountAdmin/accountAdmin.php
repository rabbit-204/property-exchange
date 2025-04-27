<div class="container py-4" style="margin-top: 100px">
    <h3>Danh sách người dùng</h3>
    <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc;" class="p-3 rounded shadow-sm bg-white">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $acc): ?>
                    <tr>
                        <td><?= htmlspecialchars($acc['id']) ?></td>
                        <td><?= htmlspecialchars($acc['fullname']) ?></td>
                        <td><?= htmlspecialchars($acc['email']) ?></td>
                        <td><?= htmlspecialchars($acc['phone']) ?></td>
                        <td><?= htmlspecialchars($acc['role']) ?></td>
                        <td>
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input 
                                    class="form-check-input toggle-active" 
                                    type="checkbox" 
                                    data-id="<?= $acc['id'] ?>" 
                                    <?= $acc['isActive'] ? 'checked' : '' ?>
                                >
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-active').forEach(toggle => {
        toggle.addEventListener('change', function () {
            const id = this.dataset.id;
            const isActive = this.checked ? 1 : 0;

            // Gửi yêu cầu AJAX tới server
            fetch('index.php?controller=account&action=toggleActive', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}&isActive=${isActive}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Thành công: Không cần làm gì thêm, trạng thái checkbox đã thay đổi
                } else {
                    // Thất bại: Hiển thị thông báo lỗi và reset trạng thái checkbox
                    alert('Cập nhật thất bại');
                    this.checked = !this.checked;  // Reset trạng thái checkbox
                }
            })
            .catch(err => {
                // Xử lý khi có lỗi xảy ra
                alert('Có lỗi xảy ra');
                this.checked = !this.checked;  // Reset trạng thái checkbox
            });
        });
    });
});


</script>