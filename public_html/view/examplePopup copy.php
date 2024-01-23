<div id="popup">
    <form method="post" id="popupCard">
        <button type="submit" id="popupClose" name="popup" value="<?php echo NO_DATA_POPUP ?>">X</button>
        <div id="popupBody">
            <div class="popupColumn">
                <div class="popupRow">
                    <!-- <div class="popupColumn">
                            <div class="popupFile">
                                <img src="./empty-image.svg" class="popupImg" id="imagePreview" accept="image/*"/>
                                <input type="file" id="imageInput"/>
                            </div>
                        </div> -->
                    <div class="popupColumn">
                        <input placeholder="Example" class="popupInput" />
                        <input placeholder="Example" class="popupInput" />
                        <input placeholder="Example" class="popupInput" />
                    </div>
                    <div class="popupColumn">
                        <input placeholder="Example" class="popupInput" />
                        <input placeholder="Example" class="popupInput" />
                        <input placeholder="Example" class="popupInput" />
                    </div>
                </div>
                <div class="popupRow">
                    <div class="popupColumn">
                        <input placeholder="Example" class="popupInput" />
                        <textarea placeholder="Example" class="popupTextarea"></textarea>
                        <button type="submit" name="popup" class="popupButton"
                            value="<?php echo NO_DATA_POPUP ?>">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="src/js/popup.js"></script>
</div>