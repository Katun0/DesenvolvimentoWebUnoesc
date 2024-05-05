<?php 
include_once 'connection.php';


if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $curso = $_POST['curso'];

    // Preparar e executar a declaração de inserção
    $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, data_nascimento, curso) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $nascimento, $curso);
    $stmt->execute();
    $stmt->close();
}

elseif (isset($_POST['edit']))
{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $curso = $_POST['curso'];


    $stmt = $conexao->prepare("UPDATE TABLE usuarios 
    SET nome = ?, email = ?, data_nascimento = ?, curso = ?
        where id = ");
    $stmt->bind_param("ssss", $nome, $email, $nascimento, $curso);
    $stmt->execute();
    $stmt->close();
}


    $sqlRead = "SELECT * FROM usuarios";
    $read = $conexao->query($sqlRead);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <title>CRUD</title>
</head>
<body>

    <div class="top-card">
        <header>
        <h1>Desenvolvimento Web CRUD</h1>
        
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Botão para acionar modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
          Adicionar Registro
        </button>
        </header>
        <!-- Modal -->
        <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"><strong>Cadastro de Alunos</strong></h5>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post">
               <div class="menu-cadastros">    
                    <div>
                        <label>Nome Completo: </label>
                        <input type="text" placeholder="Nome" name="nome" id="nome" required>
                    </div>  

                    <div>
                        <label>E-mail: </label>
                        <input type="email" placeholder="E-mail" name="email" id="email" required>
                    </div>  

                    <div>
                        <label>Data de Nascimento: </label>
                        <input type="date" name="nascimento" id="nascimento" required>
                    </div>

                    <div>
                        <label>Curso</label>
                        <select name="curso" id="curso" required>
                            <option value="">Selecione seu Curso</option>
                            <option value="Computação">Computação</option>
                            <option value="Psicologia">Psicologia</option>
                            <option value="Farmacia">Farmacia</option>
                            <option value="Pedagogia">Pedagogia</option>
                            <option value="Ed. Fisica">Ed. Fisica</option>
                            <option value="Design">Design</option>
                            <option value="Arquitetura">Arquitetura</option>
                        </select>
                    </div>
                </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn-btn-secondary-fechar" data-dismiss="modal"><strong>Cancelar</strong></button>
                        <button type="submit" name="submit" class="btn-btn-secondary-salvar"><strong>Salvar Alterações</strong></button>
                    </div>
                </div>
            </form>
            </div>
          </div>
        </div>
    </div>



    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
            </div>
            <div class="modal-body">
                <form action="editar_registro.php" method="post">
                    <!-- Campos de edição -->
                    <input type="hidden" name="id_usuario" id="id_usuario">
                    <div class="menu-cadastros">   
                    
                    <div class="inputbox">
                        <label>Nome Completo: </label>
                        <input type="text" placeholder="Nome" name="nome" id="nome_edit" required>
                    </div>  

                    <div class="inputbox">
                        <label>E-mail: </label>
                        <input type="email" placeholder="E-mail" name="email" id="email_edit" required>
                    </div>  

                    <div class="inputbox">
                        <label>Data de Nascimento: </label>
                        <input type="date" name="nascimento" id="nascimento_edit" required>
                    </div>

                    <div class="inputbox">
                        <label>Curso</label>
                        <select name="curso" id="curso_edit" required>
                            <option value="">Selecione seu Curso</option>
                            <option value="Computação">Computação</option>
                            <option value="Psicologia">Psicologia</option>
                            <option value="Farmacia">Farmacia</option>
                            <option value="Pedagogia">Pedagogia</option>
                            <option value="Ed. Fisica">Ed. Fisica</option>
                            <option value="Design">Design</option>
                            <option value="Arquitetura">Arquitetura</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-btn-secondary-fechar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="submit" class="btn-btn-secondary-salvar">Salvar Alterações</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.btn-editar').click(function(){
            var id = $(this).data('id');
            $.ajax({
                url: 'buscar_registro.php',
                type: 'POST',
                data: {id: id},
                dataType: 'json',
                success: function(response){
                    $('#id_usuario').val(response.id);
                    $('#nome_edit').val(response.nome);
                    $('#email_edit').val(response.email);
                    $('#nascimento_edit').val(response.data_nascimento);
                    $('#curso_edit').val(response.curso);
                }
            });
        }); 
    });
</script>


<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"><strong>Tem certeza que deseja deletar esse registro ?</strong></h5>
            </div>
            
            <div class="modal-body">
                <form action="deletar_registro.php" method="post">

                    <input type="hidden" name="id_usuario" id="id_usuario_delete"> <!-- Adicione este input hidden -->

                    <button type="button" class="btn-Cancel" data-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" name="submit" class="btn-Delete">
                        Deletar
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.btn-btn-delete').click(function(){
        var id = $(this).data('id');
        // Envie o ID do usuário para o script PHP de exclusão
        $('#id_usuario_delete').val(id); // Adicione esta linha para definir o valor do input hidden
    });
});
</script>

    <Div class="menu">
        <table class="grid" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($user_data = mysqli_fetch_assoc($read))
                {
                    echo "<tr>";

                    echo "<td>".$user_data['id']."</td>";
                    echo "<td>".$user_data['nome']."</td>";
                    echo "<td>".$user_data['email']."</td>"; 
                    echo "<td>".$user_data['data_nascimento']."</td>";
                    echo "<td>".$user_data['curso']."</td>";
                    echo "<td> 
                    <button class='btn-editar' data-toggle='modal' data-target='#modalEditar' data-id=".$user_data['id']. "><i class='fa-solid fa-pen-to-square'></i></button>

                    <button class='btn-btn-delete' data-toggle='modal' data-target='#modalDelete' data-id=".$user_data['id']. "><i class='fa-solid fa-trash-can'></i></i></button>
                    </td>";
                    

                    
                }
                ?>
            </tbody>
        </table>
    </Div>
</body>
</html>