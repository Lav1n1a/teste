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
                    <h1 class="m-0">Menu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/home.php">Home</a></li>
                        <li class="breadcrumb-item active">Menu</li>
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
                        <h5 class="card-title">botao aqui</h5>

                        <p class="card-text">


                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>LINK</th>
                            </tr>
                            <?php
                            $sqlMenus = $database->get_results("SELECT 
                                                                 m.*
                                                                 FROM menu m 
                                                                 ");

                            //printR($sqlUsuarios);


                            for ($i = 0; $i < count($sqlMenus); $i++) {
                            ?>
                                <tr>
                                    <td><?php echo $sqlMenus[$i]['id']; ?></td>
                                    <td><?php echo $sqlMenus[$i]['nome']; ?></td>
                                    <td><?php echo $sqlMenus[$i]['link']; ?></td>
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include('./includes/footer_home.php');
?>


</body>

</html>