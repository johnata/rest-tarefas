<?php

require_once("classes/Tarefas.php");

if (isset($_GET["id_tarefa"]) && isset($_GET["titulo"]) && isset($_GET["descricao"]) && isset($_GET["prioridade"])) {
    $result = Tarefas::alterar($_GET["id_tarefa"], $_GET["titulo"], $_GET["descricao"], $_GET["prioridade"]);
    echo $result;
} else {
	echo json_encode(array ("result" => 0, "desc" => "Informar os parametros")); 
}