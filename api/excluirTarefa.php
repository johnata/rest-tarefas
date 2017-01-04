<?php
require_once("classes/Tarefas.php");

if (isset($_GET["id_tarefa"]) && $_GET["id_tarefa"] > 0) {
    $result = Tarefas::excluir($_GET["id_tarefa"]);
    echo $result;
} else {
    echo json_encode(array ("result" => 0, "desc" => "Informar o ID da tarefa"));
}