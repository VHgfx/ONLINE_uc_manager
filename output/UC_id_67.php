
    <?php   
    require_once (__DIR__.'/../db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $motsCles1 = array("Observer");
            $motsCles2 = array("Communiquer");
            $motsCles3 = array("Evaluer");
            $motsCles4 = array("Positionner");
            $motsCles5 = array("Appel");
            $motsCles6 = array("Renforts");
            $motsCles7 = array("Suivi");
            $motsCles8 = array("Informations");
            $motsCles9 = array("Coopérer");
            $motsCles10 = array("Discrètement");
            $motsCles11 = array("Attentif");
            $motsCles12 = array("Radio");
            $motsCles13 = array("Description");
            $motsCles14 = array("Arme");
            $motsCles15 = array("Critique");
            $motsCles16 = array("Nombre");
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


        addUser($mail,$firstname,$lastname,$text,$result,67); //Mettre ID en base de donnée

    }
    ?>

    <!DOCTYPE html>
    <html>
    
    <head>
    <link rel="stylesheet" href="../assets/css/style2.css" media="screen" type="text/css" />
        <title>Ronde de sécurité</title> 
    </head>

    <?php if(empty($_POST["cover"])){ ?>
    <body class="count-quest">
        <div class="container-quest">
            <form class="form-quest" method="POST" action="">
                <!-- Changer la question -->
                <h1> Il est 23h30. Vous êtes en ronde dans une usine de papéterie. Vous entendez un bruit du côté du service comptabilité et en vous approchant discrètement, vous voyez de loin 2 personnes armées qui sortent d'un bureau et se dirigent vers la sortie. Décirvez ce que vous faites, étape par étape</h1>

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
                            <p id="correction">Observation : En entendant le bruit, je me dirige discrètement vers le service comptabilité, en restant attentif à mon environnement.
Identification des individus : En m'approchant, j'essaie d'identifier le nombre de personnes et si elles portent des armes.
Communication : Si possible, j'utilise ma radio pour informer immédiatement le poste de sécurité de l'usine de la situation, en fournissant des détails sur le nombre d'individus et le fait qu'ils soient armés.
Évaluation de la menace : J'évalue rapidement la menace que représentent ces individus armés et détermine s'ils semblent dangereux.
Positionnement : Je me positionne de manière à rester hors de leur vue tout en continuant à observer leurs actions.
Évitement : Si possible, j'évite de me faire repérer tout en continuant de surveiller les individus.
Appel aux renforts : Si la situation semble critique, j'appelle immédiatement des renforts en utilisant la radio.
Suivi : Si les individus continuent vers la sortie, je les suis à une distance sûre, tout en maintenant le contact radio avec le poste de sécurité.
Recueil d'informations : J'essaie de recueillir des informations supplémentaires, telles que la description des individus, pour aider les autorités à intervenir.
Coopération avec les forces de l'ordre : Une fois que les renforts ou les forces de l'ordre sont sur place, je coopère avec eux en fournissant toutes les informations nécessaires.
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