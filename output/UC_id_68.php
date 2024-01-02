
    <?php   
    require_once (__DIR__.'/../db.php');

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
    <link rel="stylesheet" href="../assets/css/style2.css" media="screen" type="text/css" />
        <title>Test type</title> 
    </head>

    <?php if(empty($_POST["cover"])){ ?>
    <body class="count-quest">
        <div class="container-quest">
            <form class="form-quest" method="POST" action="">
                <!-- Changer la question -->
                <h1>Test type test</h1>

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
                            <p id="correction">Si votre disque dur portable est reconnu par votre PC comme un disque dur interne, cela peut être dû à plusieurs raisons, dont l'une des plus courantes est la façon dont le disque dur est formaté. Voici quelques étapes que vous pouvez suivre pour résoudre ce problème :

Vérifiez le Format du Disque Dur : Les disques durs externes sont souvent formatés en utilisant le système de fichiers exFAT ou NTFS. Si votre disque dur est formaté en NTFS, il peut être reconnu comme un disque dur interne. Assurez-vous que votre disque dur est formaté en exFAT ou FAT32, qui sont des formats plus adaptés aux disques durs externes.

Changement de Lettre de Lecteur : Vous pouvez également essayer de changer la lettre du lecteur attribuée à votre disque dur. Pour ce faire, suivez ces étapes :

Cliquez avec le bouton droit sur "Ordinateur" ou "Ce PC" sur le bureau ou dans le menu Démarrer.
Sélectionnez "Gérer" pour ouvrir la fenêtre Gestion de l'ordinateur.
Dans le volet de gauche, cliquez sur "Gestion des disques".
Faites un clic droit sur le disque dur en question.
Choisissez "Modifier la lettre de lecteur et les chemins d'accès".
Cliquez sur "Modifier" et choisissez une lettre de lecteur disponible.
Utilisez un Câble USB Différent ou un Port USB Différent : Parfois, des problèmes de connexion peuvent affecter la reconnaissance du disque dur. Essayez d'utiliser un autre câble USB ou connectez-le à un port USB différent sur votre ordinateur.

Mise à Jour du Pilote : Assurez-vous que les pilotes de votre disque dur sont à jour. Vous pouvez le faire en accédant au Gestionnaire de périphériques et en vérifiant s'il y a des mises à jour disponibles pour le contrôleur USB ou le disque dur externe.

Vérification des Paramètres du BIOS/UEFI : Dans certains cas, le problème peut être lié aux paramètres du BIOS/UEFI de votre ordinateur. Assurez-vous que le mode USB est activé dans le BIOS/UEFI.

Si ces étapes ne résolvent pas le problème, il est possible que le boîtier externe du disque dur portable soit configuré de manière à simuler un disque interne. Dans ce cas, vous pourriez envisager de contacter le fabricant du boîtier externe pour obtenir des instructions spécifiques sur la modification de cette configuration, ou vous pourriez envisager de retirer le disque dur du boîtier et de le connecter directement à votre ordinateur en utilisant un câble ou un adaptateur approprié. Cependant, cela peut annuler la garantie du boîtier externe, alors assurez-vous de prendre cela en compte.
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