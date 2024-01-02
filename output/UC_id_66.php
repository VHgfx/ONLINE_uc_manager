
    <?php   
    require_once (__DIR__.'/../db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $motsCles1 = array("agent de sécurité");
            $motsCles2 = array("fumer");
            $motsCles3 = array("interdit");
            $motsCles4 = array("réglementation");
            $motsCles5 = array("monsieur");
            $motsCles6 = array("cigare");
            $motsCles7 = array("violation");
            $motsCles8 = array("restaurant");
            $motsCles9 = array("environnement");
            $motsCles10 = array("confort");
            $motsCles11 = array("éteindre");
            $motsCles12 = array("autorité");
            $motsCles13 = array("police");
            $motsCles14 = array("pacifique");
            $motsCles15 = array("situation");
            $motsCles16 = array("coopérer");
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


        addUser($mail,$firstname,$lastname,$text,$result,66); //Mettre ID en base de donnée

    }
    ?>

    <!DOCTYPE html>
    <html>
    
    <head>
    <link rel="stylesheet" href="../assets/css/style2.css" media="screen" type="text/css" />
        <title>Incivilité au restaurant</title> 
    </head>

    <?php if(empty($_POST["cover"])){ ?>
    <body class="count-quest">
        <div class="container-quest">
            <form class="form-quest" method="POST" action="">
                <!-- Changer la question -->
                <h1>Vous êtes assis dans une salle de restaurant et il y a 2 tables plus loin une personne imposante qui fume un cigare. Il est clair que cela indispose certaines personnes. Vous vous levez pour demander à cette personne d'arrêter de fumer dans cet endroit clos mais le fumeur n'est pas d'accord. Imaginez la conversation entre vous et cette personne tout en respectant les articles du CPP que nous venons de voir. </h1>

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
                            <p id="correction">Agent de sécurité : Excusez-moi, monsieur, je suis l'agent de sécurité de cet établissement. Fumer à l'intérieur est interdit, conformément aux réglementations locales et aux articles du Code de la Santé Publique. Pouvez-vous éteindre votre cigare, s'il vous plaît?
Fumeur : Pourquoi devrais-je éteindre mon cigare? Je ne vois pas pourquoi ça pose problème.
Agent de sécurité : Je comprends, monsieur, cependant, c'est une violation des règles du restaurant et cela perturbe le confort des autres clients. Nous devons tous respecter les lois et les politiques en place pour assurer un environnement agréable à tous.
Fumeur : Je m'en fiche des règles de votre restaurant. Je peux fumer où je veux.
Agent de sécurité : Je comprends que cela puisse être gênant, mais pour assurer la sécurité et le confort de tous, je dois vous demander de bien vouloir éteindre votre cigare. Sinon, je serai contraint de prendre des mesures supplémentaires, ce que je préférerais éviter.
Fumeur : Vous n'avez pas le droit de me dire ce que je peux faire. Vous ne pouvez rien faire contre moi.
Agent de sécurité : Je comprends que vous puissiez ressentir cela, mais je suis ici pour faire respecter les règles de cet établissement. Si vous refusez de coopérer, je serai obligé de faire appel aux autorités compétentes et vous pourriez être passible d'amendes en vertu des articles du Code de la Santé Publique.
Fumeur : C'est du bluff. Vous ne pouvez rien prouver.
Agent de sécurité : Je préférerais que nous puissions résoudre cela de manière pacifique. Cependant, si vous persistez, je vais devoir appeler la police pour qu'ils évaluent la situation et prennent les mesures nécessaires.

Fumeur : Très bien, allez-y, appelez la police. Je ne vais pas éteindre mon cigare.

Agent de sécurité : Très bien, monsieur. Je vais faire cela. En attendant, je vous demande de coopérer et d'éteindre votre cigare pour éviter tout désagrément supplémentaire.
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