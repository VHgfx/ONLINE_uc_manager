<?php
session_start();
require_once(__DIR__.'/src/user_management.php');
require_once(__DIR__.'/src/config_url.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();
}

if ($_SESSION['user_role'] != 'Administrateur') {
    header("Location: $_uc_manager");
    exit();
}

include_once('src/redirects.php');

$currentPage = 'user_manager';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Gestion des utilisateurs</title>
    <style>
        .center-container{
            text-align: center;
        }

        h2 {
            text-align: center;
            width: 100%;

            display: block;
            font-size: 1.5em;
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;

        }

        table{
            table-layout: fixed;
            width: 80%;
            border-collapse: collapse;    
            margin: auto;
        }

        body{
            margin-top: 3.5em;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: normal;
        }

        colgroup {
            width: 100%;
        } 

        .hidden-column {
            display: none;
        }

        .hidden-type {
            display: none;
        }

        .hidden-question {
            display: none;
        }

        #table-1 input[type=submit]{
            display: block;
            float:none;
            margin: 0 auto;
        }

        #table-1{
            position: fixed;
            top: 3.5em;
            height: 2em;
            z-index: 999;
            width: 100%;
            padding: 0;
        }

        .inner-form{
            margin:0;
            padding:0;
        }

        .error-message{
            top: 6em;
            width: 100%;
            text-align: center;
        }

    </style>
</head>

<body style="padding-top: 70px;">
    <?php 
        include_once(__DIR__.'/btn/navbar.php');
        include_once(__DIR__.'/src/search.php');
        
        if ($_SESSION['user_role'] == 'Administrateur'){
            include_once(__DIR__.'/src/toggle_column.php');
        } 
    ?>
    
    <table id="table-1">    
        <tr>
        <td><input type="submit" onclick="redirectToAdminRegister()" value="Ajouter un gestionnaire"></input></td>
            <td><input type="submit" onclick="toggleEditQuestion()" value="Changer le rôle d'une personne"></input></td>
            <td><input type="submit" onclick="toggleDeleteColumn()" value="Supprimer un gestionnaire"></input></td>
            <td><div class="center-container">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher dans les tableaux" style="width:80%">
                </div>
            </td>
        </tr>
    </table>

    <h2>Gérer les administrateurs</h2>
    <table class="table-2">
        <colgroup>
            <col style="width: 20%"> <!-- First column --></col>
            <col style="width: 20%"> <!-- Second column --></col>
            <col style="width: 30%"> <!-- Third column --></col>
            <col style="width: 15%" class="hidden-question"></col>
            <col style="width: 15%" class="hidden-column"></col>
        </colgroup>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th class="hidden-question">Changer le rôle</th>
            <th class="hidden-column">Supprimer l'administrateur</th>

        </tr>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?= $admin['firstname']; ?></td>
                <td><?= $admin['lastname']; ?></td>
                <td><?= $admin['email']; ?></td>
                <td class="hidden-question">
                    <form class="inner-form" method="POST" action="" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le rôle ?');">
                        <input type="hidden" name="admin_id" value="<?= $admin['id']; ?>">
                        <label for="admin_<?= $admin['id']; ?>">
                            <input type="radio" id="admin_<?= $admin['id']; ?>" name="new_role" value="Administrateur" <?= ($admin['user_role'] == 'Administrateur') ? 'checked' : ''; ?>>
                            Administrateur
                        </label>
                        <label for="manager_<?= $admin['id']; ?>">
                            <input type="radio" id="manager_<?= $admin['id']; ?>" name="new_role" value="Manager" <?= ($admin['user_role'] == 'Manager') ? 'checked' : ''; ?>>
                            Manager
                        </label>
                        <button type="submit">Changer le rôle</button>
                    </form>
                </td>
                <td class="hidden-column">
                    <form class="inner-form" method="POST" action="" onsubmit="return confirm('Ceci va supprimer DÉFINITIVEMENT cet utilisateur, êtes-vous sûr de vouloir continuer ?');">
                        <input type="hidden" name="userID" value="<?= $admin['id']; ?>">
                        <button type="submit" name="deleteUser">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


    <h2>Gérer les managers</h2>
    <table class="table-2">
        <colgroup>
            <col style="width: 20%"> <!-- First column --></col>
            <col style="width: 20%"> <!-- Second column --></col>
            <col style="width: 30%"> <!-- Third column --></col>
            <col style="width: 15%" class="hidden-question"></col>
            <col style="width: 15%" class="hidden-column"></col>

        </colgroup>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th class="hidden-question">Changer le rôle</th>
            <th class="hidden-column">Supprimer le manager</th>
        </tr>
        <?php foreach ($managers as $manager): ?>
            <tr>
                <td><?= $manager['firstname']; ?></td>
                <td><?= $manager['lastname']; ?></td>
                <td><?= $manager['email']; ?></td>
                <td class="hidden-question">
                    <form class="inner-form" method="POST" action="" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le rôle ?');">
                        <input type="hidden" name="admin_id" value="<?= $manager['id']; ?>">
                        <label for="admin_<?= $manager['id']; ?>">
                            <input type="radio" id="admin_<?= $manager['id']; ?>" name="new_role" value="Administrateur" <?= ($manager['user_role'] == 'Administrateur') ? 'checked' : ''; ?>>
                            Administrateur
                        </label>
                        <label for="manager_<?= $manager['id']; ?>">
                            <input type="radio" id="manager_<?= $manager['id']; ?>" name="new_role" value="Manager" <?= ($manager['user_role'] == 'Manager') ? 'checked' : ''; ?>>
                            Manager
                        </label>
                        <button type="submit">Changer le rôle</button>
                    </form>
                </td>
                <td class="hidden-column">
                    <form class="inner-form" method="POST" action="" onsubmit="return confirm('Ceci va supprimer DÉFINITIVEMENT cet utilisateur, êtes-vous sûr de vouloir continuer ?');">
                        <input type="hidden" name="userID" value="<?= $manager['id']; ?>">
                        <button type="submit" name="deleteUser">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>