<?php include('includes/header_home.php') ?>

<?php
$permissaoPerfil = $_SESSION['perfil_id'];

if($permissaoPerfil !== '1'){
    header("location: home.php?Não permitido");
}


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Usuários</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/home.php">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" onclick="abrirModalCadastrar()">+Novo</button>

                            <p class="card-text">


                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>NOME</th>
                                    <th>EMAIL</th>
                                    <th>PERFIL</th>
                                    <th>ACOES</th>
                                </tr>
                                <?php

                                $sqlUsuarios = $database->get_results("SELECT a.* ,b.nome as nome_perfil
                                                            FROM usuarios a
                                                            LEFT JOIN perfil b on b.id = a.perfil_id
                                                            WHERE a.status = 1 
                                                        ");

                                //printR($sqlUsuarios);


                                for ($i = 0; $i < count($sqlUsuarios); $i++) {
                                    $id = $sqlUsuarios[$i]['id'];
                                ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $sqlUsuarios[$i]['nome']; ?></td>
                                        <td><?php echo $sqlUsuarios[$i]['email']; ?></td>
                                        <td><?php echo $sqlUsuarios[$i]['nome_perfil']; ?></td>
                                        <td style="display: flex; gap:10px">
                                            <button class="btn btn-warning" onclick="abrirModal(<?php echo $id;?>)">Editar</a>
                                            <button type="button" class="btn btn-danger" onclick="abrirModalExcluir(<?php echo $id;?>)">Excluir</button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                /*foreach ($sqlUsuarios as $item) {
                       ?>
                      <tr>
                        <td><?php echo $item['id'];?></td>
                        <td><?php echo $item['nome'];?></td>
                        <td><?php echo $item['login'];?></td>
                        <td><?php echo $item['nome_perfil'];?></td>
                      </tr>
                       <?php
                      }*/
                                ?>
                            </table>
                            <?php
                            ?>

                            </p>         
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include('./includes/footer_home.php');
?>

<script>
    function abrirModal(id) {//Por aqui passa o id do onclick
        openModal('editar', 'Editar Usuário', `./modals/cadastroEdit.mdl.php?id=${id}`);//pega a function do arquivo scriptjs, passa os parametros: nome moda, titulo modal, e localização do modal passando id como parametro
    }

    function abrirModalExcluir(id){
        openModal('Excluir', 'Excluir Usuário', `./modals/cadastroExclui.mdl.php?id=${id}`);
    }

    function abrirModalCadastrar(){
        openModal('Cadastrar', 'Cadastrar Usuário', `./modals/cadastro.mdl.php`);
    }
    function abrirModalPermissao(){
        openModal('Permissao', 'Permissões de telas', `./modals/permissao.mdl.php?id=${id}`);
    }

</script>
</body>

</html>