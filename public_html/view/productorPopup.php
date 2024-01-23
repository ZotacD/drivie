<div id="popup">
    <base href="<?php echo PROJECT_PATH ?>">
    <form method="post" id="popupCard">
        <button type="submit" id="popupClose" name="popup" value="<?php echo NO_DATA_POPUP ?>">X</button>
        <div id="popupBody">
            <div class="popupColumn">

                <div class="popupRow" style="align-items: center;">
                    <img src="<?php echo $user["url_image_util"] ?>"
                        style="max-height: 100px; width:auto; border-radius: 10px; overflow: hidden;" alt="photo_profil"
                        class="popupImg">
                    <div class="popupColumn" style="justify-content: center;">
                        <label class="popupTitle">
                            <?php echo $user["prenom_util"] ?>
                            <?php echo $user["nom_util"] ?>
                        </label>
                        <label class="popupContent">
                            <?php echo $user["pseudo_util"] ?>
                        </label>
                    </div>
                </div>
                <div class="popupRow">
                    <div class="popupColumn popupBlock">
                        <label class="popupContent">Adresse :
                            <?php echo $user["adresse_util"] ?>
                        </label>
                        <label class="popupContent">Ville :
                            <?php echo $user["ville_util"] ?>
                        </label>
                        <label class="popupContent">Code Postal :
                            <?php echo $user["cp_util"] ?>
                        </label>
                    </div>
                </div>
                <div class="popupRow">
                    <div class="popupBlock">
                        <label class="popupContent">Ventes :
                            <?php echo getNbSales($user["id_util"]) ?>
                        </label>
                    </div>
                </div>
            </div>



        </div>
    </form>
    <script src="src/js/popup.js"></script>
</div>