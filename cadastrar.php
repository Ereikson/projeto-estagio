<?php
// Ative a exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifique se o nome de usuário já existe no banco de dados
    $check_query = "SELECT * FROM users WHERE usuario = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $usuario);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $error = "Este nome de usuário já está em uso.";
    } else {
        // Insira o novo usuário no banco de dados
        $hash_senha = password_hash($senha, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (usuario, senha) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ss", $usuario, $hash_senha);

        if ($insert_stmt->execute()) {
            $_SESSION["loggedin"] = true;
            header("Location: index.php");
            exit;
        } else {
            $error = "Erro ao cadastrar o usuário.";
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

        <div class="right-login">
            <div class="card-login">
                <h1>Cadastro</h1>

                  <!-- Display the error message here -->
                  <div class="error-message" style="color: red;">
                    <?php
                    if (!empty($error)) {
                        echo $error;
                    }
                    ?>
                </div>

                <form method="post" action="cadastrar.php">
                    <div class="textfield">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="usuario" placeholder="Usuário" required>
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Senha" required>
                    </div>
                    <input type="submit" value="Cadastrar" class="btn-login">
                </form>
                <a href="index.php">Login</a>

            </div>
        </div>
    </div>

</body>

</html>