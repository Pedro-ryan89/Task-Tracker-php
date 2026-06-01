<?php

function validar_id($id)
{
    $id = (int) $id;

    if ($id <= 0) {
        echo "Tarefa invalida";
        exit;
    }

    return $id;
}


function validar_titulo($titulo)
{
    $titulo = trim($titulo ?? "");

    if ($titulo == "") {
        echo "O titulo e obrigatorio.";
        exit;
    }

    return $titulo;
}
