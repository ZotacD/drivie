<div id="popup">
    <div id="popupCard">
        <form method="post">
            <button type="submit" name="popup" value="<?php echo NO_DATA_POPUP ?>" id="popupClose">X</button>
        </form>
        <div id="popupBody">
            <div class="popupColumn">
                <label class="popupTitle">Voulez-vous <br> éxécuter l'action ?</label>
            </div>
            <br>

            <div class="popupColumn">
                <div class="popupRow">
                    <form method="post">
                        <button type="submit" name="popup" value="<?php echo NO_DATA_POPUP ?>"
                            class="popupButton">non</button>
                    </form>

                    <form method="post">
                        <input type="hidden" name="popupEndpoint" value="delete" />
                        <input type="hidden" name="id_stock" value="<?php echo $id_stock ?>" />
                        <input type="hidden" name="action" value="delete" />
                        <button type="submit" name="popup" value="stock" class="popupButton">oui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="src/js/popup.js"></script>
</div>