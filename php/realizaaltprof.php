<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_POST['id'];
$nome = $_POST['nome'];
$end = $_POST['end'];
$fone = $_POST['fone'];
$sexo = $_POST['sexo'];
$dn = $_POST['dn'];
$cpf = $_POST['cpf'];

$sql = "UPDATE professores SET nome='$nome', end='$end', fone='$fone', sexo='$sexo', dn='$dn', cpf='$cpf' WHERE id='$id'";

$con = mysqli_connect("127.0.0.1", "root", "", "escola");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con, $sql);
echo "<center><h2>Professor Alterado com sucesso!</h2></center><br>";
mysqli_close($con);
?>

<center>
  <h2><a href="../listarprof.php">VOLTAR</a></h2>
</center>