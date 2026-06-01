<?php
include "config/conexao.php";
include "funcoes/validacoes.php";
include "funcoes/tarefas.php";

$id = validar_id($_GET["id"] ?? 0);

$tarefa = buscar_tarefa_por_id($conexao, $id);

if (!$tarefa) {
    echo "Tarefa nao encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="assets/Style.css">
</head>

<body>
    <h1>Editar Tarefa</h1>
    <form action="acoes/atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $tarefa["id"]; ?>">

        <input
            type="text"
            name="titulo"
            value="<?php echo htmlspecialchars($tarefa["titulo"]); ?>"
            required>
        <br><br>

        <textarea name="descricao"><?php echo htmlspecialchars($tarefa["descricao"]); ?></textarea>

        <label>
            <input
                type="checkbox"
                name="concluida"
                value="1"
                <?php if ($tarefa["concluida"] == 1) {
                    echo "checked";
                } ?>>
            concluida
        </label>

        <br><br>
        <button type="submit">atualizar</button>
        <a class="link-editar" href="index.php">Voltar</a>
    </form>
</body>

</html>
