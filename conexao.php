<?php
$host="localhost";
$user="root";
$pass="";
$banco="lifetool";
$conexao=mysqli_connect($host, $user, $pass, $banco);

if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
?>