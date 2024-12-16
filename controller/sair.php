<?php
if (!isset($_SESSION)) {
    session_start();
}
session_destroy();
echo "<script>alert('Deslogado com sucesso');</script>";
header("Refresh: 1; url=../index.php?menuop=home");  // 
?>