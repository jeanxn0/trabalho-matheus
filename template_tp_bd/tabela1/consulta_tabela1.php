<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Consulta de Alunos </title>
  <style>
	table,th,td{
		border: 1px solid black;
		border-collapse: collapse;
	}
  </style>
  
</head>
<body>
<?php 
	require_once "..\BD\conexaoBD.php";
	$stmt = $conexao->query("SELECT * FROM tabela1");
	$registros = $stmt->fetchAll();
?>

  <main>
    <h1>Lista de Registros</h1>
	<table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cpf</th>
                <th>Telefone</th>
                <th>Planos</th>
				<th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $r){ ?>
                <tr>
                    <td><?= htmlspecialchars($r['campo2']) ?></td>
                    <td><?= htmlspecialchars($r['campo3']) ?></td>
                    <td><?= htmlspecialchars($r['campo4']) ?></td>
					<td><?= htmlspecialchars($r['campo5']) ?></td>
                    <td>
                        <a href="editar_tabela1.php?id=<?= $r['id'] ?>">Editar</a>
                    </td>
                    <td>
                        <a href="excluir_tabela1.php?id=<?= $r['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este registro?');">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
  </main>

</body>
</html>

