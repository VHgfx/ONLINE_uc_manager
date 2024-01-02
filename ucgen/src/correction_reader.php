<?php
// Emplacement de output
$ucFolder = __DIR__."/../";   
$ucFolder = realpath($ucFolder);

if ($ucFolder !== false){
    // Liste des fichiers PHP dans le dossier
    $quizFiles = glob($ucFolder. '/*.php');

    foreach ($quizFiles as $quizFile) {
        // Read the content of the quiz file
        $quizContent = file_get_contents($quizFile);
        
        // Extraction id
        preg_match('/addUser\(\$mail,\$firstname,\$lastname,\$text,\$result,(\d+)\);/s', 
            $quizContent, 
            $quizId);
        $correctionId = isset($quizId[1]) ? $quizId[1] : null;
        //echo "Id: $correctionId <br>";

        // Extraction Question
        preg_match('/<form class="form-quest" method="POST" action="">\s*<!-- Changer la question -->\s*<h1>(.*?)<\/h1>/s',
                $quizContent,
                $quizQuestion);
        $correctionQuestion = isset($quizQuestion[1]) ? $quizQuestion[1] : null;
        //echo "Question: $correctionQuestion <br>";


        // Extraction Correction
        preg_match('/<p\s+id\s*=\s*"correction"\s*>(.*?)<\/p>/s', 
            $quizContent, 
            $quizCorrection);

        // Output texte correction
        $correctionText = isset($quizCorrection[1]) ? $quizCorrection[1] : null;
        //echo "Correction: $correctionText <br>";

        if ($correctionId !== null && $correctionQuestion !== null && $correctionText !== null) {
            // Store the row data in an array
            $tableRows[] = array(
                'correctionId' => $correctionId,
                'correctionQuestion' => $correctionQuestion,
                'correctionText' => $correctionText
            );
        }

    }
} else {
    echo "Mauvais dossier";

}

usort($tableRows, function ($a, $b) {
    return $b['correctionId'] - $a['correctionId'];
});


foreach ($tableRows as $row) {
    echo "<tr>
            <td>{$row['correctionId']}</td>
            <td>{$row['correctionQuestion']}</td>
            <td><button class='expand-btn' onclick='toggleCorrection(this)'>Expand</button>
                <div class='correction-content' style='display:none;'>{$row['correctionText']}</div></td> 
          </tr>";
}


?>
<script>
    function toggleCorrection(button) {
        var correctionContent = button.nextElementSibling;
        correctionContent.style.display = (correctionContent.style.display === 'none') ? 'block' : 'none';
    }
</script>
