<?php
include_once 'connection.php';

if(isset($_POST['id_usuario'])) {
    $id = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $curso = $_POST['curso'];

    // Atualizar o registro no banco de dados
    $query = "UPDATE usuarios SET nome='$nome', email='$email', data_nascimento='$nascimento', curso='$curso' WHERE id='$id'";
    $resultado = $conexao->query($query);

    if($resultado) {
        // Redirecionar de volta para o index.php após a edição
        header("Location: index.php");
        exit(); // Certifique-se de que o script seja encerrado após o redirecionamento
    } else {
        echo "Erro ao atualizar o registro: " . $conexao->error;
    }
} else {
    echo "ID do usuário não fornecido.";
}
?>
