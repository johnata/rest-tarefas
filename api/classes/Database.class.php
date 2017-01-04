<?php
/**
 * Classe de conexao ao banco de dados usando PDO
 * Modo de Usar:
 * require_once './Database.class.php';
 * $db = Database::conexao();
 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $db.
 */
class Database
{
    ### Variavel que guarda a conexao PDO
    protected static $db;
    ### private construct - garante que a classe so possa ser instanciada internamente.
    private function __construct()
    {
        $db_host    = "{db_host}";
        $db_usuario = "{db_usuario}";
        $db_senha   = "{db_senha}";
        $db_nome    = "{db_nome}";

        try
        {
            ### atribui o objeto PDO a variavel $db
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            ### garante que o PDO lance excecoes durante erros
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            ### garante que os dados sejam armazenados com codificacao UFT-8
            self::$db->exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            ### nao carrega nada mais da pagina.
            die("Connection Error: " . $e->getMessage());
        }
    }
    ### metodo estatico - acessivel sem instanciacao
    public static function conexao()
    {
        ### Garante uma unica instancia. Se nao existe uma conexao, cria uma nova
        if (!self::$db) {
            new Database();
        }
        ### Retorna conexao
        return self::$db;
    }
}