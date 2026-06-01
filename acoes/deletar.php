<?php

session_start();

include "../config/conexao.php";
include "../funcoes/validacoes.php";
include "../funcoes/tarefas.php";

$id = validar_id($_GET["id"] ?? 0);

$tarefa = buscar_tarefa_por_id($conexao, $id);

if (!$tarefa) {
    echo "Tarefa nao encontrada.";
    exit;
}

deletar_tarefa($conexao, $id);
$_SESSION["mensagem"] = "Tarefa deletada com sucesso.";
header("Location: ../index.php");
