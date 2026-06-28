# Presentation Fonctions Anonymes/Fléches/Closures

# Fonctions anonymes
 Une fonction anonyme est une fonction sans nom. Elle sont souvent utilisé pour les callbacks.

Elle est généralement stockée dans une variable. par exemple 

$som = function ($a, $b) {
    return $a + $b;
};

echo $som(10, 5); //Resultat 15

# Utilisation avec array_filter
$notes = [10, 15, 8, 19, 12];

$resultat = array_filter($notes, function ($note) {
    return $note >= 10;
});

print_r($resultat);

$wallet = array_filter(
    $wallets,
    fn($wallet) => $wallet['tel'] === $tel
);

# Fonctions Fléché
Elle permet d'écrire une fonction très courte. Par exemple S'il vous plait = Svp
Eexemple: 
$addition = fn($a, $b) => $a + $b;

echo $addition(10, 5);

# Utilisation avec array_filter
$notes = [10, 15, 8];

$resultat = array_map(
    fn($note) => $note * 2,
    $notes
);

print_r($resultat);
Resultat : 20, 30, 16

# Closures
Une Closure est une fonction anonyme capable de capturer des variables de son environnement grâce au mot-clé use. Elle est utiliséé quand une fonction doit accéder à des variables externes.
Exemple
$a = 10;

$test = function () use ($a) {
    echo $a;
};

$a = 20;

$test();
La closure conserve la valeur de $a au moment où elle est créée. 

# 1 Array_map()
Cette fonction permet de transformer chaque élément d'un tableau. Le callback est exécuté pour chaque élément et un nouveau tableau est retourné.
Exemple
$wallets = [
    ['nom' => 'Abdel', 'solde' => 1000],
    ['nom' => 'Khady', 'solde' => 2000],
    ['nom' => 'Wane', 'solde' => 500]
];

$noms = array_map(
    fn($wallet) => $wallet['nom'],
    $wallets
);

print_r($noms);
Cette exemple permet uniquement de reuperer les noms.

# 2 Array_filter ()
array_filter() permet de conserver uniquement les éléments qui respectent une condition.

Exemple 
$wallets = [
    ['nom' => 'Abdel', 'solde' => 0],
    ['nom' => 'Fatou', 'solde' => 3000],
    ['nom' => 'Sadio', 'solde' => 2000]
];

$resultat = array_filter(
    $wallets,
    fn($wallet) => $wallet['solde'] > 0
);

print_r($resultat);

# 3 array_reduce()

array_reduce() permet de réduire un tableau à une seule valeur.
Exemple 
$wallets = [
    ['nom' => 'mami', 'solde' => 1000],
    ['nom' => 'fallo', 'solde' => 2500],
    ['nom' => 'Fatou', 'solde' => 500]
];

$total = array_reduce(
    $wallets,
    fn($carry, $wallet) => $carry + $wallet['solde'],
    0
);

echo $total;
