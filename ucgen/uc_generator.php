<?php session_start();
require_once('src/config_url.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $_admin_login");
    exit();

}


include_once('src/redirects.php');
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" href="assets/css/style.css">
        <style>

            #submitButton:disabled {
                background-color: #dddddd;
                color: #aaaaaa;
                cursor: not-allowed;
            }

            fieldset{
                margin: 10px;
            }

            textarea{
                width: 100%;
                height: 300px;
                resize: none;
            }
            .column {
                flex: 25%;
            }
            .row{
                display: flex;
            }
            
            h2 {
                text-align: center;
                width: 100%;
            }

        </style>
    	<title>Générateur de question</title>
	</head>
    <body style="padding-top: 70px;">
    <?php 
    
    $currentPage = 'uc_generator'; 
    include_once(__DIR__.'/btn/navbar.php');?>

    <h2>Créer une question</h2>
    <form style="width:80%; margin:auto;" id="ucForm" method="POST" action="<?php echo $_src_writer;?>" role="form">
        <div>
            <fieldset>
                <div>
                    <label for="edittitle">Titre</label>
                    <input type="text" name="edittitle" id="edittitle" placeholder="Titre" required></input>
                </div>
                <div>
                    <label for="editquestion">Question</label>
                    <input type="text" name="editquestion" id="editquestion" required></input>
                </div>
                <div>
                    <label for="edittype" required>Type</label>
                    <input type="text" name="edittype" id="edittype" pattern="[a-z0-9_-]+" title="Espaces et accents interdits. Caractères autorisés : a-z 0-9 - _" placeholder="Ex : nomcategorie_question1"></input>
                    <span id="typeError" style="color: red;"></span>
                </div>
            </fieldset>
            <fieldset>
                <div>
                    <label for="editcorrection">Correction</label><br/>
                    <textarea name="editcorrection" id="editcorrection" minlength="500" placeholder="500 caractères minimum" required></textarea>
                    <p id="charCount">Nombre de caractères actuel (500 minimum) : 0</p>
                </div>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="column">
                    <!--Mots clés-->
                        <div>
                            <label for="editmc1">Mot-clé 1</label>
                            <input type="text" name="editmc1" id="editmc1"></input>
                        </div>
                        <div>
                            <label for="editmc2">Mot-clé 2</label>
                            <input type="text" name="editmc2" id="editmc2"></input>
                        </div>
                        <div>
                            <label for="editmc3">Mot-clé 3</label>
                            <input type="text" name="editmc3" id="editmc3"></input>
                        </div>
                        <div>
                            <label for="editmc4">Mot-clé 4</label>
                            <input type="text" name="editmc4" id="editmc4"></input>
                        </div>
                    </div>
                    <div class="column">
                        <div>
                            <label for="editmc5">Mot-clé 5</label>
                            <input type="text" name="editmc5" id="editmc5"></input>
                        </div>
                        <div>
                            <label for="editmc6">Mot-clé 6</label>
                            <input type="text" name="editmc6" id="editmc6"></input>
                        </div>
                        <div>
                            <label for="editmc7">Mot-clé 7</label>
                            <input type="text" name="editmc7" id="editmc7"></input>
                        </div>
                        <div>
                            <label for="editmc8">Mot-clé 8</label>
                            <input type="text" name="editmc8" id="editmc8"></input>
                        </div>
                    </div>
                    <div class="column">
                        <div>
                            <label for="editmc1">Mot-clé 9</label>
                            <input type="text" name="editmc9" id="editmc9"></input>
                        </div>
                        <div>
                            <label for="editmc10">Mot-clé 10</label>
                            <input type="text" name="editmc10" id="editmc10"></input>
                        </div>
                        <div>
                            <label for="editmc11">Mot-clé 11</label>
                            <input type="text" name="editmc11" id="editmc11"></input>
                        </div>
                        <div>
                            <label for="editmc12">Mot-clé 12</label>
                            <input type="text" name="editmc12" id="editmc12"></input>
                        </div>
                    </div>
                    <div class="column">
                        <div>
                            <label for="editmc13">Mot-clé 13</label>
                            <input type="text" name="editmc13" id="editmc13"></input>
                        </div>
                        <div>
                            <label for="editmc14">Mot-clé 14</label>
                            <input type="text" name="editmc14" id="editmc14"></input>
                        </div>
                        <div>
                            <label for="editmc15">Mot-clé 15</label>
                            <input type="text" name="editmc15" id="editmc15"></input>
                        </div>
                        <div>
                            <label for="editmc16">Mot-clé 16</label>
                            <input type="text" name="editmc16" id="editmc16"></input>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <div>
            <input type="submit" id="submitButton" name="isSendEditing" href="" target="_self" value="Envoyer" disabled></input>
        </div>

    </form>
    <div>
        <input type="submit" onclick="redirectToManagement()" value="Retour à la gestion des UC"></input>
    </div>

    <script>
        var requiredFields = document.querySelectorAll('[required]');
        var submitButton = document.getElementById('submitButton');
        var textCorrection = document.getElementById('editcorrection');
        var inputTitle = document.getElementById('edittitle');
        var inputQuestion = document.getElementById('editquestion');

        var allField = false;
        var correctionFormat = false;
        var inputRequired = false;
       
        inputTitle.addEventListener('input', function() {
            checkInputs();
        });

        inputQuestion.addEventListener('input', function() {
            checkInputs();
        });

        function checkInputs() {
            // Get the values of the input fields
            var titleValue = inputTitle.value;
            var questionValue = inputQuestion.value;

            var boolTitle = false;
            var boolQuestion = false;



            // Check if either of the input fields is empty
            if (titleValue.trim() === '') {
                boolTitle = false;
            } else {
                boolTitle = true;
            }

            if (questionValue.trim() === '') {
                boolQuestion = false;
            } else {
                boolQuestion = true;
            }

            if ((boolTitle) && (boolQuestion)){
                inputRequired = true;
            }
    

        }


        // Add an event listener for input changes
        document.getElementById('edittype').addEventListener('input', function() {
            // Get the input value
            var inputValue = this.value;

            // Check if the input matches the pattern
            if (!/^[a-z0-9_-]+$/.test(inputValue)) {
            document.getElementById('typeError').innerText = 'Espaces et accents interdits. Caractères autorisés : a-z 0-9 - _';
            //document.getElementById('submitButton').disabled = true;

            } else {
            document.getElementById('typeError').innerText = '';
            //document.getElementById('submitButton').disabled = false;
            allField = true;
            checkRequired();
            }
        });

        document.getElementById('editcorrection').addEventListener('input', function() {
            // Get the input value
            var textAreaCorrection = document.getElementById('editcorrection');
            var textCorrection = this.value;

            // Check if the input matches the pattern
            if (textCorrection.length < parseInt(textAreaCorrection.getAttribute('minlength'), 10)) {
                //submitButton.disabled = true;
                correctionFormat = false;
            } else {
                //submitButton.disabled = false;
                correctionFormat = true;
                checkRequired();
            }
        });


        function checkRequired(){
            if((inputRequired) && (allField) && (correctionFormat)){
            document.getElementById('submitButton').disabled = false;
            } else {
                document.getElementById('submitButton').disabled = true;
            }
        }

        var textareaCorrection = document.getElementById('editcorrection');
        var charCountElement = document.getElementById('charCount');

        textareaCorrection.addEventListener('input', function() {
            var charCount = textareaCorrection.value.length;
            charCountElement.textContent = 'Nombre de caractères actuel (min. 500 requis) : ' + charCount;
        });

    </script>
	</body>
</html>
