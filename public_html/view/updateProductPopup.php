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
                            <img src="<?php echo $product["url_image_prod"] ?>" class="popupImg" id="imagePreview"
                                accept="image/*" />
                            <input type="file" name="image_prod" id="imageInput" />
                        </div>
                    </div>
                    <div class="popupColumn">
                        <input type="text" name="nom_prod" placeholder="Ajouter un nom"
                            value="<?php echo $product["nom_prod"] ?>" class="popupInput" required />
                        <input type="number" name="pu_prod" placeholder="Prix unitaire"
                            value="<?php echo $product["pu_prod"] ?>" class="popupInput" min="0" step="0.01" required />

                        <select class="popupSelect" id="unitSelect" name="id_unite">
                            <?php foreach ($unites as $unite) { ?>
                                <option value="<?php echo $unite["id_unite"] ?>" <?php echo $product["id_unite"] == $unite["id_unite"] ? 'selected="selected"' : "" ?>>
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

                                    <option value="1" <?php echo $product["est_bio"] == 1 ? 'selected="selected"' : "" ?>>
                                        oui
                                    </option>
                                    <option value="0" <?php echo $product["est_bio"] == 0 ? 'selected="selected"' : "" ?>>
                                        non
                                    </option>

                                </select>


                            </div>
                        </div>

                        <select class="popupSelect" id="unitSelect" name="id_categorie">
                            <?php foreach ($categories as $categorie) { ?>
                                <option value="<?php echo $categorie["id_categorie"] ?>" <?php echo $product["id_categorie"] == $categorie["id_categorie"] ? 'selected="selected"' : "" ?>>
                                    <?php echo $categorie["nom_categorie"] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <textarea name="description_prod" placeholder="Ajouter une descripton"
                            class="popupTextarea"><?php echo $product["description_prod"] ?></textarea>

                        <input type="hidden" name="popupEndpoint" value="update" />
                        <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                        <button class="popupButton" name="popup" value="product" style="align-self: center;">Mettre à
                            jour</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="src/js/popup.js"></script>
</div>