<?php
session_start();

require_once ('../db.php');
require_once('redirects.php');
require_once('config_url.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Your SELECT query to get the last ID
    $result = $mysqli->query("SELECT id FROM question ORDER BY id DESC LIMIT 1");

    // Check for errors
    if (!$result) {
        die('Error: ' . $mysqli->error);
    }

    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Last ID + Incrementation
    $id = ++$row['id'];

    // Free the result set
    $result->free();

    // Get the motsCles from the form
    //
    $title = $_POST["edittitle"];

    for($index = 1; $index<=16; $index++){
        $currentMotsCles = $_POST["editmc".$index];
        if (!empty($currentMotsCles)){
            ${"motsCles".$index} = explode(',',$currentMotsCles);
            ${"motsCles" . $index} = array_map('trim', ${"motsCles" . $index});
        }
    }
    


    $question = $_POST["editquestion"];
    $correction = $_POST['editcorrection'];

    // Code à injecter dans le new UC
    $phpFileContent = "
    <?php   
    require_once (__DIR__.'/db.php');

    ".'if ($_SERVER["REQUEST_METHOD"] == "POST") {';

        // Modifier les mots clés

        for ($index = 1; $index <= 16; $index++) {
            $phpFileContent .= '
            $motsCles'.$index.' = array("'.implode('", "', ${"motsCles" . $index}).'");';
        }
        
        /*$motsCles1 = array("'.$motsCles1.'");
        $motsCles2 = array("'.$motsCles2.'");
        $motsCles3 = array("'.$motsCles3.'");
        $motsCles4 = array("'.$motsCles4.'");
        $motsCles5 = array("'.$motsCles5.'");
        $motsCles6 = array("'.$motsCles6.'");
        $motsCles7 = array("'.$motsCles7.'");
        $motsCles8 = array("'.$motsCles8.'");
        $motsCles9 = array("'.$motsCles9.'");
        $motsCles10 = array("'.$motsCles10.'");
        $motsCles11 = array("'.$motsCles11.'");
        $motsCles12 = array("'.$motsCles12.'");
        $motsCles13 = array("'.$motsCles13.'");
        $motsCles14 = array("'.$motsCles14.'");
        $motsCles15 = array("'.$motsCles15.'");
        $motsCles16 = array("'.$motsCles16.'");*/

        
        $phpFileContent .="
    // Fonction pour supprimer les accents d'une chaîne de caractères
    function supprimerAccents(\$string)
    {
        return str_replace(
            array('à', 'â', 'ä', 'á', 'ã', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'ö', 'õ', 'ø', 'œ', 'ß', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'),
            array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'oe', 'ss', 'u', 'u', 'u', 'u', 'y', 'y'),
            \$string
        );
    }
    // Retirer les accents du tableau de mots clés
    //Convertir le tableau de mots clés en mots minuscules.

    function processMotsCles(&\$motsCles)
    {
        \$motsCles = array_map('supprimerAccents', \$motsCles);
        \$motsCles = array_map('mb_strtolower', \$motsCles);
    }

    foreach (range(1, 16) as \$index)
    {".'
        $currentMotsCles = ${"motsCles".$index};
        processMotsCles($currentMotsCles);
    }
    '."
    // Vérifier si le formulaire a été soumis

        // Récupérer le texte du textarea
        \$texte = \$_POST['textarea'];
        // Retirer les accents du texte récupéré dans le textarea
        \$texte = supprimerAccents(\$texte);
        // Convertir le texte récupéré en minuscule
        \$texte = mb_strtolower(\$texte);


    // var_dump(\$texte);

        // Initialiser le compteur
        \$compteur = 0;
        ".'


        // Vérifier chaque mot-clé prédéfini dans le texte   
        foreach (range(1,16) as $index){
            $currentMotsCles = ${"motsCles".$index};
            if (!empty($currentMotsCles)){
                foreach($currentMotsCles as $currentMotCle){
                    if (stripos($texte, $currentMotCle) !== false){
                        $compteur++;
                    }
                }
            }
        }
        
        
        '."
        // Afficher le résultat

        \$result = ((\$compteur / 16) * 2)*100;


        if(\$result > 100){
            \$result = 100;
        }


        \$mail = \$_POST['mail'];

        \$text = \$texte;

        \$lastname = \$_POST['lastname'];

        \$firstname = \$_POST['firstname'];


        addUser(\$mail,\$firstname,\$lastname,\$text,\$result,".$id."); //Mettre ID en base de donnée

    }
    ?>

    <!DOCTYPE html>
    <html>
    ".'
    <head>
    <link rel="stylesheet" href="assets/css/style2.css" media="screen" type="text/css" />
        <title>'.$title.'</title> 
    </head>

    <?php if(empty($_POST["cover"])){ ?>
    <body class="count-quest">
        <div class="container-quest">
            <form class="form-quest" method="POST" action="">
                <!-- Changer la question -->
                <h1>'.$question.'</h1>

                <input type="mail" placeholder="Adresse e-mail" name="mail" required />
                <br>
                <input type="text" placeholder="Nom de famille" name="lastname" required />
                <br>
                <input type="text" placeholder="Prénom" name="firstname" required />
                <?php echo $message_info; ?>
                <textarea placeholder="Saisir la réponse ici" name="textarea" minlength="500" required></textarea>
                <br>
                <input type="submit" name="cover" value="Valider">
            </form>
        </div>

    </body>
    <?php }else{
    ?>
        <section class="bg"></section>
        <div class="loading-text" id="loading-text">Analyse des travaux en cours 0% </div>
        <div class="container-quest" id="h1">
            <form class="form-quest" method="POST" action="">
                <h1><?="Votre score est de : " . round($result) . "%";?><h1>
                <?php
                if($result < 70) {
                        echo("Vous avez obtenu moins de 70%, '."n'hésitez pas à revoir le cours.".'");?>
                    <br>
                        <a href=javascript:history.go(-1) class="validbutton">Rééssayer</a>

            <?php   }
            elseif ($result >= 70) {'."
                    echo('Félicitations, vous maitrisez les fondamentaux de ce sujet.');?>".'
                            <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Correction (Cliquer pour Voir / Cacher)
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p id="correction">'
                            .$correction.'
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
            <?php  }?>
        </div>
            </form>
    <?php
    } ?>
        <script src="assets/js/script.js"></script>';

    // -------------- Vérification si existe -------------------------

    $type = $_POST["edittype"];

    $selectQuery = "SELECT id FROM question WHERE type = ?";
    $selectStmt = $mysqli->prepare($selectQuery);
    $selectStmt->bind_param("s", $type);
    $selectStmt->execute();
    $selectStmt->store_result();

    if ($selectStmt->num_rows > 0) {
        echo "Le type existe déjà ! Veuillez en choisir un autre.";
        
    } else {

        // ----------------- Insertion dans BDD ------------------------------
        $stmt = $mysqli->prepare("INSERT INTO question (id, question, type) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id, $question, $type);
        $stmt->execute();

        // Check for errors
        if ($stmt->error) {
            die('Error: ' . $stmt->error);
        } else {

            ?>
            <head>
                <link rel="stylesheet" href="../assets/css/style.css">
            </head>
            <style>
                #generator-success {
                    background-color: #dff0d8;
                    border: 1px solid #d6e9c6;
                    color: #3c763d;
                    padding: 15px;
                    margin: 50px;
                    text-align: center;
                    margin-bottom: 20px;
                    border-radius: 4px;
                }
            </style>
            <body>
                <div id="generator-success">
                    <p>Insertion de la question dans la base de données réussie !</p>
                    <p><a style="text-decoration: underline;" target="_blank" href="https://lgx-creation.com/virgo/<?= $type; ?>.php">Lien</a> de votre question : <?php echo $type; ?></p>
                    <p>https://lgx-creation.com/virgo/<?= $type; ?>.php</p>
                    
                    <button onclick="redirectToManagement()">Retourner à la gestion des questions</button>
                </div>
            </body>
            <?php 
            // -------------- Save the generated PHP file ------------------------

            $filename = __DIR__."/../".$type.".php";    
            $fileHandle = fopen($filename,'w');

            if($fileHandle){
                fwrite($fileHandle, $phpFileContent);
                fclose($fileHandle);
            }
        }

        // Close the statement
        $stmt->close();
    }
} else {
    echo "Invalid request!";
}