<div id="popup">
    <div id="popupCard">
        <form method="post">
            <button type="submit" id="popupClose" name="popup" value="<?php echo NO_DATA_POPUP ?>">X</button>
        </form>
        <div id="popupBody">
            <div class="popupColumn">
                <label class="popupTitle" style="text-align:center">Commande -
                    <?php echo $id_commande; ?>
                </label>
                <div class="popupRow">
                    <div class="popupDisplayComm">
                        <div class="list" style="display:flex; flex-direction:column; gap:8px">
                            <?php foreach ($articles as $article) { ?>
                                <div class="popupRow" style="display:flex; align-items:center; gap:50px;">
                                    <div class="productInfo">
                                        <label style="width: 40px;" class="popupContent">
                                            <?php echo $article["qt_prod"]; ?>
                                            <?php echo $article["nom_unite"]; ?>
                                        </label>
                                        <label class="popupContent">
                                            <?php echo $article["nom_prod"]; ?>
                                        </label>
                                    </div>
                                    <div class="buttonsPrice">
                                        <form method="post">
                                            <input type="hidden" name="id_prod" value="<?php echo $article["id_prod"]; ?>">
                                            <input type="hidden" name="popupEndpoint" value="get">
                                            <button type="submit" name="popup" value="product">
                                                <img id="addReview" src="src/svg/view_prod.svg" alt="addReview">
                                            </button>
                                        </form>
                                        <form method="post">
                                            <input type="hidden" name="id_prod" value="<?php echo $article["id_prod"]; ?>">
                                            <input type="hidden" name="popupEndpoint" value="create">
                                            <button type="submit" name="popup" value="review">
                                                <img id="addReview" src="src/svg/star/star.svg" alt="addReview">
                                            </button>
                                        </form>
                                        <label class="popupContent" style="width: 50px; text-align: right;">
                                            <?php echo $article["qt_prod"] * $article["pu_prod"]; ?>€
                                        </label>
                                    </div>

                                    <?php $totalPrice += $article["qt_prod"] * $article["pu_prod"]; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="separation"></div>
                        <div class="popupRow">
                            <label class="totalTitle">Total</label>
                            <label class="totalPrice">
                                <?php echo $totalPrice ?>€
                            </label>
                        </div>
                    </div>
                </div>
                <div class="popupColumn">
                    <button class="popupButton" style="align-self: center;">Télécharger en PDF</button>
                </div>
            </div>
        </div>
    </div>
    <script src="src/js/popup.js"></script>
</div>