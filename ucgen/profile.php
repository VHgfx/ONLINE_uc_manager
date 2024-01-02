<?php session_start();
require_once('src/config_url.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();

}

include_once('src/redirects.php');
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
            float: left;
        }

        input[type=button]:hover {
            color: #fcf6ef;
            background-color: #153C4A;
            border-color: #153C4A;
        }
    </style>
    <title>Votre profil</title>
</head>
<?php
    $currentPage = 'profile'; 
    include_once(__DIR__.'/btn/navbar.php');?>
<body>


    <h2>Votre profil</h2>
    
    <div style="width:45%; margin:auto">
        <p><strong>Prénom :</strong> <?php echo $_SESSION['firstname']; ?></p>
        <p><strong>Nom :</strong> <?php echo $_SESSION['lastname']; ?></p>
        <p><strong>Email :</strong> <?php echo $_SESSION['email']; ?></p>
        <p>Vous êtes inscrit depuis le  <strong><?php echo $_SESSION['reg_date']; ?></strong></p>
        <p>Vous êtes un <strong><?php echo $_SESSION['user_role']; ?></strong></p>
        <input type="button" onclick="redirectToChangePassword()" value="Changer mon mot de passe">

    </div>

</body>
</html>