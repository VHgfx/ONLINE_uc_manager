
    <?php   
    require_once (__DIR__.'/../db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $motsCles1 = array("extincteur");
            $motsCles2 = array("contrôle visuel");
            $motsCles3 = array("dos de la main");
            $motsCles4 = array("porte chaude");
            $motsCles5 = array("évacue");
            $motsCles6 = array("refroidir");
            $motsCles7 = array("robinet");
            $motsCles8 = array("incendie");
            $motsCles9 = array("dégoupille");
            $motsCles10 = array("percute");
            $motsCles11 = array("prévenir");
            $motsCles12 = array("localise");
            $motsCles13 = array("feu");
            $motsCles14 = array("victime");
            $motsCles15 = array("dégagement");
            $motsCles16 = array("urgence");
    // Fonction pour supprimer les accents d'une chaîne de caractères
    function supprimerAccents($string)
    {
        return str_replace(
            array('à', 'â', 'ä', 'á', 'ã', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'ö', 'õ', 'ø', 'œ', 'ß', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'),
            array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'oe', 'ss', 'u', 'u', 'u', 'u', 'y', 'y'),
            $string
        );
    }
    // Retirer les accents du tableau de mots clés
    //Convertir le tableau de mots clés en mots minuscules.

    function processMotsCles(&$motsCles)
    {
        $motsCles = array_map('supprimerAccents', $motsCles);
        $motsCles = array_map('mb_strtolower', $motsCles);
    }

    foreach (range(1, 16) as $index)
    {
        $currentMotsCles = ${"motsCles".$index};
        processMotsCles($currentMotsCles);
    }
    
    // Vérifier si le formulaire a été soumis

        // Récupérer le texte du textarea
        $texte = $_POST['textarea'];
        // Retirer les accents du texte récupéré dans le textarea
        $texte = supprimerAccents($texte);
        // Convertir le texte récupéré en minuscule
        $texte = mb_strtolower($texte);


    // var_dump($texte);

        // Initialiser le compteur
        $compteur = 0;
        


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
        
        
        
        // Afficher le résultat

        $result = (($compteur / 16) * 2)*100;


        if($result > 100){
            $result = 100;
        }


        $mail = $_POST['mail'];

        $text = $texte;

        $lastname = $_POST['lastname'];

        $firstname = $_POST['firstname'];


        addUser($mail,$firstname,$lastname,$text,$result,63); //Mettre ID en base de donnée

    }
    ?>

    <!DOCTYPE html>
    <html>
    
    <head>
    <link rel="stylesheet" href="../assets/css/style2.css" media="screen" type="text/css" />
        <title>La levée de doute</title> 
    </head>

    <?php if(empty($_POST["cover"])){ ?>
    <body class="count-quest">
        <div class="container-quest">
            <form class="form-quest" method="POST" action="">
                <!-- Changer la question -->
                <h1>Décrivez en détail les différentes étapes d'une levée de doute en cas de détection incendie dans un local fermé. </h1>

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
                        echo("Vous avez obtenu moins de 70%, n'hésitez pas à revoir le cours.");?>
                    <br>
                        <a href=javascript:history.go(-1) class="validbutton">Rééssayer</a>

            <?php   }
            elseif ($result >= 70) {
                    echo('Félicitations, vous maitrisez les fondamentaux de ce sujet.');?>
                            <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Correction (Cliquer pour Voir / Cacher)
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p id="correction">Dans un premier temps l'agent va se rendre sur les lieux de la détection et une fois arrivé sur place, il avertira le PC par communication radio et réitérera cette manœuvre lors des différentes étapes de la levée de doute. Ensuite, l'agent va se munir de l'extincteur le plus proche.
Une fois muni de ce dernier, l'agent va procéder dans un premier temps à un contrôle visuel de la porte. Si celui-ci ne révèle aucune anomalie, l'agent palpera la porte du dos de la main, de bas en haut, sans oublier la poignée. Un point de vigilance est à noter quant à cette dernière, il ne faut surtout pas la prendre à pleine main au risque de se retrouver dans l'incapacité de pouvoir retirer sa main si elle est brûlante. L'agent réalisera aussi un appel à la voix.

Suite à ce contrôle, l'agent peut se retrouver face à deux situations :

(1) Dans le premier cas, la porte est chaude : l'agent ne doit rentrer en aucun cas dans la pièce. Il devra alerter immédiatement le PC afin de demander l'évacuation et l'intervention des sapeurs-pompiers. L'agent demandera aussi un renfort afin de baliser la zone. Mais ces missions ne s'arrêtent pas là dans cette situation. Il doit aussi refroidir la porte et pour cela, il est préconisé qu'il utilise un robinet d'incendie armé en jet diffusé et si cela n'est pas possible, il utilisera des extincteurs à eau pulvérisée. Dans tous les cas, il devra se placer à une distance d'attaque de 3 m. Il est aussi important que l'agent connaisse le matériel à préparer pour l'arrivée des secours, en l'occurrence les plans d'intervention, les clés et badges ainsi que les radios.

(2) Dans le deuxième cas, la porte est tiède ou froide : l'agent devra dégoupiller, percuter et tester l'extincteur. Il devra prévenir le PC avant de s'engager et d'entrer. Pour rentrer, il devra ouvrir délicatement la porte sans se mettre dans l'ouverture, pour cela il se mettra derrière un des murs encadrant la porte et ouvrira la porte en deux étapes. Il ouvrira très légèrement la porte de quelques centimètres puis après avoir attendu quelques secondes il pourra l'ouvrir suffisamment pour pouvoir entrer dans la pièce. À ce moment-là, il devra localiser le feu et réaliser un appel à la voix.
	
S'il constate la présence d'une victime, celle-ci deviendra sa priorité et il devra réaliser un dégagement d'urgence afin de la sortir de la pièce pour la mettre en sécurité. Après être sortie avec la victime, il fermera la porte et demandera un renfort à la radio avant de prendre en charge la victime et de réaliser les gestes de secours que pourrait nécessiter son état.

S’il n'y a pas de victime, l'agent progressera accroupi dans la pièce afin de se rapprocher à deux trois mètres du feu et de vider la totalité de l'extincteur sur la base des flammes. Une fois le foyer maîtrisé, l'agent couchera l'extincteur vide et procédera au désenfumage de la pièce. S'il s'agissait d'un feu de poubelle, il évacuera la poubelle. Ensuite, il effectuera une reconnaissance de la zone sinistrée et avertira le PC par communication radio de la situation. Il demandera des renforts afin de procéder au balisage de la zone et l'intervention de l'équipe de nettoyage.

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
        <script src="assets/js/script.js"></script>