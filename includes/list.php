<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require("psl-config.php");

session_start();

//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if ( !isset($_SESSION['login']) and !isset($_SESSION['senha']) ) {
    //Destrói
    session_destroy();
 
    //Limpa
    unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
     
    //Redireciona para a página de autenticação
    header('location:../index.php');
}
//$select = "select TB_ARQUIVOS.ID_ARQUIVO, TB_ARQUIVOS.DSCNOMEARQUIVO, TB_GRUPOARQUIVO.DSCGRUPOARQUIVO, TB_ARQUIVOS.DSCDESCRICAO, TB_ARQUIVOS.DSCLINKARQUIVO from TB_ARQUIVOS, TB_GRUPOARQUIVO where TB_ARQUIVOS.TB_GRUPOARQUIVO_ID_GRUPOARQUIVO = TB_GRUPOARQUIVO.ID_GRUPOARQUIVO";

$select = "select ID_USUARIO, TB_GRUPOUSUARIO_ID_GRUPOUSUARIO, DSCNOMEUSUARIO, DSCLOGIN, DSCSTATUS from TB_USUARIO";

$consulta = mysqli_query($conexao, $select);

$rows = array();
while($row = mysqli_fetch_array($consulta))
{
    $rows[] = $row;
}
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);