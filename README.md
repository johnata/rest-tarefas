API REST

    1 - Faça upload dos arquivos na pasta que desejar;
    2 - Crie seu bando de dados e a tabela abaixo:
        CREATE TABLE `tb_tarefas` (
          `id_tarefa` int(11) NOT NULL AUTO_INCREMENT,
          `titulo` varchar(30) NOT NULL,
          `descricao` varchar(200) NOT NULL,
          `prioridade` int(11) NOT NULL,
          `dt_cad` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `dt_alt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id_tarefa`)
        ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
    3 - Altere os dados de conexão com banco de dados no Database.class.php:
        $db_host    = "{db_host}";
        $db_usuario = "{db_usuario}";
        $db_senha   = "{db_senha}";
        $db_nome    = "{db_nome}";


LISTA DE TAREFAS
    04-lista-tarefas.php
        Alterar {SEU_DOMINIO} pelo seu domínio.
