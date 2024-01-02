<?php require_once(__DIR__.'/../src/config_url.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style> 
        .navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #193D4A;
            padding: 1px;
            color: #fff;
            position: fixed;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }


        .navbar a.current {
            color: #f93100;
            pointer-events: none;
        }

        .user-info {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div>
            <a href="<?php echo $_uc_generator;?>" class="<?php echo $currentPage === 'uc_generator' ? 'current' : '';?>">Créer une question</a>
            <a href="<?php echo $_uc_manager;?>" class="<?php echo $currentPage === 'uc_manager' ? 'current' : '';?>">Gérer les questions</a>
            <?php
            if ($_SESSION['user_role'] == 'Administrateur') :?>
                <a href="<?php echo $_user_manager;?>" class="<?php echo $currentPage === 'user_manager' ? 'current' : '';?>">Gérer les administrateurs / managers</a>
            <?php endif;?>
        </div>
        <div class="user-info">
        <a href="<?php echo $_profile;?>" class="<?php echo $currentPage === 'profile' ? 'current' : '';?>"><?php echo "Mon compte : ".$_SESSION['firstname']." ".$_SESSION['lastname']; ?></a>
        </div>
        <?php include_once(__DIR__.'/btn-logout.php'); ?>
    </div>
</body>
</html>