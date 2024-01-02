<?php session_start();
require_once('src/config_url.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>            
        h2{
            margin-top: 3.5em;
            width:100%;
            text-align: center;
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
    <title>Changer de mot de passe</title>
</head>
<body>
    <?php
    $currentPage = 'profile'; 
    include_once(__DIR__.'/src/redirects.php');
    include_once(__DIR__.'/btn/navbar.php');?>

    <h2>Changer de mot de passe</h2>

    <form style="width:80%; margin:auto;"action="<?php echo $_src_process_profile;?>" method="post">
    <label for="current_password">Mot de passe actuel</label>
        <input type="password" name="current_password" required><br>

        <label for="new_password">Nouveau mot de passe</label>
        <input type="password" name="new_password" required><br>

        <label for="confirm_password">Confirmer le nouveau mot de passe</label>
        <input type="password" name="confirm_password" required><br>
        
        <?php include_once('src/error-display.php');?>
        
        <input type="submit" value="Changer de mot de passe">
    </form>
    <input type="button" onclick="redirectToProfile()" value="Retourner sur le profil"/>

</body>
</html>