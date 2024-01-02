<?php session_start();
require_once('src/config_url.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();
}


if ($_SESSION['user_role'] != 'Administrateur') {
    header("Location: $_uc_manager");
    exit();
}

include_once('src/redirects.php');

$currentPage = 'admin_register';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        h2 {
            text-align: center;
            width: 100%;
        }

        input[type=button] {
            font-size: 15px;
            font-weight: bold;
            border-radius: 150px;
            background-color: #f93100;
            color: #fff;
            font-family: 'Arial';
            font-size: 14px;
            line-height: 20px;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            padding: 8px 30px;
            transition: all .3s ease;
            border: none;
            display: inline-block;
            margin: 9px 4px;
            white-space: nowrap;
            text-transform: none;
            letter-spacing: 0;
            cursor: pointer;
            /* width: 20%; */
            float: right;
        }

        input[type=button]:hover {
            color: #fcf6ef;
            background-color: #153C4A;
            border-color: #153C4A;
        }
    </style>
    <title>Nouveau gestionnaire</title>
</head>
<body style="padding-top: 70px;">
    <?php include_once(__DIR__.'/btn/navbar.php');?>

    <h2>Enregistrer un nouveau gestionnaire</h2>
    <form style="width:80%; margin:auto;" action="<?php echo $_src_process_register;?>" method="post">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" required><br>

        <label for="lastname">Nom</label>
        <input type="text" name="lastname" required><br>

        <label for="email">Email</label>
        <input type="mail" name="email" required><br>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" required><br>

        <label for="confirm_password">Confirmer le mot de passe</label>
        <input type="password" name="confirm_password" required><br>

        <label for="role">
            <input type="radio" name="role" value="Administrateur">
                Administrateur
            </label>
        <label for="role">
            <input type="radio" name="role" value="Manager" checked>
            Manager
        </label>

        <input type="submit" value="Confirmer l'enregistrement">
        <input type="button" onclick="redirectToAdminManager()" value="Retourner sur la gestion des utilisateurs"/>
    </form>
    
</body>
</html>