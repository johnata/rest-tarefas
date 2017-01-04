<?php
require_once("classes/Tarefas.php");

$result = Tarefas::listar();
echo $result;
