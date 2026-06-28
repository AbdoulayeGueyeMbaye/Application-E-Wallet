<?php

    namespace App\Repository;

$wallets = [];
$transactions = [];

function initData() {
    global $wallets, $transactions;
    $wallets = [];
    $transactions = [];
}

function ajouterWallet($tel, $nom, $solde, $code) {
    global $wallets;
    $nouveauWallet = [
        'tel' => $tel,
        'nom' => $nom, 
        'solde' => $solde,
        'code' => $code
    ];
    
    
    $taille = 0;
    foreach ($wallets as $w) { $taille++; }
    $wallets[$taille] = $nouveauWallet;
}

function trouverWalletParTel($tel) {
    global $wallets;

    $index = array_search($tel, array_column($wallets, 'tel'));

    if ($index !== false) {
        return $wallets[$index];
    }

    return null;
}

function trouverIndexWalletParTel($tel) {
    global $wallets;

    $index = array_search($tel, array_column($wallets, 'tel'));

    return $index !== false ? $index : -1;
}

function majSoldeWallet($tel, $nouveauSolde) {
    global $wallets;
    $index = trouverIndexWalletParTel($tel);
    if ($index !== -1) {
        $wallets[$index]['solde'] = $nouveauSolde;
        return true;
    }
    return false;
}

function ajouterTransaction($tel, $type, $montant, $frais = 0) {
    global $transactions;

    $transaction = [
        'tel' => $tel,
        'type' => $type,
        'montant' => $montant,
        'frais' => $frais,
        'date' => date('Y-m-d H:i:s')
    ];

    array_push($transactions, $transaction);
}

function getAllTransactions() {
    global $transactions;
    return $transactions;
}

function getTransactionsParTel($tel) {
    global $transactions;
    $result = [];
    foreach ($transactions as $t) {
        if ($t['tel'] === $tel) {
            $taille = 0;
            foreach ($result as $r) { $taille++; }
            $result[$taille] = $t;
        }
    }
    return $result;
}

function codeSecretExiste($code) {
    global $wallets;
    foreach ($wallets as $wallet) {
        if ($wallet['code'] === $code) {
            return true;
        }
    }
    return false;
}
?>