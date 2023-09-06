<?php
include('../base/classes/DB.class.php');
include('../base/classes/Funcoes.class.php');


$dbModal = new DB();

// echo 'Teste';

// $idUsuario = $_GET['id'] ?? '';

// $sqlIdUsuario = $database->get_results("SELECT * FROM usuarios WHERE id LIKE '%$idUsuario%'");
// var_dump($idUsuario);
$idExcluir = $_GET['id'];


$sqlIdUsuario = $dbModal->get_results("SELECT *,
                                            usuarios.nome as nomeUsuario,
                                            perfil.nome as perfil_Nome
                                            FROM usuarios
                                            LEFT JOIN perfil on perfil.id = usuarios.perfil_id
                                            WHERE usuarios.id = $idExcluir");


$id = $sqlIdUsuario[0]['id'];
$nome = $sqlIdUsuario[0]['nomeUsuario'];
$email = $sqlIdUsuario[0]['email'];
$senha = $sqlIdUsuario[0]['senha'];
$perfil = $sqlIdUsuario[0]['perfil_Nome'];

 echo "<form action='modals/cadastroExclui.mdl.php?acao=excluir&id=$idExcluir' method='post'>
 <p>Deseja realmente excluir esse cadastro de $nome?</p>
 <div class='modal-footer'>
     <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
     <button type='submit' class='btn btn-primary'>Excluir</button>
 </div>
</form>"
?>
<?php
            $acao = isset($_GET['acao']) ? $_GET['acao'] : null;

            if ($acao == 'excluir') {

                $dbExcluir = $dbModal->delete('usuarios', ['id' => $_GET['id']], '1');
      
                  if($dbExcluir) {
                    header("location: ../usuarios.php?msg=Usuário excluído&tipo=error");
                    exit;
                  }
                }
?>

