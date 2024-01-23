<div id="popup">
    <base href="<?php echo PROJECT_PATH ?>">
    <div id="popupCard">
        <form method="post">
            <button type="submit" id="popupClose" name="popup" value="<?php echo NO_DATA_POPUP ?>">X</button>
        </form>
        <div id="popupBody">
            <div class="popupColumn" style="align-items: center;">
                <div class="popupRow" style="align-items: center;">
                    <img src="<?php echo $product["url_image_prod"] ?>"
                        style="max-height: 100px; width:auto; border-radius: 10px; overflow: hidden;" alt="photo_profil"
                        class="popupImg">
                    <div class="popupColumn" style="justify-content: center; max-width: 150px;">
                        <label class="popupTitle">
                            <?php echo $product["nom_prod"] ?>
                        </label>
                        <label class="popupContent">
                            <?php echo $product["pseudo_util"] ?>
                        </label>
                        <label class="popupContent" style="font-weight: 700;">
                            <?php echo $product["pu_prod"] ?>€/
                            <?php echo $product["nom_unite"] ?>
                        </label>
                    </div>
                    <?php if ($product["est_bio"]) { ?>
                        <img src="src/img/bio_badge.png" style="max-height: 50px; width:auto; overflow: hidden;" alt="Bio">
                    <?php } ?>
                </div>
                <?php if ($product["description_prod"]) { ?>
                    <label class="popupBlock">
                        <?php echo $product["description_prod"] ?>
                    </label>
                <?php } ?>

                <!-- template d'un avis -->
                <?php if ($reviews) { ?>
                    <div class="popupDisplayReview">
                        <?php foreach ($reviews as $review) { ?>
                            <div class="popupColumn" style="align-self:baseline; width:100%; ">
                                <div class="popupRow" style="align-items: center; overflow: hidden;">
                                    <img id="pp" src="<?php echo $review["url_image_util"] ?>" alt="PP">
                                    <div class="popupColumn" style="justify-content: baseline; gap: 2px; overflow: hidden;">
                                        <div class="popupRow">
                                            <label class="popupContent" style="color:#909090;">
                                                <?php echo $review["date_avis"] ?>
                                            </label>
                                            <div>
                                                <img id="stars" src="src/svg/star/pleine.svg" alt="étoile">
                                                <label class="popupContent">
                                                    <?php echo $review["note_avis"] ?>
                                                </label>
                                            </div>
                                        </div>

                                        <label class="popupContent" style="overflow: hidden;">
                                            <?php echo $review["prenom_util"] ?>
                                            <?php echo $review["nom_util"] ?>
                                        </label>
                                    </div>
                                </div>
                                <label class="popupTitle" style="padding-left: 30px;">
                                    <?php echo $review["titre_avis"] ?>
                                </label>
                                <label class="popupContent" style="padding-left: 30px;">
                                    <?php echo $review["description_avis"] ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <!-- bouton ajouter au panier -->
                <form method="post" class="popupColumn">
                    <div class="popupRow" style="align-items: center;">
                        <label class="popupContent" style="min-width: fit-content;">Quantité :</label>
                        <input type="number" name="qt_prod" class="popupInput" style="max-width: 100px" min="1"
                            max="<?php echo $product["qt_stock"] ?>" required>
                        <label class="popupContent">/</label>
                        <input type="number" name="qt_stock" class="popupInput" style="max-width: 100px;"
                            value="<?php echo $product["qt_stock"] ?>" readonly>
                        <label class="popupContent">
                            <?php echo $product["nom_unite"] ?>
                        </label>
                    </div>

                    <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                    <input type="hidden" name="popupEndpoint" value="get" />
                    <input type="hidden" name="infoMessage" value="Ce produit a bien été ajouté au panier." />
                    <button type="submit" name="popup" class="popupButton" value="product"
                        style="align-self: center;">Ajouter au panier</button>
                </form>

            </div>
        </div>
    </div>

    <script src="src/js/popup.js"></script>
</div>