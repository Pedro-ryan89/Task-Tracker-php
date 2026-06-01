<?php

function buscar_todas_tarefas($conexao)
{
    $sql = "SELECT * FROM tarefas ORDER BY criada_em DESC";
    return mysqli_query($conexao, $sql);
}

function buscar_tarefa_por_id($conexao, $id)
{
    $sql = "SELECT * FROM tarefas WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function buscar_tarefas_por_status($conexao, $status)
{
    if ($status == "pendentes") {
        $concluida = 0;
    } elseif ($status == "concluidas") {
        $concluida = 1;
    } else {
        return buscar_todas_tarefas($conexao);
    }

    $sql = "SELECT * FROM tarefas
            WHERE concluida = ?
            ORDER BY criada_em DESC";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $concluida);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

function buscar_tarefas_por_titulo($conexao, $busca, $status)
{
    $busca = "%" . trim($busca) . "%";

    if ($status == "pendentes") {
        $sql = "SELECT * FROM tarefas
                WHERE titulo LIKE ? AND concluida = 0
                ORDER BY criada_em DESC";
    } elseif ($status == "concluidas") {
        $sql = "SELECT * FROM tarefas
                WHERE titulo LIKE ? AND concluida = 1
                ORDER BY criada_em DESC";
    } else {
        $sql = "SELECT * FROM tarefas
                WHERE titulo LIKE ?
                ORDER BY criada_em DESC";
    }

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $busca);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

function deletar_tarefa($conexao, $id)
{
    $sql = "DELETE FROM tarefas WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    return mysqli_stmt_execute($stmt);
}


function criar_tarefa($conexao, $titulo, $descricao)
{
    $sql = "INSERT INTO tarefas (titulo,descricao)
            VALUES (?,?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $titulo, $descricao);

    return mysqli_stmt_execute($stmt);
}

function atualizar_tarefa($conexao, $id, $titulo, $descricao, $concluida)
{
    $sql = "UPDATE tarefas
        SET titulo = ?, descricao = ?, concluida = ?
        WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssii", $titulo, $descricao, $concluida, $id);

    return mysqli_stmt_execute($stmt);
}

function atualizar_status_tarefa($conexao, $id, $concluida)
{
    $sql = "UPDATE tarefas 
            SET concluida = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $concluida, $id);

    return mysqli_stmt_execute($stmt);
}
