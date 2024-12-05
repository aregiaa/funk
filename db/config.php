
<?php

// conexao  com banco de dados


try{

    $pdo = new PDO("mysql:dbname=funk_rap;host=localhost","root","");

}catch(PDOException $e){
echo "Erro de conexao:".$e->getMessage();

}catch (Exception $e){
    echo" Erro generico:".$e->getMessage();
}
