<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/messagerie/newMessage.css" />
    <link rel="stylesheet" href="src/css/messagerie/messagerie_left.css" />
    <title>Document</title>

</head>

<body>
    <?php require_once "view/header.php"; ?>
    <div class="main">

        <?php include_once "view/messageLeftBar.php"; ?>
        <div>
            <form id="receiverForm" method="post">
                <label>Ajouter un destinataire</label>
                <div class="receiversSection">

                    <div class="groups">
                        <?php foreach ($receivers as $receiver) { ?>
                            <div class="group">
                                <?php echo $receiver["nom_groupe"] ?>
                                <button class="deleteButton" type="submit" name="delete_dest_group_mess"
                                    value="<?php echo $receiver["dest_group_mess"] ?>">x</button>
                            </div>
                        <?php } ?>
                        <input type="text" placeholder="Prénom NOM" id="dest_group_mess" name="dest_group_mess"
                            list="receivers" autocomplete="off">
                    </div>

                </div>

                <datalist id="receivers">
                    <?php foreach ($groups as $group) { ?>
                        <option value="<?php echo $group["id_groupe"] ?>">
                            <?php echo $group["nom_groupe"] ?>
                        </option>
                    <?php } ?>
                </datalist>
            </form>

            <form method="post">
                <label>Expéditeur</label>
                <div class="receiversSection">
                    <div class="groups">
                        <div class="group">
                            <?php echo $_SESSION["pseudo_util"] ?>
                        </div>
                    </div>
                </div>

                <label>Objet</label>
                <input aria-required="true" required <?php echo $nbReceivers <= 0 ? "disabled" : "" ?> type="text"
                    name="objet_mess">

                <label>Message</label>
                <textarea aria-required="true" required <?php echo $nbReceivers <= 0 ? "disabled" : "" ?>
                    name="contenu_mess" rows="4" cols="50"></textarea>

                <button name="action" id="sendButton" type="submit" value="send">Envoyer</button>
            </form>
        </div>

    </div>

    <script>
        var groupIds = [<?php foreach ($groups as $group) { ?> "<?php echo $group["id_groupe"] ?>", <?php } ?>];
        document.getElementById("dest_group_mess").addEventListener('input', function (e) {
            if (groupIds.includes(e.target.value)) {
                document.getElementById("receiverForm").submit();
            }
        })
    </script>
</body>

</html>