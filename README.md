﻿Instructions
 
Consignes du projet.

Lors de ce test technique, vous créerez une API de gestion de notes de frais. 

Ce test porte UNIQUEMENT sur l’API. Elle pourra être consommée via Postman, Insomnia... La création du code, côté front, n’est pas attendue. 

Vous utiliserez la version de PHP ainsi que le SGBD de votre choix.  

Vous êtes libre d’utiliser un Framework ou non. 

Votre code sera versionné sur un dépôt Git (GitHub, Gitlab , Bitbucket ...)

Vous documenterez le code et le projet. Entre autres, afin de faciliter l’installation et le lancement du projet. 

Contexte 

Un commercial travaillant pour différentes entreprises doit pouvoir se faire rembourser les frais engagés pour son travail. 

Besoins 

Vous créez une API de gestion de notes de frais contenant les routes suivantes : 

GET des notes de frais 

GET d'une note de frais 

POST d'une nouvelle note

PUT d'une note à éditer

DELETE d'une note 

L’API ne sera utilisée que par un seul utilisateur ayant l’ID #1. La gestion des droits et d’authentification n’est pas attendue. Toutefois, vous pouvez détailler dans la documentation du projet le type d’authentification que vous auriez mis en place. 

Tests 

Les classes utilisées par la route POST seront testées unitairement et/ou fonctionnellement. 

Modèle de données 

Vous intègrerez à minima les données suivantes. Vous pourrez ajouter à ce modèle de données les éléments qui vous semblent nécessaires. 

Utilisateur 

Identifiant 

Nom

Prénom

Email

Date de naissance 

Note de frais  

Identifiant 

Date de la note 

Montant de la note 

Type de note (essence, péage, repas, conférence) 

Date d’enregistrement 

Société (à qui l’on demande le remboursement) 

Nom de la société 

Bonus 

Implémentation d’un système d’authentification 

Toutes les routes sont testées 

Nous regarderons le choix de la stack, la qualité du code, des commits, de la documentation et des tests, ainsi que la procédure d’installation. 

-Projet réalisé avec PHP/7.4 </br>
-Symfony 5; </br>
-Base de données Mysql; </br>
-Versionning Git; </br>
-Api Rest conçu avec Api Platform </br>

I) Installation du projet

Clonez le projet dans votre repertoire local via la commande git clone.
Executez la commande composer install afin d'installer les dépendances du projet.
Mettez à jour le fichier .env avec les paramètres de connexion à votre base de données, 
de même pour le fichier .env.test pour la base de données de test.
Renseigner un passphrase dans le fichier .env.test. et .env aussi.

Ensuite Executez les commandes suivantes pour mettre à jour la base de données :

1) Pour l'environnement de développement :

-Créer la base de données : php bin/console doctrine:database:create </br>
-Charger les tables dans la base : php bin/console doctrine:schema:update --force </br>
-Lancer les fixtures afin d'insérer un jeu de données dans la base: php bin/console doctrine:fixtures:load </br>

2) Pour l'environnement de test : 
    
	php bin/console doctrine:database:create --env=test </br>
	php bin/console doctrine:schema:update --force </br>
	php bin/console doctrine:fixtures:load -n --env=test </br>


Pour démarrer le projet: symfony server:start.
La documentation de l'API sera accessible à l'URL : http://127.0.0.1:8000/api

II) Utilisation de l'API.

1) Authentification:

Pour l'authentification nous avons utilsé l'authentification JWT.

Pour pouvoir réaliser des requêtes auprès de l'API vous devez impérativement être authentifié.
Pour cela vous devez faire une requête POST à l'url http://127.0.0.1:8000/api/login_check en indiquant 
dans le corps de la requête les identifiants de l'utilisateur suivant enregistré en base de donnée via les fixtures:
"email" : "adouessono@yahoo.fr",
"password : "test"

Dès lors vous obtiendrez un token que vous devrez renseigner, dans Postman, dans la partie bearer token pour toutes les autres requêtes sur l'api.

2) Particularité pour ajouter une note de frais via la requête POST : 
En ce qui concerne le paramètre "society", vous devez renseigner l'iri d'une société déjà présente en base de données, par exemple "api/societies/1" pour que la note de frais soit relié à la société dont l'id est 1. Car en effet il y a une relation manyToOne entre l'entité Notes et Society

III) Tests unitaires et fonctionnels : 

Pour lancer les tests unitaires, il vous suffira d'executer la commande php bin/phpunit.

Le dossier tests/Func/Entity contient les tests fonctionnels de l'API relatives à l'entité Notes. 
Et le dossier tests/Unit/Entity contient les tests unitaires sur 
l'entité Notes.

Et toutes les commandes ci dessus sont a réaliser bien sûr dans le répertoire du projet.



