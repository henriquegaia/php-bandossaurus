<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
?>
<div class="chat">
    <input type="text" class="chat-name" placeholder="enter your name">
    <div class="chat-messages">
        <div class="chat-message"></div>
    </div>
    <textarea class="chat-typed" placeholder="type your message"></textarea>
    <div class="chat-status">Status: <label id="label_chat-status">Idle</label></div>
</div>