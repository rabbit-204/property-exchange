<div class="chat-container">
    <h2>Trang hỏi đáp</h2>
    <div class="chat-box" id="chatBox">
        <!-- Tin nhắn sẽ được tải động -->
    </div>
    <form class="chat-form" id="chatForm">
        <input type="hidden" name="sender" id="sender" value="<?= $role ?>"> 
        <input type="text" name="message" id="message" placeholder="Aa..." required>
        <button type="submit">Send</button>
    </form>
</div>