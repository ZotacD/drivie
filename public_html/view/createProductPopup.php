<div id="popup">
    <base href="<?php echo PROJECT_PATH ?>">
    <div id="popupCard">
        <form method="post">
            <button type="submit" id="popupClose" name="popup" value="<?php echo NO_DATA_POPUP ?>">X</button>
        </form>
        <form id="popupBody" method="post" enctype="multipart/form-data">
            <div class="popupColumn">
                <label class="popupTitle">Ajouter un nouveau produit</label>
                <div class="popupRow">
                    <div class="popupColumn">
                        <div class="popupFile">
                            <img src="<?php echo DEFAULT_PRODUCT_IMAGE_PATH ?>" class="popupImg" id="imagePreview"
                                accept="image/*" />
                            <input type="file" name="image_prod" id="imageInput" />
                        </div>
                    </div>
                    <div class="popupColumn">
                        <input type="text" name="nom_prod" placeholder="Ajouter un nom" class="popupInput" required />
                        <input type="number" name="pu_prod" placeholder="Prix unitaire" class="popupInput" min="0"
                            step="0.01" required />

                        <select class="popupSelect" id="unitSelect" name="id_unite">
                            <?php foreach ($unites as $unite) { ?>
                                <option value="<?php echo $unite["id_unite"] ?>">
                                    <?php echo $unite["nom_unite"] ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="popupRow">
                    <div class="popupColumn">
                        <div class="popupBlock">
                            <div class="popupRow">
                                <label style="align-self: center;">Bio</label>


                                <select style="width: min-content;" class="popupSelect" id="unitSelect" name="est_bio">

                                    <option value="1">
                                        oui
                                    </option>
                                    <option value="0" selected="selected">
                                        non
                                    </option>

                                </select>


                            </div>
                        </div>

                        <select class="popupSelect" id="unitSelect" name="id_categorie" required>
                            <?php foreach ($categories as $categorie) { ?>
                                <option value="<?php echo $categorie["id_categorie"] ?>">
                                    <?php echo $categorie["nom_categorie"] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <textarea name="description_prod" placeholder="Ajouter une descripton"
                            class="popupTextarea"></textarea>

                        <input type="hidden" name="popupEndpoint" value="create" />
                        <button class="popupButton" name="popup" value="product"
                            style="align-self: center;">Confirmer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="src/js/popup.js"></script>
</div>