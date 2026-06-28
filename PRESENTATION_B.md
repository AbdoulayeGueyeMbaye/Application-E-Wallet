# Presentation sur Composer et Packagist.org

# Composer
Composer est le gestionnaire de dépendances de PHP.

Une dépendance est une bibliothèque externe utilisée par une application.

Composer permet de :

installer des bibliothèques ;
mettre à jour les bibliothèques ;
supprimer des bibliothèques ;
charger automatiquement les classes (autoload).

Par exemple sur notre projet E-Wallet on creer manuellement toutes les fichiers index.php, services.php, validator.php etc mais avec une seule commande de composer composer install toutes les bibliothques sont installé automatiquement.

# Avantage de composer
Installation automatique des bibliothèques
Gestion des versions
Mise à jour facile
Autoload automatique
Compatible avec tous les frameworks PHP
Gain de temps
Standard du développement PHP

# Installation de composer sudo apt install composer

# Packagist
Packagist.org est le dépôt officiel des packages PHP.

Il contient des milliers de bibliothèques prêtes à être installées avec Composer.

On peut le comparer à :

npm pour JavaScript

Packagist est le répertoire principal et public des packages PHP.

C'est là que Composer va chercher les packages que vous lui demandez.

Si vous cherchez une bibliothèque pour gérer des paiements (Stripe), générer des PDF ou envoyer des emails, vous allez sur Packagist.org pour trouver son nom et l'ajouter à votre projet.

# L'Entrepôt : Le dossier vendor/
C'est le dossier qui contient le code physique de toutes les dépendances téléchargées par Composer.

Vous ne devez jamais modifier le code à l'intérieur de ce dossier, car il est écrasé à chaque mise à jour.

Ce dossier est généralement exclu de Git (.gitignore) car il est lourd et peut être recréé à tout moment par n'importe quel développeur travaillant sur le projet grâce à la commande composer install.

# La Magie de l'Inclusion : L'Autoload
Avant Composer, pour utiliser une classe située dans un autre fichier, il fallait écrire des dizaines de require_once 'chemin/vers/le/fichier.php';. C'était un cauchemar à maintenir.

L'Autoload (généré automatiquement par Composer dans vendor/autoload.php) résout ce problème. Il charge automatiquement et à la volée le fichier PHP contenant la classe que vous essayez d'utiliser au moment précis où vous l'appelez dans votre code.

Il vous suffit d'inclure cette unique ligne au point d'entrée de votre application (ex: index.php)
require __DIR__ . '/vendor/autoload.php';

# L'Action : require package
La commande composer require nom-du-package est l'action qui déclenche tout le processus. Par exemple, si vous tapez composer require guzzlehttp/guzzle dans votre terminal :

Composer interroge Packagist.org pour trouver le package.

Il vérifie la compatibilité avec votre version de PHP.

Il inscrit automatiquement la dépendance dans votre composer.json.

Il télécharge le code du package et l'installe dans le dossier vendor/.

Il met à jour l'autoload pour que vous puissiez utiliser la bibliothèque immédiatement.