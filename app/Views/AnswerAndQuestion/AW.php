<div class="chat-container">
        <h2>Admin</h2>
        <div class="chat-box" id="chatBox">
            <!-- Tin nhắn sẽ được tải động -->
        </div>
        <form class="chat-form" id="chatForm">
            <input type="hidden" name="sender" id="sender" value="<?= $role ?>"> <!-- 'user' hoặc 'admin' -->
            <input type="text" name="message" id="message" placeholder="Type your message..." required>
            <button type="submit">Send</button>
        </form>
    </div>