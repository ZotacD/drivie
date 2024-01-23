<?php

// Récupérer l'URL depuis le paramètre "url"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

switch ($requestUrl) {
  case '/':
    require_once "model/user.php";
    require_once "model/product.php";

    $products = get10NewProducts();
    $productors = getProductors();
    $productorsMapScript = getProductorsMapScript();

    setupHomeInputs();

    $popup = isset($_POST['popup']) ? $_POST['popup'] : NO_DATA_POPUP;

    switch ($popup) {
      case 'product':
        require_once("controller/popup/product.php");
        break;
      case 'productor':
        require_once("controller/popup/productor.php");
        break;
      default:
        break;
    }

    require_once "view/home.php";
    break;
  default:
    header("Location: " . PROJECT_PATH);
    exit();
}

function setupHomeInputs()
{
}

function getProductorsMapScript()
{
  $address = '[';
  $productors = getProductors();

  foreach ($productors as $productor) {
    $address = $address . '"' . $productor["adresse_util"] . " " . $productor["cp_util"] . " " . $productor["ville_util"] . '"' . ',';
  }
  $address = $address . ']';

  $script = '
    let map;

    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 46.603354, lng: 1.888334 }, // Coordonnées pour la France
        zoom: 5, // Zoom approprié pour voir toute la France
      });

      const geocoder = new google.maps.Geocoder();
      const addresses = ' . $address . ';

      for (let i = 0; i < addresses.length; i++) {
        geocodeAddress(geocoder, map, addresses[i]);
      }
    }

    function geocodeAddress(geocoder, resultsMap, address) {
      geocoder.geocode({ address: address }, (results, status) => {
        if (status === "OK") {
          new google.maps.Marker({
            map: resultsMap,
            position: results[0].geometry.location,
          });
        }
      });
    }';
  return $script;
}
