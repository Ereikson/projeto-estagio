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
        <form method="POST" action="php/cadastraprofessores.php" class="mt-4  m-5 flex-column shadow p-2 mb-4 text-white fw-bold bg-secondary rounded">
          <h2>Cadastro de Professor</h2>
            
          <div class="form-outline mb-2 ">
            <input type="text" name="nome" class="form-control">
            <label class="form-label">Nome</label>
          </div>

          <div class="form-outline mb-2">
            <input type="text" name="end" class="form-control">
            <label class="form-label">Endereço</label>
          </div>

          <div class="form-outline mb-2">
            <input type="text" name="fone" class="form-control">
            <label class="form-label">Endereço</label>
          </div>

          <div class="form-outline mb-2">
            <input type="text" name="sexo" class="form-control">
            <label class="form-label">Sexo</label>
          </div>

          <div class="form-outline mb-2">
            <input type="text" name="dn" class="form-control">
            <label class="form-label">Data de Nascimento</label>
          </div>

          <div class="form-outline mb-2">
            <input type="text" name="cpf" class="form-control">
            <label class="form-label">Cpf</label>
          </div>


          <button type="submit" class="btn btn-success btn-lg ">Enviar</button>
        </form>
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