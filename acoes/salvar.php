<?php

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

include "../config/conexao.php";
include "../funcoes/validacoes.php";
include "../funcoes/tarefas.php";

$titulo = validar_titulo($_POST["titulo"] ?? "");
$descricao = trim($_POST["descricao"] ?? "");

if (criar_tarefa($conexao, $titulo, $descricao)) {
    $_SESSION["mensagem"] = "Tarefa criada com sucesso.";
    header("Location: ../index.php");
    exit;
} else {
    echo "Erro ao salvar.";
}
