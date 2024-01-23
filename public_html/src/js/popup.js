async function handleFileInput() {
    const input = document.getElementById('imageInput');
    const previewImage = document.getElementById('imagePreview');

    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
}

const imageInput = document.getElementById('imageInput');
imageInput.addEventListener('change', handleFileInput);

function resizeColumns(row) {
    // Obtenez toutes les colonnes de la rangée
    var columns = row.querySelectorAll('.popupColumn');

    // Initialisez minHeight avec la hauteur de la première colonne
    var minHeight = Infinity;

    // Trouvez la hauteur minimale parmi toutes les colonnes
    for (var i = 0; i < columns.length; i++) {
        console.log(columns[i].querySelectorAll('input, textarea, button'))
        if (columns[i].querySelectorAll('input, textarea, button').length == 0) continue;

        var columnHeight = columns[i].offsetHeight;
        if (columnHeight < minHeight) {
            minHeight = columnHeight;
        }
    }

    // Définissez la hauteur de toutes les colonnes sur la hauteur minimale
    for (var i = 0; i < columns.length; i++) {
        columns[i].style['max-height'] = minHeight + 'px';
    }

    // Parcourez récursivement tous les enfants de chaque colonne
    for (var i = 0; i < columns.length; i++) {
        var childRows = columns[i].querySelectorAll('.popupRow');
        for (var j = 0; j < childRows.length; j++) {
            resizeColumns(childRows[j]);
        }
    }
}

// Exécutez la fonction de redimensionnement lorsque la page est chargée
window.onload = function () {
    var row = document.querySelector('.popupRow');
    resizeColumns(row);
};

// Exécutez la fonction de redimensionnement chaque fois que la fenêtre est redimensionnée
window.onresize = function () {
    var row = document.querySelector('.popupRow');
    resizeColumns(row);
};