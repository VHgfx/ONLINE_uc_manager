<?php
    require_once (__DIR__.'/../db.php');
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        define('INCLUDED_REDIRECT', true);
        include_once('redirects.php');
        
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user_role = $_POST["role"];
        $confirm_password = $_POST["confirm_password"];

            // Check if email is already used
        $check_email_query = "SELECT * FROM Admins WHERE email = ?";
        $check_stmt = $mysqli->prepare($check_email_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // Email already exists
            die("Error: L'email est déjà utilisé");
        }

            // Validate passwords
        if ($password != $confirm_password) {
            die("Error: Passwords do not match");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO Admins (firstname, lastname, email, password, user_role) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $mysqli->prepare($insert_query);
        $insert_stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $user_role);
    
        if ($insert_stmt->execute()) {
            ?>
            <head>
                <link rel="stylesheet" href="../../assets/css/style.css">
            </head>
            <style>
                #register-success {
                    background-color: #dff0d8;
                    border: 1px solid #d6e9c6;
                    color: #3c763d;
                    padding: 15px;
                    margin: 50px;
                    text-align: center;
                    margin-bottom: 20px;
                    border-radius: 4px;
                }
            </style>
            <body>
                <div id="register-success">
                    <p><?php echo $user_role?> ajouté avec succès !</p>
                    
                    <button onclick="redirectToAdminManager()">Retourner à la gestion utilisateurs</button>
                    <button onclick="redirectToManagement()">Retourner à la gestion des questions</button>
                </div>
            </body>
        <?php
        } else {
            echo "Erreur lors de la création de la table : " . $insert_stmt->error;
        }
    
        $check_stmt->close();
        $insert_stmt->close();
        $mysqli->close();
    }
