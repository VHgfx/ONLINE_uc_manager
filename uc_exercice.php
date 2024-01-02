<?php

require_once ('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Modifier les mots clés
    $motsCles = array('Lois');
    $motsCles2 = array('règalements');
    $motsCles3 = array('Sécurité');
    $motsCles4 = array('ordre public');
    $motsCles5 = array('Protection civile');
    $motsCles6 = array('Administration territoriale');
    $motsCles7 = array('coordination');
    $motsCles8 = array('collectivités locales');
    $motsCles9 = array('Élections');
    $motsCles10 = array('acteurs locaux');
    $motsCles11 = array('région');
    $motsCles12 = array('mission');
    $motsCles13 = array('catastrophe naturelle');
    $motsCles14 = array('accident majeur');
    $motsCles15 = array('gendarmerie');
    $motsCles16 = array('association');

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
$motsCles = array_map('supprimerAccents', $motsCles);
//Convertir le tableau de mots clés en mots minuscules.
$motsCles = array_map('mb_strtolower', $motsCles);
$motsCles2 = array_map('supprimerAccents', $motsCles2);
$motsCles2 = array_map('mb_strtolower', $motsCles2);
$motsCles3 = array_map('supprimerAccents', $motsCles3);
$motsCles3 = array_map('mb_strtolower', $motsCles3);
$motsCles4 = array_map('supprimerAccents', $motsCles4);
$motsCles4 = array_map('mb_strtolower', $motsCles4);
$motsCles5 = array_map('supprimerAccents', $motsCles5);
$motsCles5 = array_map('mb_strtolower', $motsCles5);
$motsCles6 = array_map('supprimerAccents', $motsCles6);
$motsCles6 = array_map('mb_strtolower', $motsCles6);
$motsCles7 = array_map('supprimerAccents', $motsCles7);
$motsCles7 = array_map('mb_strtolower', $motsCles7);
$motsCles8 = array_map('supprimerAccents', $motsCles8);
$motsCles8 = array_map('mb_strtolower', $motsCles8);
$motsCles9 = array_map('supprimerAccents', $motsCles9);
$motsCles9 = array_map('mb_strtolower', $motsCles9);
$motsCles10 = array_map('supprimerAccents', $motsCles10);
$motsCles10 = array_map('mb_strtolower', $motsCles10);
$motsCles11 = array_map('supprimerAccents', $motsCles11);
$motsCles11 = array_map('mb_strtolower', $motsCles11);
$motsCles12 = array_map('supprimerAccents', $motsCles12);
$motsCles12 = array_map('mb_strtolower', $motsCles12);
$motsCles13 = array_map('supprimerAccents', $motsCles13);
$motsCles13 = array_map('mb_strtolower', $motsCles13);
$motsCles14 = array_map('supprimerAccents', $motsCles14);
$motsCles14 = array_map('mb_strtolower', $motsCles14);
$motsCles15 = array_map('supprimerAccents', $motsCles15);
$motsCles15 = array_map('mb_strtolower', $motsCles15);
$motsCles16 = array_map('supprimerAccents', $motsCles16);
$motsCles16 = array_map('mb_strtolower', $motsCles16);
//var_dump($motsCles);

// Vérifier si le formulaire a été soumis

    // Récupérer le texte du textarea
    $texte = $_POST["textarea"];
    // Retirer les accents du texte récupéré dans le textarea
    $texte = supprimerAccents($texte);
    // Convertir le texte récupéré en minuscule
    $texte = mb_strtolower($texte);


  // var_dump($texte);

    // Initialiser le compteur
    $compteur = 0;

    // Vérifier chaque mot-clé prédéfini dans le texte
    if (!empty($motsCles)) {
        foreach ($motsCles as $motCle) {
            if (stripos($texte, $motCle) !== false) {
                $compteur++;
                //echo $motCle."<br/>";
            }
        }
    }
        foreach ($motsCles2 as $motCle2) {
            if (stripos($texte, $motCle2) !== false) {
                $compteur++;
                //echo $motCle2."<br/>";
            }
        }

    if (!empty($motsCles3)) {
        foreach ($motsCles3 as $motCle3) {
            if (stripos($texte, $motCle3) !== false) {
                $compteur++;
                //echo $motCle3."<br/>";
            }
        }
    }
    if (!empty($motsCles4)) {
        foreach ($motsCles4 as $motCle4) {
            if (stripos($texte, $motCle4) !== false) {
                $compteur++;
                //echo $motCle4."<br/>";
            }
        }
    }
    if (!empty($motsCles5)) {
        foreach ($motsCles5 as $motCle5) {
            if (stripos($texte, $motCle5) !== false) {
                $compteur++;
                //echo $motCle5."<br/>";
            }
        }
    }
    if (!empty($motsCles6)) {
        foreach ($motsCles6 as $motCle6) {
            if (stripos($texte, $motCle6) !== false) {
                $compteur++;
                //echo $motCle6."<br/>";
            }
        }
    }
    foreach ($motsCles7 as $motCle7) {
        if (stripos($texte, $motCle7) !== false) {
            $compteur++;
            //echo $motCle7."<br/>";
        }
    }
    foreach ($motsCles8 as $motCle8) {
        if (stripos($texte, $motCle8) !== false) {
            $compteur++;
            //echo $motCle8."<br/>";
        }
    }
    foreach ($motsCles9 as $motCle9) {
        if (stripos($texte, $motCle9) !== false) {
            $compteur++;
            //echo $motCle9."<br/>";
        }
    }
    foreach ($motsCles10 as $motCle10) {
        if (stripos($texte, $motCle10) !== false) {
            $compteur++;
            //echo $motCle10."<br/>";
        }
    }
    foreach ($motsCles11 as $motCle11) {
        if (stripos($texte, $motCle11) !== false) {
            $compteur++;
            //echo $motCle11."<br/>";
        }
    }
    foreach ($motsCles12 as $motCle12) {
        if (stripos($texte, $motCle12) !== false) {
            $compteur++;
            //echo $motCle12."<br/>";
        }
    }
    foreach ($motsCles13 as $motCle13) {
        if (stripos($texte, $motCle13) !== false) {
            $compteur++;
            //echo $motCle13."<br/>";
        }
    }
    foreach ($motsCles14 as $motCle14) {
        if (stripos($texte, $motCle14) !== false) {
            $compteur++;
            //echo $motCle14."<br/>";
        }
    }
    foreach ($motsCles15 as $motCle15) {
        if (stripos($texte, $motCle15) !== false) {
            $compteur++;
            //echo $motCle15."<br/>";
        }
    }
    foreach ($motsCles16 as $motCle16) {
        if (stripos($texte, $motCle16) !== false) {
            $compteur++;
            //echo $motCle15."<br/>";
        }
    }
    // Afficher le résultat
    //echo "Nombre de mots-clés présents dans le texte : " . $compteur;

    $result = (($compteur / 16) * 2)*100;


    if($result > 100){
        $result = 100;
    }

    //echo "Le score est donc de : " . $result . "%";


    $mail = $_POST['mail'];

    $text = $texte;

    $lastname = $_POST['lastname'];

    $firstname = $_POST['firstname'];


    addUser($mail,$firstname,$lastname,$text,$result,76); //Mettre ID en base de donnée

}
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="assets/css/style2.css" media="screen" type="text/css" />
    <title>UC Test</title> <!-- Changer le titre de l'uc -->
</head>

<?php if(empty($_POST['cover'])){ ?>
<body class="count-quest">
    <div class="container-quest">
        <form class="form-quest" method="POST" action="">
            <!-- Changer la question -->
            <h1>Quels sont les rôles et responsabilités du préfet dans l’exercice de ses fonctions ?</h1>

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
                        <!-- Changer la correction -->
                        <p id="correction">
                     Le préfet est un haut fonctionnaire qui occupe un rôle important dans l'administration territoriale de la France. Ses principales responsabilités et fonctions incluent :

Représentation de l'État : Le préfet est le représentant de l'État dans le département où il est nommé. Il veille à l'application des lois, des règlements et des politiques gouvernementales.
Sécurité et ordre public : Le préfet est responsable du maintien de la sécurité et de l'ordre public dans le département. Il coordonne les actions des forces de l'ordre (police, gendarmerie) et prend les mesures nécessaires pour assurer la tranquillité et la sécurité des citoyens.
Protection civile : Le préfet est chargé de la protection civile et de la gestion des crises. Il coordonne les mesures de prévention et de secours en cas de catastrophes naturelles, d'accidents majeurs ou d'événements exceptionnels.
Administration territoriale : Le préfet exerce des fonctions administratives importantes. Il supervise les services déconcentrés de l'État dans le département et assure la coordination entre les différentes administrations locales.
Contrôle des collectivités locales : Le préfet veille au respect de la légalité dans les décisions prises par les collectivités locales (communes, départements, régions). Il peut exercer un contrôle de légalité et annuler des décisions contraires aux lois et règlements.
Élections : Le préfet organise et supervise les élections dans le département, en veillant à leur bon déroulement et à la régularité du processus électoral.
Relations avec les acteurs locaux : Le préfet entretient des relations avec les acteurs locaux tels que les élus, les représentants des associations et les partenaires socio-économiques. Il favorise la concertation et la coordination des actions pour le développement du territoire.
Il convient de noter que les responsabilités exactes d'un préfet peuvent varier en fonction du département et des circonstances spécifiques. Les préfets exercent également d'autres missions qui leur sont confiées par le gouvernement.

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