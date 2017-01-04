<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Lista de tarefas</title>

        <!-- Bootstrap -->
        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap theme -->
        <link href="./bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="./bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="./bootstrap/theme.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="./bootstrap/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="./bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Tarefas</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container theme-showcase" role="main">
            <div class="page-header">
                <h1>Lista de tarefas</h1>
            </div>
            <div class="table-responsive tb_sorted">
                <table class="table table-striped table-bordered sorted_table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Prioridade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista_tarefas = file_get_contents("http://vendingmachine.blog.br/teste/api/listarTarefas.php");
                        $lista_tarefas = json_decode($lista_tarefas, true);

                        $count = 0;
                        for ($i = 0; $i < count($lista_tarefas); $i++) {
                            $count++;
                            $id_tarefa = $lista_tarefas[$i]["id_tarefa"];
                            $titulo = $lista_tarefas[$i]["titulo"];
                            $descricao = $lista_tarefas[$i]["descricao"];
                            $prioridade = $lista_tarefas[$i]["prioridade"];
                            ?>
                                <tr>
                                    <td><?=$count?></td>
                                    <td><?=$id_tarefa?></td>
                                    <td><?=$titulo?></td>
                                    <td><?=$descricao?></td>
                                    <td><?=$prioridade?></td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="./bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="./bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="./bootstrap/assets/js/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="./bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>

        <script src="./jquery-sortable.js"></script>

        <script>
            $(function  () {
                // Sortable rows
                $('.sorted_table').sortable({
                    containerSelector: 'table',
                    itemPath: '> tbody',
                    itemSelector: 'tr',
                    placeholder: '<tr class="placeholder"/>'
                });

                // Sortable column heads
                var oldIndex;
                $('.sorted_head tr').sortable({
                    containerSelector: 'tr',
                    itemSelector: 'th',
                    placeholder: '<th class="placeholder"/>',
                    vertical: false,
                    onDragStart: function ($item, container, _super) {
                        oldIndex = $item.index();
                        $item.appendTo($item.parent());
                        _super($item, container);
                    },
                    onDrop: function  ($item, container, _super) {
                        var field,
                            newIndex = $item.index();

                        if(newIndex != oldIndex) {
                            $item.closest('table').find('tbody tr').each(function (i, row) {
                                row = $(row);
                                if(newIndex < oldIndex) {
                                    row.children().eq(newIndex).before(row.children()[oldIndex]);
                                } else if (newIndex > oldIndex) {
                                    row.children().eq(newIndex).after(row.children()[oldIndex]);
                                }
                            });
                        }

                        _super($item, container);
                    }
                });
            });
        </script>
        <style>
            .table-bordered {
                -moz-border-bottom-colors: none;
                -moz-border-left-colors: none;
                -moz-border-right-colors: none;
                -moz-border-top-colors: none;
                border-collapse: separate;
                border-color: #dddddd #dddddd #dddddd -moz-use-text-color;
                border-image: none;
                border-radius: 4px;
                border-style: solid solid solid none;
                border-width: 1px 1px 1px 0;
            }
            .table {
                margin-bottom: 18px;
                width: 100%;
            }
            table {
                background-color: transparent;
                border-collapse: collapse;
                border-spacing: 0;
                max-width: 100%;
            }

            .tb_sorted {
                margin-left: 20px;
            }

            .sorted_table tr {
                cursor: pointer;
            }

            .sorted_table tr.placeholder {
                background: red none repeat scroll 0 0;
                border: medium none;
                display: block;
                margin: 0px;
                padding: 0px;
                position: relative;
            }
            .sorted_table tr.placeholder::before {
                -moz-border-bottom-colors: none;
                -moz-border-left-colors: none;
                -moz-border-right-colors: none;
                -moz-border-top-colors: none;
                border-color: transparent -moz-use-text-color transparent red;
                border-image: none;
                border-style: solid none solid solid;
                border-width: 5px medium 5px 5px;
                content: "";
                height: 0;
                left: -5px;
                margin-top: -5px;
                position: absolute;
                width: 0;
            }
            .sorted_head th {
                cursor: pointer;
            }
            .sorted_head th.placeholder {
                background: red none repeat scroll 0 0;
                display: block;
                height: 0;
                margin: 0;
                padding: 0;
                position: relative;
                width: 0;
            }
            .sorted_head th.placeholder::before {
                -moz-border-bottom-colors: none;
                -moz-border-left-colors: none;
                -moz-border-right-colors: none;
                -moz-border-top-colors: none;
                border-color: red transparent -moz-use-text-color;
                border-image: none;
                border-style: solid solid none;
                border-width: 5px 5px medium;
                content: "";
                height: 0;
                margin-left: -5px;
                position: absolute;
                top: -6px;
                width: 0;
            }

        </style>
    </body>
</html>
