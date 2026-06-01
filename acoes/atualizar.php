<?php

session_start();

include "../config/conexao.php";
include "../funcoes/validacoes.php";
include "../funcoes/tarefas.php";

$id = validar_id($_POST["id"] ?? 0);


$titulo = validar_titulo($_POST["titulo"] ?? "");
$descricao =  trim($_POST["descricao"] ?? "");


$tarefa = buscar_tarefa_por_id($conexao, $id);

if (!$tarefa) {
        echo "Tarefa nao encontrada";
        exit;
}

$concluida = isset($_POST["concluida"]) ? 1 : 0;
atualizar_tarefa($conexao, $id, $titulo, $descricao, $concluida);

$_SESSION["mensagem"] = "Tarefa atualizada com sucesso.";

header("Location: ../index.php");
