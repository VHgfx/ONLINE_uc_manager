<?php
session_start();

require_once('src/uc_management.php');
require_once('src/config_url.php');
require_once('src/redirects.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();
}

$currentPage = 'uc_manager';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Gestion des UCs</title>
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
        
        if ($_SESSION['user_role'] == 'Administrateur'){
            include_once(__DIR__.'/src/toggle_column.php');
        }
    ?>
    
    
    <?php include_once('error-display.php');?>

    <table id="table-1">    
        <tr>
            <td><input type="submit" onclick="redirectToCorrection()" value="Liste des corrections"></input></td>
        <?php
            if ($_SESSION['user_role'] == 'Administrateur') :?>
            <td><input type="submit" onclick="toggleEditQuestion()" value="Changer une question"></input></td>
            <td><input type="submit" onclick="toggleEditTypeColumn()" value="Changer le type d'une question"></input></td>
            <td><input type="submit" onclick="toggleDeleteColumn()" value="Supprimer une question"></input></td>
        <?php endif; ?>
            <td>
                <div class="center-container">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher dans le tableau" style="width:80%">
                </div>
            </td>
        </tr>
    </table>
    <table class="table-2">
        <colgroup id="colgroup-2">
            <col style="width: 3%"> <!-- First column --></col>
            <col style="width: 30%"> <!-- Second column --></col>
            <col style="width: 17%"> <!-- Third column --></col>
            <col style="width: 20%"></col>
        <?php
            if ($_SESSION['user_role'] == 'Administrateur') :?>
            <col class="hidden-question" style="width: 12%"></col>
            <col class="hidden-type" style="width: 8%"></col>
            <col class="hidden-column" style="width: 10%"></col>
        <?php endif;?>
        </colgroup>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Type</th>
            <th>Lien</th>
        <?php
            if ($_SESSION['user_role'] == 'Administrateur') :?>
            <th class="hidden-question">Modifier la question</th>
            <th class="hidden-type">Modifier le type</th>
            <th class="hidden-column">Supprimer</th>
        <?php endif;?>
        </tr>
        <?php foreach ($questions as $question): ?>
            
            <?php 
            $ucFolder = __DIR__;   
            $ucFolder = realpath($ucFolder);

            $questionId = $question['ID'];

            if ($ucFolder !== false) {
                // List of PHP files in the folder
                $quizFiles = glob($ucFolder . '/*.php');
            
                foreach ($quizFiles as $quizFile) {
                    // Read the content of the quiz file
                    $quizContent = file_get_contents($quizFile);
            
                    // Extract ID from the file content
                    preg_match('/addUser\(\$mail,\$firstname,\$lastname,\$text,\$result,(\d+)\);/s',
                        $quizContent,
                        $quizId);
            
                    $correctionId = isset($quizId[1]) ? $quizId[1] : null;
            
                    // Check if the ID in the file matches the question ID
                    if ($correctionId === $questionId) {
                        // The IDs match, output the file name
                        $fileName = basename($quizFile);
                        break; // Stop searching after finding a match
                    }
                }
            }?>
            <tr>
                <td><?= $question['ID']; ?></td>
                <td style="width: 40%"><?= $question['question']; ?></td>
                <td><?= $question['type']; ?></td>
                <td><a target="_blank" href="<?= $_root; ?><?= $fileName; ?>"><?= $_root; ?><?= $fileName; ?></a></td>
                <?php
                if ($_SESSION['user_role'] == 'Administrateur') :?>
                <td class="hidden-question">
                    <form method="POST" action="" onsubmit="return confirm('Êtes-vous sûr de vouloir changer l\'énoncé de cette question ?');">
                        <input type="hidden" name="questionID" value="<?= $question['ID']; ?>">
                        <input type="text" name="newQuestion" placeholder="Nouvelle question" required>
                        <button type="submit">Changer la question <?= $question['ID']; ?></button>
                    </form>
                </td>
                <td class="hidden-type">
                    <form method="POST" action="" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le type de cette question ?');" id="typeForm_<?= $question['ID']; ?>">
                        <input type="hidden" name="questionID" value="<?= $question['ID']; ?>">
                        <input type="text" id="edittype_<?= $question['ID']; ?>" name="newType" placeholder="Nouveau type" oninput="validateType(<?= $question['ID']; ?>)" pattern="[a-z0-9_]+" required>
                        <span id="typeError_<?= $question['ID']; ?>" style="color: red;"></span>
                        <button type="submit" id="submitType_<?= $question['ID']; ?>" >Changer le type <?= $question['ID']; ?></button>
                    </form>
                </td>
                <td class="hidden-column">
                    <form method="POST" action="" onsubmit="return confirm('Ceci va supprimer DÉFINITIVEMENT cette question, êtes-vous sûr de vouloir continuer ?');">
                        <input type="hidden" name="questionID" value="<?= $question['ID']; ?>">
                        <button type="submit" name="deleteEntry">Supprimer la question <?= $question['ID']; ?></button>
                    </form>
                </td>
                <?php endif;?>
            </tr>
        <?php endforeach; ?>
    </table>

    <script> 
       
       function validateType(questionID) {
            var newTypeInput = document.getElementById('edittype_' + questionID);
            var typeErrorSpan = document.getElementById('typeError_' + questionID);
            var submitButton = document.getElementById('submitType_' + questionID);

            var isValid = /^[a-z0-9_-]+$/.test(newTypeInput.value);

            if (!isValid) {
                typeErrorSpan.innerText = 'Le type doit contenir uniquement des minuscules, des chiffres, des tirets et des underscores.';
                submitButton.disabled = true;
            } else {
                typeErrorSpan.innerText = '';
                submitButton.disabled = false;
            }

            return isValid;
        }

    </script>
</body>
</html>