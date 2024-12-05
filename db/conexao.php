<?php
include ("config.php");

define ("SERVIDOR","localhost");
define ("USUARIO","root");
define ("SENHA","");
define ("BANCO","funk_rap"); 

$conexao = mysqli_connect(SERVIDOR,USUARIO,SENHA,BANCO) or die("Erro na conexão".mysqli_connect_error());
