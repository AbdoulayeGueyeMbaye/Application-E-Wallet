<?php
function creerWallet() {
    echo "**** Création Wallet ****\n";
    echo " Numéro de téléphone : ";
    $tel = trim(fgets(STDIN));
    echo "Nom du client : ";
    $nom = trim(fgets(STDIN));
    echo "Solde initial : ";
    $solde = trim(fgets(STDIN));
    echo "Code secret : ";
    $code = trim(fgets(STDIN));
    
    $result = serviceCreerWallet($tel, $nom, $solde, $code);
    echo $result['message'] . "\n";
}

function faireDepot() {
    echo "**** DEPOT ****\n";
    echo "  Numéro de téléphone : ";
    $tel = trim(fgets(STDIN));
    echo "Montant à déposer : ";
    $montant = trim(fgets(STDIN));
    
    $result = serviceDepot($tel, $montant);
    echo $result['message'] . "\n";
}

function faireRetrait() {
    echo "**** RETRAIT ****\n";
    echo "Numéro de téléphone : ";
    $tel = trim(fgets(STDIN));
    echo "Montant à retirer : ";
    $montant = trim(fgets(STDIN));
    
    $result = serviceRetrait($tel, $montant);
    echo $result['message'] . "\n";
}

function listerTransactions() {
    echo "***** Lister Transactions ****\n";
    echo "1 - Toutes les transactions\n";
    echo "2 - Par numéro de téléphone\n";
    echo "\n                           \n";
    echo "Choix : ";
    $choix = trim(fgets(STDIN));
    
    $transactions = [];
    if ($choix === '1') {
        $transactions = getAllTransactions();
    } elseif ($choix === '2') {
        echo "Numéro de téléphone : ";
        $tel = trim(fgets(STDIN));
        $transactions = getTransactionsParTel($tel);
    } else {
        echo "Choix invalide\n";
        return;
    }
    
    if (count($transactions) === 0) {
        echo "Aucune transaction trouvée\n";
        return;
    }
    
    echo "Date | Tel | Type | Montant | Frais\n";
    echo "                                      \n";
    foreach ($transactions as $t) {
        echo $t['date'] . " | " . $t['tel'] . " | " . $t['type'] . " | " . $t['montant'] . " | " . $t['frais'] . "\n";
    }
}
?>