
    <?php   
    require_once (__DIR__.'/db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $motsCles1 = array("azeaze", "azeaze");
            $motsCles2 = array("");
            $motsCles3 = array("");
            $motsCles4 = array("");
            $motsCles5 = array("");
            $motsCles6 = array("");
            $motsCles7 = array("");
            $motsCles8 = array("");
            $motsCles9 = array("");
            $motsCles10 = array("");
            $motsCles11 = array("");
            $motsCles12 = array("");
            $motsCles13 = array("");
            $motsCles14 = array("");
            $motsCles15 = array("");
            $motsCles16 = array("");
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


        addUser($mail,$firstname,$lastname,$text,$result,68); //Mettre ID en base de donnée

    }
    ?>

    <!DOCTYPE html>
    <html>
    
    <head>
    <link rel="stylesheet" href="assets/css/style2.css" media="screen" type="text/css" />
        <title>Test type</title> 
    </head>

    <?php if(empty($_POST["cover"])){ ?>
    <body class="count-quest">
        <div class="container-quest">
            <form class="form-quest" method="POST" action="">
                <!-- Changer la question -->
                <h1>Test question output + lien</h1>

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
                            <p id="correction">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mi proin sed libero enim sed faucibus. Pharetra vel turpis nunc eget. Euismod elementum nisi quis eleifend quam adipiscing vitae proin. Id donec ultrices tincidunt arcu non sodales neque sodales ut. Lectus nulla at volutpat diam ut venenatis tellus in metus. Scelerisque eleifend donec pretium vulputate sapien nec sagittis. Convallis convallis tellus id interdum velit laoreet id donec ultrices. Aliquet eget sit amet tellus cras adipiscing. Urna nec tincidunt praesent semper. Quam quisque id diam vel quam elementum. Pretium vulputate sapien nec sagittis aliquam malesuada bibendum arcu. Mi proin sed libero enim sed. Tincidunt eget nullam non nisi est. Dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in. A condimentum vitae sapien pellentesque habitant morbi. Dictum at tempor commodo ullamcorper a. Turpis tincidunt id aliquet risus feugiat in ante.

Nisi quis eleifend quam adipiscing. Neque vitae tempus quam pellentesque nec nam aliquam sem et. A cras semper auctor neque vitae tempus quam pellentesque. Quis varius quam quisque id diam vel quam elementum pulvinar. Adipiscing bibendum est ultricies integer. Elementum curabitur vitae nunc sed. Fames ac turpis egestas integer eget. Ut faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Fermentum et sollicitudin ac orci phasellus egestas tellus. Dolor magna eget est lorem ipsum dolor sit. Amet facilisis magna etiam tempor orci. Quis eleifend quam adipiscing vitae proin sagittis.

Mus mauris vitae ultricies leo integer malesuada. Odio aenean sed adipiscing diam donec. Auctor neque vitae tempus quam. Et netus et malesuada fames ac turpis egestas maecenas pharetra. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper. Vel elit scelerisque mauris pellentesque pulvinar pellentesque. Vestibulum lorem sed risus ultricies tristique nulla aliquet. Non tellus orci ac auctor augue. Aliquam purus sit amet luctus. Phasellus vestibulum lorem sed risus ultricies tristique nulla. Enim nec dui nunc mattis enim ut tellus elementum sagittis. Ultricies leo integer malesuada nunc vel risus commodo viverra maecenas. Et ultrices neque ornare aenean. Adipiscing at in tellus integer feugiat scelerisque varius morbi enim. Vitae aliquet nec ullamcorper sit amet risus.

Ut eu sem integer vitae justo. Amet nisl purus in mollis. Arcu dictum varius duis at consectetur lorem. Etiam tempor orci eu lobortis elementum nibh tellus molestie nunc. Suscipit tellus mauris a diam maecenas sed enim ut sem. Nulla aliquet enim tortor at auctor. Malesuada fames ac turpis egestas maecenas. At imperdiet dui accumsan sit amet nulla facilisi. Leo vel orci porta non pulvinar neque laoreet suspendisse. Ut sem viverra aliquet eget sit. Hac habitasse platea dictumst quisque sagittis purus sit amet. Etiam non quam lacus suspendisse faucibus interdum posuere.
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