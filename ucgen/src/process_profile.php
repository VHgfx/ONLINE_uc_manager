<?php session_start();
require_once('config_url.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();

}
require_once (__DIR__.'/../db.php');
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate the current password
    $stmt = $mysqli->prepare("SELECT password FROM Admins WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($dbPassword);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($current_password, $dbPassword)) {
        // Current password is incorrect
        $_SESSION['error'] = "Mot de passe actuel incorrect";
        header("Location: $_change_password");
        exit();
    }

    // Validate the new password
    if ($new_password !== $confirm_password) {
        // New passwords do not match
        $_SESSION['error'] = "Les mots de passe ne correspondent pas";
        header("Location: $_change_password");
        exit();
    }

    // Update the password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_stmt = $mysqli->prepare("UPDATE Admins SET password = ? WHERE id = ?");
    $update_stmt->bind_param("si", $hashed_password, $user_id);
    $update_stmt->execute();
    $update_stmt->close();

    $_SESSION['success'] = "Mot de passe mis à jour !";
    header("Location: $_change_password");
    exit();
} else {
    // Redirect to the profile page if accessed directly without submitting the form
    header("Location: $_profile");
    exit();
}

