<?php

// Récupérer l'URL depuis le paramètre "endpoint"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

switch ($requestUrl) {
    case '/':
        require_once 'model/message.php';
        $messages = null;
        $page = "";

        switch ($_GET["page"]) {
            case 'received':
                $messages = getReceivedMessages($_SESSION["id_groupe"], $_SESSION["id_type"]);
                setupSearchReceivedMessageInputs();
                break;
            case 'sent':
                $messages = getSentMessages($_SESSION["id_groupe"]);
                setupSearchSentMessageInputs();
                break;
            default:
                header("Location: " . PROJECT_PATH . "message?page=received");
                exit();
        }

        $nbMessages = count($messages);

        $page = $_GET["page"];

        $message = null;
        $receivers = null;
        $id_mess = 0;

        displayMessageInputs();
        refresh();


        require_once 'view/messageList.php';
        break;
    case 'new':
        require_once 'model/message.php';
        require_once 'model/group.php';

        $page = "";
        $receivers = null;
        $nbReceivers;
        $groups = getGroups();

        setupInputsNewMessage();

        require_once 'view/messageNew.php';
        break;
    default:
        header("Location: " . PROJECT_PATH . "message");
        exit();
}

function setupInputsNewMessage()
{
    global $receivers, $nbReceivers;

    // unset($_SESSION["receivers"]);

    if (!isset($_SESSION["receivers"])) {
        $_SESSION["receivers"] = array();
    }

    $receivers = $_SESSION["receivers"];
    $nbReceivers = count($receivers);

    if (isset($_POST["dest_group_mess"]) && !empty($_POST["dest_group_mess"])) {
        $dest_group_mess = $_POST["dest_group_mess"];

        if (!in_array(["id_groupe" => $dest_group_mess], getGroupIds())) {
            return;
        }

        $receiver = [
            "nom_groupe" => getGroup($dest_group_mess)["nom_groupe"],
            "dest_group_mess" => $dest_group_mess
        ];

        if (!in_array($receiver, $receivers)) {
            array_push($receivers, $receiver);
        }

        $_SESSION["receivers"] = $receivers;
        $nbReceivers = count($receivers);
        return;
    }

    if (isset($_POST["delete_dest_group_mess"])) {
        $delete_dest_groupe_mess = $_POST["delete_dest_group_mess"];

        $receiver = [
            "nom_groupe" => getGroup($delete_dest_groupe_mess)["nom_groupe"],
            "dest_group_mess" => $delete_dest_groupe_mess
        ];

        array_splice($receivers, array_search($receiver, $receivers), 1);

        $_SESSION["receivers"] = $receivers;
        $nbReceivers = count($receivers);
        return;
    }

    if ($nbReceivers == 0) {
        return;
    }

    if (!isset($_POST["action"])) {
        return;
    }
    if (!isset($_POST["objet_mess"])) {
        return;
    }
    if (!isset($_POST["contenu_mess"])) {
        return;
    }

    $action = $_POST["action"];
    $objet_mess = $_POST["objet_mess"];
    $contenu_mess = $_POST["contenu_mess"];

    switch ($action) {
        case "send":
            $id_mess = createMessage($objet_mess, $contenu_mess, $_SESSION["id_groupe"]);

            foreach ($receivers as $ordre_groupe_mess => $receiver) {
                addReceiver($id_mess, $receiver["dest_group_mess"], $ordre_groupe_mess);
            }

            unset($_SESSION["receivers"]);
            header("Location: " . PROJECT_PATH . "message?page=sent");
            exit();
        default:
            header("Refresh:0");
            exit();
    }

    // FOREACH($DESTINATAIRES AS $DESTINATAIRE)
    // ajouterDestinataire();
}

function displayMessageInputs()
{

    global $message, $receivers, $id_mess;

    if (!isset($_POST["id_mess"])) {
        return;
    }

    $id_mess = $_POST["id_mess"];

    $message = getMessage($id_mess);
    $receivers = getReceivers($id_mess);
}

function setupSearchReceivedMessageInputs()
{
    global $messages;

    if (!isset($_POST["action"]) || !isset($_POST["searchTerm"])) {
        return;
    }

    $action = $_POST["action"];
    $searchTerm = $_POST["searchTerm"];

    if ($action == "search") {
        $messages = searchReceivedMessages($searchTerm, $_SESSION["id_groupe"], $_SESSION["id_type"]);
    }
}
function setupSearchSentMessageInputs()
{
    global $messages;

    if (!isset($_POST["action"]) || !isset($_POST["searchTerm"])) {
        return;
    }

    $action = $_POST["action"];
    $searchTerm = $_POST["searchTerm"];

    if ($action == "search") {
        $messages = searchSentMessages($searchTerm, $_SESSION["id_groupe"]);
    }
}

function refresh()
{
    if (!isset($_POST["action"])) {
        return;
    }

    $action = $_POST["action"];

    if ($action == "refresh") {
        header("Refresh:0");
        exit();
    }
}

