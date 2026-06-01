<?php

session_start();
include "config/conexao.php";
include "funcoes/tarefas.php";

$status = $_GET["status"] ?? "todas";
$busca = trim($_GET["busca"] ?? "");

if ($busca != "") {
    $resultado = buscar_tarefas_por_titulo($conexao, $busca, $status);
} else {
    $resultado = buscar_tarefas_por_status($conexao, $status);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Task Tracker</title>
    <link rel="stylesheet" href="assets/Style.css">
</head>

<body>
    <?php if (isset($_SESSION["mensagem"])) { ?>
        <p class="mensagem">
            <?php echo $_SESSION["mensagem"]; ?>
        </p>

        <?php unset($_SESSION["mensagem"]); ?>
    <?php } ?>

    <h1>Nova Tarefa</h1>

    <form action="acoes/salvar.php" method="POST">
        <input type="text" name="titulo" placeholder="Título da tarefa" required>
        <br><br>

        <textarea name="descricao" placeholder="Descrição"></textarea>
        <br><br>

        <button type="submit">Salvar</button>
    </form>

    <h2> Lista de Tarefas</h2>

    <div class="filtros">
        <a class="<?php echo $status == 'todas' ? 'ativo' : ''; ?>" href="index.php?status=todas&busca=<?php echo urlencode($busca); ?>">Todas</a>

        <a class="<?php echo $status == 'pendentes' ? 'ativo' : ''; ?>" href="index.php?status=pendentes&busca=<?php echo urlencode($busca); ?>">Pendentes</a>

        <a class="<?php echo $status == 'concluidas' ? 'ativo' : ''; ?>" href="index.php?status=concluidas&busca=<?php echo urlencode($busca); ?>">Concluídas</a>
    </div>

    <form class="form-busca" action="index.php" method="GET">
        <input type="hidden" name="status" value="<?php echo htmlspecialchars($status); ?>">
        <input
            type="text"
            name="busca"
            placeholder="buscar por titulo"
            value="<?php echo htmlspecialchars($busca); ?>">

        <button type="submit">Buscar</button>

        <?php if ($busca != "") { ?>
            <a class="link-editar" href="index.php?status=<?php echo htmlspecialchars($status) ?>">Limpar</a>
        <?php } ?>
    </form>

    <?php if (mysqli_num_rows($resultado) == 0) { ?>
        <p>Nemnhuma tarefa cadrastada ainda.</p>
    <?php } ?>

    <?php while ($tarefa = mysqli_fetch_assoc($resultado)) { ?>
        <div class="tarefa">
            <h3><?php echo htmlspecialchars($tarefa["titulo"]); ?> </h3>

            <p>
                <?php echo htmlspecialchars($tarefa["descricao"]); ?>
            </p>

            <p>
                Status:
                <?php
                if ($tarefa["concluida"] == 1) {
                    echo '<span class="status concluida">concluida</span>';
                } else {
                    echo '<span class="status pendente">Pendente</span>';
                }
                ?>
            </p>

            <small>
                Criada em: <?php echo htmlspecialchars($tarefa["criada_em"]); ?>
            </small>

            <br><br>
            <?php if ($tarefa["concluida"] == 1) { ?>
                <a class="link-status" href="acoes/alternar_status.php?id=<?php echo $tarefa["id"]; ?>">Reabrir</a>
            <?php } else { ?>
                <a class="link-status" href="acoes/alternar_status.php?id=<?php echo $tarefa["id"]; ?>">Concluir</a>
            <?php } ?>

            <a class="link-editar" href="editar.php?id=<?php echo $tarefa["id"]; ?>"> editar</a>
            <a class="link-deletar" href="acoes/deletar.php?id=<?php echo $tarefa["id"]; ?>" onclick="return confirm('Tem certeza que deseja deletar esta tarefa?')"> deletar</a>

        </div>
    <?php } ?>

</body>

</html>
