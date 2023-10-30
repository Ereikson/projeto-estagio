<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_POST['id'];
$sql = "delete from professores where id='$id'";
$con = mysqli_connect("127.0.0.1", "root", "", "escola");

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con, $sql);
echo "<center><h2>Professor Deletado com sucesso!</center></h2><p><br>";
mysqli_close($con);

?>
<center>
	<h2><a href="../listarprof.php">VOLTAR</a></h2>
</center>