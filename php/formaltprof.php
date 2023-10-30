<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("127.0.0.1", "root", "", "escola");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = isset($_POST['id']) ? $_POST['id'] : '';
  $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
  $end = isset($_POST['end']) ? $_POST['end'] : '';
  $fone = isset($_POST['fone']) ? $_POST['fone'] : '';
  $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
  $dn = isset($_POST['dn']) ? $_POST['dn'] : '';
  $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';

  // Verifique se o ID está definido antes de executar a atualização
  if (!empty($id)) {
    // Verifique se a data de nascimento é válida (não vazia e em formato correto)
    if (!empty($dn) && preg_match("/^\d{4}-\d{2}-\d{2}$/", $dn)) {
      $sql = "UPDATE professores SET nome='$nome', end='$end', fone='$fone', sexo='$sexo', dn='$dn', cpf='$cpf' WHERE id='$id'";

      if (mysqli_query($con, $sql)) {
        echo "<center><h2>Professor alterado com sucesso!</h2></center><br>";
      } else {
        echo "Erro ao atualizar o professor: " . mysqli_error($con);
      }
    }
  }
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$result = mysqli_query($con, "SELECT * FROM professores WHERE id='$id'");
?>

<p>
  <center>
    <form method="post">
      <?php while ($row = mysqli_fetch_array($result)) { ?>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <label>Nome:<input type="text" name="nome" value="<?php echo $row['nome']; ?>" /></label><br />
        <label>Endereço:<input type="text" name="end" value="<?php echo $row['end']; ?>" /></label><br />
        <label>Telefone:<input type="text" name="fone" value="<?php echo $row['fone']; ?>" /></label><br />
        <label>Sexo:
          <input type="radio" name="sexo" value="f" <?php echo ($row['sexo'] === 'f') ? 'checked' : ''; ?> />Feminino</label><br />
        <input type="radio" name="sexo" value="m" <?php echo ($row['sexo'] === 'm') ? 'checked' : ''; ?> />Masculino</label><br />
        <label>Data de Nascimento:<input type="text" name="dn" value="<?php echo $row['dn']; ?>" /></label><br />
        <label>Série:<input type="text" name="cpf" value="<?php echo $row['cpf']; ?>" /></label><br />
        <button type="submit" name="enviar" value="ok">Alterar</button>
      <?php } ?>
    </form>
  </center>
</p>

<?php
mysqli_close($con);
?>

<center>
  <h2><a href="../listarprof.php">VOLTAR</a></h2>
</center>
