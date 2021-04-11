Bonjour, 

Afin que l'installation se passe au mieux, merci de suivre les étapes ci-dessous :

Etape 1: Changer les informations du fichiers ".env" pour connecter votre BDD.

Etape 2: Créer une BDD avec le nom que vous aurez choisi (Ex: Create database db_name)

Etape 3: Mettre en commentaire la fonction boot dans le dossier Providers > fichier AppServiceProvider.php

Etape 4 : Ouvrir le terminal et copier les commandes indiquées :

$php artisan db:create
$php artisan migrate:fresh --seed
$php artisan serve

Pour vous connecter à l'admin :
Mettez /login après l'URL, et recopier les identifiants du UserTableSeeder.php qui se trouve dans le dosser database > seeders. 

Bravo ! Vous pouvez utiliser le site comme vous le souhaitez :) 

Si vous avez des problèmes, n'hésitez pas à me contacter