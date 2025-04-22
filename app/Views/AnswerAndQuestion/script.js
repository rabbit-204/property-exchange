function loadMessages(scrollToBottom = false) {
    const chatBox = $('#chatBox');

    $.ajax({
        url: '/index.php?controller=answerandquestion&action=getMessages', // API lấy tin nhắn
        method: 'GET',
        success: function (data) {
            const messages = JSON.parse(data).messages;
            chatBox.html(''); // Xóa nội dung cũ
            console.log(messages);
            messages.forEach(function (message) {
                const messageClass = message.sender === 'user' ? 'user' : 'admin';
                chatBox.append(`
                    <div class="message ${messageClass}">
                        <p>${message.message}</p>
                    </div>
                `);
            });

            // Cuộn xuống cuối nếu `scrollToBottom` là true
            if (scrollToBottom) {
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }
        }
    });
}

// Gửi tin nhắn
$('#chatForm').on('submit', function (e) {
    e.preventDefault();
    // const sender = $('#sender').val();
    const message = $('#message').val();

    $.ajax({
        url: '/index.php?controller=answerandquestion&action=sendMessage', // API gửi tin nhắn
        method: 'POST',  
        data: { message },
        success: function () {
            $('#message').val(''); // Xóa nội dung input
            loadMessages(true); // Tải lại tin nhắn
        }
    });
});

// Tải tin nhắn mỗi 2 giây
// setInterval(loadMessages(false), 2000);
setInterval(function () {
    loadMessages(false);
}, 2000);
// Tải tin nhắn lần đầu
loadMessages(true);
// console.log($_session['user']);