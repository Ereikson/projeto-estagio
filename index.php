<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";

// Initialize the error message
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $authenticated = false;

    // Validate and sanitize user input
    if (empty($usuario) || empty($senha)) {
        $error = "Preencha todos os campos.";
    } else {
        $sql = "SELECT usuario, senha FROM users WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if (password_verify($senha, $row['senha'])) {
                $_SESSION["loggedin"] = true;
                $authenticated = true;

                // Redirecionar para home.php
                header("Location: home.php");
                exit; 
            }
        }

        if (!$authenticated) {
            $error = "Usuário ou senha incorretos";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleindex.css">
    <title>Login</title>
</head>

<body>
    <div class="main-login">
        <div class="left-login">
            <h1>Faça login<br>no nosso sistema de Gestão Escolar</h1>
            <img src="imagens/college-project-animate.svg" class="left-login-image" alt="alunos sentados em vários livros">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>

                <!-- Display the error message here -->
                <div class="error-message" style="color: red;">
                    <?php
                    if (!empty($error)) {
                        echo $error;
                    }
                    ?>
                </div>

                <form method="post" action="index.php" onsubmit="return validateForm();">
                    <div class="textfield">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="usuario" id="usuario" placeholder="Usuário" required>
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha" required>
                    </div>
                    <input type="submit" value="Login" class="btn-login">
                </form>
                <a href="cadastrar.php">Cadastre-se</a>

            </div>
        </div>
    </div>

</body>

</html>