<?php
require 'repository.php';
require 'validator.php'; 
require 'services.php';
require 'controller.php';


initData();

do {
    echo "\n****** MENU DISTRIBUTEUR ******\n";
    echo "1 - Créer Wallet\n";
    echo "2 - Faire Dépôt\n";
    echo "3 - Faire Retrait\n";
    echo "4 - Lister les Transactions\n";
    echo "0 - Quitter\n";
    echo "\n                        \n";
    echo "Votre choix : ";
    
    $choix = trim(fgets(STDIN));
    
    switch ($choix) {
        case '1':
            creerWallet();
            break;
        case '2':
            faireDepot();
            break;
        case '3':
            faireRetrait();
            break;
        case '4':
            listerTransactions();
            break;
        case '0':
            echo "Au revoir !\n";
            break;
        default:
            echo "Choix invalide, veuillez réessayer\n"; 
    }
    
} while ($choix !== '0');