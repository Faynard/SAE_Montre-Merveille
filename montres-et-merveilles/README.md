# Application Laravel

## Développer sur Windows

Premièrement, installer PHP 8.2.15 sur votre machine si ce n'est pas déjà fait.  
[Ce lien](https://windows.php.net/download#php-8.2) vous permettra de télécharger un `.zip`, qu'il faudra décompresser et placer dans un répertoire connu, afin d'ajouter le chemin vers `php.exe` dans votre PATH.

Il vous faudra aussi installer [`Composer`](https://getcomposer.org/doc/00-intro.md#installation-windows).

## Développer sur les PC de l'IUT

[Installer `composer` sur Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)

Après cela, vous aurez une `segmentation fault` lorsque vous essayerez d'utiliser `composer`.

Il vous faudra installer `tzdata` via `apt install tzdata`.  
**Note**: Répéter cette commande deux fois.

# Lancer l'application pour 1ere fois

L'application se lance via la commande `php artisan serve`.

Il se peut que vous ayez besoin d'installer les dépendences avec `composer install --ignore-platform-reqs`

Ensuite, créer un fichier .env à partir du fichier fourni `.env.example`, et renseigner les informations relatives à votre DB dans les clés `DB_`. Vérifier que votre service de base de données est actif.

Enfin, éxecuter `php artisan migrate` afin de mettre à jour votre base de données avec les dernières migrations du projet.
