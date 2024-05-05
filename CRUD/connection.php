<?php
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'wall-e';

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    //if($conexao->connect_errno)
    //{
    //    echo 'Error';
    //}
    //else
    //{
    //    echo 'Conectado ao Banco';
    //}
 ?>