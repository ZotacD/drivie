<div id="popup">
    <base href="<?php echo PROJECT_PATH ?>">
    <div id="popupCard">
        <form method="post">
            <button type="submit" id="popupClose" name="popup" value="<?php echo NO_DATA_POPUP ?>">X</button>
        </form>
        <form id="popupBody" method="post" enctype="multipart/form-data">

            <div class="popupColumn">
            <label class="popupTitle" style="text-align:center;">Donnez votre avis !</label>
                <input type="text" name="titre_avis" placeholder="Titre de l'avis" class="popupInput" required />
                <div class="popupRow">
                    <input type="number" name="note_avis" placeholder="Note" class="popupInput" min="0" max="5"
                        step="0.1" required />
                    <img id="stars" src="src/svg/star/star.svg" alt="étoile">
                </div>
                <textarea name="description_avis" placeholder="Rédigez votre avis" class="popupTextarea"></textarea>
                <input type="hidden" name="id_prod" value="<?php echo $id_prod; ?>">
                <input type="hidden" name="popupEndpoint" value="create">
                <button type="submit" class="popupButton" name="popup" value="review" style="align-self: center;">Publier</button>
            </div>
        </form>
    </div>

    <script src="src/js/popup.js"></script>

</div>