<?php session_start();
require_once('src/config_url.php');

if (isset($_SESSION['user_id'])) {
    header("Location: $_uc_manager");
    exit();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>      
    
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 20em;
            margin: 0;
        }
        form{
            width: 80%;
            margin: auto;
        }

        h2{
            margin-top: 30px;
        }
    </style>
    <title>Connexion administrateur</title>
</head>
<body>
    <h2>Connexion</h2>
    <form action="<?php echo $_src_process_login;?>" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Se connecter">
        <?php include_once('src/error-display.php');?>
    </form>
</body>
</html>