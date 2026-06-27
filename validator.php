<?php
function validerChampsObligatoires($tel, $nom, $code) {
    return $tel !== '' && $nom !== '' && $code !== ''; 
}

function validerSoldeInitial($solde) {
return is_numeric($solde) && $solde >= 0; 
}

function validerUniciteTel($tel) {
    return trouverWalletParTel($tel) === null; 
}

function validerUniciteCode($code) 
{
    return !codeSecretExiste($code); 
}

function validerWalletExiste($tel) {
    return trouverWalletParTel($tel) !== null;
}

function validerMontantPositif($montant) {
    return is_numeric($montant) && $montant > 0; 
}

function validerSoldeSuffisant($tel, $montant, $frais) {

    $wallet = trouverWalletParTel($tel);
    if ($wallet === null) return false;
    return $wallet['solde'] >= ($montant + $frais); 
}
?>