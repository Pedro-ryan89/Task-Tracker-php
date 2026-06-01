<?php

$conexao = mysqli_connect("localhost", "root", "", "task_tracker");

if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_errno());
}
