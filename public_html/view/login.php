<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Connexion</title>
  <base href="<?php echo PROJECT_PATH ?>">
  <meta charset="utf-8">
  <link rel="stylesheet" href="src/css/login.css" />
</head>

<body>

  <div class="main">
    <form class="card" method="post">
      <label id="cardTitle">Connexion</label>

      <div id="cardBody">
        <div class="inputSection">
          <div class="inputGroup">
            <!-- <label>Identifiant</label> -->
            <input aria-required="true" type="text" placeholder="Pseudo | Email" name="pseudo_mail_util" required>
          </div>
        </div>

        <div class="inputSection">
          <div class="inputGroup">
            <!-- <label>Mot de passe</label> -->
            <input aria-required="true" type="password" placeholder="Mot de passe" name="mdp_util" required>
          </div>
        </div>
      </div>

      <button id="submitButton" type="submit">Se connecter</button>

      <div id="sepBar"></div>
      <div id="infos">
        <label>Vous n’avez pas de compte ?</label>
        <label>Créer un compte <a href="auth/register?type=1">client</a>, <a
            href="auth/register?type=2">producteur</a></label>
      </div>
    </form>
  </div>
</body>

</html>