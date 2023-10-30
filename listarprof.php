<?php
session_start();
require_once "config.php";

function logout()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["logout"])) {
    logout();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $con = mysqli_connect("127.0.0.1", "root", "", "escola");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        $sql = "DELETE FROM professores WHERE id='$id'";
        if (mysqli_query($con, $sql)) {
            // Redireciona de volta para a página atual após a exclusão com uma mensagem
            header("Location: listarprof.php?message=Professor%20deletado%20com%20sucesso!");
        } else {
            echo "Erro ao deletar o professor: " . mysqli_error($con);
        }
        mysqli_close($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Projeto ETB</title>
</head>

<body class="bg-secondary bg-gradient ">
    <header class="bg-dark">
        <div class="topnav" id="myTopnav">
            <a href="home.php" class="active">Home</a>
            <a href="cadastraalunos.php">Cadastrar Aluno</a>
            <a href="cadastrarprofessores.php">Cadastrar Professor</a>
            <a href="listaralunos.php">Alterar Aluno</a>
            <a href="listarprof.php">Alterar Professor</a>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <button type="submit" name="logout" value="Logout" class="btn m-2 position-absolute end-0 btn-danger">Logout</button>
            </form>

            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>




    </header>

    <div class="container-fluid ">
        <div class="row">
            <div class="col-sm-2 mt-4">
                <div class="shadow p-2 mb-3 bg-white rounded">
                    <img class="img-fluid" src="imagens/mec.png">
                    <img class="img-fluid" src="imagens/sedf.webp">
                    <img class="img-fluid" src="imagens/editora.jpg">
                </div>

                <ul class="nav nav-pills flex-column shadow p-2 mb-4 bg-white rounded">
                    <li class="nav-item">
                        <a class="nav-link" href="listaralunos.php">Alunos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listarprof.php">Professores</a>
                    </li>
                </ul>
                <hr class="d-sm-none">
            </div>

            <div class="col-sm-10 p-0">
                <div class="mt-4  m-5 flex-column shadow p-2 mb-4 text-white fw-bold bg-secondary rounded">

                    <?php
                    if (isset($_GET['message'])) {
                        echo "<center><h2>" . urldecode($_GET['message']) . "</h2></center><br>";
                    }
                    ?>

                    <?php
                    try {
                        $pdo = new PDO("mysql:host=localhost;dbname=escola", "root", "");
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $result = $pdo->query("SELECT * FROM professores");
                    } catch (PDOException $e) {
                        echo "Failed to connect to MySQL: " . $e->getMessage();
                    }
                    ?>

                    <table class="table table-responsive table-bordered table-hover ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Data de Nascimento</th>
                                <th scope="col">Cpf</th>
                                <th scope="col">Deletar</th>
                                <th scope="col">Alterar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['nome']; ?></td>
                                    <td><?php echo $row['end']; ?></td>
                                    <td><?php echo $row['fone']; ?></td>
                                    <td><?php echo $row['sexo']; ?></td>
                                    <td><?php echo $row['dn']; ?></td>
                                    <td><?php echo $row['cpf']; ?></td>
                                    <td>
                                        <form action="listarprof.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
                                            <button type="submit" name="botdelprof" value="ok">Del</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="php/formaltprof.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
                                            <button type="submit" name="botaltprof" value="ok">Alt</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <footer class="container-fluid text-center m-0 p-0 text-dark" style="background-color: #ECEFF1">

        <section class="d-flex p-2 text-white" style="background-color: #21D192">

            <div>
                <span class="fw-bold ">Entre em contato:</span>
            </div>

        </section>

        <section class="">
            <div class="container-fluid text-center text-md-start mt-1">
                <div class="row">
                    <div class="col-md-2 mt-4 col-lg-4 col-xl-3 mx-auto">
                        <h6 class="text-uppercase fw-bold">Sponte</h6>
                        <p>
                            A parceria certa para sua gestão de ensino!
                        </p>
                    </div>

                    <div class="col-md-4  mx-auto mt-1 ">
                        <h6 class="text-uppercase fw-bold">Contato</h6>
                        <p>Brasília, Qn 01, DF</p>
                        <p>ereikson@gmail.com</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center text-white bg-dark ">
            © 2023 Copyright:
            <a class="text-white" href="https://linkedin.com/">Ereikson Mendes</a>
        </div>

    </footer>

    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>