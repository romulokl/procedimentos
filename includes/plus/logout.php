<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'includes/functions.php';
sec_session_start();
 
// Desfaz todos os valores da sessão  
$_SESSION = array();
 
// obtém os parâmetros da sessão 
$params = session_get_cookie_params();
 
// Deleta o cookie em uso. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Destrói a sessão 
session_destroy();
header('Location: ../ index.php');