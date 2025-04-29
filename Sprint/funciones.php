<?php
error_reporting(0);
function Conectar(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db= "bplc";
    $cnn = mysqli_connect($host, $user, $pass);
    mysqli_select_db($cnn, $db);
    return $cnn;
}
?>