<?php
include('./base/classes/DB.class.php');
include('./base/classes/Funcoes.class.php');
$database = new DB();

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <title>Login Projeto</title>

  <?php include('./includes/header.php'); ?>
</head>


<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Admin</b>LTE</a>
    </div>


    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Faça o login para começar sua sessão</p>

        <?php
          if (@$_POST['email'] && @$_POST['senha']) {
            $email = addslashes($_POST['email']);
            $senha = md5(addslashes($_POST['senha']));

            printR($email, $senha);

          
            $sql = $database->get_results("SELECT 
                                              usuarios.* 
                                              ,perfil.nome as nome_perfil
                                              FROM usuarios 
                                              LEFT JOIN perfil on perfil.id = usuarios.perfil_id
                                              WHERE usuarios.email = '$email' AND usuarios.senha = '$senha' AND usuarios.status = 1 
                                              LIMIT 1");
          
            if (count($sql)) {
              session_start();
          
              $_SESSION['id'] = $sql[0]['id'];
              $_SESSION['user'] = $sql[0]['email']; 
              $_SESSION['perfil_id'] = $sql[0]['perfil_id'];
              $_SESSION['nome'] = $sql[0]['nome'];
              $_SESSION['nome_perfil'] = $sql[0]['nome_perfil'];

          
              header("location: home.php");
            } else {
              echo "<div class='alert alert-danger' style='margin: 10px 0px;' role='alert'>
                      Login Inválido!
                    </div>";
              unset($_POST);
              $_POST['email'] = ''; // Atualize o campo de entrada para 'email'
            }
          } else {
            unset($_POST);
            $_POST['email'] = ''; // Atualize o campo de entrada para 'email'
          }
          
        ?>


        <form action="index.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Senha" name="senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-primary btn-block" style="width: 50%; margin: 0px auto">Acessar</button>
          </div>
        </form>
        <div class="row" style="display: flex; gap: 10px;">
          <p>Ainda não possui uma conta?</p>
          <a href="cadastro.php" class="text-center">Cadastrar</a>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>


  <?php include('./includes/scripts.php'); ?>
</body>

</html>