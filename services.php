<?php
function serviceCreerWallet($tel, $nom, $solde, $code) {
    
    if (!validerChampsObligatoires($tel, $nom, $code)) {
        return ['success' => false, 'message' => 'Tous les champs sont obligatoires'];
    }
    if (!validerSoldeInitial($solde)) {
        return ['success' => false, 'message' => 'Le solde initial doit être positif ou nul'];
    }
    if (!validerUniciteTel($tel)) {
        return ['success' => false, 'message' => 'Ce numéro de téléphone existe déjà'];
    }
    if (!validerUniciteCode($code)) {
        return ['success' => false, 'message' => 'Ce code secret est déjà utilisé'];
    }
    
    ajouterWallet($tel, $nom, $solde, $code);
    return ['success' => true, 'message' => 'Wallet créé avec succès'];
}

function calculerFraisRetrait($montant) {
    
    if ($montant >= 0 && $montant <= 10000) {
        return 200;
    } elseif ($montant >= 10001 && $montant <= 100000) {
        return 500;
    } else { 
        $frais = $montant * 0.01; 
        return $frais > 5000 ? 5000 : $frais; 
    }
}

function serviceDepot($tel, $montant) {
    
    if (!validerWalletExiste($tel)) {
        return ['success' => false, 'message' => 'Numéro de téléphone introuvable'];
    }
    if (!validerMontantPositif($montant)) {
        return ['success' => false, 'message' => 'Le montant doit être strictement positif'];
    }
    
    $wallet = trouverWalletParTel($tel);
    $nouveauSolde = $wallet['solde'] + $montant;
    majSoldeWallet($tel, $nouveauSolde);
    ajouterTransaction($tel, 'DEPOT', $montant, 0);
    
    return ['success' => true, 'message' => "Dépôt de $montant CFA effectué. Nouveau solde: $nouveauSolde CFA"];
}

function serviceRetrait($tel, $montant) {
    
    if (!validerWalletExiste($tel)) {
        return ['success' => false, 'message' => 'Numéro de téléphone introuvable'];
    }
    if (!validerMontantPositif($montant)) {
        return ['success' => false, 'message' => 'Le montant doit être strictement positif'];
    }
    
    $frais = calculerFraisRetrait($montant); 
    
    if (!validerSoldeSuffisant($tel, $montant, $frais)) {
        return ['success' => false, 'message' => 'Solde insuffisant pour couvrir montant + frais'];
    }
    
    $wallet = trouverWalletParTel($tel);
    $nouveauSolde = $wallet['solde'] - $montant - $frais;
    majSoldeWallet($tel, $nouveauSolde);
    ajouterTransaction($tel, 'RETRAIT', $montant, $frais);
    
    return ['success' => true, 'message' => "Retrait de $montant CFA effectué. Frais: $frais CFA. Nouveau solde: $nouveauSolde CFA"];
}
?>