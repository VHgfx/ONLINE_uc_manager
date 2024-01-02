
    <?php   
    require_once (__DIR__.'/../db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $motsCles1 = array("observer");
            $motsCles2 = array("communication");
            $motsCles3 = array("identifier");
            $motsCles4 = array("positionnement");
            $motsCles5 = array("avertissement");
            $motsCles6 = array("évaluation");
            $motsCles7 = array("intervention physique");
            $motsCles8 = array("maintien sécurité");
            $motsCles9 = array("coopération");
            $motsCles10 = array("situation");
            $motsCles11 = array("intercepter");
            $motsCles12 = array("arrêter");
            $motsCles13 = array("maîtriser");
            $motsCles14 = array("menace");
            $motsCles15 = array("témoignage");
            $motsCles16 = array("distance");
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


        addUser($mail,$firstname,$lastname,$text,$result,65); //Mettre ID en base de donnée

    }
    ?>

    <!DOCTYPE html>
    <html>
    
    <head>
    <link rel="stylesheet" href="../assets/css/style2.css" media="screen" type="text/css" />
        <title>Intervention en extérieur</title> 
    </head>

    <?php if(empty($_POST["cover"])){ ?>
    <body class="count-quest">
        <div class="container-quest">
            <form class="form-quest" method="POST" action="">
                <!-- Changer la question -->
                <h1>Vous êtes en faction devant un batiment administratif.. Soudain, vous entendez des cris et plusieurs personnes pointent un individu qui court avec un objet en cuir noir dans la main. Il va passer juste à côté de vous. Décrivez ce que vous faites étape par étape</h1>

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
                            <p id="correction">Observation : D'abord, je reste attentif à mon environnement en tant qu'agent de sécurité, évaluant la situation normale autour du bâtiment administratif.
Réaction aux cris : Lorsque j'entends des cris, je me tourne immédiatement dans la direction du bruit pour identifier la source du problème.
Identification de l'individu : En repérant l'individu qui court, je m'efforce de déterminer s'il représente une menace potentielle en évaluant son comportement et l'objet en cuir noir qu'il tient.
Communication : J'appelle immédiatement  le poste de sécurité pour informer mes collègues de la situation et demander un renfort si nécessaire.
Positionnement : Je me positionne de manière à intercepter l'individu en fuite tout en maintenant une distance de sécurité, prêt à réagir en fonction de son comportement.
Avertissement verbal : Je lui ordonne de s'arrêter immédiatement en utilisant un avertissement verbal fort et clair, indiquant que je suis un agent de sécurité.
Évaluation de la situation : Pendant que l'individu approche, je continue d'évaluer la situation pour déterminer s'il représente une menace réelle et s'il y a des mesures spécifiques à prendre.
Intervention physique si nécessaire : Si l'individu ignore l'avertissement et semble représenter une menace, j'interviens physiquement pour le maîtriser en utilisant les techniques appropriées.
Maintien de la sécurité : Une fois l'individu maîtrisé, je m'assure que la situation est sécurisée et qu'il n'y a pas d'autres menaces imminentes.
Coopération avec les autorités : Je coopère avec les autorités compétentes, fournissant des informations sur l'incident et apportant mon témoignage si nécessaire.
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