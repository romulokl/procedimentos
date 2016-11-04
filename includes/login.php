<?php

require ('psl-config.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// as variáveis login e senha recebem os dados digitados na página anterior
$login = filter_input(INPUT_POST, 'txuser', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'txsenha', FILTER_SANITIZE_SPECIAL_CHARS);

//Seleciona o banco de dados
//$selecionabd = mysqli_select_db($conexao, $database) or die ("Banco de dados inexistente.");
 
//Comando SQL de verificação de autenticação
$sql = "SELECT *
FROM TB_USUARIO
WHERE DSCLOGIN = '$login'
AND DSCSENHA = SHA('$senha')";
 
$resultado = mysqli_query($conexao, $sql) or die ("Erro na seleção da tabela.");
 
//Caso consiga logar cria a sessão
if (mysqli_num_rows ($resultado) > 0) {
    
// session_start inicia a sessão
    session_start();
    
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    
    header('location:listagem.php');
}
 
//Caso contrário redireciona para a página de autenticação
else {
    //Destrói
    // if (session_status() == PHP_SESSION_ACTIVE) {
    // session_destroy();
    //}
    
    //Limpa
    unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
 
    //Redireciona para a página de autenticação
    header('location:../index.php');
     
}