# Application Laravel

## Développer sur Windows

Premièrement, installer PHP 8.2.15 sur votre machine si ce n'est pas déjà fait.  
[Ce lien](https://windows.php.net/download#php-8.2) vous permettra de télécharger un `.zip`, qu'il faudra décompresser et placer dans un répertoire connu, afin d'ajouter le chemin vers `php.exe` dans votre PATH.

Il vous faudra aussi installer [`Composer`](https://getcomposer.org/doc/00-intro.md#installation-windows).

## Développer sur les PC de l'IUT

executer chaque commandes suivantes:

1. `sudo apt-get install composer`

2. `sudo apt-get update`

3. `sudo apt-get install php-xml`
4. `sudo apt-get install php-dom`

**Répéter cette commande 2 fois !!!**. 5. `sudo apt-get install tzdata`

Ensuite aller dans un dossier sur votre pc pour cloner le repo actuel:  
6. `git clone https://gitlab.univ-nantes.fr/pub/but/but2/sae3.real.01_developpement_d_une_application/alt/eq_alt_01_bausson-maximilien_hay-thomas_le-bras-mathieu_vandemeulebroucke-bertin-nolan.git`

# Lancer l'application pour la 1ere fois.

`cd 'nouveau dossier qui vient d'être créer'`

Installer les dépendances:  
7. `composer install --ignore-platform-reqs`

Lancer le projet laravel  
8. `cp .env.example .env`  
9. `php artisan migrate`  
10. `php artisan serve`
