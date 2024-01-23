<div id="popup">
    <div id="popupCard">
        <form method="post">
            <button type="submit" id="popupClose" name="popup" value="<?php echo NO_DATA_POPUP ?>">X</button>
        </form>
        <form method="post" id="popupBody">
            <div class="popupColumn">
                <label class="popupTitle">Ajouter un stock</label>
                <input type="text" name="nom_stock" placeholder="Nom du stock" class="popupInput" required />
                <input type="number" name="qt_stock" placeholder="Quantité stock" class="popupInput" min="1" required />
                <label class="popupContent" style="align-self: baseline;">Date du stock</label>
                <input type="date" name="date_stock" placeholder="Date du stock" class="popupInput" required />
                <label class="popupContent" style="align-self: baseline;">Date d'expiration du stock</label>
                <input type="date" name="date_exp_stock" placeholder="Date d'expiration du stock" class="popupInput" />

                <input type="hidden" name="popupEndpoint" value="create" />
                <input type="hidden" name="id_prod" value="<?php echo $id_prod ?>" />
                <button class="popupButton" name="popup" value="stock" style="align-self: center;">Confirmer</button>
            </div>
        </form>
    </div>
    <script src="src/js/popup.js"></script>
</div>