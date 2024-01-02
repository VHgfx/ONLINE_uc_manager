<?php
session_start();

require_once('src/config_url.php');
require_once('src/redirects.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();
}

$currentPage = 'uc_correction';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Liste des corrections</title>
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

        .table-2{
            margin-top: 6em;
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
    </style>
</head>

<body style="padding-top: 70px;">
    <?php 
        include_once(__DIR__.'/btn/navbar.php');
        include_once(__DIR__.'/src/search.php');
    ?>
    
    
    <?php include_once('error-display.php');?>


    <table id="table-1">    
            <tr>
                <td style="width:30%">
                    <div style="margin-left:20%">    
                        <input type="submit" onclick="redirectToManagement()" value="Retour à la gestion des UC"></input>
                    </div>
                </td>
                <td style="width:50%">                     
                    <div class="center-container" style="margin-right: 20%"> 
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher dans le tableau"></input>
                    </div>
                </td>
            </tr>
        </div>
    </table>

    <table class="table-2">
        <colgroup id="colgroup-2">
            <col style="width: 3%"> <!-- First column --></col>
            <col style="width: 25%"> <!-- Second column --></col>
            <col style="width: 50%"> <!-- Third column --></col>
        </colgroup>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Réponse</th>
        </tr>
        <?php include(__DIR__.'/src/correction_reader.php'); ?>
    </table>
</body>
</html>