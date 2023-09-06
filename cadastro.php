<?php
  include('./base/classes/DB.class.php');
  include('./base/classes/Funcoes.class.php');


  $db = new DB();
?>  

<!DOCTYPE html>
<html lang="pt">

<head>
  <title>Cadastro</title>

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
        <p class="login-box-msg">Faça o Cadastro</p>

        <?php

          $acao = isset($_GET['acao']) ? $_GET['acao'] : null;
          $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
          $tipoMsg = isset($_GET['tipo']) ? $_GET['tipo'] : null;

          if($acao == 'cadastrar'){

            $nome = $_POST['nome'];
            $senha = $_POST['senha'];
            $email = $_POST['email'];
            $perfilId = 2;//comum
            $perfilStatus = 1; //ativo

            //Validacao...
            $emailExitente = $db->exists('usuarios','email', ['email' => $email] );              
            if($emailExitente){
              
              header("location: cadastro.php?msg=Email já cadastrado!Tente outro&tipo=error");
              exit;
            }

            // Inserindo
           $dbInsert = $db->insert('usuarios', [
              'nome' => $nome,
              'senha' => md5($senha),
              'email' => $email,
              'status' => $perfilStatus
            ]);

            if($dbInsert) {
              header("location: cadastro.php?msg=Usuário cadastrado&tipo=error");
              exit;
            }
          }
          

          if($msg){
            echo $msg;
          }
        ?>


        <form action="cadastro.php?acao=cadastrar" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="nome" name="nome">
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
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-primary btn-block" style="width: 50%; margin: 0px auto">Cadastrar</button>
          </div>
        </form>
        <div class="row" style="display: flex; gap: 10px;">
          <p>Já possui uma conta?</p>
          <a href="index.php" class="text-center">Login</a>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>


</body>

</html>