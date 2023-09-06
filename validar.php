<?php
session_start();

if(isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
} else {
    session_destroy();
    header("location: sair.php?msg=Tentativa Invalida");
}
?>