<!DOCTYPE html>
<?php
require("psl-config.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();



//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if (!isset($_SESSION['login']) and ! isset($_SESSION['senha'])) {
    //Destrói
    session_destroy();

    //Limpa
    unset($_SESSION['login']);
    unset($_SESSION['senha']);

    //Redireciona para a página de autenticação
    header('location:../index.php');
}
//while ($rowuser = mysqli_fetch_assoc($usersql)) {
//    echo $rowuser['DSCNOMEUSUARIO'];
//}

$sql = mysqli_query($conexao, "select TB_ARQUIVOS.DSCNOMEARQUIVO, TB_GRUPOARQUIVO.DSCGRUPOARQUIVO, TB_ARQUIVOS.DSCDESCRICAO, TB_ARQUIVOS.DSCLINKARQUIVO from TB_ARQUIVOS, TB_GRUPOARQUIVO where TB_ARQUIVOS.TB_GRUPOARQUIVO_ID_GRUPOARQUIVO = TB_GRUPOARQUIVO.ID_GRUPOARQUIVO");


?>
<html lang="pt-br">
    <head>
        <title>Control Ambiental - Docs</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../bootstrap-3.3.7/css/bootstrap.min.css" />
        <link href="../jquery-ui-1.12.1/jquery-ui.theme.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

        <script src="../bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="../jquery-3.1.1/jquery.min.js" type="text/javascript"></script>
        <script src="../jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>  
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    </head>
    <body>
        <!--<div class="container-fluid">
            <div class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
                
            </div>    
        </div>-->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-header"><img src="../img/azinho.jpg" alt="logo" height="50" width="50"></a> 
                    <a class="navbar-brand">&nbsp; Control Ambiental</a>
                    <a class="navbar-text navbar-text"><?php
                            $usersql = mysqli_query($conexao, "SELECT TB_USUARIO.DSCNOMEUSUARIO FROM TB_USUARIO WHERE TB_USUARIO.DSCLOGIN = '".$_SESSION['login']."'");                                     
                            while ($rowuser = mysqli_fetch_assoc($usersql)) {
                            echo "Usuário conectado: ".$rowuser['DSCNOMEUSUARIO'];
}                       ?></a>
                </div>    
                <ul class="nav navbar-nav navbar-right">
            <!--      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
                    
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">    
            <h2 text-align >Arquivos disponíves:</h2>
            <p>Arquivos de manuais e formulários disponíveis para visualização ou download.</p>
            <p>Clique no ícone <img src="../img/download.png" alt="ícone" width="20" height="20"> para efetuar o download.</p> 
            <p>&nbsp;</p>
            <table class="table table-bordered table-condensed" id="listagem">
                <thead>
                    <tr>
                        <th>Arquivo</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $class = 'active';
                    while ($tabela = mysqli_fetch_assoc($sql)) {
                        echo '<tr class="' . $class . '">';
                        echo '<td> ' . $tabela['DSCNOMEARQUIVO'] . '</td>';
                        echo '<td> ' . $tabela['DSCGRUPOARQUIVO'] . '</td>';
                        echo '<td> ' . $tabela['DSCDESCRICAO'] . '</td>';
                        echo '<td style="width: 20px"><a target="_BLANK" href="' . $tabela['DSCLINKARQUIVO'] . '"><img src="../img/download.png" alt="download" title="Download" width="20" height="20"></a></td></tr>';

                        if ($class == 'active') {
                            $class = 'info';
                        } else {
                            $class = 'active';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script type="text/javascript">

            $(document).ready(function () {
                $('#listagem').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
                    }

                });
            });

        </script>



    </body>
</html>