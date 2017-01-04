<?php

require_once("classes/Tarefas.php");

if (isset($_GET["titulo"]) && isset($_GET["descricao"]) && isset($_GET["prioridade"])) {
    $result = Tarefas::incluir($_GET["titulo"], $_GET["descricao"], $_GET["prioridade"]);
    echo $result;
} else {
	echo json_encode(array ("result" => 0, "desc" => "Informar os parametros"));
}
