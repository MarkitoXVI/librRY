<?php
// Iestatam datubāzes savienojumu
$dsn = "mysql:host=localhost;dbname=my_database";
$username = "your_username";
$password = "your_password";

try {
    // Izveidojam PDO savienojumu
    $pdo = new PDO($dsn, $username, $password);
    
    // Sagatavoam SQL pieprasījumu
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    
    // Norādam parametrus un saistam tos ar vērtībām
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    
    // Izpildam pieprasījumu
    $stmt->execute();
    
    // Iegūstam rezultātu
    $user = $stmt->fetch();

    // Pārbaudam, vai ir atbilstošs lietotājs
    if ($user) {
        // Atgriežam "success", ja lietotājs atrasts
        echo "success";
    } else {
        // Atgriežam "error", ja lietotājs nav atrasts
        echo "error";
    }
} catch (PDOException $e) {
    // Atgriežam kļūdas ziņojumu, ja radusies kļūda savienojumā ar datubāzi
    echo "Error: " . $e->getMessage();
}
?>
