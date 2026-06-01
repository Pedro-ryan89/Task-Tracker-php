<?php

session_start();

include "../config/conexao.php";
include "../funcoes/tarefas.php";
include "../funcoes/validacoes.php";

$id = validar_id($_GET["id"] ?? 0);

$tarefa = buscar_tarefa_por_id($conexao, $id);

if (!$tarefa) {
    echo "Tarefa nao encontrada.";
    exit;
}

if ($tarefa["concluida"] == 1) {
    $novo_status = 0;
    $_SESSION["mensagem"] = "Tarefa reaberta com sucesso.";
} else {
    $novo_status = 1;
    $_SESSION["mensagem"] = "Tarefa concluida com sucesso.";
}

atualizar_status_tarefa($conexao, $id, $novo_status);
header("Location: ../index.php");
exit;
