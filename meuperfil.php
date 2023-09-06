<?php include('includes/header_home.php') ?>
<?php 
$dbUsu = new DB();?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Meu Perfil</h1>
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

                            <p class="card-text">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>NOME</th>
                                    <th>SENHA</th>
                                    <th>EMAIL</th>
                                    <th>ACOES</th>
                                </tr>
                                <?php
                                $idUsuario = $_SESSION['id'];

                               
                                $usuario = $dbUsu->get_results("SELECT * FROM usuarios WHERE usuarios.id = $idUsuario limit 1");
                                
                                $id = $usuario[0]['id'];

                                //printR($sqlUsuarios);

                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $usuario[0]['nome']; ?></td>
                                        <td></td>
                                        <td><?php echo $usuario[0]['email']; ?></td>
                                        <td><button type="button" class="btn btn-warning" onclick="abrirModalEdit(<?php echo $id;?>)">Editar</button>
                                            <button type="button" class="btn btn-danger" onclick="abrirModalExcluir(<?php echo $id;?>)">Excluir</button>
                                        </td>
                                    </tr>
                                <?php
                                
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

    function abrirModalExcluir(id){
        openModal('Excluir', 'Excluir Usuário', `./modals/comumExclui.mdl.php?id=${id}`);
    }

    function abrirModalEdit(id){
        openModal('Editar', 'Editar Usuário', `./modals/comumEdit.mdl.php`);
    }
</script>

</body>

</html>