<?php session_start();
// user_management.php


require_once(__DIR__.'/../db.php');
require_once('config_url.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();
}


// Change Type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_role"])) {
    // Get the updated type value from the form
    $new_role = $_POST["new_role"];
    $user_id = $_POST["admin_id"];

    // Update the type in the database
    $stmt = $mysqli->prepare("UPDATE Admins SET user_role = ? WHERE ID = ?");
    $stmt->bind_param("si", $new_role, $user_id);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        die('Error: ' . $stmt->error);
    } else {
        $_SESSION['success'] = "Rôle mis à jour !";
        header("Location: $_user_manager");
        exit();
    }

    // Close the statement
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteUser"])) {
    $userID = $_POST["userID"];

    // Delete the entry from the database
    $stmt = $mysqli->prepare("DELETE FROM Admins WHERE ID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        die('Error: ' . $stmt->error);
    } else {
        echo '<script>alert("Utilisateur supprimé !");</script>';
    }

    // Close the statement
    $stmt->close();
}


// Fetch questions from the database
$result = $mysqli->query("SELECT id, firstname, lastname, email, user_role FROM Admins WHERE user_role = 'Administrateur' ORDER BY id");

// Check for errors
if (!$result) {
    die('Error: ' . $mysqli->error);
}

// Fetch questions as an associative array
$admins = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the result set
//return $admins;

// Fetch questions from the database
$resultManager = $mysqli->query("SELECT id, firstname, lastname, email, user_role FROM Admins WHERE user_role = 'Manager' ORDER BY id");

// Check for errors
if (!$resultManager) {
    die('Error: ' . $mysqli->error);
}

// Fetch questions as an associative array
$managers = mysqli_fetch_all($resultManager, MYSQLI_ASSOC);

// Close the result set
//return $managers;