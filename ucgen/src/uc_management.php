<?php session_start();
// src/ucManagement_v5.php

//v1 : Update type
//v2 : Delete entrées
//v4 : Edit Question
//v5 : Login required


require_once(__DIR__.'/../db.php');
require_once('config_url.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();
}


// Change Type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["newType"])) {
    // Get the updated type value from the form
    $newType = $_POST["newType"];
    $questionID = $_POST["questionID"];

    // Update the type in the database
    $stmt = $mysqli->prepare("UPDATE question SET type = ? WHERE ID = ?");
    $stmt->bind_param("si", $newType, $questionID);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        die('Error: ' . $stmt->error);
    } else {
        echo '<script>alert("Type mis à jour !");</script>';
    }

    // Close the statement
    $stmt->close();
}

// Change Question
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["newQuestion"])) {
    // Get the updated type value from the form
    $newQuestion = $_POST["newQuestion"];
    $questionID = $_POST["questionID"];

    // Update the type in the database
    $stmt = $mysqli->prepare("UPDATE question SET question = ? WHERE ID = ?");
    $stmt->bind_param("si", $newQuestion, $questionID);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        die('Error: ' . $stmt->error);
    } else {
        echo '<script>alert("Question mise à jour !");</script>';
    }

    // Close the statement
    $stmt->close();
}

// Check if the form is submitted for deleting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteEntry"])) {
    $questionID = $_POST["questionID"];

    // Delete the entry from the database
    $stmt = $mysqli->prepare("DELETE FROM question WHERE ID = ?");
    $stmt->bind_param("i", $questionID);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        die('Error: ' . $stmt->error);
    } else {
        echo '<script>alert("Question supprimée !");</script>';
    }

    // Close the statement
    $stmt->close();
}

// Fetch questions from the database
$result = $mysqli->query("SELECT ID, question, type FROM question ORDER BY id DESC");

// Check for errors
if (!$result) {
    die('Error: ' . $mysqli->error);
}

// Fetch questions as an associative array
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the result set
$result->close();
?>