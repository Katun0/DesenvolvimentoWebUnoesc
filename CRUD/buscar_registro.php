<?php
include_once 'connection.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Consulta para buscar as informações do usuário com base no ID fornecido
    $query = "SELECT * FROM usuarios WHERE id = $id";
    $result = $conexao->query($query);
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Retornar os dados do usuário em formato JSON
        echo json_encode($row);
    } else {
        // Se nenhum usuário for encontrado, retornar um JSON vazio ou uma mensagem de erro
        echo json_encode(array("error" => "Usuário não encontrado"));
    }
} else {
    // Se o ID não for fornecido, retornar um JSON vazio ou uma mensagem de erro
    echo json_encode(array("error" => "ID não fornecido"));
}
?>
