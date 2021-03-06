Instructions

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



