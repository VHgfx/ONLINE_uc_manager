<?php

require_once ('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Modifier les mots clés
    $motsCles = array('fournisseur');
    $motsCles2 = array('sourire');
    $motsCles3 = array('attitude professionnelle');
    $motsCles4 = array('anglais');
    $motsCles5 = array('livraison');
    $motsCles6 = array('calendrier');
    $motsCles7 = array('message');
    $motsCles8 = array('rendez-vous');
    $motsCles9 = array('registre des visiteurs');
    $motsCles10 = array('zone restreinte','zones restreintes');
    $motsCles11 = array('badge');
    $motsCles12 = array('procédure de sécurité');
    $motsCles13 = array('service client');
    $motsCles14 = array('résoudre les problèmes');
    $motsCles15 = array('attentif');
    $motsCles16 = array('courtois');

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


    addUser($mail,$firstname,$lastname,$text,$result,64); //Mettre ID en base de donnée

}
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="assets/css/style2.css" media="screen" type="text/css" />
    <title>UC Compétences</title> <!-- Changer le titre de l'uc -->
</head>

<?php if(empty($_POST['cover'])){ ?>
<body class="count-quest">
    <div class="container-quest">
        <form class="form-quest" method="POST" action="">
            <!-- Changer la question -->
            <h1>Vous êtes affecté au poste d'accueil d'une société de fabrication de machines outils. Cette société reçoit la visite de beaucoup de clients et de fournisseurs. Elle reçoit aussi des livraisons de matières premières nécessaires à son fonctionnement.  Certains visiteurs ne parlent qu'anglais. Décrivez l'ensemble des taches que vous aurez à réaliser pour remplir au mieux de votre rôle. </h1>

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
                      En tant qu'agent d'accueil dans une société de fabrication de machines-outils, votre rôle est essentiel pour assurer une expérience positive aux clients, fournisseurs et visiteurs. Voici un ensemble de tâches que vous aurez à réaliser pour remplir au mieux votre rôle :

Accueil des visiteurs :
Accueillir les visiteurs, clients et fournisseurs avec un sourire et une attitude professionnelle.
Identifier le but de leur visite et les orienter vers le service ou la personne appropriée.
Communication en anglais :
Si certains visiteurs ne parlent que l'anglais, vous devrez être capable de communiquer de manière efficace en anglais pour répondre à leurs besoins.
Gestion des livraisons de matières premières :
Recevoir et vérifier les livraisons de matières premières en fonction des bons de livraison.
Assurer que les livraisons sont acheminées vers les zones de stockage appropriées.
Gestion des rendez-vous :
Prendre des rendez-vous pour les visiteurs et les fournisseurs.
Maintenir un calendrier des rendez-vous pour s'assurer que les réunions se déroulent sans problème.
Réception des appels téléphoniques :
Répondre aux appels téléphoniques entrants et diriger les appelants vers la personne ou le service approprié.
Prendre des messages en cas d'indisponibilité.
Gestion des besoins des clients et fournisseurs :
Fournir des informations générales sur l'entreprise, ses produits et ses services.
Répondre aux questions courantes des visiteurs et des fournisseurs.
Enregistrement des visiteurs :
Tenir un registre des visiteurs, y compris leurs noms, sociétés, heures d'arrivée et de départ.
Contrôler l'accès aux zones restreintes si nécessaire.
Gestion des documents :
Gérer la distribution de documents importants, tels que brochures, contrats, et autres informations pertinentes.
Gestion de la sécurité :
Assurer la sécurité en demandant aux visiteurs de porter des badges d'identification s'ils doivent accéder à des zones sécurisées.
Suivre les procédures de sécurité en cas d'urgence.
Maintenir la propreté de la zone d'accueil :
S'assurer que la zone d'accueil est propre et bien rangée en tout temps.
Résolution des problèmes :
Résoudre les problèmes mineurs des visiteurs, comme les retards ou les problèmes d'accès.
Service client :
Offrir un excellent service client en étant attentif, courtois et en répondant de manière proactive aux besoins des visiteurs.
Formation et mise à jour :
Se tenir informé des produits et des activités de l'entreprise pour être en mesure de répondre aux questions des visiteurs de manière précise.
Suivi des visiteurs :
Assurer le suivi des visiteurs qui ont pris rendez-vous, en informant les employés de leur arrivée.
Préparation de rapports :
Préparer des rapports d'accueil, si nécessaire, pour documenter les activités de la réception.
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
