-- CREATION DONNEES

USE but2drivie_main;

DROP TABLE IF EXISTS MEMBRE;
DROP TABLE IF EXISTS DESTINATAIRE;
DROP TABLE IF EXISTS ARTICLE;
DROP TABLE IF EXISTS AVIS;
DROP TABLE IF EXISTS STOCK;
DROP TABLE IF EXISTS COMMANDE;
DROP TABLE IF EXISTS PANIER;
DROP TABLE IF EXISTS MESSAGE;
DROP TABLE IF EXISTS PRODUIT;
DROP TABLE IF EXISTS NOTIFICATION;
DROP TABLE IF EXISTS UTILISATEUR;
DROP TABLE IF EXISTS TYPE;
DROP TABLE IF EXISTS UNITE;
DROP TABLE IF EXISTS CATEGORIE;
DROP TABLE IF EXISTS GROUPE;


CREATE TABLE GROUPE(
   id_groupe SMALLINT AUTO_INCREMENT,
   nom_groupe VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_groupe)
);

CREATE TABLE CATEGORIE(
   id_categorie SMALLINT AUTO_INCREMENT,
   nom_categorie VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_categorie)
);

CREATE TABLE UNITE(
   id_unite SMALLINT AUTO_INCREMENT,
   nom_unite VARCHAR(50),
   PRIMARY KEY(id_unite)
);

CREATE TABLE TYPE(
   id_type SMALLINT AUTO_INCREMENT,
   nom_type VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_type)
);

CREATE TABLE UTILISATEUR(
   id_util SMALLINT AUTO_INCREMENT,
   prenom_util VARCHAR(50) NOT NULL,
   nom_util VARCHAR(50) NOT NULL,
   adresse_util VARCHAR(100) NOT NULL,
   ville_util VARCHAR(50) NOT NULL,
   cp_util VARCHAR(5) NOT NULL,
   mail_util VARCHAR(50) NOT NULL,
   tel_util VARCHAR(10) NOT NULL,
   num_siret VARCHAR(14),
   pseudo_util VARCHAR(50) NOT NULL,
   description_util VARCHAR(300),
   mdp_util VARCHAR(150) NOT NULL,
   id_type SMALLINT NOT NULL,
   url_image_util VARCHAR(300),
   PRIMARY KEY(id_util),
   UNIQUE(mail_util),
   UNIQUE(pseudo_util),
   CONSTRAINT cle_etrangere_util_id_type FOREIGN KEY(id_type) REFERENCES TYPE(id_type)
);

CREATE TABLE NOTIFICATION(
   id_notif SMALLINT AUTO_INCREMENT,
   titre_notif VARCHAR(50),
   description_notif VARCHAR(150) NOT NULL,
   date_notif DATETIME NOT NULL,
   id_groupe SMALLINT NOT NULL,
   PRIMARY KEY(id_notif),
   CONSTRAINT cle_etrangere_notif_id_groupe FOREIGN KEY(id_groupe) REFERENCES GROUPE(id_groupe)
);

CREATE TABLE MESSAGE(
   id_mess SMALLINT AUTO_INCREMENT,
   objet_mess VARCHAR(50),
   contenu_mess VARCHAR(500),
   date_mess DATETIME NOT NULL,
   exp_groupe_mess SMALLINT NOT NULL,
   PRIMARY KEY(id_mess),
   CONSTRAINT cle_etrangere_mess_id_groupe FOREIGN KEY(exp_groupe_mess) REFERENCES GROUPE(id_groupe)
);

CREATE TABLE PANIER(
   id_panier SMALLINT AUTO_INCREMENT,
   nom_panier VARCHAR(50) NOT NULL,
   date_panier DATETIME NOT NULL,
   id_util SMALLINT NOT NULL,
   PRIMARY KEY(id_panier),
   CONSTRAINT cle_etrangere_panier_id_util FOREIGN KEY(id_util) REFERENCES UTILISATEUR(id_util)
);

CREATE TABLE COMMANDE(
   id_commande SMALLINT AUTO_INCREMENT,
   date_commande DATETIME NOT NULL,
   statut_commande VARCHAR(50) NOT NULL,
   id_panier SMALLINT NOT NULL,
   id_util SMALLINT NOT NULL,
   PRIMARY KEY(id_commande),
   CONSTRAINT cle_etrangere_commande_id_panier FOREIGN KEY(id_panier) REFERENCES PANIER(id_panier),
   CONSTRAINT cle_etrangere_commande_id_util FOREIGN KEY(id_util) REFERENCES UTILISATEUR(id_util)
);

CREATE TABLE PRODUIT(
   id_prod SMALLINT AUTO_INCREMENT,
   nom_prod VARCHAR(50) NOT NULL,
   description_prod VARCHAR(500),
   url_image_prod VARCHAR(300) NOT NULL,
   date_prod DATETIME NOT NULL,
   est_bio BIT NOT NULL,
   id_categorie SMALLINT NOT NULL,
   id_util SMALLINT NOT NULL,
   pu_prod DECIMAL(5,2) NOT NULL CHECK(pu_prod >= 0),
   id_unite SMALLINT NOT NULL,
   PRIMARY KEY(id_prod),
   CONSTRAINT cle_etrangere_prod_id_categorie FOREIGN KEY(id_categorie) REFERENCES CATEGORIE(id_categorie),
   CONSTRAINT cle_etrangere_prod_id_util FOREIGN KEY(id_util) REFERENCES UTILISATEUR(id_util),
   CONSTRAINT cle_etrangere_prod_id_unite FOREIGN KEY(id_unite) REFERENCES UNITE(id_unite)
);

CREATE TABLE STOCK(
   id_stock SMALLINT AUTO_INCREMENT,
   qt_stock SMALLINT NOT NULL CHECK(qt_stock >= 0),
   nom_stock VARCHAR(255) NOT NULL,
   date_stock DATETIME NOT NULL,
   date_exp_stock DATETIME,
   id_prod SMALLINT NOT NULL,
   PRIMARY KEY(id_stock),
   CONSTRAINT cle_etrangere_stock_id_prod FOREIGN KEY(id_prod) REFERENCES PRODUIT(id_prod)
);

CREATE TABLE AVIS(
   id_avis SMALLINT AUTO_INCREMENT,
   titre_avis VARCHAR(50),
   description_avis VARCHAR(300),
   note_avis DECIMAL(2,1) NOT NULL CHECK(note_avis >= 0 AND note_avis <= 5),
   date_avis DATETIME NOT NULL,
   id_util SMALLINT,
   id_prod SMALLINT NOT NULL,
   PRIMARY KEY(id_avis, id_prod),
   CONSTRAINT cle_etrangere_avis_id_util FOREIGN KEY(id_util) REFERENCES UTILISATEUR(id_util),
   CONSTRAINT cle_etrangere_avis_id_prod FOREIGN KEY(id_prod) REFERENCES PRODUIT(id_prod)
);

CREATE TABLE ARTICLE(
   id_prod SMALLINT,
   id_panier SMALLINT,
   qt_prod SMALLINT NOT NULL CHECK(qt_prod > 0),
   pu_prod DECIMAL(5,2) NOT NULL CHECK(pu_prod >= 0),
   PRIMARY KEY(id_prod, id_panier),
   CONSTRAINT cle_etrangere_article_id_prod FOREIGN KEY(id_prod) REFERENCES PRODUIT(id_prod),
   CONSTRAINT cle_etrangere_article_id_panier FOREIGN KEY(id_panier) REFERENCES PANIER(id_panier)
);

CREATE TABLE DESTINATAIRE(
   id_mess SMALLINT,
   dest_groupe_mess SMALLINT,
   ordre_groupe_dest TINYINT NOT NULL,
   PRIMARY KEY(id_mess, dest_groupe_mess),
   CONSTRAINT cle_etrangere_dest_id_mess FOREIGN KEY(id_mess) REFERENCES MESSAGE(id_mess),
   CONSTRAINT cle_etrangere_dest_id_groupe FOREIGN KEY(dest_groupe_mess) REFERENCES GROUPE(id_groupe)
);

CREATE TABLE MEMBRE(
   id_util SMALLINT,
   id_groupe SMALLINT,
   num_membre SMALLINT NOT NULL,
   PRIMARY KEY(id_util, id_groupe),
   CONSTRAINT cle_etrangere_membre_id_util FOREIGN KEY(id_util) REFERENCES UTILISATEUR(id_util),
   CONSTRAINT cle_etrangere_membre_id_groupe FOREIGN KEY(id_groupe) REFERENCES GROUPE(id_groupe)
);














































-- PROCEDURES

USE but2drivie_main;

DROP PROCEDURE IF EXISTS SuppArtiPanier;
DROP PROCEDURE IF EXISTS SuppClient;
DROP PROCEDURE IF EXISTS SuppProd;
DROP PROCEDURE IF EXISTS SuppProduit;
DROP PROCEDURE IF EXISTS creerUtil;

DELIMITER $$

CREATE PROCEDURE creerUtil (
    IN prenom_util VARCHAR(50),
    IN nom_util VARCHAR(50),
    IN adresse_util VARCHAR(100),
    IN ville_util VARCHAR(50),
    IN cp_util VARCHAR(5),
    IN mail_util VARCHAR(50),
    IN tel_util VARCHAR(10),
    IN num_siret VARCHAR(14),
    IN pseudo_util VARCHAR(50),
    IN description_util VARCHAR(300),
    IN mdp_util VARCHAR(50),
    IN id_type SMALLINT
)
BEGIN
  DECLARE id_inserted_util SMALLINT;
  
  -- Créer les groupes et numéros membre correspondants
  DECLARE id_inserted_groupe_seul SMALLINT;
  DECLARE id_groupe_role SMALLINT;
  DECLARE id_groupe_general SMALLINT;
  
  DECLARE num_membre_groupe_seul SMALLINT;
  DECLARE num_membre_groupe_role SMALLINT;
  DECLARE num_membre_groupe_general SMALLINT;

  -- Insérer l'utilisateur dans la table UTILISATEUR
  INSERT INTO UTILISATEUR (
    prenom_util,
    nom_util,
    pseudo_util,
    adresse_util,
    ville_util,
    cp_util,
    mail_util,
    tel_util,
    mdp_util,
    num_siret,
    description_util,
    id_type,
    url_image_util
  )
  VALUES (
    prenom_util,
    nom_util,
    pseudo_util,
    adresse_util,
    ville_util,
    cp_util,
    mail_util,
    tel_util,
    mdp_util,
    num_siret,
    description_util,
    id_type,
    "public/img/base_user_image.png"
  );

  SET id_inserted_util = LAST_INSERT_ID();

  SET id_groupe_role = id_type;
  SET id_groupe_general = 4;
  
  SET num_membre_groupe_seul = 1;
  SET num_membre_groupe_role = IFNULL((SELECT MAX(MEMBRE.num_membre) FROM MEMBRE WHERE id_groupe = id_groupe_role), 0) + 1;
  SET num_membre_groupe_general = IFNULL((SELECT MAX(MEMBRE.num_membre) FROM MEMBRE WHERE id_groupe = id_groupe_general), 0) + 1;

  -- Insérer l'utilisateur dans le groupe individuel
  -- Crétation groupe
  INSERT INTO GROUPE(nom_groupe) VALUES (CONCAT(prenom_util, ' ', nom_util));
  SET id_inserted_groupe_seul = LAST_INSERT_ID();

  -- Insertion de l'utilisateur dans tous ses groupes
  -- Insérer l'utilisateur dans son groupe
  INSERT INTO MEMBRE VALUES (id_inserted_util, id_inserted_groupe_seul, num_membre_groupe_seul);
  -- Insérer l'utilisateur dans le groupe de son rôle
  INSERT INTO MEMBRE VALUES (id_inserted_util, id_groupe_role, num_membre_groupe_role);
  -- Insérer l'utilisateur dans le groupe général
  INSERT INTO MEMBRE VALUES (id_inserted_util, id_groupe_general, num_membre_groupe_general);
  
  -- CREATION PANIER
  INSERT INTO PANIER(nom_panier, date_panier, id_util) VALUES ("", NOW(), id_inserted_util);
END $$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE SuppArtiPanier (
    IN p_id_panier SMALLINT,
    IN p_id_prod SMALLINT
)
BEGIN
	DELETE FROM ARTICLE WHERE ARTICLE.id_panier = p_id_panier AND ARTICLE.id_prod = p_id_prod;
END $$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE SuppClient (
    IN p_id_util SMALLINT
)
BEGIN
    DECLARE v_id_groupe_seul SMALLINT;

    SET v_id_groupe_seul = (SELECT GROUPE.id_groupe FROM GROUPE 
                            INNER JOIN MEMBRE ON GROUPE.id_groupe = MEMBRE.id_groupe 
                            WHERE MEMBRE.id_util = p_id_util AND GROUPE.id_groupe NOT IN (1, 4));

    -- GESTION PANIERS/COMMANDES
    -- SUPPRESSION DE TOUS LES ARTICLES DE SON PANIER (NORMALEMENT 1 PANIER AFFECTÉ)
    DELETE FROM ARTICLE WHERE ARTICLE.id_panier IN (SELECT id_panier FROM PANIER WHERE PANIER.id_util=p_id_util AND PANIER.id_panier NOT IN (SELECT COMMANDE.id_panier FROM COMMANDE));
    -- SUPPRESSION DE TOUS LES PANIERS NON COMMANDES (NORMALEMENT 1 SEUL SUPPRESSION)
    DELETE FROM PANIER WHERE PANIER.id_util=p_id_util AND PANIER.id_panier NOT IN (SELECT COMMANDE.id_panier FROM COMMANDE);
    -- MODIFICATION DE TOUS LES PANIERS COMMANDES AVEC UTILISATEUR SUPPRIME (ID=1)
    UPDATE PANIER SET PANIER.id_util=1 WHERE PANIER.id_util=p_id_util;

    -- GESTION AVIS
    -- MODIFICATION DE TOUS LES AVIS AVEC UTILISATEUR SUPPRIME (ID=1)
    UPDATE AVIS SET AVIS.id_util=1 WHERE AVIS.id_util=p_id_util;

    -- GESTION MESSAGES
    -- SUPPRESSION DE TOUS LES LIENS DESTINATAIRES
    DELETE FROM DESTINATAIRE WHERE DESTINATAIRE.dest_groupe_mess=v_id_groupe_seul;
    -- MODIFICATION DE TOUS LES MESSAGES ENVOYES AVEC GROUPE SUPPRIME (ID=5)
    UPDATE MESSAGE SET MESSAGE.exp_groupe_mess=5 WHERE MESSAGE.exp_groupe_mess=v_id_groupe_seul;
    -- MODIFICATION DE TOUTES LES NOTIFICATIONS ENVOYEES AVEC GROUPE SUPPRIME (ID=5)
    UPDATE NOTIFICATION SET NOTIFICATION.id_groupe=5 WHERE NOTIFICATION.id_groupe=v_id_groupe_seul;
    
    -- SUPPRESSION TOUS MEMBRE DE TOUS GROUPES AUXQUELS IL APPARTIENT
    DELETE FROM MEMBRE WHERE MEMBRE.id_util=p_id_util;
    -- SUPPRESSION DE SON GROUPE
    DELETE FROM GROUPE WHERE GROUPE.id_groupe = v_id_groupe_seul;

   -- SUPPRESSION DE L'UTILISATEUR
    DELETE FROM UTILISATEUR WHERE UTILISATEUR.id_util=p_id_util;
END $$

DELIMITER ;



DELIMITER $$

CREATE PROCEDURE SuppProd (
    IN p_id_util SMALLINT
)
BEGIN
    DECLARE v_id_groupe_seul SMALLINT;

    SET v_id_groupe_seul = (SELECT MEMBRE.id_groupe FROM GROUPE 
                            INNER JOIN MEMBRE ON GROUPE.id_groupe = MEMBRE.id_groupe 
                            WHERE MEMBRE.id_util = p_id_util AND GROUPE.id_groupe NOT IN (2, 4));

   -- GESTION PANIERS/COMMANDES
    -- SUPPRESSION DE TOUS LES ARTICLES DE SON PANIER (NORMALEMENT 1 PANIER AFFECTÉ)
    DELETE FROM ARTICLE WHERE ARTICLE.id_panier IN (SELECT id_panier FROM PANIER WHERE PANIER.id_util=p_id_util AND PANIER.id_panier NOT IN (SELECT COMMANDE.id_panier FROM COMMANDE));
    -- SUPPRESSION DE TOUS LES PANIERS NON COMMANDES (NORMALEMENT 1 SEUL SUPPRESSION)
    DELETE FROM PANIER WHERE PANIER.id_util=p_id_util AND PANIER.id_panier NOT IN (SELECT COMMANDE.id_panier FROM COMMANDE);
    -- MODIFICATION DE TOUS LES PANIERS COMMANDES AVEC UTILISATEUR SUPPRIME (ID=1)
    UPDATE PANIER SET PANIER.id_util=1 WHERE PANIER.id_util=p_id_util;

    -- GESTION AVIS
    -- MODIFICATION DE TOUS LES AVIS AVEC UTILISATEUR SUPPRIME (ID=1)
    UPDATE AVIS SET AVIS.id_util=1 WHERE AVIS.id_util=p_id_util;
                            
    -- GESTION MESSAGES
    -- SUPPRESSION DE TOUS LES LIENS DESTINATAIRES
    DELETE FROM DESTINATAIRE WHERE DESTINATAIRE.dest_groupe_mess=v_id_groupe_seul;
    -- MODIFICATION DE TOUS LES MESSAGES ENVOYES AVEC GROUPE SUPPRIME (ID=5)
    UPDATE MESSAGE SET MESSAGE.exp_groupe_mess=5 WHERE MESSAGE.exp_groupe_mess=v_id_groupe_seul;
    -- MODIFICATION DE TOUTES LES NOTIFICATIONS ENVOYEES AVEC GROUPE SUPPRIME (ID=5)
    UPDATE NOTIFICATION SET NOTIFICATION.id_groupe=5 WHERE NOTIFICATION.id_groupe=v_id_groupe_seul;

    -- MODIFICATION DE TOUTES LES COMMANDES ACCOMPLI ET EN COURS AVEC UTILISATEUR SUPPRIME (ID=1)
    UPDATE COMMANDE SET id_util=1 WHERE id_util=p_id_util;

    -- SUPRESSION DE TOUS LES ARTICLES NON COMMANDES
    DELETE FROM ARTICLE WHERE ARTICLE.id_prod IN (SELECT id_prod FROM PANIER WHERE PANIER.id_util=p_id_util AND PANIER.id_panier NOT IN (SELECT COMMANDE.id_panier FROM COMMANDE));
    -- SUPPRESSION DE TOUS LES STOCKS DE TOUS SES PRODUITS
    DELETE FROM STOCK WHERE id_prod IN (SELECT id_prod FROM PRODUIT WHERE id_util=p_id_util);
    
    -- MODIFICATION PROPRIETAIRE PRODUIT A UTILISATEUR SUPPRIME (ID=1)
    UPDATE PRODUIT SET id_util=1 WHERE id_util = p_id_util;

    -- SUPPRESSION TOUS MEMBRE DE TOUS GROUPES AUXQUELS IL APPARTIENT
    DELETE FROM MEMBRE WHERE MEMBRE.id_util=p_id_util;
    -- SUPPRESSION DE SON GROUPE
    DELETE FROM GROUPE WHERE GROUPE.id_groupe = v_id_groupe_seul;

    -- SUPPRESSION DE L'UTILISATEUR
    DELETE FROM UTILISATEUR WHERE UTILISATEUR.id_util=p_id_util;
END $$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE SuppProduit (
    IN p_id_prod SMALLINT
)
BEGIN
    -- SUPRESSION DE TOUS LES ARTICLES NON COMMANDES
    DELETE FROM ARTICLE WHERE ARTICLE.id_prod=p_id_prod AND ARTICLE.id_panier NOT IN (SELECT COMMANDE.id_panier FROM COMMANDE);
    -- SUPPRESSION DE TOUS LES STOCKS DE TOUS SES PRODUITS
    DELETE FROM STOCK WHERE id_prod=p_id_prod;

    UPDATE PRODUIT SET id_util=1 WHERE PRODUIT.id_prod=p_id_prod;
END $$

DELIMITER ;

USE but2drivie_main;
DROP PROCEDURE IF EXISTS validerPanier;

DELIMITER $$

CREATE PROCEDURE validerPanier(
    in p_id_panier SMALLINT
)
BEGIN
    DECLARE v_id_prod SMALLINT;
    DECLARE v_qt_prod SMALLINT;

    DECLARE v_id_producteur SMALLINT;
    DECLARE v_tmp_id_producteur SMALLINT;

    DECLARE v_id_util SMALLINT;

    DECLARE v_loop_finished INT DEFAULT 0;

    DECLARE cursor_validerPanier CURSOR FOR
        SELECT ARTICLE.id_prod, qt_prod, PRODUIT.id_util FROM ARTICLE
            INNER JOIN PANIER ON PANIER.id_panier = ARTICLE.id_panier
            INNER JOIN PRODUIT ON PRODUIT.id_prod = ARTICLE.id_prod
        WHERE PANIER.id_panier = p_id_panier ORDER BY PRODUIT.id_util ASC;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_loop_finished = 1;

    OPEN cursor_validerPanier;
    FETCH cursor_validerPanier INTO v_id_prod, v_qt_prod, v_id_producteur;

    INSERT INTO COMMANDE(date_commande, statut_commande, id_panier, id_util) VALUES (NOW(), 'En cours de preparation', p_id_panier, v_id_producteur);

    WHILE v_loop_finished=0 DO
        SET v_tmp_id_producteur = v_id_producteur;

        CALL autoDiminiuerStock(v_id_prod, v_qt_prod);

        FETCH cursor_validerPanier INTO v_id_prod, v_qt_prod, v_id_producteur;

        IF(v_id_producteur <> v_tmp_id_producteur)
        THEN
            INSERT INTO COMMANDE(date_commande, statut_commande, id_panier, id_util) VALUES (NOW(), 'En cours de preparation', p_id_panier, v_id_producteur);
        END IF;
    END WHILE;
    
    SET v_id_util = (SELECT id_util FROM PANIER WHERE PANIER.id_panier=p_id_panier);
    INSERT INTO PANIER(nom_panier, date_panier, id_util) VALUES ("", NOW(), v_id_util);

    CLOSE cursor_validerPanier; 
END $$
DELIMITER ;





DROP PROCEDURE IF EXISTS autoDiminiuerStock;

DELIMITER $$
CREATE PROCEDURE autoDiminiuerStock (
    IN p_id_prod SMALLINT,
    IN p_qt_prod SMALLINT
)
BEGIN
   DECLARE v_loop_finished INT DEFAULT 0;
   DECLARE v_id_stock SMALLINT;
   DECLARE v_qt_stock SMALLINT;

	DECLARE cursor_autoDiminiuerStock CURSOR FOR SELECT STOCK.id_stock, STOCK.qt_stock FROM STOCK WHERE STOCK.id_prod = p_id_prod ORDER BY STOCK.date_stock ASC;

   DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_loop_finished = 1;

   OPEN cursor_autoDiminiuerStock;
   FETCH cursor_autoDiminiuerStock INTO v_id_stock, v_qt_stock;

   WHILE v_loop_finished=0 DO
      IF(p_qt_prod > v_qt_stock) THEN
         UPDATE STOCK SET STOCK.qt_stock=0 WHERE STOCK.id_stock=v_id_stock;
         SET p_qt_prod = p_qt_prod - v_qt_stock;
      ELSE
         UPDATE STOCK SET STOCK.qt_stock=v_qt_stock - p_qt_prod WHERE STOCK.id_stock=v_id_stock;
         SET p_qt_prod = 0;
      END IF;

      IF(p_qt_prod = 0) THEN
         SET v_loop_finished = 1;
      END IF;

      FETCH cursor_autoDiminiuerStock INTO v_id_stock, v_qt_stock;
   END WHILE;
   CLOSE cursor_autoDiminiuerStock;
END $$

DELIMITER ;











DROP PROCEDURE IF EXISTS SupprimerMessage;

DELIMITER $$
CREATE PROCEDURE SupprimerMessage (
    IN p_id_mess SMALLINT
)
BEGIN
	DELETE FROM DESTINATAIRE WHERE id_mess=p_id_mess;
   DELETE FROM MESSAGE WHERE id_mess=p_id_mess;
END $$

DELIMITER ;

DROP PROCEDURE IF EXISTS modifierProduit;

DELIMITER $$

CREATE PROCEDURE modifierProduit (
   IN p_id_prod SMALLINT,
   IN p_nom_prod VARCHAR(50),
   IN p_description_prod VARCHAR(500),
   IN p_est_bio BIT,
   IN p_id_categorie SMALLINT,
   IN p_id_unite SMALLINT,
   IN p_pu_prod DECIMAL(5,2),
   IN p_url_image_prod VARCHAR(300)
)
BEGIN
    UPDATE PRODUIT SET 
    nom_prod=p_nom_prod,
    description_prod=p_description_prod,
    est_bio=p_est_bio,
    id_categorie=p_id_categorie,
    id_unite=p_id_unite,
    pu_prod=p_pu_prod,
    url_image_prod=p_url_image_prod
    WHERE id_prod=p_id_prod;

    UPDATE ARTICLE SET pu_prod=p_pu_prod WHERE id_panier NOT IN (SELECT id_panier FROM COMMANDE);
END $$

DELIMITER ;








































-- INSERTION DONNEES


-- GROUPE --
INSERT INTO GROUPE (id_groupe, nom_groupe)
VALUES
(1, 'Clients'),
(2, 'Producteurs'),
(3, 'Administrateurs'),
(4, 'Général'),
(5, 'Groupe Supprimé');
-- GROUPE --

-- CATEGORIE --
INSERT INTO CATEGORIE (nom_categorie)
VALUES
('Fruits'),
('Légumes'),
('Produits laitiers'),
('Viandes'),
('Poissons et fruits de mer'),
('Produits de boulangerie'),
('Confiseries'),
('Boissons'),
('Produits biologiques'),
('Autres');
-- CATEGORIE --

-- UNITE --
INSERT INTO UNITE (nom_unite)
VALUES
('KG'),
('G'),
('MG'),
('L'),
('CL'),
('ML'),
('Piece'),
('Demi-douzaine'),
('Autres'),
('Sachet');
-- UNITE --

-- TYPE --
INSERT INTO TYPE (id_type, nom_type)
VALUES
(1, 'Client'),
(2, 'Producteur'),
(3, 'Administrateur'),
(4, 'Inconnu');
-- TYPE --

-- UTILISATEUR --
INSERT INTO UTILISATEUR (id_util, prenom_util, nom_util, adresse_util, ville_util, cp_util, mail_util, tel_util, num_siret, pseudo_util, description_util, mdp_util, id_type, url_image_util)
VALUES
(1, 'Utilisateur Supprimé','Utilisateur Supprimé', 'Inconnu','Inconnu','00000','Inconnu','Inconnu', NULL, 'UtilisateurSupprimé', 'Cet utilisateur a été supprimé','LpEOPFIH1234Bxh7B=+-734 zndvh',4, "");

-- CALL creerUtil('Jean', 'Dupont', '123 Rue de la Rivière', 'Nantes', '44000', 'jean.dupont@email.com', '0123456789', '03671295000033', 'La ferme en folie', 'Nous sommes fou et il y a du bon paint che nous',"LALEU",2);
-- CALL creerUtil('Marie', 'Martin', '456 Avenue des Champs', 'Angers', '49000', 'marie.martin@email.com', '0699854525', NULL, 'mmartin', NULL,"123456789", 1);
-- CALL creerUtil('Pierre', 'Leclerc', '789 Rue des Bois', 'Le Mans', '72000', 'pierre.leclerc@email.com', '0658425749', '67367760000011', 'Ferme Soleil Doré', 'Cultivez la joie, récoltez la nature.',"LALEU",2);
-- CALL creerUtil('Sophie', 'Girard', '1010 Boulevard de la Mer', 'Nantes', '44000', 'sophie.girard@email.com', '0659863015', NULL, 'Sophie Girard', 'Je suis moi, tu es toi et nous sommes heureux.',"LALEU",1);
-- CALL creerUtil('Philippe', 'Thomas', '111 Rue de la Montagne', 'Nantes', '44000', 'philippe.thomas@email.com', '0758421569', '90118145000023', 'La ferme à fifi', NULL ,"LALEU",2);
-- CALL creerUtil('Catherine', 'Lefevre', '131 Avenue des Fleurs', 'Angers', '49000', 'catherine.lefebvre@email.com', '0752014589', NULL, 'La Fermeture', NULL,"LALEU",1);
-- CALL creerUtil('Luc', 'Dubois', '151 Rue du Soleil', 'Le Mans', '72000', 'luc.dubois@email.com', '0658963201', '32867576000024', 'La ferme dans le luc', 'Travail dans la joie et la rigolade',"LALEU",2);
-- CALL creerUtil('Isabelle', 'Moreau', '171 Boulevard de la Plage', 'Nantes', '44000', 'isabelle.moreau@email.com', '0630201578', NULL, 'Les petits plaisir d Isabelle',NULL,"LALEU",1);
-- CALL creerUtil('François', 'Laurent', '191 Rue de la Forêt', 'Le Mans', '72000', 'francois.laurent@email.com', '0615402015', '26419477000022', 'La ferme de la grande folie des fous', 'Nous sommes géniaux',"LALEU", 2);
-- CALL creerUtil('Christine', 'Roux', '212 Avenue des Étoiles', 'Angers', '49000', 'christine.roux@email.com', '0768020548', NULL,'Croux', NULL,"LALEU", 1);
-- CALL creerUtil('Jean', 'Raison', '123 Rue des Producteurs', 'Nantes', '44000', 'jean@gmal.com', '0240123456', NULL,'JeanvaisRaison', 'Administrateur et fier de l être',"LALEU", 3);
-- CALL creerUtil('Marie', 'Situsavais', '456 Avenue des Agriculteurs', 'Angers', '49000', 'marie@email.com', '0240987654', NULL, 'OhMarieSiTuSavais', 'Administrateur',"LALEU", 3);
-- CALL creerUtil('Pierre', 'Leroux', '789 Rue des Fermes Locales', 'Le Mans', '72000', 'pierre@outlook.com', '0240876543', NULL, 'PLeroux', 'Administrateur',"LALEU",3);
-- UTILISATEUR --

-- NOTIFICATION --
-- INSERT INTO NOTIFICATION (titre_notif, description_notif, date_notif, id_groupe)
-- VALUES
-- ('Nouvelle offre', 'Nouvelle offre spéciale sur les produits locaux.', '2023-10-23 10:00:00', 1),
-- ('Confirmation de commande', 'Votre commande a été confirmée.', '2023-10-23 11:30:00', 6),
-- ('Nouvelle notification', 'Veuillez consulter cette importante notification.', '2023-10-23 12:45:00', 5),
-- ('Offre exclusive', 'Offre exclusive pour nos clients fidèles.', '2023-10-23 14:20:00', 1),
-- ('Mise à jour du produit', 'Le produit Fraise a été supprimé', '2023-10-23 15:10:00', 7),
-- ('Promotion spéciale', 'Grande promotion pour nos produits de saison.', '2023-10-23 16:30:00', 1),
-- ('Notification importante', 'Informations importantes pour tous les utilisateurs.', '2023-10-23 17:15:00', 4),
-- ('Nouvelle offre', 'Nouvelle offre limitée dans le temps.', '2023-10-23 18:40:00', 1),
-- ('Message de service', 'Message de service pour tous les membres.', '2023-10-23 19:55:00', 2),
-- ('Nouvelle mise à jour', 'Mise à jour de l''application disponible au téléchargement.', '2023-10-23 20:25:00', 4);
-- NOTIFICATION --

-- PRODUIT --
-- INSERT INTO PRODUIT (id_prod, nom_prod, description_prod, url_image_prod, date_prod, est_bio, id_categorie, id_util)
-- VALUES
-- (1, 'Produit supprimé', '-', '-', '0000-00-00 00:00:00', 0, 1, 1);

-- INSERT INTO PRODUIT (nom_prod, description_prod, url_image_prod, date_prod, est_bio, id_categorie, id_util, pu_prod, id_unite)
-- VALUES
-- ('Pommes', 'Pommes fraîches du verger local.', 'public/img/base_product_image.png', '2023-10-23 08:00:00', 1, 1, 2, 2.99, 1),
-- ('Carottes', 'Carottes biologiques cultivées localement.', 'public/img/base_product_image.png', '2023-10-23 09:15:00', 1, 2, 2, 2.99, 2),
-- ('Lait frais', 'Lait frais de la ferme voisine.', 'public/img/base_product_image.png', '2023-10-23 10:30:00', 1, 3, 2, 2.99, 3),
-- ('Poulet fermier', 'Poulet élevé en plein air, sans antibiotiques.', 'public/img/base_product_image.png', '2023-10-23 11:45:00', 1, 4, 4, 2.99, 4),
-- ('Saumon sauvage', 'Saumon frais pêché dans les eaux locales.', 'public/img/base_product_image.png', '2023-10-23 13:00:00', 1, 5, 6, 2.99, 5),
-- ('Pain artisanal', 'Pain fraîchement cuit au four artisanal.', 'public/img/base_product_image.png', '2023-10-23 14:15:00', 0, 6, 6, 2.99, 6),
-- ('Chocolat noir', 'Chocolat noir biologique fait à la main.', 'public/img/base_product_image.png', '2023-10-23 15:30:00', 1, 7, 8, 2.99, 7),
-- ('Jus d orange frais', 'Jus d orange fraîchement pressé.', 'public/img/base_product_image.png', '2023-10-23 16:45:00', 1, 8, 8, 2.99, 8),
-- ('Légumes bio', 'Panier de légumes biologiques variés.', 'public/img/base_product_image.png', '2023-10-23 18:00:00', 1, 2, 10, 2.99, 9),
-- ('Produit spécial', 'Produit spécial en édition limitée.', 'public/img/base_product_image.png', '2023-10-23 19:15:00', 0, 10, 10, 2.99, 10);
-- PRODUIT --

-- MESSAGE --
-- INSERT INTO MESSAGE (objet_mess, contenu_mess, date_mess, exp_groupe_mess)
-- VALUES
-- ('Nouveau message', 'Nouveau message de bienvenue.', '2023-10-23 08:00:00', 3),
-- ('Information importante', 'Veuillez lire cette information importante.', '2023-10-23 09:15:00', 3),
-- ('Annonce spéciale', 'Annonce spéciale pour nos membres.', '2023-10-23 10:30:00', 3),
-- ('Invitation à un événement', 'Vous êtes invité à notre événement spécial.', '2023-10-23 11:45:00', 6),
-- ('Mise à jour du site', 'Notre site a été mis à jour avec de nouvelles fonctionnalités.', '2023-10-23 13:00:00', 3),
-- ('Promotion du mois', 'Découvrez notre promotion du mois.', '2023-10-23 14:15:00', 7),
-- ('Message de service', 'Message de service pour nos clients.', '2023-10-23 15:30:00', 3),
-- ('Nouvelle offre spéciale', 'Nouvelle offre spéciale pour nos abonnés.', '2023-10-23 16:45:00', 9),
-- ('Annonce de réduction', 'Réduction spéciale sur certains produits.', '2023-10-23 18:00:00', 9),
-- ('Actualités de l entreprise', 'Restez informé sur nos dernières actualités.', '2023-10-23 19:15:00', 13);
-- MESSAGE --

-- PANIER --
-- GENERER PAR creerUtil
-- PANIER --

-- COMMANDE --
-- INSERT INTO COMMANDE (date_commande, statut_commande, id_panier, id_util)
-- VALUES
-- ('2023-10-23 20:30:00', 'En cours de preparation', 1, 2),
-- ('2023-10-23 21:45:00', 'Terminee', 2, 2),
-- ('2023-10-23 23:00:00', 'En attente de recuperation', 3, 4),
-- ('2023-10-24 00:15:00', 'En cours de preparation', 4, 6),
-- ('2023-10-24 02:45:00', 'En attente de recuperation', 6, 8),
-- ('2023-10-24 04:00:00', 'Terminee', 7, 8),
-- ('2023-10-24 05:15:00', 'En cours de preparation', 8, 10),
-- ('2023-10-24 06:30:00', 'En attente de recuperation', 9, 10),
-- ('2023-10-24 07:45:00', 'Terminee', 10, 10);
-- COMMANDE --

-- STOCK --
-- INSERT INTO STOCK (id_stock, qt_stock, nom_stock, pu_stock, date_stock, date_exp_stock, id_prod, id_unite)
-- VALUES
-- (1, 1, 'Indisponible', 0, '0000-00-00 00:00:00', NULL, 1, 1);

-- INSERT INTO STOCK (qt_stock, nom_stock, date_stock, date_exp_stock, id_prod)
-- VALUES
-- (100, 'Stock Pommes Oct 2023', '2023-10-23 08:00:00', NULL, 1),
-- (200, 'Stock Carottes Oct 2023', '2023-10-23 09:15:00', NULL, 2),
-- (50, 'Stock Lait Oct 2023', '2023-10-23 10:30:00', NULL, 3),
-- (75, 'Stock Poulet Oct 2023', '2023-10-23 11:45:00', NULL, 4),
-- (300, 'Stock Saumon Oct 2023', '2023-10-23 13:00:00', NULL, 5),
-- (80, 'Stock Pain Oct 2023', '2023-10-23 14:15:00', NULL, 6),
-- (150, 'Stock Chocolat Oct 2023', '2023-10-23 15:30:00', NULL, 7),
-- (90, 'Stock Jus Oct 2023', '2023-10-23 16:45:00', NULL, 8),
-- (120, 'Stock Légumes Oct 2023', '2023-10-23 18:00:00', NULL, 9),
-- (40, 'Stock Produit spécial Oct 2023', '2023-10-23 19:15:00', NULL, 10);
-- STOCK --

-- AVIS --
-- INSERT INTO AVIS (titre_avis, description_avis, note_avis, date_avis, id_util, id_prod)
-- VALUES
-- ('Excellent produit', 'Je suis très satisfait de ce produit.', 4.5, '2023-10-23 08:00:00', 3, 2),
-- ('Très bon produit', 'J aime vraiment ce produit.', 4.0, '2023-10-23 09:15:00', 3, 2),
-- ('Bonne qualité', 'Ce produit est de très bonne qualité.', 4.2, '2023-10-23 10:30:00', 5, 3),
-- ('À recommander', 'Je recommande fortement ce produit.', 4.8, '2023-10-23 11:45:00', 5, 4),
-- ('Satisfait', 'Je suis satisfait de mon achat.', 4.0, '2023-10-23 13:00:00', 7, 5),
-- ('Excellent goût', 'Ce produit a un goût exceptionnel.', 4.7, '2023-10-23 14:15:00', 7, 6),
-- ('Très bon service', 'Service client exceptionnel.', 4.5, '2023-10-23 15:30:00', 9, 7),
-- ('Rapport qualité-prix', 'Bon rapport qualité-prix.', 4.0, '2023-10-23 16:45:00', 9, 8),
-- ('Produit frais', 'Les produits sont toujours frais.', 4.4, '2023-10-23 18:00:00', 9, 9),
-- ('Excellent choix', 'Je suis très heureux avec ce produit.', 4.6, '2023-10-23 19:15:00', 9, 10);
-- AVIS --

-- ARTICLE --
-- INSERT INTO ARTICLE (id_prod, id_panier, qt_prod, pu_prod)
-- VALUES
-- (1, 1, 3, 5.0),
-- (2, 2, 2, 5.0),
-- (3, 2, 1, 5.0),
-- (4, 3, 2, 5.0),
-- (5, 3, 4, 5.0),
-- (7, 4, 2, 5.0),
-- (8, 5, 3, 5.0),
-- (9, 5, 1, 5.0),
-- (10, 9, 2, 5.0);
-- ARTICLE --

-- DESTINATAIRE --
-- INSERT INTO DESTINATAIRE (id_mess, dest_groupe_mess, ordre_groupe_dest)
-- VALUES
-- (1, 6, 1),
-- (1, 8, 2),
-- (2, 14, 1),
-- (3, 2, 1),
-- (4, 12, 1),
-- (5, 4, 1),
-- (6, 8, 1),
-- (6, 10, 2),
-- (6, 12, 3),
-- (7, 1, 1),
-- (8, 6, 1),
-- (9, 6, 1),
-- (10, 6, 1);
-- DESTINATAIRE --

-- MEMBRE --
INSERT INTO MEMBRE (id_util, id_groupe, num_membre)
VALUES
(1, 5, 1);
-- Utilisateur supprimé appartient au groupe supprimé
-- MEMBRE --
































-- VUES

DROP VIEW IF EXISTS produitsDisponible;
CREATE VIEW produitsDisponible AS SELECT 
PRODUIT.id_prod, 
PRODUIT.nom_prod, 
UTILISATEUR.pseudo_util, 
PRODUIT.url_image_prod, 
PRODUIT.est_bio,
UNITE.nom_unite
FROM PRODUIT
INNER JOIN UTILISATEUR ON PRODUIT.id_util=UTILISATEUR.id_util
INNER JOIN UNITE ON PRODUIT.id_unite=UNITE.id_unite
INNER JOIN STOCK ON PRODUIT.id_prod=STOCK.id_prod
GROUP BY 
PRODUIT.id_prod, 
PRODUIT.nom_prod, 
UTILISATEUR.pseudo_util, 
PRODUIT.url_image_prod, 
PRODUIT.est_bio,
UNITE.nom_unite
HAVING SUM(STOCK.qt_stock) > 0;

USE but2drivie_main;



DROP VIEW IF EXISTS paniersNonCommandes;
CREATE VIEW paniersNonCommandes AS 
SELECT id_panier, id_util FROM PANIER WHERE id_panier NOT IN (SELECT id_panier FROM COMMANDE);

DROP VIEW IF EXISTS articlesNonCommandes;
CREATE VIEW articlesNonCommandes AS SELECT 
PANIER.id_util AS 'id_client', 
PRODUIT.id_prod,
nom_prod, 
url_image_prod, 
ARTICLE.pu_prod, 
qt_prod, 
nom_unite, 
PRODUIT.id_util AS 'id_producteur' ,
UTILISATEUR.pseudo_util AS 'pseudo_producteur',
STOCK.qt_stock AS 'qt_stock_disponible'
FROM PANIER 
INNER JOIN ARTICLE ON PANIER.id_panier = ARTICLE.id_panier
INNER JOIN PRODUIT ON PRODUIT.id_prod = ARTICLE.id_prod
INNER JOIN UTILISATEUR ON UTILISATEUR.id_util = PRODUIT.id_util
INNER JOIN UNITE ON UNITE.id_unite = PRODUIT.id_unite
INNER JOIN STOCK ON STOCK.id_prod = PRODUIT.id_prod
WHERE PANIER.id_panier NOT IN (SELECT id_panier FROM COMMANDE);

DROP VIEW IF EXISTS articlesCommandes;
CREATE VIEW articlesCommandes AS SELECT 
id_commande,
statut_commande,
PRODUIT.id_prod,
pseudo_util,
qt_prod,
url_image_prod,
nom_prod,
nom_unite,
PANIER.id_util AS 'id_client',
ARTICLE.pu_prod,
PRODUIT.id_util AS 'id_producteur'
FROM COMMANDE INNER JOIN PANIER ON COMMANDE.id_panier=PANIER.id_panier
INNER JOIN ARTICLE ON PANIER.id_panier=ARTICLE.id_panier
INNER JOIN PRODUIT ON PRODUIT.id_prod= ARTICLE.id_prod
INNER JOIN UNITE ON UNITE.id_unite=PRODUIT.id_unite
INNER JOIN UTILISATEUR ON UTILISATEUR.id_util=PRODUIT.id_util WHERE COMMANDE.id_util=PRODUIT.id_util;

USE but2drivie_main;
DROP VIEW IF EXISTS infosProduits;
CREATE VIEW infosProduits AS SELECT PRODUIT.id_prod, PRODUIT.id_util, pseudo_util, nom_prod, description_prod, url_image_prod, date_prod, est_bio, nom_categorie, pu_prod, nom_unite, PRODUIT.id_unite, SUM(qt_stock) AS 'qt_stock', PRODUIT.id_categorie
FROM PRODUIT 
INNER JOIN UNITE ON PRODUIT.id_unite=UNITE.id_unite
INNER JOIN CATEGORIE ON PRODUIT.id_categorie=CATEGORIE.id_categorie
INNER JOIN UTILISATEUR ON PRODUIT.id_util=UTILISATEUR.id_util 
LEFT JOIN STOCK ON PRODUIT.id_prod=STOCK.id_prod 
GROUP BY id_prod;




USE but2drivie_main;
DROP VIEW IF EXISTS infosMessages;
CREATE VIEW infosMessages AS SELECT G1.nom_groupe AS 'nom_groupe_exp', MESSAGE.id_mess, MESSAGE.objet_mess, MESSAGE.contenu_mess, MESSAGE.date_mess, MESSAGE.exp_groupe_mess, DESTINATAIRE.dest_groupe_mess, DESTINATAIRE.ordre_groupe_dest, G2.nom_groupe AS 'nom_groupe_dest' FROM GROUPE AS G1
INNER JOIN MESSAGE ON G1.id_groupe=MESSAGE.exp_groupe_mess
INNER JOIN DESTINATAIRE ON MESSAGE.id_mess=DESTINATAIRE.id_mess
INNER JOIN GROUPE AS G2 ON DESTINATAIRE.dest_groupe_mess=G2.id_groupe;

USE but2drivie_main;
DROP VIEW IF EXISTS infosAvis;
CREATE VIEW infosAvis AS SELECT UTILISATEUR.url_image_util, UTILISATEUR.prenom_util, UTILISATEUR.nom_util, note_avis, date_avis, date_prod, titre_avis, description_avis, AVIS.id_prod
FROM AVIS 
INNER JOIN PRODUIT ON AVIS.id_prod=PRODUIT.id_prod
INNER JOIN UTILISATEUR ON AVIS.id_util=UTILISATEUR.id_util;

-- CREATE VIEW infosUtil AS SELECT UTILISATEUR.id_util, 
-- prenom_util, 
-- nom_util, 
-- adresse_util, 
-- ville_util,
-- cp_util,
-- mail_util,
-- tel_util,
-- num_siret,
-- pseudo_util,
-- description_util,
-- id_type,
-- url_image_util
-- FROM UTILISATEUR
-- LEFT JOIN PRODUIT ON UTILISATEUR.id_util=PRODUIT.id_util
-- LEFT JOIN COMMANDE ON UTILISATEUR.id_util=COMMANDE.id_util
-- GROUP BY UTILISATEUR.id_util;



USE but2drivie_main;
-- SELECT COUNT(*) FROM (SELECT PRODUIT.id_prod FROM PRODUIT LEFT JOIN STOCK ON PRODUIT.id_prod = STOCK.id_prod WHERE PRODUIT.id_util = 16 GROUP BY PRODUIT.id_prod HAVING SUM(STOCK.qt_stock) = 0 OR SUM(STOCK.qt_stock) IS NULL) AS produits_rupture;





USE but2drivie_main;

DROP PROCEDURE IF EXISTS nbProduitsRupture;
DELIMITER $$
CREATE PROCEDURE nbProduitsRupture(
   IN id_util SMALLINT, 
   OUT nb_rupture SMALLINT)
BEGIN
    SELECT COUNT(*) INTO nb_rupture
    FROM 
        (SELECT PRODUIT.id_prod, SUM(STOCK.qt_stock) as total_stock 
         FROM PRODUIT 
         LEFT JOIN STOCK ON PRODUIT.id_prod = STOCK.id_prod 
         WHERE PRODUIT.id_util = id_util 
         GROUP BY PRODUIT.id_prod 
         HAVING total_stock = 0 OR total_stock IS NULL
        ) AS produits_rupture;
END $$
DELIMITER ;

DROP VIEW IF EXISTS infosUtil;

CREATE VIEW infosUtil AS
SELECT id_util,
       prenom_util,
       nom_util,
       adresse_util,
       ville_util,
       cp_util,
       mail_util,
       tel_util,
       num_siret,
       pseudo_util,
       description_util,
       mdp_util,
       id_type,
       url_image_util,
       (SELECT COUNT(*) FROM PRODUIT WHERE PRODUIT.id_util = UTILISATEUR.id_util) AS nb_produits,
       (SELECT SUM(ARTICLE.qt_prod * ARTICLE.pu_prod) FROM ARTICLE JOIN PANIER ON ARTICLE.id_panier = PANIER.id_panier JOIN COMMANDE ON COMMANDE.id_panier = PANIER.id_panier JOIN PRODUIT ON ARTICLE.id_prod = PRODUIT.id_prod WHERE PRODUIT.id_util = UTILISATEUR.id_util AND COMMANDE.id_util = UTILISATEUR.id_util AND COMMANDE.statut_commande = 'Terminee') AS total_ventes,
       (SELECT COUNT(*) FROM COMMANDE WHERE COMMANDE.id_util = UTILISATEUR.id_util AND COMMANDE.statut_commande = 'En cours de preparation') AS nb_commandes_preparation,
       (SELECT COUNT(*) FROM COMMANDE WHERE COMMANDE.id_util = UTILISATEUR.id_util AND COMMANDE.statut_commande = 'En attente') AS nb_commandes_attente,
       (SELECT COUNT(*) FROM COMMANDE WHERE COMMANDE.id_util = UTILISATEUR.id_util AND COMMANDE.statut_commande = 'Terminee') AS nb_commandes_terminees,
       (SELECT MEMBRE.id_groupe FROM MEMBRE WHERE MEMBRE.id_util = UTILISATEUR.id_util AND MEMBRE.id_groupe != UTILISATEUR.id_type AND MEMBRE.id_groupe != 4) AS id_groupe
FROM UTILISATEUR;









-- DROP VIEW IF EXISTS commandeProducteur;

-- CREATE VIEW commandeProducteur AS SELECT id_commande, prenom_util, nom_util, pseudo_util, date_commande, statut_commande, nom_panier, date_panier, qt_prod, nom_prod FROM UTILISATEUR 
-- INNER JOIN COMMANDE ON UTILISATEUR.id_util=COMMANDE.id_util
-- INNER JOIN PANIER ON PANIER.id_panier=COMMANDE.id_panier
-- INNER JOIN ARTICLE ON ARTICLE.id_panier=PANIER.id_panier
-- INNER JOIN PRODUIT ON PRODUIT.id_prod=ARTICLE.id_prod;


-- DROP VIEW IF EXISTS notifUtil;

-- CREATE VIEW notifUtil AS SELECT id_notif, UTILISATEUR.id_util, prenom_util, nom_util, GROUPE.nom_groupe, titre_notif, description_notif, date_notif
-- FROM UTILISATEUR 
-- INNER JOIN MEMBRE ON UTILISATEUR.id_util=MEMBRE.id_util 
-- INNER JOIN GROUPE ON GROUPE.id_groupe=MEMBRE.id_groupe
-- INNER JOIN NOTIFICATION ON NOTIFICATION.id_groupe=GROUPE.id_groupe;


-- DROP VIEW IF EXISTS AvisUtil;

-- CREATE VIEW AvisUtil AS SELECT V1.prenom_util AS 'Prenom_client', V1.nom_util AS 'Nom_client', V1.pseudo_util AS 'Pseudo_client', titre_avis, description_avis, note_avis, date_avis, nom_prod, V2.prenom_util AS 'Prenom_producteur', V2.nom_util AS 'Nom_producteur', V2.pseudo_util AS 'Pseudo_producteur' FROM UTILISATEUR AS V1 INNER JOIN AVIS ON V1.id_util=AVIS.id_util
-- INNER JOIN PRODUIT ON PRODUIT.id_prod=AVIS.id_prod
-- INNER JOIN UTILISATEUR AS V2 ON PRODUIT.id_util=V2.id_util;

