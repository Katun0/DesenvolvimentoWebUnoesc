<?php
include_once 'connection.php';

if(isset($_POST['id_usuario'])) {
    $id = $_POST['id_usuario'];

    // Preparar a instrução SQL para excluir o registro
    $stmt = $conexao->prepare("DELETE FROM usuarios WHERE id=?");

    // Vincular parâmetro e executar a instrução
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Verificar se a exclusão foi bem-sucedida
    if ($stmt->affected_rows > 0) {
        // Redirecionar de volta para o index.php após a exclusão
        header("Location: index.php");
        exit(); // Certifique-se de que o script seja encerrado após o redirecionamento
    } else {
        echo "Erro ao excluir o registro: " . $conexao->error;
    }

    // Fechar a instrução preparada
    $stmt->close();
} else {
    echo "ID do usuário não fornecido.";
}
?>
