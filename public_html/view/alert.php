<div id="popup">
    <div id="popupCard">
        <form method="post">
            <button type="submit" name="popup" value="<?php echo NO_DATA_POPUP ?>" id="popupClose">X</button>
        </form>
        <div id="popupBody">
            <div class="popupColumn">
                <label class="popupTitle">Alerte</label>
                <label class="popupContent">
                    <?php echo $infoMessage; ?>
                </label>
                <form class="popupColumn" method="post">
                    <button type="submit" style="justify-self: center;" name="popup" value="<?php echo NO_DATA_POPUP ?>"
                        class="popupButton">Ok</button>
                </form>
            </div>
        </div>
    </div>
    <script src="src/js/popup.js"></script>
</div>