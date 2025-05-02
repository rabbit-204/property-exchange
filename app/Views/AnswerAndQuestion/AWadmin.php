

<div class="container py-5 mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4 col-lg-3 active" id="sidebarUser">
            <div class="card shadow rounded-4 cus_sidebar">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0 text-center">Chatbox</h5>
                    <i id="close" class="fa-duotone fa-solid fa-xmark d-md-none"></i>
                </div>
                <div class="card-body" id="userList" style="overflow-y: auto; background-color: #f4f4f4;">
                    <ul class="list-group">
                        <!-- Danh sách user sẽ load ở đây -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Chatbox -->
        <div class="col-md-8 col-lg-9" id="chatSection">
            <div class="card shadow rounded-4" style="height: calc(100vh - 144px);">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex gap-2">
                    <button class=" d-md-none" id="toggleSidebar">☰</button>
                    <h4 class="mb-0" id="chatWith">Messenger</h4>
                </div>
                <div class="card-body d-flex flex-column p-3" id="chatBox" style="overflow-y: auto;">
                    <!-- Tin nhắn sẽ được load ở đây -->
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
    </div>
    <!-- Thêm overlay khi sidebar mở -->

</div>

