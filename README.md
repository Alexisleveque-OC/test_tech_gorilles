# Test technique pour Gorilles

## Installation

Le projet a été fait en php 8.1 et Symfony 6.3.

### Etape 1 :
Cloner le projet à partir de l'URL suivante sur votre serveur local. (Exemple pour WAMP : C:/wamp64/www)
https://github.com/Alexisleveque-OC/test_tech_gorilles.git

### Etape 2 : 
- Placez vous dans votre dossier.
- Entrez cette commande  
''''  
composer install  
''''

### Etape 3 :
Copiez le fichier .env en .env.local et insérez les informations de connexion à votre base de données.

### Etape 4 :
- Générez la base de données et les fixtures à l'aide de la commande suivante :  
''''  
composer prepare  
''''  

### Etape 5 : 
Une dernière commande pour lancer le server de symfony :  
''''  
symfony server:start  
''''  
Et ... voilà :) Tout est prêt pour tester cette petite application !
