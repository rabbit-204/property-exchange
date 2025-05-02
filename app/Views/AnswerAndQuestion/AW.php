<!-- <div class="chat-container">
    <h2>Trang hỏi đáp</h2>
    <div class="chat-box" id="chatBox">
    </div>
    <form class="chat-form" id="chatForm">
        <input type="hidden" name="sender" id="sender" value="<?= $role ?>"> 
        <input type="text" name="message" id="message" placeholder="Aa..." required>
        <button type="submit">Send</button>
    </form>
</div> -->
<div class="container py-5 mt-5">
    <div class="card shadow rounded-4" style="height: calc(100vh - 144px);">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="mb-0">Đang trò chuyện với Admin</h4>
        </div>
        <div class="card-body d-flex flex-column p-3" id="chatBox" style="overflow-y: auto;">
        </div>
        <div class="card-footer bg-light rounded-bottom-4">
            <form class="d-flex gap-2" id="chatForm">
                <input type="hidden" name="sender" id="sender" value="<?= $role ?>"> 
                <input type="text" class="form-control" name="message" id="message" placeholder="Aa..." required>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
</div>
<!-- <div class="container py-5 mt-5">
    <div class="card shadow rounded-4" style="height: calc(100vh - 144px);">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="mb-0">Trang Hỏi Đáp</h4>
        </div>
        <div class="card-body d-flex flex-column p-3" id="chatBox" style="overflow-y: auto; background-color: #f4f4f4;">
        </div>
        <div class="card-footer bg-light rounded-bottom-4">
            <form class="d-flex gap-2" id="chatForm">
                <input type="hidden" name="sender" id="sender" value="<?= $role ?>"> 
                <input type="text" class="form-control" name="message" id="message" placeholder="Aa..." required>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
</div> -->

