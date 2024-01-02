<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
 
 $message_info = 'Votre réponse devra comprendre au minimum 500 caractères pour pouvoir être soumise.<br>
 <span style="font-weight: bold; text-decoration: underline;">Attention</span> : il vous faudra obtenir un score de 70% minimum pour pouvoir <span style="text-decoration: underline;">accéder à la correction</span> et passer à l\'étape suivante dans de bonnes conditions.';

 $mysqli = new mysqli("localhost", "u864174266_cda", "LTvWxDb5SBe7GDNwIsWh", "u864174266_cda");


function addUser($mail,$firstname,$lastname,$text,$score,$questionToCorrect){

$date = new DateTime();
$date = $date->format('d/m/Y H:i:s');

$mysqli = new mysqli("localhost", "u864174266_cda", "LTvWxDb5SBe7GDNwIsWh", "u864174266_cda");

$stmt = $mysqli->prepare("INSERT INTO `user`( `mail`, `firstname`, `lastname`, `text`, `score`,`sendDate`,`question_id`) VALUES (?,?,?,?,?,?,?) ");

$stmt->bind_param("ssssssi", $mail, $firstname, $lastname, $text, $score, $date, $questionToCorrect);

$stmt->execute();

}
