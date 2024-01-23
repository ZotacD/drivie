<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Inscription</title>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="utf-8">
    <link rel="stylesheet" href="src/css/register.css" />
</head>

<body>

    <div class="main">
        <form class="card" method="post">
            <label id="cardTitle">Création compte
                <?php echo ($type == ID_TYPE_PRODUCTEUR) ? "PRODUCTEUR" : "CLIENT" ?>
            </label>

            <div id="cardBody">
                <div class="inputSection">
                    <div class="inputGroup">
                        <!-- <label>Prénom</label> -->
                        <input aria-required="true" type="text" placeholder="Prénom" name="prenom_util" required>
                    </div>
                    <div class="inputGroup">
                        <!-- <label>Nom</label> -->
                        <input aria-required="true" type="text" placeholder="Nom" name="nom_util" required>
                    </div>
                </div>

                <div class="inputSection">
                    <div class="inputGroup">
                        <!-- <label>Email</label> -->
                        <input aria-required="true" type="email" placeholder="Email" name="mail_util" required>
                    </div>
                </div>

                <div class="inputSection">
                    <div class="inputGroup">
                        <!-- <label>Pseudonyme</label> -->
                        <input aria-required="true" type="text" placeholder="Pseudonyme" name="pseudo_util" required>
                    </div>
                    <div class="inputGroup">
                        <!-- <label>Numéro de Téléphone</label> -->
                        <input aria-required="true" type="tel" placeholder="Numéro de Téléphone" name="tel_util"
                            pattern="[0-9]{10}" required>
                    </div>
                </div>

                <div class="inputSection">
                    <div class="inputGroup">
                        <!-- <label>Adresse</label> -->
                        <input aria-required="true" type="text" placeholder="Adresse" name="adresse_util" required>
                    </div>
                </div>

                <div class="inputSection">
                    <div class="inputGroup">
                        <!-- <label>Ville</label> -->
                        <input aria-required="true" type="text" placeholder="Ville" name="ville_util" required>
                    </div>
                    <div class="inputGroup">
                        <!-- <label>Code postal</label> -->
                        <input aria-required="true" type="text" placeholder="Code postal" name="cp_util"
                            pattern="[0-9]{5}" required>
                    </div>
                </div>

                <?php if ($type == ID_TYPE_PRODUCTEUR) { ?>
                    <div class="inputSection">
                        <div class="inputGroup">
                            <!-- <label>Numéro SIRET</label> -->
                            <input aria-required="true" type="text" placeholder="Numéro SIRET" name="num_siret"
                                pattern="[0-9]{14}" required>
                        </div>
                    </div>
                <?php } ?>

                <div class="inputSection">
                    <div class="inputGroup">
                        <!-- <label>Mot de passe</label> -->
                        <input aria-required="true" type="password" placeholder="Mot de passe" name="mdp_util" required>
                    </div>
                </div>

                <div class="inputSection">
                    <div class="inputGroup">
                        <!-- <label>Confirmer le mot de passe</label> -->
                        <input aria-required="true" type="password" placeholder="Confirmer le mot de passe"
                            name="c_mdp_util" required>
                    </div>
                </div>
            </div>

            <button id="submitButton" type="submit">S'inscrire</button>

            <div id="sepBar"></div>
            <div id="infos">
                <label>Vous avez déjà un compte ?</label>
                <label>Se connecter <a href="auth/login">ICI</a></label>
            </div>
        </form>
    </div>
</body>

</html>