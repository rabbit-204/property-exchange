// function loadMessages(scrollToBottom = false) {
//     const chatBox = $('#chatBox');

//     $.ajax({
//         url: '/index.php?controller=answerandquestion&action=getMessages', // API lấy tin nhắn
//         method: 'GET',
//         success: function (data) {
//             const messages = JSON.parse(data).messages;
//             chatBox.html(''); // Xóa nội dung cũ
//             console.log(messages);
//             messages.forEach(function (message) {
//                 const messageClass = message.sender === 'user' ? 'user' : 'admin';
//                 chatBox.append(`
//                     <div class="message ${messageClass}">
//                         <p>${message.message}</p>
//                     </div>
//                 `);
//             });

//             // Cuộn xuống cuối nếu `scrollToBottom` là true
//             if (scrollToBottom) {
//                 chatBox.scrollTop(chatBox[0].scrollHeight);
//             }
//         }
//     });
// }

// // Gửi tin nhắn
// $('#chatForm').on('submit', function (e) {
//     e.preventDefault();
//     // const sender = $('#sender').val();
//     const message = $('#message').val();

//     $.ajax({
//         url: '/index.php?controller=answerandquestion&action=sendMessage', // API gửi tin nhắn
//         method: 'POST',  
//         data: { message },
//         success: function () {
//             $('#message').val(''); // Xóa nội dung input
//             loadMessages(true); // Tải lại tin nhắn
//         }
//     });
// });

// // Tải tin nhắn mỗi 2 giây
// // setInterval(loadMessages(false), 2000);
// setInterval(function () {
//     loadMessages(false);
// }, 2000);
// // Tải tin nhắn lần đầu
// loadMessages(true);
// // console.log($_session['user']);
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


function loadMessages(scrollToBottom = false) {
    const chatBox = $('#chatBox');

    $.ajax({
        url: '/index.php?controller=answerandquestion&action=getMessages',
        method: 'GET',
        success: function (data) {
            const messages = JSON.parse(data).messages;
            chatBox.html('');
            messages.forEach(function (message) {
                const messageClass = message.sender === 'user' ? 'justify-content-start flex-row-reverse' : 'justify-content-start';
                const messageBg = message.sender === 'user' ? 'bg-primary text-white' : 'bg-light text-dark';
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
        }
    });
}

// Gửi tin nhắn
$('#chatForm').on('submit', function (e) {
    e.preventDefault();
    const message = $('#message').val();

    $.ajax({
        url: '/index.php?controller=answerandquestion&action=sendMessage',
        method: 'POST',
        data: { message },
        success: function () {
            $('#message').val('');
            loadMessages(true);
        }
    });
});

// Tải tin nhắn mỗi 2 giây
setInterval(function () {
    loadMessages(false);
}, 2000);

// Tải lần đầu
loadMessages(true);
