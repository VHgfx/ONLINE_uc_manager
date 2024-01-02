<?php
session_start();
require_once(__DIR__.'/../db.php'); 
require_once('config_url.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, firstname, lastname, email, password, reg_date, user_role FROM Admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $firstname, $lastname, $dbEmail, $dbPassword, $reg_date, $user_role);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
            // Password is correct
            
            $_SESSION['id'] = $id;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['email'] = $dbEmail;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $dbEmail;
            $_SESSION['user_role'] = $user_role;
            $_SESSION['reg_date'] = date("d-m-Y", strtotime($reg_date));
            header("Location: $_uc_manager"); // Redirect to the dashboard or any other page
            exit();
            

        } else {
            // echo "Mot de passe incorrect";

            // Current password is incorrect
            $_SESSION['error'] = "Mot de passe incorrect";
            header("Location: $_admin_login");
            exit();
        }
    } else {
        // echo "L'utilisateur n'existe pas";

        $_SESSION['error'] = "L'utilisateur n'existe pas";
        header("Location: $_admin_login");
        exit();
    }

    $stmt->close();
}
