<?php
	require_once "../BD/conexaoBD.php";

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$id = $_POST['id'];
		$campo2  = $_POST['campo2'];
		$campo3   = $_POST['campo3'];
		$campo4  = $_POST['campo4'];
		$campo5 = $_POST['campo5'];
	

		$stmt = $conexao->prepare("UPDATE tabela1 SET campo2 = :campo2, 
		campo3 = :campo3, campo4 = :campo4, campo5 = :campo5 WHERE id = :id");
		$stmt->execute([
			':campo2' => $campo2,
			':campo3' => $campo3,
			':campo4' => $campo4,
			':campo5' => $campo5,
			':id' => $id
		]);

		header("Location: consulta_tabela1.php");
		exit;
	}

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$stmt = $conexao->prepare("SELECT * FROM tabela1 WHERE id = :id");
		$stmt->execute([':id' => $id]);
		$registro = $stmt->fetch();

		if (!$registro) {
			echo "Registro não encontrado.";
			exit;
		}
	} else {
		echo "ID não fornecido.";
		exit;
	}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Atualização de Registros</title>
  
</head>
<body>

  <main>
    <h1>Editar Registro</h1>

    <form method="POST">
	  <input type="hidden" name="id" value="<?= $registro['id'] ?>">
      <label for="campo2">nome</label>
      <input type="text" id="campo2" name="campo2" maxlength="20" required value="<?= htmlspecialchars($registro['campo2']) ?>"><br><br>

      <label for="campo3">cpf:</label>
      <input type="text" id="campo3" name="campo3" maxlength="20" value="<?= htmlspecialchars($registro['campo3']) ?>"><br><br>

      <label for="campo4">telefone:</label>
      <input type="text" id="campo4" name="campo4" maxlength="20" value="<?= htmlspecialchars($registro['campo4']) ?>"><br><br>

      <fieldset>
        <legend>Planos</legend>
        <label for="campo5">Planos:</label>
        <select id="campo5" name="campo5">
          <option value="black" <?= $registro['campo5'] === 'Opção 1' ? 'selected' : '' ?>>black</option>
          <option value="gold" <?= $registro['campo5'] === 'Opção 2' ? 'selected' : '' ?>>gold </option>
          <option value="Silver	" <?= $registro['campo5'] === 'Opção 3' ? 'selected' : '' ?>>silver</option>
        </select>
      </fieldset><br><br>

      <button type="submit">Salvar alterações no registro</button>
    </form>
  </main>

</body>
</html>
