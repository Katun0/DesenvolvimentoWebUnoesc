<?php 

if (isset($_POST['submit']));
{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $ativo = $_POST['ativo'];
    $foto = $_POST['foto'];

    include_once 'connection.php';
    
    $result = mysqli_query($conexao,"INSERT INTO usuarios (nome,email,foto,ativo,data_nascimento) VALUES ('$nome','$email','$foto','$ativo','$nascimento')");
}
?>