<?php $requestUrl = isset($_GET['url']) ? $_GET['url'] : '/'; ?>

<div class="header">
    <div class="start">
        <a href="<?php echo PROJECT_PATH ?>">
            <img id="main_logo" src="src/img/logoDriVie.png" alt="logo">
        </a>
    </div>
    <div class="middle">
        <?php if ($requestUrl === 'search' || $requestUrl === '/') { ?>
            <form class="search" method="get" action="<?php echo PROJECT_PATH ?>search">
                <input type="hidden" name="type" value="<?php echo isset($_GET["type"]) ? $_GET["type"] : "1" ?>" />
                <input id="searchbar" type="text" name="q" placeholder="Rechercher"
                    value="<?php echo isset($_GET["q"]) ? $_GET["q"] : "" ?>">
                <button type="submit" class="buttonsearch">
                    <img src="src/img/loupe.png" alt="Boutton recherche">
                </button>
            </form>
        <?php } ?>
        <?php if ($requestUrl === 'admin') { ?>
            <form class="search" method="get">
                <input type="hidden" value="<?php echo $search_type ?>" name="type" />
                <input id="searchbar" type="text" name="q" placeholder="Rechercher" value="<?php echo $search_term ?>">
                <button type="submit" class="buttonsearch">
                    <img src="src/img/loupe.png" alt="Boutton recherche">
                </button>
            </form>
        <?php } ?>
    </div>
    <div class="end">
        <?php if ($_SESSION["id_util"] !== NOT_CONNECTED_USER_ID) { ?>
            <a href="<?php echo PROJECT_PATH ?>message">
                <img src="src/img/message.png" alt="message">
            </a>
            <a href="<?php echo PROJECT_PATH ?>cart">
                <img src="src/img/panier.png" alt="pansier">
            </a>
            <div id="sep_bar"></div>
        <?php } ?>
        <?php if ($_SESSION["id_util"] !== NOT_CONNECTED_USER_ID) { ?>
            <a href="<?php echo PROJECT_PATH ?>account">
                <img src="src/img/sidentifier.png" alt="login">
            <?php } else { ?>
                <a href="<?php echo PROJECT_PATH ?>auth/login">
                    <img src="src/img/sidentifier.png" alt="login">
                <?php } ?>

            </a>
            <?php if ($_SESSION["id_util"] !== NOT_CONNECTED_USER_ID) { ?>
                <a href="<?php echo PROJECT_PATH ?>account" id="pseudo">
                    <?php echo $_SESSION["pseudo_util"] ?>
                </a>
            <?php } ?>
    </div>
</div>