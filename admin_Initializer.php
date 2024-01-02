<?php
require_once ('db.php');

$firstname = 'Victor';
$lastname = 'Hu';
$email = 'victor@lgx-france.fr';
$password = 'Lgx2023!';
$user_role = 'Administrateur';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$insert_query = "INSERT INTO Admins (firstname, lastname, email, password, user_role) VALUES (?, ?, ?, ?, ?)";
$insert_stmt = $mysqli->prepare($insert_query);
$insert_stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $user_role);

if ($insert_stmt->execute()) {
    echo "Admin créé";
} else {
    echo "Erreur lors de la création de la table : ".$mysqli->error;
}

$mysqli->close();