let userId = $;
function formatTime(datetimeString) {
    const date = new Date(datetimeString);
    date.setHours(date.getHours() + 7); // ✅ cộng thêm 7 giờ vào thời gian lấy từ server

    const now = new Date();
    now.getHours(); // ✅ cộng +7 giờ vào thời gian hiện tại để so sánh đúng

    const isToday = date.getDate() === now.getDate() &&
                    date.getMonth() === now.getMonth() &&
                    date.getFullYear() === now.getFullYear();

    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');

    if (isToday) {
        return `${hours}:${minutes}`;
    } else {
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year} ${hours}:${minutes}`;
    }
}


function loadMessages(id,scrollToBottom = false) {
    const chatBox = $('#chatBox');

    $.ajax({
        url: '/index.php?controller=answerandquestion&action=getMessagesAdmin',
        method: 'POST',
        data: { id },
        success: function (data) {
            const messages = JSON.parse(data).messages;
            chatBox.html('');
            messages.forEach(function (message) {
                const messageClass = message.sender === 'admin' ? 'justify-content-start flex-row-reverse' : 'justify-content-start';
                const messageBg = message.sender === 'admin' ? 'bg-primary text-white' : 'bg-light text-dark';
                const time = formatTime(message.created_at);

                chatBox.append(`
                    <div class="mb-3 d-flex gap-2 align-items-center ${messageClass}">
                            <span class="px-3 py-2 rounded-pill ${messageBg}">
                                ${message.message}
                            </span>
                            <div class="small text-muted" style="font-size: 0.75rem; white-space: nowrap;">
                                ${time}
                            </div>
                    </div>
                `);
                
                
            });

            if (scrollToBottom) {
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }
            
            markMessagesAsRead(id);
        }
    });
}
document.querySelector('.list-group').addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('user-item')) {
        userId = e.target.getAttribute('data-id');
        const fullname = e.target.getAttribute('data-fullname');

        // Cập nhật tiêu đề của chatbox
        document.getElementById('chatWith').innerText = fullname;

        // Tải tin nhắn của người này
        loadMessages(userId, true);
    }
});
function loadUser(){
    const chatBox = $('.list-group');

    $.ajax({
        url: '/index.php?controller=answerandquestion&action=loadUser',
        method: 'GET',
        success: function (data) {
            const listUser = JSON.parse(data).listChat;
            chatBox.html('');
            listUser.forEach(function (user) {
                const checkRead = user.is_read == 0 ? 'fw-bold fs-5' : '';

                chatBox.append(`
                    <li class="list-group-item user-item ${checkRead}" data-id="${user.id_user}" data-fullname="${user.fullname}">
                        ${user.fullname}
                    </li>
                `);
                
                
            });
        }
    });
}

// Gửi tin nhắn
$('#chatForm').on('submit', function (e) {
    e.preventDefault();
    const message = $('#message').val();

    $.ajax({
        url: '/index.php?controller=answerandquestion&action=sendMessageAdmin',
        method: 'POST',
        data: { message,userId },
        success: function () {
            $('#message').val('');
            loadMessages(userId,true);
        }
    });
});

// Tải tin nhắn mỗi 2 giây
setInterval(function () {
    loadMessages(userId,false);
    loadUser();
}, 2000);

// Tải lần đầu
// loadMessages(true);
loadUser();
// Xử lý khi người dùng chọn người chat
function markMessagesAsRead(userId) {
    $.ajax({
        url: '/index.php?controller=answerandquestion&action=markMessagesAsRead',
        method: 'POST',
        data: { id: userId },
        success: function () {
            loadUser();
        }
    });
}


// Giả sử bạn có một hàm tải tin nhắn khi chọn người dùng

document.getElementById('toggleSidebar').addEventListener('click', function () {
    document.getElementById('sidebarUser').classList.add('active');
});

// Đóng Sidebar khi click vào overlay
document.getElementById('close').addEventListener('click', function () {
    document.getElementById('sidebarUser').classList.remove('active');
});

// Đóng Sidebar khi chọn người dùng (nếu màn hình nhỏ)
document.querySelector('.list-group').addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('user-item')) {
        if (window.innerWidth <= 768) {
            document.getElementById('sidebarUser').classList.remove('active');
        }
    }
});
