<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$nome = $_POST['nome'];
$end = $_POST['end'];
$fone = $_POST['fone'];
$sexo = $_POST['sexo'];
$dn = $_POST['dn'];
$cpf = $_POST['cpf'];

$dn = date("Y-m-d", strtotime($_POST['dn']));
$sql = "INSERT INTO professores (nome, end, fone, sexo, dn, cpf) VALUES ('$nome', '$end', '$fone', '$sexo', '$dn', '$cpf')";


$con = mysqli_connect("127.0.0.1", "root", "", "escola");
if (mysqli_connect_error()) {
      echo "Failed to connect to MySQL: " .  mysqli_connect_error();
}
mysqli_query($con, $sql);
echo "<center><h2>Professor cadastrado com sucesso!</center></h2><p><br>";
mysqli_close($con);
?>
<center>
      <h2><a href="../cadastrarprofessores.php">VOLTAR</a></h2>
</center>