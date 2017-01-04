<?php
require_once("Database.class.php");

class Tarefas
{
    public function incluir($titulo, $descricao, $prioridade)
    {
        $pdo = Database::conexao();
        $sql = " /* Linha: ". __LINE__ ." - Arquivo: ". __FILE__ ." */
            INSERT INTO tb_tarefas (titulo, descricao, prioridade)
            VALUES (:titulo, :descricao, :prioridade)
        ";

        $pdo_sql = $pdo->prepare($sql);

        $pdo_sql->bindParam(":titulo",     $titulo,     PDO::PARAM_STR);
        $pdo_sql->bindParam(":descricao",  $descricao,  PDO::PARAM_STR);
        $pdo_sql->bindParam(":prioridade", $prioridade, PDO::PARAM_INT);

        if ($pdo_sql->execute()) {
            $sql = " /* Linha: ". __LINE__ ." - Arquivo: ". __FILE__ ." */
                SELECT id_tarefa
                FROM tb_tarefas
                ORDER BY id_tarefa DESC
                LIMIT 1
            ";

            $pdo_sql = $pdo->prepare($sql);

            $pdo_sql->execute();
            
            while ($row = $pdo_sql->fetch(PDO::FETCH_ASSOC)) {
                $id_tarefa = $row['id_tarefa'] ;
            }

            $result = array ("result" => 1, "id_tarefa" => $id_tarefa, "desc" => "Tarefa cadastrada com sucesso");
        } else {
            $result = array ("result" => 0, "desc" => "Falha ao incluir");
        }

        return json_encode($result);
    }
    public function alterar($id_tarefa, $titulo, $descricao, $prioridade)
    {
        $pdo = Database::conexao();
        $sql = " /* Linha: ". __LINE__ ." - Arquivo: ". __FILE__ ." */
            SELECT id_tarefa
            FROM tb_tarefas
            WHERE id_tarefa = :id_tarefa
        ";

        $pdo_sql = $pdo->prepare($sql);

        $pdo_sql->bindParam(":id_tarefa", $id_tarefa, PDO::PARAM_INT);
        $pdo_sql->execute();

        $rowCount = (int) $pdo_sql->fetchColumn();
        if ($rowCount) {
            $sql = " /* Linha: ". __LINE__ ." - Arquivo: ". __FILE__ ." */
                UPDATE tb_tarefas
                SET titulo = :titulo, descricao = :descricao, prioridade = :prioridade
                WHERE id_tarefa = :id_tarefa
            ";

            $pdo_sql = $pdo->prepare($sql);

            $pdo_sql->bindParam(":titulo",     $titulo,     PDO::PARAM_STR);
            $pdo_sql->bindParam(":descricao",  $descricao,  PDO::PARAM_STR);
            $pdo_sql->bindParam(":prioridade", $prioridade, PDO::PARAM_INT);
            $pdo_sql->bindParam(":id_tarefa",  $id_tarefa,  PDO::PARAM_INT);

            if ($pdo_sql->execute()) {
                $result = array ("result" => 1, "id_tarefa" => $id_tarefa, "desc" => "Tarefa alterada com sucesso");
            } else {
                $result = array ("result" => 0, "id_tarefa" => $id_tarefa, "desc" => "Falha ao alterar");
            }
        } else {
            $result = array ("result" => 0, "id_tarefa" => $id_tarefa, "desc" => "Tarefa inexistente");
        }

        return json_encode($result);
    }
    
    public function excluir($id_tarefa)
    {
        $pdo = Database::conexao();
        $sql = " /* Linha: ". __LINE__ ." - Arquivo: ". __FILE__ ." */
            SELECT id_tarefa
            FROM tb_tarefas
            WHERE id_tarefa = :id_tarefa
        ";

        $pdo_sql = $pdo->prepare($sql);

        $pdo_sql->bindParam(":id_tarefa", $id_tarefa, PDO::PARAM_INT);
        $pdo_sql->execute();

        $rowCount = (int) $pdo_sql->fetchColumn();
        if ($rowCount) {
            $sql = " /* Linha: ". __LINE__ ." - Arquivo: ". __FILE__ ." */
                DELETE FROM tb_tarefas
                WHERE id_tarefa = :id_tarefa
            ";

            $pdo_sql = $pdo->prepare($sql);

            $pdo_sql->bindParam(":id_tarefa", $id_tarefa, PDO::PARAM_INT);

            if ($pdo_sql->execute()) {
                $result = array ("result" => 1, "id_tarefa" => $id_tarefa, "desc" => "Tarefa removida com sucesso");
            } else {
                $result = array ("result" => 0, "id_tarefa" => $id_tarefa, "desc" => "Falha ao remover");
            }
        } else {
            $result = array ("result" => 0, "id_tarefa" => $id_tarefa, "desc" => "Tarefa inexistente");
        }

        return json_encode($result);
    }
    
    public function listar()
    {
        $pdo = Database::conexao();
        $sql = " /* Linha: ". __LINE__ ." - Arquivo: ". __FILE__ ." */
            SELECT *
            FROM tb_tarefas
            ORDER BY prioridade ASC
        ";

        $pdo_sql = $pdo->prepare($sql);

        $pdo_sql->execute();

        return json_encode($pdo_sql->fetchAll());
    }
}
