<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "formulario_pessoa";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
if(!$conn){
    echo "Houve um erro: ".mysqli_connect_error();
 }

/*
$mysql = mysqli_connect("localhost", "root", "", "formulario_pessoa");

if(!$mysql){
    echo "Erro";
    exit;
 }
*/