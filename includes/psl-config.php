<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//define("hostname", "casmproc.mysql.dbaas.com.br");     // Para o host com o qual você quer se conectar.
//define("username", "casmproc");    // O nome de usuário para o banco de dados. 
//define("password", "CasmEnseada407");    // A senha do banco de dados. 
//define("database", "casmproc");    // O nome do banco de dados. 
// 
//define("CAN_REGISTER", "any");
//define("DEFAULT_ROLE", "member");
// 
//define("SECURE", FALSE);    // ESTRITAMENTE PARA DESENVOLVIMENTO!!!!

$hostname = 'casmproc.mysql.dbaas.com.br';
$username = 'casmproc';
$password = 'CasmEnseada407';
$database = 'casmproc';

//Conexão mysql
$conexao = mysqli_connect($hostname, $username, $password, $database) or die ("Erro na conexão do banco de dados.");
mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao, 'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');