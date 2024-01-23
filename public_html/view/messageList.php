<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/messagerie/message.css" />
    <link rel="stylesheet" href="src/css/messagerie/messagerie_left.css" />
    <title>Document</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>
    <div class="main">

        <?php require_once 'view/messageLeftBar.php'; ?>

        <div id="messageMiddle">
            <form method="post" id="searchForm">
                <input id="searchBar" type="text" name="searchTerm" placeholder="Rechercher un message">
                <input type="hidden" name="action" value="search" />
            </form>

            <?php if ($nbMessages > 0) { ?>
                <div id="messagesScroll">
                    <div id="messages">
                        <?php foreach ($messages as $receivedMessage) { ?>
                            <form method="post"
                                class="message<?php echo $id_mess == $receivedMessage["id_mess"] ? ' focus' : '' ?>">
                                <button type="submit">
                                    <img class="messageImg" src="src/img/message.png" />
                                    <div class="messageInfos">
                                        <label class="messageSubject">
                                            <?php echo $receivedMessage["nom_groupe_exp"]; ?> |
                                        </label>
                                        <label class="messageBody">
                                            <?php echo $receivedMessage["objet_mess"]; ?>
                                        </label>
                                    </div>
                                    <label class="messageDate">
                                        <?php echo $receivedMessage["date_mess"]; ?>
                                    </label>
                                </button>
                                <input type="hidden" name="id_mess" value="<?php echo $receivedMessage["id_mess"]; ?>" />
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>


        <div id="messageEnd">
            <?php if ($message) { ?>
                <div class="messageHead">

                    <label class="senderMail">From :
                        <?php echo $message["nom_groupe_exp"]; ?>
                    </label>

                    <label class="sendedMail">To :
                        <?php foreach ($receivers as $receiver) { ?>
                            <?php echo $receiver["nom_groupe_dest"]; ?>;
                        <?php } ?>
                    </label>

                    <label class="messageSubject">Objet :
                        <?php echo $message["objet_mess"]; ?>
                    </label>

                    <label class="messageDate">
                        <?php echo $message["date_mess"]; ?>
                    </label>

                </div>
                <div class="separation"></div>
                <div class="messageContent">
                    <p>
                        <?php echo $message["contenu_mess"]; ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>