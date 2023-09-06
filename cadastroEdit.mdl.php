<?php
include('../base/classes/DB.class.php');
include('../base/classes/Funcoes.class.php');


$dbModal = new DB();

// echo 'Teste';

// $idUsuario = $_GET['id'] ?? '';

// $sqlIdUsuario = $database->get_results("SELECT * FROM usuarios WHERE id LIKE '%$idUsuario%'");
// var_dump($idUsuario);
$idEditar = $_GET['id'];


$sqlIdUsuario = $dbModal->get_results("SELECT *,
                                            usuarios.nome as nomeUsuario,
                                            perfil.nome as perfil_Nome,
                                            perfil.id as perfil_Id
                                            FROM usuarios
                                            LEFT JOIN perfil on perfil.id = usuarios.perfil_id
                                            WHERE usuarios.id = $idEditar");


$id = $sqlIdUsuario[0]['id'];
$nome = $sqlIdUsuario[0]['nomeUsuario'];
$email = $sqlIdUsuario[0]['email'];
$senha = $sqlIdUsuario[0]['senha'];
$perfil = $sqlIdUsuario[0]['perfil_Nome'];
$perfilId = $sqlIdUsuario[0]['perfil_Id'];

echo "<form action='modals/cadastroEdit.mdl.php?acao=editar&id=$idEditar' method='post'>
    <div class='mb-3'>
        <label for='nome' class='form-label'>Nome</label>
        <input type='text' class='form-control' name='nome' value='$nome'>
    </div>
    <div class='mb-3'>
        <label for='email' class='form-label'>Email</label>
        <input type='email' class='form-control' name='email' value='$email'>
    </div>
    <div class='mb-3'>
        <label for='senha' class='form-label'>Senha</label>
        <input type='text' class='form-control' name='senha'>
    </div>
    <div class='mb-3'>
        <label for='perfil' class='form-label'>Perfil</label>
        <select class='form-control' aria-label='Large select example' name='perfil'>
            <option value='$perfilId'>$perfil</option>
            <option value='1'>Admin</option>
            <option value='2'>Comum</option>
        </select>
    </div>
    <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
        <button type='submit' class='btn btn-primary'>Salvar</button>
    </div>
</form>"
?>
<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;

if ($acao == 'editar') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];

    $data =  [
        'nome' => $nome,
        'email' => $email,
        'perfil_id' => $perfil
    ];

    if (isset($senha) && !empty($senha)) {
        $data['senha'] = md5($senha);
    }

    $dbUpdate = $dbModal->update('usuarios', $data, ['id' => $_GET['id']], '1');

    if ($dbUpdate) {
        header("location: ../usuarios.php?msg=Usuário cadastrado&tipo=error");
        exit;
    }
}
?>

