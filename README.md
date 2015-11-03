Première version de IwaPHP CMS 
==============================

IwaPHP CMS est un système de gestion de contenu codé en PHP (Procédural) utilisant la base de données MySQL.
Le projet a été crée en 2007 et en permanence réadapté pour la comptabilité PHP.
Cette version est dépréciée donc unstable, je vous déconseille donc fortement de l'utiliser pour créer votre site, des failles de sécurité sont probablement présentes. Une refonte complète est en cours avec le pattern MVC.

Lien vers le dépot de la refonte du projet :
https://github.com/iwaphp/IwaPHP-CMS_recast

Installation de IwaPHP CMS old :
--------------------------------

Commandes Linux :

> git clone https://github.com/iwaphp/IwaPHP-CMS_old.git

> cd IwaPHP-CMS_old

> sudo chmod 777 -R config/

Ensuite démarrer votre navigateur et rendez vous sur votre localhost

<http://localhost/IwaPHP-CMS_old/>

Le script d'installation va se lancer alors, suivez les instructions.

Créer une base de données MySQL dans le terminal :
--------------------------------------------------

> mysql -u root

> CREATE DATABASE iwaphp
