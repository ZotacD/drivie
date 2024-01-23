<div id="leftBar">
    <label id="pageTitle">Messagerie</label>

    <a id="newMessage" href="message/new">
        <img src="src/svg/new_msg.svg" alt="nouveau message">
        <span>Rédiger un message</span>
    </a>

    <div id="leftButtons">
        <a href="message?page=received" class="leftButton<?php echo $page == "received" ? ' focus' : '' ?>">
            <img src="src/svg/recus.svg" alt="messages reçus">
            <span>Reçus</span>
        </a>
        <a href="message?page=sent" class="leftButton<?php echo $page == "sent" ? ' focus' : '' ?>">
            <img src="src/svg/envoyes.svg" alt="message envoyés">
            <span>Envoyés</span>
        </a>
    </div>
</div>